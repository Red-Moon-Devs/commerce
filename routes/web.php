<?php

use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//  return view('dashboard');
//}/)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'index'])
        ->name('manager.dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');
});

// Routes pour les clients
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'index'])
        ->middleware('role:client')
        ->name('client.dashboard');
});

require __DIR__ . '/auth.php';
