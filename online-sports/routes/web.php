<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Welcome route
Route::get('/', function () {
    return view('welcome');
});

// Auth middleware routes
Route::middleware(['auth'])->group(function () {
    // Get user teams
    Route::get('/teams', function() {
        return view('favorite');
    });

    // User dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Managing favorite teams
    Route::resource('user', UserController::class)
        ->only(['index', 'store', 'destroy']);

    // Get list of user favorite teams
    Route::get('/all-teams', [TeamController::class, 'index']);

    // Get a team profile page
    Route::get('/team/{team_key}', [TeamController::class, 'show']);


});

require __DIR__.'/auth.php';
