<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlockController;


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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [BlockController::class, 'index'])->name('index');
Route::post('/', [BlockController::class, 'auth'])->name('login.auth');
Route::get('/logout', [BlockController::class, 'logout'])->name('logout');
Route::get('/dashboard', [BlockController::class, 'dashboard'])->name('dashboard');
Route::get('/page', [BlockController::class, 'page'])->name('page');
