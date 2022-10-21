<?php

use App\Http\Controllers\Login;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VotesController;
use App\Http\Middleware\Authenticate;
use App\Models\Vote;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
    Route::get('/users', [Users::class, 'index'])->name('users.index');
    Route::get('/users/create', [Users::class, 'create'])->name('users.create');
    Route::post('/users', [Users::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [Users::class, 'edit'])->name('users.edit');
    Route::delete('/users/{user}/delete', [Users::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{user}', [Users::class, 'update'])->name('users.update');
    Route::get('/users/{user}', [Users::class, 'show'])->name('users.show');
    ==> Route::resource('users', Users::class);
    */

Route::middleware('auth')->group(function (){
    Route::get('/', [VotesController::class, 'index'])->name('index');
    Route::get('/archives', [VotesController::class, 'archives'])->name('votes.archives');
    Route::get('/logout', [Login::class, 'logout'])->name('auth.logout');


    Route::middleware('delegate')->group(function () {
        Route::get('/referendum/create', [VotesController::class, 'create'])->name('votes.create');
        Route::post('/referendum/create', [VotesController::class, 'store'])->name('votes.store');
    });


    Route::get('/referendum/{vote}', [VotesController::class, 'show'])->name('votes.show');


    Route::middleware('delegateOrStudent')->group(function () {
        Route::post('/referendum/{vote}/yes', [VotesController::class, 'voteYes'])->name('votes.yes');
        Route::post('/referendum/{vote}/no', [VotesController::class, 'voteNo'])->name('votes.no');
    });

    Route::middleware('superAdmin')->group(function (){
        Route::get('/referendum/{vote}/edit', [VotesController::class, 'edit'])->name('votes.edit');
        Route::put('/referendum/{vote}/edit', [VotesController::class, 'update'])->name('votes.update');
        Route::delete('/referendum/{vote}/delete', [VotesController::class, 'destroy'])->name('votes.destroy');
        Route::post('/referendum/{vote}/finish', [VotesController::class, 'finish'])->name('votes.finish');

    });

    Route::middleware('admin')->group(function (){
        //Route::get('/users/{user}/change-role', [UsersController::class, 'changeRole'])->name('users.changeRole');
        //Route::post('/users/{user}/change-role', [UsersController::class, 'updateRole'])->name('users.updateRole');
        Route::resource('users', UsersController::class);
        Route::get('/users/{user}/change-pass', [UsersController::class, 'changePass'])->name('users.changePass');
        Route::put('/users/{user}/change-pass', [UsersController::class, 'updatePass'])->name('users.updatePass');

        Route::post('/referendum/{vote}/decline', [VotesController::class, 'decline'])->name('votes.decline');
        Route::post('/referendum/{vote}/accept', [VotesController::class, 'accept'])->name('votes.accept');
    });

});
Route::middleware('guest')->group(function (){
    Route::get('/login', [Login::class, 'login'])->name('auth.login');
    Route::post('/login', [Login::class, 'authenticate'])->name('auth.authenticate');
});
