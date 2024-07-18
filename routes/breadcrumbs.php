<?php

use App\Models\Seeker;
use App\Models\Vacancy;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Seekers
Breadcrumbs::for('seekers', function (BreadcrumbTrail $trail) {
    $trail->push('Кандидати', route('seekers'));
});

// Seekers > [Seeker]
Breadcrumbs::for('seeker', function (BreadcrumbTrail $trail, Seeker $seeker) {
    $trail->parent('seekers');
    $trail->push($seeker->name, route('seekers.show', $seeker));
});

// Seekers > [Seeker] > Reviews
Breadcrumbs::for('reviews', function (BreadcrumbTrail $trail, Seeker $seeker) {
    $trail->parent('seeker', $seeker);
    $trail->push('Відгуки', route('seekers.reviews', $seeker));
});

// Vacancies
Breadcrumbs::for('vacancies', function (BreadcrumbTrail $trail) {
    $trail->push('Вакансії', route('vacancies'));
});

// Vacancies > [Vacancy]
Breadcrumbs::for('vacancy', function (BreadcrumbTrail $trail, Vacancy $vacancy) {
    $trail->parent('vacancies');
    $trail->push($vacancy->job, route('vacancies.show', $vacancy));
});

// Vacancies > [Vacancy] > [Saloon]
Breadcrumbs::for('saloon', function(BreadcrumbTrail $trail, Vacancy $vacancy) {
    $trail->parent('vacancy', $vacancy);
    $trail->push($vacancy->saloon->name, route('saloons.show', $vacancy));
});
