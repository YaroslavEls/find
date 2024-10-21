<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageStoreRequest;
use App\Models\Chat;

class MessageController extends Controller
{
    public function store(MessageStoreRequest $request, Chat $chat): void
    {
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

        broadcast(new MessageSent($message))->toOthers();
    }
}
