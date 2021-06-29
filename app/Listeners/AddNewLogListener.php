<?php

namespace App\Listeners;

use App\Models\Barcode;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddNewLogListener
{
    protected $log ;

    public function __construct(Log $log)
    {
        $this->log = $log ;
    }
    public function OnBarcodeCreated($event)
    {
        $this->log->create([
            'barcode_id'=>$event->barcode->id  ,
            'user_id'=>$event->user->id ,
            'status'=>$event->user->name  . ' Has Add New Shipment At ' . date('l , d F Y ' , strtotime(now()))   ,

        ]);
    }
    public function OnBarcodeUpdated($event)
    {
        $this->log->create([
            'barcode_id'=>$event->barcode->id  ,
            'user_id'=>$event->user->id ,
            'status'=>$event->user->name  . ' Has Update Shipment With Number ' . $event->barcode->barcode_number . ' At '. date('l , d F Y ' , strtotime(now()))    ,
        ]);
    }
//    public function OnBarcodeDeleted($event)
//    {
//        $this->log->create([
//            'barcode_id'=>null,
//            'user_id'=>$event->user->id ,
//            'status'=>$event->user->name  . ' Has Deleted Shipment With Number ' . $event->barcode->barcode_number . ' At '.now() ,
//        ]);
//    }
//    public function OnBarcodeInHisWayToStockFromSeller($event)
//    {
//        collect($event->barcodes)->each(function($barcode) use($event){
//            $this->log->create([
//                'barcode_id'=> $barcode->id ,
//                'user_id'=>$event->user->id ,
//                'status'=>'Barcode With Number '.$barcode->barcode_number.' In His Way To The Stock From Seller '. $barcode->seller->name ,
//
//            ]);
//        });
//    }

    public function OnBarcodeReceivedAtHub($event)
    {


            $this->log->create([
                'barcode_id'=> $event->barcode->id ,
                'user_id'=>$event->user->id ,
                'status'=>'Barcode With Number '.$event->barcode->barcode_number.' Has Been Received At Hub By '.$event->user->name . ' At '. date('l , d F Y ' , strtotime(now())) ,
            ]);
    }
    public function OnBarcodeReceivedByCourier($event)
    {
        $status = $event->status == 'RTO' ?
            $event->courier->name ." Has Received Shipment With Number ".$event->barcode->barcode_number . ' To Return it To The Seller '.$event->barcode->seller->name . ' At '. date('l , d F Y ' , strtotime(now()))  :
            $event->courier->name ." Has Received Shipment With Number ".$event->barcode->barcode_number . ' To Deliver it To The Client '.$event->barcode->client_name . ' At '. date('l , d F Y ' , strtotime(now())) ;

        $this->log->create([
            'barcode_id'=>$event->barcode->id,
            'user_id'=>$event->courier->id ,
            'status'=>$status  ,
        ]);
    }
    public function OnBarcodeRescheduledFromSeller($event)
    {
        collect($event->barcodes)->each(function($barcode) use($event){
            $this->log->create([
                'barcode_id'=> $barcode->id ,
                'user_id'=>$event->user->id ,
                'status'=>'Shipment With Number '.$barcode->barcode_number.' In His Way To The Hub From Seller '. $barcode->seller->name . ' At '. date('l , d F Y ' , strtotime(now())) ,

            ]);
        });
    }
    public function OnBarcodeBarcodeReturnedSeller($event)
    {
        collect($event->barcodes)->each(function($barcode) use($event){
            $this->log->create([
                'barcode_id'=> $barcode->id ,
                'user_id'=>$event->user->id ,
                'status'=>'Shipment With Number '.$barcode->barcode_number.' Returned To The Seller '. $barcode->seller->name . ' Successfully At' . date('l , d F Y ' , strtotime(now())) ,
            ]);
        });
    }
    public function OnBarcodeCanceled($event)
    {
        $this->log->create([
            'barcode_id'=>$event->barcode->id,
            'user_id'=>$event->user->id ,
            'status'=>'Shipment With Number '.$event->barcode->barcode_number.' Has Been Canceled From Client '. $event->barcode->client_name . ' At '. date('l , d F Y ' , strtotime(now())) ,
        ]);
    }
    public function OnBarcodeScheduledFromClient($event)
    {
        $this->log->create([
            'barcode_id'=>$event->barcode->id,
            'user_id'=>$event->user->id ,
            'status'=>'Shipment With Number '.$event->barcode->barcode_number.' Has Been Rescheduled From Client '. $event->barcode->client_name . ' At '. date('l , d F Y ' , strtotime(now())) .
            ' for ' . $event->barcode->scheduling_times .' Time/Times' ,
        ]);
    }
    public function OnBarcodeDelivered($event)
    {
        $this->log->create([
            'barcode_id'=>$event->barcode->id,
            'user_id'=>$event->user->id ,
            'status'=>'Shipment With Number '.$event->barcode->barcode_number.' Has Been Delivered To Client '. $event->barcode->client_name . ' At '. date('l , d F Y ' , strtotime(now())) ,
        ]);
    }




    public function subscribe($events)
    {
        $events->listen(
            'App\Events\BarcodeCreated' ,
            'App\Listeners\AddNewLogListener@OnBarcodeCreated'
        );
        $events->listen(
            'App\Events\BarcodeReceived' ,
            'App\Listeners\AddNewLogListener@OnBarcodeReceivedAtHub'
        );
        $events->listen(
            'App\Events\BarcodeUpdated' ,
            'App\Listeners\AddNewLogListener@OnBarcodeUpdated'
        );
//        $events->listen(
//            'App\Events\BarcodeDeleted' ,
//            'App\Listeners\AddNewLogListener@OnBarcodeDeleted'
//        );
//        $events->listen(
//            'App\Events\BarcodeInWayToStockFromSeller',
//            'App\Listeners\AddNewLogListener@OnBarcodeInHisWayToStockFromSeller'
//        );
        $events->listen(
            'App\Events\BarcodeReceivedByCourier',
            'App\Listeners\AddNewLogListener@OnBarcodeReceivedByCourier'
        );
        $events->listen(
            'App\Events\BarcodeScheduledFromSeller',
            'App\Listeners\AddNewLogListener@OnBarcodeRescheduledFromSeller'
        );
        $events->listen(
            'App\Events\BarcodeReturnedSeller',
            'App\Listeners\AddNewLogListener@OnBarcodeBarcodeReturnedSeller'
        );
        $events->listen(
            'App\Events\BarcodeCanceled',
            'App\Listeners\AddNewLogListener@OnBarcodeCanceled'
        );
        $events->listen(
            'App\Events\BarcodeScheduledFromClient',
            'App\Listeners\AddNewLogListener@OnBarcodeScheduledFromClient'
        );
        $events->listen(
            'App\Events\BarcodeDelivered',
            'App\Listeners\AddNewLogListener@OnBarcodeDelivered'
        );


    }
}
