<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\TaskUpdateMail;
use App\Events\TaskUpdatedEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTaskUpdatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(TaskUpdatedEvent $event)
    {
        // Get all Admins and Managers
        $users = User::whereIn('role_id', [1, 2])->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new TaskUpdateMail($event->task));
        }


    }
}
