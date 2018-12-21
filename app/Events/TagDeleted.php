<?php

namespace App\Events;

use App\Notification;
use App\Tag;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TagDeleted {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Tag $tag) {
        Notification::create([
            'space_id' => $tag->space_id,
            'entity_id' => $tag->id,
            'entity_type' => 'tag',
            'action' => 'tag.deleted'
        ]);
    }
}