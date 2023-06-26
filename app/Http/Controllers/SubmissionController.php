<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Models\Competition;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create(int $id): View
    {
        $competition = Competition::findOrFail($id);
        $user = User::find(Auth()->id());

        $this->authorize('create-submission', $competition);

        $amountOfSubmissions = $user->submissions->where('competition_id', $id)->count();

        return view('submission.create', [
            'competition' => $competition,
            'limitReached' => ($amountOfSubmissions >= $competition->submissions_limit)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubmissionRequest $request): RedirectResponse
    {
        $request->validated();

        $amountOfSubmissions = User::find(Auth()->id())->submissions->where('competition_id', $request->competition_id)->count();
        $submissionsLimit = Competition::find($request->competition_id)->submissions_limit;
        if ($amountOfSubmissions >= $submissionsLimit) {
            return back();
        }

        $submission = new Submission();
        $submission['title'] = $request['title'];
        $submission['description'] = $request['description'];
        $submission['user_id'] = Auth::id();
        $submission['competition_id'] = $request['competition_id'];

        if ($request['submission_url'] != null) {
            $submission['submission_image'] = '';
            $submission['submission_url'] = $request['submission_url'];
        }

        if ($request->hasFile('submission_image')) {
            $submission['submission_url'] = '';

            $image = $request->file('submission_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/uploads', $filename);

            $submission['submission_image'] = 'storage/uploads/' . $filename;
        }

        $submission->save();
        $competition = Competition::find($request['competition_id']);

        return redirect(route('competition.show', ['competition' => $competition]));

    }


    public function mySubmissions(): View
    {
        $user = Auth::user();
        $mySubmissions = $user->submissions->sortBy(function ($submission) {
            return $submission->competition->title;
        });
        $competition = $user->competitions;

        return view('submission.mysubmissions', compact('mySubmissions', 'competition'));
    }


    public function destroy(Competition $competition, Submission $submission): RedirectResponse
    {
        if ($submission->is_winning_submission || (!$submission->hasBeenPostedBy(Auth::user()) && !Auth::user()->isCompetitionOwner($competition))) {
            return abort(403);
        }

        $submission->delete();
        flash('De inzending is succesvol verwijderd.');

        return redirect(route('competition.show', ['competition' => $competition]));
    }
}
