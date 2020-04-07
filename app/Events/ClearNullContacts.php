<?php

namespace App\Events;

use App\Contact;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ClearNullContacts
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $contact;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->contact = $data;
    }

    /**
     * @return Bank;
     */
    public function getContacts()
    {
        return $this->contact;
    }
}
