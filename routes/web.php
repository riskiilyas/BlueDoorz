<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
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
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/search', [DashboardController::class, 'search'])->middleware(['auth', 'verified'])->name('dashboard.search');
Route::get('/room/{id}', [DashboardController::class, 'room'])->middleware(['auth', 'verified'])->name('room');
Route::get('/book/{id}', [DashboardController::class, 'book'])->middleware(['auth', 'verified'])->name('book');
Route::post('/book/{id}', [DashboardController::class, 'pay'])->middleware(['auth', 'verified'])->name('pay');
Route::get('/review/{id}', [HistoryController::class, 'review'])->middleware(['auth', 'verified'])->name('review');
Route::post('/review/{id}', [HistoryController::class, 'postReview'])->middleware(['auth', 'verified'])->name('review.post');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/{user}', [ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
    Route::post('/tickets', [TicketController::class,'submit'])->name('tickets.submit');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
});

require __DIR__.'/auth.php';
