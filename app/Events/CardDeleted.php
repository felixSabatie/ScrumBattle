<?php

namespace App\Events;

use App\Models\Card;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CardDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $card;
    /**
     * Create a new event instance.
     *
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getCard()
    {
        return $this->card;
    }
}
