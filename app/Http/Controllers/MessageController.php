<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chat;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Chat $chat): void
    {
        if ($request->user()->cannot('message', $chat)) {
            abort(403);
        }

        $receiver_id = $request->user()->is_seeker()
            ? $chat->saloon->user->id
            : $chat->seeker->user->id;
        
        $data = [
            'sender_id' => $request->user()->id,
            'receiver_id' => $receiver_id,
            'text' => $request->text
        ];

        $message = $chat->messages()->create($data);
        $message->load(['sender']);

        broadcast(new MessageSent($message));
    }
}
