<?php

namespace App\Http\Controllers;

use App\Events\BarcodeCanceled;
use App\Events\BarcodeDelivered;
use App\Events\BarcodeReturnedSeller;
use App\Events\BarcodeScheduledFromClient;
use App\Events\BarcodeScheduledFromSeller;
use App\Models\Barcode;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourierController extends Controller
{
//    public function index()
//    {
//       $barcodes = Barcode::where('status','out to deliver')->orWhere('status','RTO')->get();
//       return view('backend.courier.index')->with('barcodes',$barcodes);
//    }
    public function showDeliverItems(User $courier)
    {
        return view('backend.courier.deliverToClient')->with('barcodes',$courier->barcodesToClient);
    }
    public function showReturnToSellersItems(User $courier)
    {
        $itemsToReturn = $courier->barcodesToReturn->load('seller')->each(function($barcode){
            $barcode->seller_info = $barcode->seller->name . ','. $barcode->seller->email . ',' .$barcode->seller->phone.','.$barcode->seller->id;
        })->groupBy('seller_info');


        return view('backend.courier.ReturnToSellers')->with('barcodes',$itemsToReturn);
    }
    public function ScheduleToSeller(Request $request ,User $courier)
    {

        $barcodesQuery = $courier->barcodesToReturn()->where('barcodes.seller_id',$request->seller_id);
        Event(new BarcodeScheduledFromSeller($barcodesQuery->get() , $courier));
        $barcodesQuery->update([
            'status'=>'reschedule' ,
            'previous_status'=>'Return to seller' ,
            'note'=>$request->message
        ]);
//        $courier->barcodesToReturn()->wherePivot(
//            'seller_id',$request->seller_id
//        )->detach();
      return response()->json([
          'status'=>true
      ]);
    }
    public function ReturnedToSeller(Request $request ,User $courier)
    {

        $barcodesQuery=$courier->barcodesToReturn()->where('barcodes.seller_id',$request->seller_id);
        $barcodesQuery->update([
            'status'=>'Returned' ,
            'previous_status'=>'Return to seller' ,
            'return_courier_id'=>$courier->id ,
            'note'=>$request->message
        ]);
        Event(new BarcodeReturnedSeller($barcodesQuery->get() , $courier));
//        $courier->barcodesToReturn()->wherePivot(
//            'seller_id',$request->seller_id
//        )->detach();
        return response()->json([
            'status'=>true
        ]);
    }
    public function cancelledItem(Barcode $barcode,$comment):JsonResponse
    {
//        $barcode->courier()->detach();
        $barcode->update([
            'status'=>'canceled',
            'previous_status'=>'out to deliver',
            'note'=> $comment ,
        ]);
        Event(new BarcodeCanceled($barcode ,$barcode->courier->first()));
        return response()->json([
            'status'=>true
        ]);
    }
    public function RescheduledItem(Barcode $barcode,$note ):JsonResponse
    {
       // $barcode->courier()->detach();
        $barcode->update([
            'status'=>'reschedule',
            'previous_status'=>'out to deliver',
            'note'=> $note,
            'scheduling_times'=>($barcode->scheduling_times ? $barcode->scheduling_times + 1 : 1 )
        ]);
        Event(new BarcodeScheduledFromClient($barcode ,$barcode->courier->first()));
        return response()->json([
            'status'=>true
        ]);


    }
    public function deliveredItem(Barcode $barcode)
    {
        //$barcode->courier()->detach();
        $barcode->update([
            'previous_status'=>$barcode->status ,
            'status'=>'delivered' ,
            'deliver_courier_id'=>$barcode->courier->first()->id ,
        ]);
        Event(new BarcodeDelivered($barcode ,$barcode->courier->first()));
        return response()->json([
            'status'=>true
        ]);
    }
    public function ShowUnDebriefed(User $courier)
    {

        $unDebriefed = $courier->barcodes ;
        $totalPrice = $unDebriefed->sum('price') ;
      //  $courier->barcodesDelivered()
        return view('backend.courier.UnDebriefed')->with('barcodes',$unDebriefed)
            ->with('totalPriceExceptReturned',$totalPrice);
    }
}
