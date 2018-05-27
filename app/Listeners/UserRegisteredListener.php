<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Mail;

/**
 * Class UserRegisteredListener
 * @package App\Listeners
 */
class UserRegisteredListener
{
    /**
     * @param Registered $event
     */
    public function handle(Registered $event)
    {
        Mail::to($event->user->getAttribute('email'))
            ->send(new UserRegistered($event->user, $event->password));
    }
}
