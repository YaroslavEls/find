<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function store(Request $request, Chat $chat): void
    {
        if ($request->user()->cannot('archive', $chat)) {
            abort(403);
        }

        if ($request->user()->is_seeker()) {
            $chat->seeker_archived = true;
        } else {
            $chat->saloon_archived = true;
        }

        $chat->save();
    }

    public function destroy(Request $request, Chat $chat): void
    {
        if ($request->user()->cannot('archive', $chat)) {
            abort(403);
        }

        if ($request->user()->is_seeker()) {
            $chat->seeker_archived = false;
        } else {
            $chat->saloon_archived = false;
        }

        $chat->save();
    }
}
