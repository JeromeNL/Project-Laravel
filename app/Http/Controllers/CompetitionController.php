<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompetitionRequest;
use App\Http\Requests\ToggleActiveCompetitionRequest;
use App\Http\Requests\UpdateCompetitionRequest;
use App\Models\Competition;
use App\Models\CompetitionUser;
use App\Models\CustomLink;
use App\Models\Enums\CompetitionPublicationStatus;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\RemovedUser;

class CompetitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     */

    public function index(): View
    {
        $user = Auth::user();
        $publishedStatus = CompetitionPublicationStatus::Published->value;

        $competitions = Competition::where('publication_status', $publishedStatus)->where('private', false);
        if (Auth::check()) {
            $competitions->orWhere('owner_id', $user->id);
            $joined = $user->competitions;
        } else {
            $joined = [];
        }

        $competitions = $competitions->get();

        return view('competition.index', compact('competitions', 'joined'));
    }


    public function join($competitionId): RedirectResponse
    {
        $competition = Competition::find($competitionId);
        $userId = Auth::id();

        $removedUser = RemovedUser::where('competition_id', $competitionId)
            ->where('user_id', $userId)
            ->first();

        if ($removedUser) {
            flash('Je bent eerder verwijderd van de competitie dus je kan niet meer meedoen.', 'error');
        } else if($competition) {
            if ($competition->private) {
                $message = 'Deelname succesvol aangevraagd!';
            } else {
                $message = 'Succesvol deelgenomen!';
            }

            $competitionUser = new CompetitionUser();
            $competitionUser->competition_id = $competitionId;
            $competitionUser->user_id = $userId;
            $competitionUser->save();

            flash($message);
        }
        return back();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $possiblePublicationStatuses = CompetitionPublicationStatus::getPossiblePublicationStatuses();
        return view('competition.create', compact('possiblePublicationStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompetitionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $competition = new Competition();
        $competition->fill($validated);

        $competition['owner_id'] = Auth::id();
        $competition['publication_status'] = $request->publication_status;
        $competition['submissions_limit'] = $request->submissions_limit;
        $competition->save();

        flash('Je hebt succesvol de competitie aangemaakt!');
        return redirect(route('competition.show', $competition->id));
    }


    public function edit($competition): View|RedirectResponse
    {
        $competition = Competition::find($competition);
        if (!Auth::user()->isCompetitionOwner($competition)) {
            abort(403);
        }
        $possiblePublicationStatuses = CompetitionPublicationStatus::getPossiblePublicationStatuses();
        return view('competition.edit', compact('competition', 'possiblePublicationStatuses'));
    }


    public function update($competition, UpdateCompetitionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $competition = Competition::find($competition);

        $competition->fill($validated);

        $competition->save();

        if ($competition->custom_link_alias != $validated['custom_link']) {
            $customLink = CustomLink::where('competition_id', $competition->id)->first();
            if ($customLink == null) {
                $customLink = new CustomLink();
                $customLink['competition_id'] = $competition->id;
            }
            $customLink['link_url'] = Env::get('APP_URL') . '/uitnodiging/' . $validated['custom_link'];
            $customLink->save();
        }

        flash("De competitie is succesvol aangepast!");

        return redirect(route('competition.show', $competition->id));
    }


    public function publish($competitionId): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $competition = Competition::find($competitionId);
        $competition['publication_status'] = CompetitionPublicationStatus::Published->value;
        $competition->save();
        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(Competition $competition)
    {
        $this->authorize('show', $competition);

        $submissions = Submission::with(['user', 'ratings'])->where('competition_id', $competition->id)->get();
        $competition = Competition::with('user')->find($competition->id);
        $removedUsers = RemovedUser::where('competition_id', $competition->id)->get();
        $user = Auth::user();
        $joined = $user ? $user->competitions : null;
        $hasWinner = $competition->winning_submission_id != null;
        $hasCustomLink = CustomLink::where('competition_id', $competition->id)->exists();
        $hasCustomLink ? $customLink = $competition->customLink->link_url : $customLink = "";
        $usersWithJoinRequests = $competition->users()->wherePivot('accepted', null)->get();
        $joinedUsers = $competition->users()->where('id', '!=', $competition->owner_id)->get(); // Retrieve all joined users except the owner

        $hasWinner ? $winningSubmissionUrl = Submission::find($competition->winning_submission_id)->submission_url : $winningSubmissionUrl = "";
        $hasWinner ? $winningSubmissionImage = Submission::find($competition->winning_submission_id)->submission_image : $winningSubmissionImage = "";

        $winningSubmission = Submission::with('winningSubmissionQuotes')->find($competition->winning_submission_id);

        $winnerEmail = "";
        if ($hasWinner) {
            $winnerID = Submission::find($competition->winning_submission_id)->user_id;
            $winnerEmail = User::find($winnerID)->email;
        }

        $fileIsPdf = (pathinfo($winningSubmissionUrl, PATHINFO_EXTENSION) == 'pdf' || pathinfo($winningSubmissionImage, PATHINFO_EXTENSION) == 'pdf');

        return view('competition.show')
            ->with(compact('submissions', 'competition', 'customLink', 'winningSubmissionUrl', 'winnerEmail', 'winningSubmissionImage', 'fileIsPdf', 'joined', 'user', 'winningSubmission', 'usersWithJoinRequests', 'joinedUsers', 'removedUsers'));
    }


    public function removeUser($competitionId, $userId)
    {
        $competition = Competition::find($competitionId);
        $user = User::find($userId);

        if ($competition && $user) {
            $user->ratings()->whereIn('submission_id', $competition->submissions->pluck('id'))->delete();
            $user->submissions()->where('competition_id', $competition->id)->delete();
            $competition->users()->detach($user);

            $removedUser = RemovedUser::create([
                'competition_id' => $competition->id,
                'user_id' => $user->id,
                'is_removed' => true,
            ]);

            flash('Gebruiker succesvol verwijderd');
        } else {
            flash('Kan gebruiker niet verwijderen', 'error');
        }
        return back();
    }


    public function joinedIndex(): View
    {
        $user = Auth::user();
        $joinedCompetitions = $user->competitions;

        return view('competition.joinedIndex', compact('joinedCompetitions'));
    }


    public function ownedIndex(): View
    {
        $user = Auth::user();
        $ownedCompetitions = Competition::where('owner_id', $user->id)->get();
        $joinedCompetitions = $user->competitions;

        return view('competition.ownedIndex', compact('ownedCompetitions', 'joinedCompetitions'));
    }


    public function toggleActive(ToggleActiveCompetitionRequest $request): RedirectResponse
    {
        $request = $request->validated();
        $competition = Competition::find($request['competition_id']);

        $isResumed = !$competition->active;
        $competition->toggleActive();

        if ($isResumed) {
            $competition->winning_submission_id = null;
            $competition->save();
        }

        return redirect(route('competition.show', $competition->id));
    }


    public function acceptUser(Request $request, $competitionId, $userId): RedirectResponse
    {
        $user = User::find($userId);
        $user->competitions()->updateExistingPivot($competitionId, ['accepted' => $request->accepted]);

        return back();

    }
}
