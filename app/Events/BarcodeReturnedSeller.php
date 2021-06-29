<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BarcodeReturnedSeller
{
    public $barcodes  ;
    public $user ;
    public function __construct($barcodes , $user)
    {
        $this->barcodes =$barcodes ;
        $this->user=$user ;
    }
}
