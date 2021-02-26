<?php

namespace App\Providers;

use App\Events\ReSendEmailWithLoginCredentialsUser;
use App\Events\SendEmailWithLoginCredentialsUser;
use App\Listeners\ReSendMailCredentials;
use App\Listeners\SendMailCredentials;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendEmailWithLoginCredentialsUser::class => [
            SendMailCredentials::class,
        ],
        ReSendEmailWithLoginCredentialsUser::class => [
            ReSendMailCredentials::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
