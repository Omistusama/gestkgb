<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CibleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PlanqueController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\WelcomeController;



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

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::resource('missions', MissionController::class)->middleware(['auth']);
Route::resource('agents', AgentController::class)->middleware(['auth']);
Route::resource('cibles', CibleController::class)->middleware(['auth']);
Route::resource('contacts', ContactController::class)->middleware(['auth']);
Route::resource('planques', PlanqueController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
