<?php

namespace App\Providers;

use App\Events\TaskAssignedEvent;
use App\Events\TaskUpdatedEvent;
use App\Listeners\SendTaskAssignedNotification;
use App\Listeners\SendTaskUpdatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        TaskAssignedEvent::class => [
            SendTaskAssignedNotification::class
        ],


        TaskUpdatedEvent::class => [
            SendTaskUpdatedNotification::class
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
