<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']); // Login to API


// Protected
Route::middleware(['auth:sanctum'])->group(function () {
    // GET
    // Competitions
    Route::get('/competitions/all', [\App\Http\Controllers\APIController::class, 'getAllCompetitions']);
    Route::get('/competition/{id}', [\App\Http\Controllers\APIController::class, 'getCompetititionById']);

    // Submissions && Ratings
    Route::get('/submissions/all', [\App\Http\Controllers\APIController::class, 'getAllSubmissions']);
    Route::get('/submission/{id}/ratings', [\App\Http\Controllers\APIController::class, 'getRatingsFromSubmission']);
    Route::get('/submission/{id}/average', [\App\Http\Controllers\APIController::class, 'getAverageFromSubmission']);
    Route::get('/competition/{competitionId}/submissions', [\App\Http\Controllers\APIController::class, 'getAllCompetitionSubmissions']);

    // Users
    Route::get('/user/{id}', [\App\Http\Controllers\APIController::class, 'getUserInfo']);
    Route::get('/users/all', [\App\Http\Controllers\APIController::class, 'getAllUserInfo']);
    Route::get('/user/{id}/joined-competitions', [\App\Http\Controllers\APIController::class, 'getCompetitionsByUser']);
    Route::get('/user/{id}/submissions', [\App\Http\Controllers\APIController::class, 'getSubmissionsByUser']);
    Route::get('/user/{id}/given-ratings', [\App\Http\Controllers\APIController::class, 'getGivenRatingsByUser']);


    // POST
    // Competitions
    Route::post('/competition/create', [\App\Http\Controllers\APIController::class,'createCompetition']);
    Route::post('/competition/join', [\App\Http\Controllers\APIController::class,'joinCompetitionAsUser']);
    Route::post('/competition/generatelink', [\App\Http\Controllers\APIController::class,'generateCompetitionLink']);
    Route::post('/competition/edit', [\App\Http\Controllers\APIController::class,'editCompetition']);
    Route::post('/competition/publish', [\App\Http\Controllers\APIController::class,'publishCompetition']);

    // Submissions
    Route::post('/competition/submission/create', [\App\Http\Controllers\APIController::class,'createSubmissionForCompetition']);
    Route::post('/submission/markaswinner', [\App\Http\Controllers\APIController::class,'markSubmissionAsWinner']);

    // Ratings
    Route::post('/competition/rating/create', [\App\Http\Controllers\APIController::class,'createRatingForSubmission']);

    // Users
    Route::post('/user/register', [\App\Http\Controllers\APIController::class,'registerUser']);
});

























