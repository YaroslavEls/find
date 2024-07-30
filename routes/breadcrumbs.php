<?php

use App\Models\Chat;
use App\Models\Location;
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

// Vacancies > [Vacancy] > [Saloon] > [Location]
Breadcrumbs::for('location', function(BreadcrumbTrail $trail, Vacancy $vacancy, Location $location) {
    $trail->parent('saloon', $vacancy);
    $trail->push($location->name, route('location.show', [$vacancy, $location]));
});

// Chats
Breadcrumbs::for('chats', function (BreadcrumbTrail $trail) {
    $trail->push('Чати', route('chat'));
});

// Chats > [Chatter]
Breadcrumbs::for('chat', function (BreadcrumbTrail $trail, Chat $chat, $chatter) {
    $trail->parent('chats');
    $trail->push($chatter->name, route('chat.show', $chat));
});
