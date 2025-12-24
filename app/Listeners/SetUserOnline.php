<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class SetUserOnline
{
    public function handle(Login $event): void
    {
        $event->user->update([
            'status' => 'online',
        ]);
    }
}
