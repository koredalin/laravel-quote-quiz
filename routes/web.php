<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\GuestUserController;
use App\Http\Controllers\QuoteController;

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

Route::get('/', [GuestUserController::class, 'index'])
    ->name('home');

Route::get('/questionnaires', [QuestionnaireController::class, 'index'])
    ->name('questionnaires');

Route::get('/guest_users/index_admin', [GuestUserController::class, 'indexAdmin'])
    ->middleware('can:Admin')->name('guest_users.index_admin');

Route::get('/quotes/create_one', [QuoteController::class, 'createOne'])
    ->middleware('can:Admin')->name('quotes.create_one');

Route::post('/quotes/add_one', [QuoteController::class, 'addOne'])
    ->middleware('can:Admin')->name('quotes.add_one');

Route::get('/admin/questionnaires/create_one', [QuestionnaireController::class, 'createOne'])
    ->middleware('can:Admin')->name('admin.questionnaires.create_one');

Route::post('/admin/questionnaires/add_one', [QuestionnaireController::class, 'addOne'])
    ->middleware('can:Admin')->name('admin.questionnaires.add_one');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
