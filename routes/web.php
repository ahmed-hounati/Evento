<?php

use App\Http\Controllers\CategoryController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/events/{event}/show', [EventController::class, 'show'])->name('events.show');
});

Route::group(['middleware' => 'organizer'], function() {
    Route::get('/organizer/dashboard', [UserController::class, 'organizer'])->name('organizer.dashboard');
    Route::get('/organizer/all', [EventController::class, 'index'])->name('organizer.all');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}/update', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}/destroy', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/events/{event}/reservations', [ReservationController::class, 'allReservations'])->name('events.reservations');
    Route::post('/reservation/{reservation}/valid', [ReservationController::class, 'valid'])->name('reservation.valid');
});

Route::group(['middleware' => 'user'], function() {
    Route::get('/user/dashboard', [UserController::class, 'user'])->name('user.dashboard');
    Route::get('/user/all', [EventController::class, 'user'])->name('user.all');
    Route::get('/user/search', [EventController::class, 'search'])->name('user.search');
    Route::post('/event/{event}/book', [ReservationController::class, 'store'])->name('event.book');
    Route::get('/ticket/{event}', [ReservationController::class, 'showTicket'])->name('event.ticket');
});


Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin/dashboard', [UserController::class, 'admin'])->name('admin.dashboard');
    Route::get('/categories/all', [CategoryController::class, 'index'])->name('categories.all');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}/destroy', [CategoryController::class, 'delete'])->name('categories.destroy');
    Route::get('/users/all', [UserController::class, 'getAllUsers'])->name('users.all');
    Route::post('/users/archive/{user}', [UserController::class, 'archive'])->name('users.archive');
    Route::get('/event/all', [EventController::class, 'allEvents'])->name('event.all');
    Route::post('/event/{event}/valid', [EventController::class, 'valid'])->name('event.valid');
});

require __DIR__.'/auth.php';
