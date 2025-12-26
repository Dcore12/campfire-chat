<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function store(Request $request, Room $room)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        if (! $room->users->contains(auth()->id())) {
            abort(403);
        }

        $message = Message::create([
            'user_id'          => auth()->id(),
            'content'          => $request->content,
            'messageable_id'   => $room->id,
            'messageable_type' => Room::class,
        ]);

        broadcast(new MessageSent($message))->toOthers();
        //\Log::info('🚀 MessageSent dispatched', ['room' => $room->id]);

        // ✅ MUITO IMPORTANTE
        return response()->json($message->load('user'));
    }

}
