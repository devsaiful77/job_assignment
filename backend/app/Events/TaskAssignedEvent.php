<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskAssignedEvent implements ShouldBroadcast
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
        // return new Channel('tasks');
        return new PrivateChannel('tasks.' . $this->task->assigned_to);
    }

    public function broadcastWith()
    {
        return [
            'task_id' => $this->task->id,
            'assigned_to' => $this->task->assigned_to,
            'project_id' => $this->task->project_id,
            'message' => 'A new task has been assigned',
        ];
    }
}

