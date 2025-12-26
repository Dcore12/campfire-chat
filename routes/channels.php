<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Conversation;
use App\Models\Room;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('room.{roomId}', function ($user, $roomId) {
    return Room::where('id', $roomId)
        ->whereHas('users', function ($q) use ($user) {
            $q->where('users.id', $user->id);
        })
        ->exists();
});

Broadcast::channel('dm.{conversationId}', function ($user, $conversationId) {
    return true;
});