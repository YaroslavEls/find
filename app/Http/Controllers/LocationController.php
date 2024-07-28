<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Models\Location;
use App\Models\Vacancy;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class LocationController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Location/Create');
    }

    public function validate(Request $request): void
    {
        $orig = new LocationStoreRequest();

        $request->validate($orig->rules(), $orig->messages());
    }

    public function store(LocationStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['schedule'] = implode(';', $validated['schedule']);

        $pathes = [];
        foreach ($validated['photos'] as $photo) {
            $path = $photo->store('uploads');
            $pathes[] = $path;
        }
        $validated['photos'] = implode(';', $pathes);

        $request->user()->userable->locations()->create($validated);

        return redirect(route('profile', ['sec' => 'locations']));
    }

    public function show(Vacancy $vacancy, Location $location): Response
    {
        $location->load(['vacancies']);

        $breadcrumbs = Breadcrumbs::generate('location', $vacancy, $location);

        return Inertia::render('Location/Show', [
            'breadcrumbs' => $breadcrumbs,
            'location' => $location
        ]);
    }

    public function edit(Location $location): Response
    {
        return Inertia::render('Location/Edit', [
            'location' => $location
        ]);
    }

    public function update(LocationUpdateRequest $request, Location $location): RedirectResponse
    {
        $validated = $request->validated();

        $validated['schedule'] = implode(';', $validated['schedule']);

        $pathes = [];
        foreach ($validated['photos'] as $photo) {
            $path = $photo->store('uploads');
            $pathes[] = $path;
        }
        $pathes = array_merge($validated['oldPhotos'], $pathes);
        $validated['photos'] = implode(';', $pathes);
        
        $diff = array_diff(explode(';', $location->photos), $validated['oldPhotos']);
        foreach ($diff as $photo) {
            Storage::delete($photo);
        }
        unset($validated['oldPhotos']);

        if ($validated['video'] == null) {
            $validated['video'] = $location->video;
        } else {
            $path = $validated['video']->store('uploads');
            $validated['video'] = $path;
            Storage::delete($location->video);
        }
        
        $location->fill($validated);
        $location->save();

        return redirect(route('profile', ['sec' => 'locations']));
    }

    public function destroy(Request $request, Location $location): void
    {
        if ($request->user()->cannot('delete', $location)) {
            abort(403);
        }

        $location->delete();
    }
}
