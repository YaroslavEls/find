<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyStoreRequest;
use App\Http\Requests\VacancyUpdateRequest;
use App\Models\Vacancy;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VacancyController extends Controller
{
    public function index(Request $request): Response
    {
        $sort = $request->query('sort');
        $saloon = $request->query('saloon');
        $job = $request->query('job');
        $emp = $request->query('emp');
        $exp = $request->query('exp');
        $sal = $request->query('sal');
        $city = $request->query('city');

        switch ($sort) {
            case 'new':
                $vacancies = Vacancy::orderBy('created_at', 'desc');
                break;
            case 'saved':
                $ids = $request->user()
                    ->saves()
                    ->join('vacancies', 'vacancies.id', '=', 'saves.savable_id')
                    ->select('vacancies.*')
                    ->pluck('id');
                $vacancies = Vacancy::whereIn('id', $ids)
                    ->with([
                        'saloon:id,logo,name', 
                        'location:id,photos,city,address,gen'
                    ]);
                break;
            default:
                $vacancies = Vacancy::query();
                break;
        }

        $vacancies = $vacancies
            ->when($saloon, function (Builder $query, string $saloon) {
                $query->where('saloon_id', $saloon);
            })
            ->when($job, function(Builder $query, string $job) {
                $jobs = explode(';', $job);
                $query->whereIn('job', $jobs);
            })
            ->when($emp, function(Builder $query, string $emp) {
                $emps = explode(';', $emp);
                $query->where('employment', 'like', '%' . $emps[0] . '%');
                for ($i = 1; $i < count($emps); $i++) {
                    $query->orWhere('employment', 'like', '%' . $emps[$i] . '%');
                }
            })
            ->when($exp, function(Builder $query, string $exp) {
                $query->where('experience', '>=', $exp);
            })
            ->when($sal, function(Builder $query, string $sal) {
                $query->where('salary', '>=', $sal);
            })
            ->when($city, function(Builder $query, string $city) {
                $query->whereHas('location', function ($query) use ($city) {
                    $query->where('city', 'like', '%' . $city . '%');
                });
            })
            ->paginate(10)
            ->withQueryString()
            ->onEachSide(1);

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

        return redirect(route('profile', ['sec' => 'vacancies']));
    }

    public function show(Vacancy $vacancy)
    {
        $vacancy->load(['saloon', 'location']);

        $score = $vacancy->saloon->user->reviews->avg('score');
        if ($score) {
            $vacancy->score = $score;
        } else {
            $vacancy->score = 0;
        }

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

        return redirect(route('profile', ['sec' => 'vacancies']));
    }

    public function destroy(Request $request, Vacancy $vacancy): void
    {
        if ($request->user()->cannot('delete', $vacancy)) {
            abort(403);
        }

        $vacancy->delete();
    }
}
