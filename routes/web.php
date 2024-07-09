<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaloonController;
use App\Http\Controllers\SeekerController;
use App\Http\Controllers\VacancyController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::middleware('signed')->group(function () {
//     Route::get('/register/seeker', [SeekerController::class, 'create'])
//         ->name('register.seeker');
// });

Route::get('/', function (Request $request) {
    
    // dd($request->user()->is_seeker());
    return Inertia::render('Home');
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
})->name('home');

// Route::get('/register/seeker', [SeekerController::class, 'create'])
//     ->name('register.seeker');

Route::get('/register/seeker', [SeekerController::class, 'create'])
    ->name('register.seeker');
Route::post('/register/seeker', [SeekerController::class, 'store'])
    ->name('register.seeker');
Route::post('/register/seeker/validate', [SeekerController::class, 'validate'])
    ->name('seeker.validate');

Route::get('/register/saloon', [SaloonController::class, 'create'])
    ->name('register.saloon');
Route::post('/register/saloon', [SaloonController::class, 'store'])
    ->name('register.saloon');
Route::post('/register/saloon/validate', [SaloonController::class, 'validate'])
    ->name('saloon.validate');

Route::post('/registe/location/validate', [LocationController::class, 'validate'])
    ->name('location.validate');

// Route::get('/register/saloon', function() {
//     return Inertia::render('RegisterSaloon');
// })->name('register.saloon');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/seeker', [SeekerController::class, 'update'])
        ->name('seeker.update');

    Route::patch('/saloon', [SaloonController::class, 'update'])
        ->name('saloon.update');

    Route::get('/location', [LocationController::class, 'create'])
        ->name('location.create');
    Route::post('/location', [LocationController::class, 'store'])
        ->name('location.store');
    Route::get('/location/{location}/edit', [LocationController::class, 'edit'])
        ->name('location.edit');
    Route::patch('/location/{location}/update', [LocationController::class, 'update'])
        ->name('location.update');
    Route::delete('/location/{location}/delete', [LocationController::class, 'destroy'])
        ->name('location.delete');

    Route::get('/vacancy', [VacancyController::class, 'create'])
        ->name('vacancy.create');
    Route::post('/vacancy', [VacancyController::class, 'store'])
        ->name('vacancy.store');
    Route::get('/vacancy/{vacancy}/edit', [VacancyController::class, 'edit'])
        ->name('vacancy.edit');
    Route::patch('/vacancy/{vacancy}/update', [VacancyController::class, 'update'])
        ->name('vacancy.update');
    Route::delete('/vacancy/{vacancy}/delete', [VacancyController::class, 'destroy'])
        ->name('vacancy.delete');
});

require __DIR__.'/auth.php';
