<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/organizer/dashboard', [UserController::class, 'organizer'])->name('organizer.dashboard');
Route::get('/user/dashboard', [UserController::class, 'user'])->name('user.dashboard');
Route::get('/admin/dashboard', [UserController::class, 'admin'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/organizer/all', [EventController::class, 'index'])->name('organizer.all');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{event}/show', [EventController::class, 'show'])->name('events.show');

Route::get('/user/all', [EventController::class, 'user'])->name('user.all');
Route::get('/user/search', [EventController::class, 'search'])->name('user.search');
Route::post('/event/{event}/book', [ReservationController::class, 'store'])->name('event.book');
Route::get('/ticket/{event}', [ReservationController::class, 'showTicket'])->name('event.ticket');

require __DIR__.'/auth.php';
