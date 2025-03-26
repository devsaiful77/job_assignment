<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CsvProcessingProgress implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $processed;
    public $total;
    public $completed;

    public function __construct($userId, $processed, $total, $completed = false)
    {
        $this->userId = $userId;
        $this->processed = $processed;
        $this->total = $total;
        $this->completed = $completed;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('csv-progress.' . $this->userId);
    }
}
