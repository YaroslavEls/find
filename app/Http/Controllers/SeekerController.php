<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeekerStoreRequest;
use App\Http\Requests\SeekerUpdateRequest;
use App\Models\Seeker;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SeekerController extends Controller
{
    public function index(): Response
    {
        $seekers = Seeker::all();

        return Inertia::render('Seeker/Index', [
            'seekers' => $seekers
        ]);
    }

    public function create(Request $request): Response 
    {
        return Inertia::render('Seeker/Create');
    }

    public function validate(Request $request): void
    {
        $orig = new SeekerStoreRequest();

        $rules = [
            [
                'name' => $orig->rules()['name'],
                'birthday' => $orig->rules()['birthday'],
                'photo' => $orig->rules()['photo'],
            ],
            [
                'job' => $orig->rules()['job'],
                'experience' => $orig->rules()['experience'],
                'salary' => $orig->rules()['salary'],
            ],
            [
                'city' => $orig->rules()['city'],
                'employment' => $orig->rules()['employment'],
                'employment.*' => $orig->rules()['employment.*'],
            ],
            [
                'info' => $orig->rules()['info'],
                'cv' => $orig->rules()['cv'],
            ]
        ];

        $request->validate($rules[$request->header('form-page')], $orig->messages());
    }

    public function store(SeekerStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['birthday'] = Carbon::createFromFormat('Y-m-d', $validated['birthday']);

        $validated['employment'] = implode(';', $validated['employment']);

        $path = $validated['photo']->store('uploads');
        $validated['photo'] = $path;

        if ($validated['cv']) {
            $path = $validated['cv']->store('uploads');
            $validated['cv'] = $path;
        }

        $seeker = Seeker::create($validated);
        $request->user()->update(['userable_id' => $seeker->id]);

        return redirect(route('home', absolute: false));
    }

    public function show(Seeker $seeker): Response
    {
        $seeker->score = round($seeker->user->reviews->avg('score'));

        $breadcrumbs = Breadcrumbs::generate('seeker', $seeker);

        return Inertia::render('Seeker/Show', [
            'breadcrumbs' => $breadcrumbs,
            'seeker' => $seeker
        ]);
    }

    public function update(SeekerUpdateRequest $request): RedirectResponse
    {
        $seeker = $request->user()->userable;

        $validated = $request->validated();

        $validated['employment'] = implode(';', $validated['employment']);

        if ($validated['photo'] == null) {
            $validated['photo'] = $seeker->photo;
        } else {
            $path = $validated['photo']->store('uploads');
            $validated['photo'] = $path;
            Storage::delete($seeker->photo);
        }

        if ($validated['cv'] == null) {
            $validated['cv'] = $seeker->cv;
        } else {
            $path = $validated['cv']->store('uploads');
            $validated['cv'] = $path;
            if ($seeker->cv) {
                Storage::delete($seeker->cv);
            }
        }
        
        $seeker->fill($validated);
        $seeker->save();

        return redirect(route('profile'));
    }
}
