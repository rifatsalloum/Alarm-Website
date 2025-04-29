<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendReminderEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    protected $message;
    protected $title;
    protected $userId;

    /**
     * Create a new event instance.
     */
    public function __construct($userId,string $title,string $message)
    {
        $this->userId = $userId;
        $this->message = $message;
        $this->title = $title;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("reminder." . $this->userId),
        ];
    }

    public function broadcastAs() : string
    {
        return "reminder-message"; //remember front should add . like this .send-chat-message because of laravel and echo broadcasting protocol
    }

    public function broadcastWith() : array
    {
        return [
            "title" => $this->title,
            "message" => $this->message
        ];
    }
}
