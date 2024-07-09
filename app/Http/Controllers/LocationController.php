<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class LocationController extends Controller
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
        return Inertia::render('Location/Create');
    }

    public function validate(Request $request)
    {
        $orig = new LocationStoreRequest();

        $request->validate($orig->rules(), $orig->messages());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationStoreRequest $request)
    {
        $validated = $request->validated();

        $pathes = [];
        foreach ($validated['photos'] as $photo) {
            $path = $photo->store('uploads');
            $pathes[] = $path;
        }
        $validated['photos'] = implode(';', $pathes);

        $request->user()->saloon->locations()->create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return Inertia::render('Location/Edit', [
            'location' => $location
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationUpdateRequest $request, Location $location)
    {
        $validated = $request->validated();

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
    }
}
