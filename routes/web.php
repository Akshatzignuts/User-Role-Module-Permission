<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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


// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');


Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');
Route::get('/permissions', $controller_path . '\pages\Page2@index')->name('permission');

// pages

Route::get('/modules/', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
Route::post('/', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login-basic', [AuthController::class, 'logout']);
Route::get('/modules/', [AdminController::class, 'displayModule'])->name('modules');
Route::get('/module/edit/{code}', [AdminController::class, 'editModule'])->name('module-edit');
Route::post('module/edited/{code}', [AdminController::class, 'updateModule'])->name('module-update');
Route::put('/modules/', [AdminController::class, 'toggleModuleStatus'])->name('modules.toggle-status');

Route::prefix('/permission')->group(function () {
    Route::get('/add/', [AdminController::class, 'permission'])->name('permission-add');
    Route::post('/added/', [AdminController::class, 'addPermission'])->name('permission-added');
    Route::get('/delete/{id}', [AdminController::class, 'deletePermission'])->name('permission-delete');
    Route::get('/edit/{id}', [AdminController::class, 'editPermission'])->name('permission-edit');
    Route::post('/edited/{id}', [AdminController::class, 'updatePermission'])->name('permission-update');
});
Route::get('/permissions/', [AdminController::class, 'displayPermission'])->name('permission-display');
Route::put('/permissions/', [AdminController::class, 'toggleStatus'])->name('permissions.toggleStatus');


Route::prefix('/role')->group(function () {
    Route::get('/', [AdminController::class, 'roleIndex'])->name('role-index');
    Route::get('/add/', [AdminController::class, 'role'])->name('role');
    Route::post('/added/', [AdminController::class, 'addRole'])->name('role-add');
    Route::get('/', [AdminController::class, 'displayRole'])->name('role-display');
    Route::put('/', [AdminController::class, 'toggleRoleStatus'])->name('roles.toggle-status');
    Route::get('/edit/{id}', [AdminController::class, 'editRole']);
    Route::get('/delete/{id}', [AdminController::class, 'deleteRole'])->name('delete-role');
});
