<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\ProfileController;
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

//Route::get('/daftarbuku', [BooksController::class, 'index'])->name('daftarbuku.index');
//Route::get('/daftarbuku/create', [BooksController::class, 'create'])->name('daftarbuku.create');
//Route::post('/daftarbuku', [BooksController::class, 'store'])->name('daftarbuku.store');
//Route::get('/daftarbuku/{id}/edit', [BooksController::class, 'edit'])->name('daftarbuku.edit');
//Route::put('/daftarbuku/{id}', [BooksController::class, 'update'])->name('daftarbuku.update');
//Route::delete( '/daftarbuku/{id}', [BooksController::class, 'destroy'])->name('daftarbuku.destroy');

Route::resource('daftarbuku', BooksController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [BooksController::class, 'dashboard'])->name('dashboard')->middleware('auth');







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
