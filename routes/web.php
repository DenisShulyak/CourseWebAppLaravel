<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/status/{status}', [App\Http\Controllers\HomeController::class, 'filter']);
Route::get('/language/{language_id}', [HomeController::class, 'byLanguage']);
Route::get('/language/{language_id}/status/{status}', [HomeController::class, 'byLanguageByStatus']);
Route::get('/course/{id}', [HomeController::class, 'viewCourse']);
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin']);
Route::get('/enrol/{id}', [App\Http\Controllers\HomeController::class, 'enrol']);
Route::get('/unsubscribe/{id}', [App\Http\Controllers\HomeController::class, 'unsubscribe']);

Route::resource('courses', CourseController::class)->middleware('auth');

Route::get('/master-classes', [ApiController::class, 'list']);
Route::get('/master-classes/{id}', [ApiController::class, 'byId']);
