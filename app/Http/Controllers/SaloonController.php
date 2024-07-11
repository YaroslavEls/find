<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaloonStoreRequest;
use App\Http\Requests\SaloonUpdateRequest;
use App\Models\Saloon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SaloonController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Saloon/Create');
    }

    public function validate(Request $request): void
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

    public function store(SaloonStoreRequest $request): RedirectResponse
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
            $loc['schedule'] = implode(';', $loc['schedule']);
            foreach ($loc['photos'] as $photo) {
                $path = $photo->store('uploads');
            }
            $loc['photos'] = implode(';', $loc['photos']);
            $saloon->locations()->create($loc);
        }

        return redirect(route('home', absolute: false));
    }

    public function show(Saloon $saloon)
    {
        //
    }

    public function update(SaloonUpdateRequest $request, Saloon $saloon): RedirectResponse
    {
        $saloon = $request->user()->userable;
        
        $validated = $request->validated();

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

        return redirect(route('profile'));
    }
}
