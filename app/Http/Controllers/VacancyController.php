<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyStoreRequest;
use App\Http\Requests\VacancyUpdateRequest;
use App\Models\Vacancy;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VacancyController extends Controller
{
    public function index(Request $request): Response
    {
        if ($request->query('sort') == 'new') {
            $vacancies = Vacancy::orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();
        } else if ($request->query('sort') == 'saved') {
            $saves = $request->user()
                ->saves()
                ->where(['user_id' => $request->user()->id])
                ->distinct()
                ->pluck('savable_id');
            $vacancies = Vacancy::whereIn('id', $saves)
                ->paginate(10)
                ->withQueryString();
        } else {
            $vacancies = Vacancy::paginate(10)
                ->withQueryString();
        }

        return Inertia::render('Vacancy/Index', [
            'vacancies' => $vacancies
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Vacancy/Create', [
            'locations' => $request->user()->userable->locations
        ]);
    }

    public function store(VacancyStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        $validated['employment'] = implode(';', $validated['employment']);

        $request->user()->userable->vacancies()->create($validated);

        return redirect(route('profile'));
    }

    public function show(Vacancy $vacancy)
    {
        $vacancy->load(['saloon', 'location']);
        $vacancy->score = round($vacancy->saloon->user->reviews->avg('score'));

        $breadcrumbs = Breadcrumbs::generate('vacancy', $vacancy);

        return Inertia::render('Vacancy/Show', [
            'breadcrumbs' => $breadcrumbs,
            'vacancy' => $vacancy
        ]);
    }

    public function edit(Request $request, Vacancy $vacancy): Response
    {
        return Inertia::render('Vacancy/Edit', [
            'vacancy' => $vacancy,
            'locations' => $request->user()->userable->locations
        ]);
    }

    public function update(VacancyUpdateRequest $request, Vacancy $vacancy): RedirectResponse
    {
        $validated = $request->validated();
        
        $validated['employment'] = implode(';', $validated['employment']);

        $vacancy->fill($validated);
        $vacancy->save();

        return redirect(route('profile'));
    }

    public function destroy(Request $request, Vacancy $vacancy): void
    {
        if ($request->user()->cannot('delete', $vacancy)) {
            abort(403);
        }

        $vacancy->delete();
    }
}
