<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkAsWinnerRequest;
use App\Http\Requests\PostWinnerRequest;
use App\Models\Competition;
use App\Models\Rating;
use App\Models\Submission;
use App\Models\WinningSubmissionQuote;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\UpdateScoreRequest;

class SubmissionsRatingController extends Controller
{
    public function postScore(Request $request)
    {
        $user = Auth::user();

        $competitionId = $request->input('competition_id');
        $competition = Competition::findOrFail($competitionId);

        $this->authorize('evaluate-submission', $competition);

        $requestArray = $request->all();
        foreach ($requestArray as $key => $value) {
            if (preg_match('/^rating\d+$/', $key)) {
                $request['rating'] = $value;
                unset($request[$key]);
            }
        }

        $request->validate([
            'rating' => 'required|between:0.5,5.0',
            'submission_id' => 'required|integer',
            'competition_id' => 'required|integer',
            'comment' => 'nullable|max:255'
        ], [
            'rating.required' => 'Selecteer een geldig aantal sterren!',
            'comment.max' => 'Comment kan niet langer zijn dan :max characters.'
        ]);

        $rating = new Rating();
        $rating->rating = $request->rating;
        $rating->comment = $request->comment ?? '';
        $rating->submission_id = $request->submission_id;
        $rating->user_id = Auth::id();
        $rating->save();

        flash('Beoordeling is succesvol toegevoegd!');
        return redirect()->route('competition.show', $request->competition_id);
    }


    public function PickWinner(MarkAsWinnerRequest $request): RedirectResponse
    {
        $request->validated();

        $competition = Competition::find($request->competition_id);

        if (!Auth::user()->isCompetitionOwner($competition)) {
            abort(403, 'Je bent niet de eigenaar van deze wedstrijd!');
        }

        $competition->winning_submission_id = $request->submission_id;
        $competition->save();

        flash('De winnaar is gekozen!', 'alert alert-success');
        return redirect()->route('competition.show', $request->competition_id);
    }
    public function updateScore(UpdateScoreRequest $request)
    {
        $submissionId = $request->input('submission_id');
        $submission = Submission::findOrFail($submissionId);

        $competition = $submission->competition;
        $this->authorize('evaluate-submission', $competition);

        $rating = $submission->ratings()->where('user_id', Auth::id())->first();
        $rating->rating = $request->input('rating');
        $rating->comment = $request->input('comment', null);
        $rating->save();

        flash('Beoordeling is succesvol bijgewerkt!');
        return redirect()->route('competition.show', $submission->competition_id);
    }


    public function postWinnerText(PostWinnerRequest $request, WinningSubmissionQuote $winner, Submission $submission)
    {
        $request->validated();

        $name = $request->input('winner_name');
        $message = $request->input('message');

        $messageCount = WinningSubmissionQuote::where('submission_id', $submission->id)->whereNotNull('winner_text')->count();
        if ($messageCount >= 3) {
            flash()->error('Je hebt het maximale aantal teksten geplaatst.');
            return redirect()->back();
        }

        $winner->winner_text = $message;
        $winner->name = $name;
        $winner->submission_id = $submission->id;
        $winner->save();

        return redirect()->route('competition.show', $submission->competition_id);
    }


    public function ShowRatingsForSubmission(Submission $submission): View
    {
        $submission = Submission::with('ratings')->find($submission->id);

        $averageScore = round($submission->ratings->avg('rating'), 1);

        $ratings = $submission->ratings->sortBy(function ($rating) {
            return $rating->user_id === auth()->id() ? 0 : 1;
        });

        return view('submissionsrating.showRatingsForSubmission', compact('submission', 'ratings', 'averageScore'));
    }

    public function destroy($ratingId) : RedirectResponse
    {
        try {
            Rating::destroy($ratingId);
        } catch (Exception $e) {
            flash('Er is iets misgegaan.', 'alert alert-danger');
            return back();
        }

        flash('Beoordeling succesvol verwijderd.', 'alert alert-success');

        return back();
    }
}
