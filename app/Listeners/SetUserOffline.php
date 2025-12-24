<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class SetUserOffline
{
    public function handle(Logout $event): void
    {
        $event->user->update([
            'status' => 'offline',
        ]);
    }
}
