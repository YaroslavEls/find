<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/Register', [
            'type' => $request->query('type') ?? null,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $messages = [
            'email.unique' => 'Користувач з даною електронною адресою вже зареєстрований.'
        ];

        $request->validate([
            'userable_type' => 'required|in:App\Models\Seeker,App\Models\Saloon',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', Rules\Password::defaults()],
            'agree' => ['required', 'accepted']
        ], $messages);

        $user = User::create([
            'userable_type' => $request->userable_type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user->is_seeker()) {
            return redirect(route('register.seeker'));
        }
        if ($user->is_saloon()) {
            return redirect(route('register.saloon'));
        }
    }
}
