<?php

namespace App\Listeners;

use App\Mail\TaskAssignedMail;
use App\Events\TaskAssignedEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Mail;

class SendTaskAssignedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(TaskAssignedEvent $event)
    {
        $user = $event->task->assignedUser; // Assuming the relationship is defined in Task model
        Mail::to($user->email)->send(new TaskAssignedMail($event->task));
    }
}
