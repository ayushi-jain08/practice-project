<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['admin.guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login.user');
    Route::post('/login/store', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [UserController::class, 'getRegister'])->name('register.user');
    Route::post('/register/store', [UserController::class, 'RegisterStore'])->name('register.store');
});
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'getDashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'Logout'])->name('logout.user');
    Route::get('/edit/user/{id}', [UserController::class, 'index'])->name('edit.user');
    Route::post('/edit/store', [UserController::class, 'store'])->name('edit.store');
    Route::get('/task', [TaskController::class, 'getTaskPage'])->name('page.task');
Route::get('/task/create', [TaskController::class, 'CreateTaskPage'])->name('task.create');
Route::post('/task/store', [TaskController::class, 'addTask'])->name('task.store');

Route::put('/task/update', [TaskController::class, 'changeStatus'])->name('task.update');

});
