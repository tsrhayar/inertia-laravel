<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('home');
    Route::resource('tasks', TaskController::class);
    Route::get('/category/{category}/tasks', [TaskController::class, 'getTasksByCategory'])->name('category.tasks');
    Route::get('/order/{column}/{direction}/tasks', [TaskController::class, 'getTasksOrderedBy'])->name('order.tasks');
    Route::get('/search/tasks', [TaskController::class, 'getTasksByTerm'])->name('search.tasks');
    Route::post('/user/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user/profile', [AuthController::class, 'profile'])->name('profile');
});

Route::middleware('guest')->group(function () {
    Route::get('/user/register', [AuthController::class, 'register'])->name('register');
    Route::post('/user/store', [AuthController::class, 'store'])->name('register');
    Route::get('/user/auth', [AuthController::class, 'login'])->name('login');
    Route::post('/user/auth', [AuthController::class, 'auth'])->name('login');
});
