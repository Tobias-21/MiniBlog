<?php

namespace App\Events;

use App\Models\Publication;
use Dotenv\Util\Str;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use LaravelLang\Lang\Plugins\Spark\Stripe;

class PublicationRejetted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $publication;
    /**
     * Create a new event instance.
     */
    public function __construct(Publication $publication)
    {
        $this->publication = $publication;
        
    }
   

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
