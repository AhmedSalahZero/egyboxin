<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BarcodeDeleted
{
  //  use Dispatchable, InteractsWithSockets, SerializesModels;
    public $barcode  ;
    public $user ;
    public function __construct($barcode , $user)
    {
        $this->barcode =$barcode ;
        $this->user=$user ;
    }
}
