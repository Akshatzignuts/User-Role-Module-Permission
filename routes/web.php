<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');
Route::get('/permissions', $controller_path . '\pages\Page2@index')->name('pages-page-2');

// pages
Route::get('/modules', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');



Route::post('/', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login-basic', [AuthController::class, 'logout']);
Route::get('/roles', [RoleController::class, 'index'])->name('roles');
Route::get('/role/add', [RoleController::class, 'role'])->name('role-add');
