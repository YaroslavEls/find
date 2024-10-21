<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ChatController extends Controller
{
    public function index(Request $request): Response
    {
        if ($request->query('sort') == 'archive') {
            $chats = $request->user()->archivedChats();
        } else {
            $chats = $request->user()->nonArchivedChats();
        }

        $chats->load(['seeker', 'saloon', 'latestMessage']);

        $unread_chats_ids = $request->user()->unread_chats();

        $chats->each(function ($chat) use ($request, $unread_chats_ids) {
            $chat->has_new_messages = in_array($chat->id, $unread_chats_ids);
            $chat->archived = $request->user()->is_seeker()
                ? $chat->seeker_archived 
                : $chat->saloon_archived;
            unset($chat['seeker_archived'], $chat['saloon_archived']);
        });

        $chats = $chats->sortByDesc(function($chat) {
            return $chat->latestMessage->created_at;
        })->values()->all();

        return Inertia::render('Chat/Index', [
            'chats' => $chats
        ]);
    }

    public function create(Request $request, User $user): RedirectResponse|Response
    {
        if ($request->user()->cannot('chat', $user)) {
            abort(403);
        }

        $chat = $request->user()->chats()
            ->where([
                ['seeker_id', $request->user()->is_seeker() 
                    ? $request->user()->userable_id
                    : $user->userable_id
                ],
                ['saloon_id', $request->user()->is_seeker()
                    ? $user->userable_id
                    : $request->user()->userable_id
                ]
            ])
            ->first();

        if ($chat) {
            return redirect(route('chat.show', ['chat' => $chat]));
        }

        $breadcrumbs = Breadcrumbs::generate('chats');
        $breadcrumbs->push([
            'title' => $user->userable->name, 
            'url' => route('chat.create', ['user' => $user])
        ]);

        return Inertia::render('Chat/Create', [
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ]);
    }

    public function store(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->is_saloon()) {
            $saloon_id = $request->user()->userable_id;
            $seeker_id = $user->userable_id;
        } else {
            $saloon_id = $user->userable_id;
            $seeker_id = $request->user()->userable_id;
        }

        $chat = Chat::firstOrCreate([
            'saloon_id' => $saloon_id,
            'seeker_id' => $seeker_id
        ]);

        $data = [
            'sender_id' => $request->user()->id,
            'receiver_id' => $user->id,
            'text' => $request->text
        ];

        $chat->messages()->create($data);

        $chat->load(['messages']);

        return redirect(route('chat.show', ['chat' => $chat]));
    }

    public function show(Request $request, Chat $chat): Response
    {
        if ($request->user()->cannot('view', $chat)) {
            abort(403);
        }

        $chatter = $request->user()->is_seeker()
            ? $chat->saloon
            : $chat->seeker;

        $breadcrumbs = Breadcrumbs::generate('chat', $chat, $chatter);

        $chat->load(['messages', 'seeker', 'saloon']);
        $chat->messages->load(['sender']);

        $chat->archived = $request->user()->is_seeker()
            ? $chat->seeker_archived 
            : $chat->saloon_archived;
        unset($chat['seeker_archived'], $chat['saloon_archived']);

        $this->read($request, $chat);

        return Inertia::render('Chat/Show', [
            'breadcrumbs' => $breadcrumbs,
            'chat' => $chat
        ]);
    }

    public function read(Request $request, Chat $chat): void
    {
        if ($request->user()->cannot('view', $chat)) {
            abort(403);
        }

        $messages_to_read = $chat->messages
            ->where('receiver_id', $request->user()->id)
            ->where('read', false);

        if (!$messages_to_read->isEmpty()) {
            $messages_to_read->toQuery()->update(['read' => true]);
        }
    }
}
