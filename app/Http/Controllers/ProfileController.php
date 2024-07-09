<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function edit(Request $request): Response
    {
        if ($request->user()->is_seeker()) {
            return Inertia::render('Seeker/Edit', [
                'seeker' => $request->user()->userable
            ]);
        }
        if ($request->user()->is_saloon()) {
            return Inertia::render('Saloon/Edit', [
                'saloon' => $request->user()->userable,
                'vacancies' => $request->user()->userable->vacancies,
                'locations' => $request->user()->userable->locations
            ]);
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
