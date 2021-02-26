<?php

namespace App\Listeners;

use App\Events\ReSendEmailWithLoginCredentialsUser;
use App\Mail\ReLoginCredentials;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ReSendMailCredentials
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
     * @param  ReSendEmailWithLoginCredentialsUser  $event
     * @return void
     */
    public function handle(ReSendEmailWithLoginCredentialsUser $event)
    {
        Mail::to($event->user)->queue(
            new ReLoginCredentials($event->user, $event->password)
        );
    }
}
