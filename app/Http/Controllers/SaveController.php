<?php

namespace App\Http\Controllers;

use App\Models\Save;
use App\Models\Seeker;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function storeSeeker(Request $request, Seeker $seeker)
    {
        $seeker->saves()->create([
            'user_id' => $request->user()->id
        ]);
    }

    public function storeVacancy(Request $request, Vacancy $vacancy)
    {
        $vacancy->saves()->create([
            'user_id' => $request->user()->id
        ]);
    }

    public function destroySeeker(Request $request, Seeker $seeker)
    {
        Save::where([
            'user_id' => $request->user()->id,
            'savable_type' => 'App\Models\Seeker',
            'savable_id' => $seeker->id
        ])->delete();
    }

    public function destroyVacancy(Request $request, Vacancy $vacancy)
    {
        Save::where([
            'user_id' => $request->user()->id,
            'savable_type' => 'App\Models\Vacancy',
            'savable_id' => $vacancy->id
        ])->delete();
    }
}
