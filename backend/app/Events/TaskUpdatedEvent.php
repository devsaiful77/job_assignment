<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;

    /**
     * Create a new event instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        $channels = [];

        // Send notification to the assigned user
        $channels[] = new PrivateChannel('tasks.' . $this->task->assigned_to);

        // Send notification to all admins (role_id = 1) and managers (role_id = 2)
        $adminsManagers = \App\Models\User::whereIn('role_id', [1, 2])->pluck('id');
        foreach ($adminsManagers as $userId) {
            $channels[] = new PrivateChannel('tasks.admins.' . $userId);
        }

        return $channels;
    }

    public function broadcastWith()
    {
        return [
            'task_id' => $this->task->id,
            'updated_by' => auth()->user()->name,
            'message' => 'A task has been updated',
        ];
    }
}
