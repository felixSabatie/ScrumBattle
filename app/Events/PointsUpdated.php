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

class PointsUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $updatedCard;
    protected $oldCard;

    /**
     * Create a new event instance.
     *
     * @param Card $updatedCard
     * @param Card $oldCard
     */
    public function __construct(Card $updatedCard, Card $oldCard)
    {
        $this->updatedCard = $updatedCard;
        $this->oldCard = $oldCard;
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

    public function getUpdatedCard()
    {
        return $this->updatedCard;
    }

    public function getOldCard()
    {
        return $this->oldCard;
    }
}
