<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $data = null;

        if ($request->user()) {
            $data = [
                'user_id' => $request->user()->id,
                'userable_type' => $request->user()->userable_type,
                'email' => $request->user()->email,
            ];
        }

        if ($request->user() && $request->user()->userable) {
            $data = [
                'user_id' => $request->user()->id,
                'userable_id' => $request->user()->userable_id,
                'userable_type' => $request->user()->userable_type,
                'email' => $request->user()->email,
                'name' => $request->user()->userable->name,
                'photo' => $request->user()->is_seeker()
                    ? $request->user()->userable->photo
                    : $request->user()->userable->logo,
                'saves' => array_column($request->user()->saves->toArray(), 'savable_id')
            ];
        }

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $data
            ],
        ];
    }
}
