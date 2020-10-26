<?php

namespace App\Listeners;

use App\Events\NewUserHasRegisteredEvent;
use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeNewUserListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewUserHasRegisteredEvent  $event
     * @return void
     */

    public $delay = 20;

    public function handle(NewUserHasRegisteredEvent $event)
    {
        // sleep(10);
        Mail::to($event->user->email)->send(new WelcomeMail($event->user));
    }
}
