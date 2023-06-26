<?php

namespace App\Http\Controllers;

use App\Http\Requests\API;
use App\Http\Requests\API\APICustomLinkRequest;
use App\Http\Requests\API\APIMarkAsWinnerRequest;
use App\Http\Requests\API\APIPostScoreRequest;
use App\Http\Requests\API\RegisterAPIRequest;
use App\Models\Competition;
use App\Models\CompetitionUser;
use App\Models\CustomLink;
use App\Models\Enums\CompetitionPublicationStatus;
use App\Models\Rating;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class APIController extends Controller
{
    public function getAllCompetitions(): \Illuminate\Http\JsonResponse
    {
        $competitions = Competition::all();
        if(!$competitions){
            return response()->json(['message' => 'Competitions not found!']);
        }
        return response()->json($competitions);
    }


    public function getCompetititionById(int $id): \Illuminate\Http\JsonResponse
    {
        $competition = Competition::find($id);
        if(!$competition){
            return response()->json(['message' => 'Competition not found!']);
        }
        return response()->json($competition);
    }


    public function getRatingsFromSubmission(int $id): \Illuminate\Http\JsonResponse
    {
        $submission = Competition::find($id);
        if(!$submission) {
            return response()->json(['message' => 'Competition not found!']);
        }

        $submission = Submission::with('ratings')->find($id);
        $ratings = $submission->ratings;

        return response()->json($ratings);
    }


    public function getAverageFromSubmission(int $id): \Illuminate\Http\JsonResponse
    {
        $submission = Competition::find($id);
        if(!$submission){
            return response()->json(['message' => 'Competition not found!']);
        }

        $submission = Submission::with('ratings')->find($id);
        $averageScore = round($submission->ratings->avg('rating'), 1);

        return response()->json($averageScore);
    }


    public function getAllCompetitionSubmissions($competitionId): \Illuminate\Http\JsonResponse
    {
        $competition = Competition::find($competitionId);

        if (!$competition) {
            return response()->json(['message' => 'Competition not found!']);
        }

        $submissions = $competition->submissions;

        if ($submissions->isEmpty()) {
            return response()->json(['message' => 'Submissions not found for the specified competition!']);
        }

        return response()->json($submissions);
    }


    public function getAllSubmissions(): \Illuminate\Http\JsonResponse
    {
        $submissions = Submission::all();

        if ($submissions->isEmpty()) {
            return response()->json(['message' => 'No submissions found!']);
        }

        return response()->json($submissions);
    }


    public function getCompetitionsByUser(int $id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        if(!$user) {
            return response()->json(['message' => 'User not found!']);
        }

        $competitions = $user->competitions;

        if ($competitions->isEmpty()) {
            return response()->json(['message' => 'Competitions not found for the specified user!']);
        }

        return response()->json($competitions);
    }


    public function getSubmissionsByUser(int $id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        if(!$user) {
            return response()->json(['message' => 'User not found!']);
        }

        $submissions = $user->submissions;

        if ($submissions->isEmpty()) {
            return response()->json(['message' => 'Submissions not found for the specified user!']);
        }

        return response()->json($submissions);
    }


    public function getGivenRatingsByUser(int $id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        if(!$user) {
            return response()->json(['message' => 'User not found!']);
        }

        $ratings = $user->ratings;

        if ($ratings->isEmpty()) {
            return response()->json(['message' => 'Ratings not found for the specified user!']);
        }

        return response()->json($ratings);
    }


    public function getUserInfo(int $id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        if(!$user) {
            return response()->json(['message' => 'User not found!']);
        }

        return response()->json($user);
    }


    public function getAllUserInfo(): \Illuminate\Http\JsonResponse
    {
        return response()->json(User::all());
    }


    public function createCompetition(API\APIStoreCompetitionRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        $competition = new Competition();
        $competition->fill($validated);

        $competition['owner_id'] = $request->owner_id;
        $competition['publication_status'] = $request->publication_status;
        $competition['submissions_limit'] = $request->submissions_limit;
        $competition->save();

        $competitionUser = new CompetitionUser();
        $competitionUser['competition_id'] = $competition->id;
        $competitionUser['user_id'] = $request->owner_id;
        $competitionUser->save(['competition_id', 'user_id']);

        return response()->json(['message' => 'Competition is created successfully!']);
    }


    public function createSubmissionForCompetition(API\APIStoreSubmissionRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $user = User::find($request->user_id);
        if(!$user) {
            return response()->json(['message' => 'User not found!']);
        }

        $amountOfSubmissions = $user->submissions->where('competition_id', $request->competition_id)->count();
        $submissionsLimit = Competition::find($request->competition_id)->submissions_limit;
        if ($amountOfSubmissions >= $submissionsLimit) {
            return response()->json(['message' => 'Submission limit is reached!']);
        }

        $submission = new Submission();
        $submission->fill($validated);

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

        $submission['user_id'] = $user->id;
        $submission['competition_id'] = $request['competition_id'];
        $submission->save();

        return response()->json(['message' => 'Submission is created successfully!']);
    }


    public function publishCompetition(API\APIPublishCompetitionRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->validated();

        $competition = (new \App\Models\Competition)->find($request->competition_id);

        if(!$competition) {
            return response()->json(['message' => 'Competition not found!']);
        }

        if($competition['publication_status'] == CompetitionPublicationStatus::Published) {
            return response()->json(['message' => 'Competition is already published!']);
        }

        $competition['publication_status'] = CompetitionPublicationStatus::Published->value;
        $competition->save();
        return response()->json(['message' => 'Competition has been published!']);
    }


    public function editCompetition(API\EditCompetitionAPIRequest $request): \Illuminate\Http\JsonResponse
    {
        $competition = Competition::find($request->competition_id);
        if(!$competition) {
            return response()->json(['message' => 'Competition not found!']);
        }

        $validated = $request->validated();
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

        return response()->json(['message' => 'Competition is successfully edited!']);
    }


    public function generateCompetitionLink(APICustomLinkRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->validated();

        $competition = Competition::find($request->competition_id);
        if(!$competition) {
            return response()->json(['message' => 'Competition not found!']);
        }

        if (CustomLink::where('competition_id', $request->competition_id)->exists()) {
            return response()->json(['message' => 'There already is a custom link for this competition!']);
        }

        if (CustomLink::where('link_url', $request->custom_link)->exists()) {
            return response()->json(['message' => 'Cusotom link already in use. Use another link']);
        }

        $link = new CustomLink();
        $link['link_url'] = Env::get('APP_URL') . '/uitnodiging/' . $request->input('custom_link');
        $link['competition_id'] = $request->input('competition_id');
        $link->save();

        return response()->json(['message' => 'Custom link has been created!']);
    }


    public function joinCompetitionAsUser(Request $request): \Illuminate\Http\JsonResponse
    {
        $competition = Competition::find($request->competition_id);

        if(!$competition) {
            return response()->json(['message' => 'Competition not found!']);
        }

        $existingParticipant = CompetitionUser::where('competition_id', $request->competition_id)
            ->where('user_id', $request->user_id)
            ->first();

        if($existingParticipant) {
            return response()->json(['message' => 'User is already participating in the competition!']);
        }

        if ($competition->private) {
            $message = 'Successfully participation requested!';
        } else {
            $message = 'Successfully joined!';
        }

        $competitionUser = new CompetitionUser();
        $competitionUser['competition_id'] = $request->competition_id;
        $competitionUser['user_id'] = $request->user_id;
        $competitionUser->save(['competition_id', 'user_id']);

        return response()->json(['message' => $message]);
    }


    public function markSubmissionAsWinner(APIMarkAsWinnerRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->validated();

        $competition = Competition::find($request->competition_id);
        if(!$competition) {
            return response()->json(['message' => 'Competition not found!']);
        }

        $submission = Submission::find($request->submission_id);
        if(!$submission) {
            return response()->json(['message' => 'Submission not found!']);
        }

        $competition->winning_submission_id = $request->submission_id;
        $competition->save();

        return response()->json(['message' => 'Submission has been marked as winner!']);
    }


    public function createRatingForSubmission(APIPostScoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $competition = Competition::find($request->competition_id);
        if(!$competition) {
            return response()->json(['message' => 'Competition not found!']);
        }

        $submission = Submission::find($request->submission_id);
        if(!$submission) {
            return response()->json(['message' => 'Submission not found!']);
        }

        $existingRating = Rating::where('submission_id', $request->submission_id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($existingRating) {
            return response()->json(['message' => 'Submission is already rated by this user!']);
        }


        $rating = new Rating();
        $rating->rating = $request->rating;
        $rating->comment = $request->comment ?? '';
        $rating->submission_id = $request->submission_id;
        $rating->user_id = $request->user_id;
        $rating->save();
        return response()->json(['message' => 'Rating is added for the submission!']);
    }

    public function registerUser(RegisterAPIRequest $request)
    {
        $fields = $request->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
