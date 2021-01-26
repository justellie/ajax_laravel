<?php

use App\Http\Controllers\MailFormController;
use App\Http\Controllers\UserController;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Route::get('users', [UserController::class, 'index'])->name('users');
Route::post('user', [UserController::class, 'store']);
Route::put('user', [UserController::class, 'update']);
Route::delete('user/{user_id}', [UserController::class, 'destroy']);
Route::get('user/{user_id}', [UserController::class, 'show'])->name('user.view');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('user/{user_id}/mail',[UserController::class,'createMail'])->name('contact.create')->middleware('auth');
Route::post('user/{user_id}/mail',[UserController::class,'storeMail'])->name('contact.store')->middleware('auth');
Auth::routes();