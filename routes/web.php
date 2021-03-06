<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('missions', App\Http\Controllers\MissionController::class);
Route::resource('agents', App\Http\Controllers\AgentController::class);
Route::resource('cibles', App\Http\Controllers\CibleController::class);
Route::resource('contacts', App\Http\Controllers\ContactController::class);
Route::resource('planques', App\Http\Controllers\PlanqueController::class);

require __DIR__.'/auth.php';
