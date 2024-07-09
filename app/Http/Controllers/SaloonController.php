<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaloonStoreRequest;
use App\Http\Requests\SaloonUpdateRequest;
use App\Models\Saloon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SaloonController extends Controller
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
        return Inertia::render('Saloon/Create');
    }

    public function validate(Request $request)
    {
        $orig = new SaloonStoreRequest();

        $rules = [
            'name' => $orig->rules()['name'],
            'descr' => $orig->rules()['descr'],
            'logo' => $orig->rules()['logo'],
            'socials' => $orig->rules()['socials'],
            'socials.*' => $orig->rules()['socials.*'],
        ];

        $request->validate($rules, $orig->messages());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaloonStoreRequest $request)
    {
        $validated = $request->validated();

        $locations = $validated['locations'];
        unset($validated['locations']);

        $path = $validated['logo']->store('uploads');
        $validated['logo'] = $path;

        $validated['socials'] = implode(';', $validated['socials']);
        
        $saloon = Saloon::create($validated);
        $request->user()->update(['userable_id' => $saloon->id]);

        foreach ($locations as $loc) {
            foreach ($loc['photos'] as $photo) {
                $path = $photo->store('uploads');
            }
            $loc['photos'] = implode(';', $loc['photos']);
            $saloon->locations()->create($loc);
        }

        return redirect(route('home', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(Saloon $saloon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saloon $saloon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaloonUpdateRequest $request, Saloon $saloon)
    {
        $saloon = $request->user()->userable;
        
        $validated = $request->validated();
        // dd($validated);

        $validated['socials'] = implode(';', $validated['socials']);

        if ($validated['logo'] == null) {
            $validated['logo'] = $saloon->logo;
        } else {
            $path = $validated['logo']->store('uploads');
            $validated['logo'] = $path;
            Storage::delete($saloon->logo);
        }

        $saloon->fill($validated);
        $saloon->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saloon $saloon)
    {
        //
    }
}
