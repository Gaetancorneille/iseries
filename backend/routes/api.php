<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\SeasonController;
use App\Http\Controllers\Api\EpisodeController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\SurveyController;
use App\Http\Controllers\Api\QuizController;

Route::prefix('v1')->group(function () {

    // ─── Auth publique ───────────────────────────────────────────────────────
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);

    // ─── Lecture publique ────────────────────────────────────────────────────
    Route::get('search',        [SearchController::class, 'index']);
    Route::get('articles',      [ArticleController::class, 'index']);
    Route::get('articles/{id}', [ArticleController::class, 'show']);
    Route::get('series',        [SeriesController::class,  'index']);
    Route::get('series/{id}',   [SeriesController::class,  'show']);

    // Saisons & épisodes — lecture publique
    Route::get('series/{seriesId}/seasons',                                         [SeasonController::class,  'index']);
    Route::get('series/{seriesId}/seasons/{seasonNumber}',                          [SeasonController::class,  'show']);
    Route::get('series/{seriesId}/seasons/{seasonNumber}/episodes',                 [EpisodeController::class, 'index']);
    Route::get('series/{seriesId}/seasons/{seasonNumber}/episodes/{episodeNumber}', [EpisodeController::class, 'show']);

    // ─── Routes protégées (JWT requis) ───────────────────────────────────────
    Route::middleware('auth:api')->group(function () {

        // Auth
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me',      [AuthController::class, 'me']);

        // Articles — écriture
        Route::post('articles',        [ArticleController::class, 'store']);
        Route::put('articles/{id}',    [ArticleController::class, 'update']);
        Route::delete('articles/{id}', [ArticleController::class, 'destroy']);

        // Series — écriture
        Route::post('series',        [SeriesController::class, 'store']);
        Route::put('series/{id}',    [SeriesController::class, 'update']);
        Route::delete('series/{id}', [SeriesController::class, 'destroy']);

        // Saisons — écriture
        Route::post('series/{seriesId}/seasons',                       [SeasonController::class, 'store']);
        Route::put('series/{seriesId}/seasons/{seasonNumber}',         [SeasonController::class, 'update']);
        Route::delete('series/{seriesId}/seasons/{seasonNumber}',      [SeasonController::class, 'destroy']);

        // Épisodes — écriture
        Route::post('series/{seriesId}/seasons/{seasonNumber}/episodes',                         [EpisodeController::class, 'store']);
        Route::put('series/{seriesId}/seasons/{seasonNumber}/episodes/{episodeNumber}',          [EpisodeController::class, 'update']);
        Route::delete('series/{seriesId}/seasons/{seasonNumber}/episodes/{episodeNumber}',       [EpisodeController::class, 'destroy']);

        // Favoris
        Route::get('favorites',              [FavoriteController::class, 'index']);
        Route::post('favorites',             [FavoriteController::class, 'store']);
        Route::post('favorites/toggle',      [FavoriteController::class, 'toggle']);
        Route::get('favorites/check/{seriesId}', [FavoriteController::class, 'check']);
        Route::delete('favorites/{seriesId}', [FavoriteController::class, 'destroy']);

        // Surveys
        Route::get('surveys',                      [SurveyController::class, 'index']);
        Route::get('surveys/{id}',                 [SurveyController::class, 'show']);
        Route::post('surveys',                     [SurveyController::class, 'store']);
        Route::post('surveys/{id}/submit',         [SurveyController::class, 'submit']);
        Route::get('surveys/{id}/results',         [SurveyController::class, 'results']);

        // Quizzes
        Route::get('quizzes',                              [QuizController::class, 'index']);
        Route::get('quizzes/{id}',                         [QuizController::class, 'show']);
        Route::post('quizzes',                             [QuizController::class, 'store']);
        Route::post('quizzes/{id}/start',                  [QuizController::class, 'start']);
        Route::post('quizzes/attempts/{id}/submit',        [QuizController::class, 'submit']);
        Route::get('quizzes/{id}/results',                 [QuizController::class, 'results']);
    });
});
