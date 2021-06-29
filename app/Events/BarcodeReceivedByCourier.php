<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BarcodeReceivedByCourier
{
  //  use Dispatchable, InteractsWithSockets, SerializesModels;
    public $barcode  ;
    public $courier ;
    public $status ;
    public function __construct($barcode , $courier , $status )
    {
        $this->barcode =$barcode ;
        $this->courier=$courier ;
        $this->status = $status ;
    }
}
