<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SourceController;


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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'role:admin'], function () {
    Route::resource('users', ManageUsersController::class);
    Route::resource('sources', SourceController::class);
});

Route::group(['middleware' => 'role:admin,customer'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

Route::get('/run-migration', function () {
    Artisan::call('optimize:clear');
    Artisan::call('migrate:fresh --seed');

    return "Migrations Executed Successfully!";
});


Route::get('/', function () {
    return view('auth.login');
});