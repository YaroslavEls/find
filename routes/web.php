<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SaloonController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\SeekerController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)
    ->name('home');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile');

    Route::get('/vacancies', [VacancyController::class, 'index'])
        ->name('vacancies');
    Route::get('/vacancies/{vacancy}', [VacancyController::class, 'show'])
        ->name('vacancies.show');

    Route::get('vacancies/{vacancy}/saloon', [SaloonController::class, 'show'])
        ->name('saloons.show');
    Route::get('vacancies/{vacancy}/saloon/{location}', [LocationController::class, 'show'])
        ->name('location.show');

    Route::post('/reviews/{user}', [ReviewController::class, 'store'])
        ->name('review.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->name('review.delete');

    Route::post('seeker/save/{seeker}', [SaveController::class, 'storeSeeker'])
        ->name('save.seeker');
    Route::delete('seeker/save/{seeker}', [SaveController::class, 'destroySeeker'])
        ->name('unsave.seeker');
    Route::post('vacancy/save/{vacancy}', [SaveController::class, 'storeVacancy'])
        ->name('save.vacancy');
    Route::delete('vacancy/save/{vacancy}', [SaveController::class, 'destroyVacancy'])
        ->name('unsave.vacancy');
});

Route::middleware(['auth', 'seeker'])->group(function () {
    Route::patch('/seeker', [SeekerController::class, 'update'])
        ->name('seeker.update');
});

Route::middleware(['auth', 'saloon'])->group(function () {
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

    Route::get('/seekers', [SeekerController::class, 'index'])
        ->name('seekers');
    Route::get('/seekers/{seeker}', [SeekerController::class, 'show'])
        ->name('seekers.show');
    Route::get('/seekers/{seeker}/reviews', [ReviewController::class, 'index'])
        ->name('seekers.reviews');
});

require __DIR__.'/auth.php';
