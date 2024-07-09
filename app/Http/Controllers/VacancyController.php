<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyStoreRequest;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Ramsey\Uuid\Type\Integer;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Vacancy/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VacancyStoreRequest $request)
    {
        $validated = $request->validated();
        
        $validated['employment'] = implode(';', $validated['employment']);

        $request->user()->saloon->vacancies()->create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
        return Inertia::render('Vacancy/Edit', [
            'vacancy' => $vacancy
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VacancyStoreRequest $request, Vacancy $vacancy)
    {
        $validated = $request->validated();
        
        $validated['employment'] = implode(';', $validated['employment']);

        $vacancy->fill($validated);
        $vacancy->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
    }
}
