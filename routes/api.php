<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\QuoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::pattern('id', '[0-9]+');

Route::get('/questionnaires/{id}/quotes', [QuestionnaireController::class, 'getQuotes']);

Route::post('/questionnaire/{id}/submit', [QuestionnaireController::class, 'submitQuiz']);

Route::get('/admin/quotes/search/{mode}/{text}', [QuoteController::class, 'search'])
//    ->middleware('can:Admin')->name('admin.quotes.search');
    ->name('admin.quotes.search');
