<?php

use App\Http\Controllers\EducationController;
use App\Http\Controllers\EmplomentController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ProjecttController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SocialController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('personal', PersonalController::class)->only(['create','update']);
Route::resource('social', SocialController::class)->only(['update']);
Route::resource('skill', SkillController::class)->except(['create','show']);
Route::resource('education', EducationController::class)->except(['create','show']);
Route::resource('employment', EmplomentController::class)->except(['create','show']);
Route::resource('project', ProjecttController::class)->only(['index','store','update','destroy','edit']);
