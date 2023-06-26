<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CustomLinkController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubmissionsRatingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('competition.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/info', function () {
    return view('info.info');
});

Auth::routes();

Route::controller(CompetitionController::class)->group(function () {
    Route::get('/competition/owned', 'ownedIndex')->name('competition.ownedIndex');

    Route::get('/competition/joined', 'joinedIndex')->name('competition.joinedIndex');
    Route::get('/competition/{competition}/join/', 'join')->name('user.join');

    Route::put('/competition/{competition}/toggleActive', 'toggleActive')->name('competition.toggleActive');
    Route::patch('/competition/{competition}/publish/', 'publish')->name('competition.publish');

    Route::patch('/competition/{competition}/{user}/acceptUser', 'acceptUser')->name('competition.acceptUser');
    Route::delete('/competition/{competitionId}/remove-user/{userId}', 'removeUser')->name('competition.removeUser');


    Route::resource('competition', CompetitionController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update']);
});

Route::controller(SubmissionController::class)->group(function () {
    Route::resource('competition.submission', SubmissionController::class)->only(['create', 'store', 'destroy']);
    Route::get('submission/mysubmissions', 'mySubmissions')->name('submission.mysubmissions');
});

Route::controller(SubmissionsRatingController::class)->group(function () {
    Route::get('/submissions/{submission}/ratings', 'ShowRatingsForSubmission')->name('submissions.showRatingsForSubmission');
    Route::post('/submission/{submission}/pickWinner/', 'pickWinner')->name('submission.pickWinner');
    Route::post('/submission/{submission}/rate', 'postScore')->name('submission.postScore');
    Route::post('/submission/{submission}/winnerText', 'postWinnerText')->name('submission.postWinnerText');
    Route::delete('/submission/ratings/{ratingId}/destroy', 'destroy')->name('ratings.destroy');
    Route::post('/submission/{submissionId}/update-score', 'updateScore')->name('submission.updateScore');
});

Route::controller(CustomLinkController::class)->group(function () {
    Route::post('/uitnodiging/aanmaken/{competition}', [CustomLinkController::class, 'store'])->name('customlink.store');
    Route::get('/uitnodiging/{custom_url}', 'index')->name('customlink.get');
});
