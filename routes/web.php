<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ManageUsersController;

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
    Route::resource('status', StatusController::class);
    Route::resource('vehicle', VehicleController::class);
    Route::resource('users', ManageUsersController::class);
    Route::post('/vehicle/import', [VehicleController::class, 'importData'])->name('vehicle.importData');
    Route::post('/status/{id}', [StatusController::class, 'update'])->name('status.update');

});

Route::group(['middleware' => 'role:admin,customer'], function () {
    Route::resource('appointments', AppointmentController::class);
});

Route::get('/run-migration', function () {
    Artisan::call('optimize:clear');
    Artisan::call('migrate:fresh --seed');

    return "Migrations Executed Successfully!";
});






// Route::prefix('/admin')->namespace('App\Http\Controllers')->group(function(){
//     Route::get('dashboard', 'AdminController@dashboard');
// });


Route::get('/', function () {
    return view('auth.login');
});