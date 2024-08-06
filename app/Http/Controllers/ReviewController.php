<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Models\Review;
use App\Models\Seeker;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ReviewController extends Controller
{
    public function index(Seeker $seeker): Response
    {
        $breadcrumbs = Breadcrumbs::generate('reviews', $seeker);

        $reviews = $seeker
            ->user
            ->reviews()
            ->with(['author.userable:id,logo,name'])
            ->orderBy('created_at', 'desc')
            ->get();

        $seeker->score = round($seeker->user->reviews->avg('score'));

        return Inertia::render('Review/Index', [
            'breadcrumbs' => $breadcrumbs,
            'seeker' => $seeker,
            'reviews' => $reviews
        ]);
    }

    public function store(ReviewStoreRequest $request, User $user): void
    {
        $validated = $request->validated();
        $validated['user_id'] = $user->id;

        $request->user()->authorship()->create($validated);
    }

    public function update(Request $request, Review $review)
    {
        //
    }

    public function destroy(Request $request, Review $review)
    {
        if ($request->user()->cannot('delete', $review)) {
            abort(403);
        }

        $review->delete();
    }
}
