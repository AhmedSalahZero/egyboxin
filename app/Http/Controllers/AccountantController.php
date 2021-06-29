<?php

namespace App\Http\Controllers;

use App\Exports\CourierDebriefExport;
use App\Exports\SellerDebriefExport;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AccountantController extends Controller
{
    public function courierDebrief()
    {
        return view('backend.accountant.courier-debrief')
            ->with('areas',Country::all());
    }
    public function getCourierDebrief(User $courier):View
    {
        $data = $courier->barcodes()->where('end_courier_debrief',false)->get() ;
        $endDebrief = $data->filter(function($barcode){
            return $barcode->status != 'delivered' && $barcode->status !='Returned' ;
        })->count();
        $totalPriceExceptReturned = $data->sum(function($barcode){

            if ($barcode->status == 'Returned' || $barcode->status == 'RTO' )
                return 0 ;
            return $barcode->price ;
        });
        return view('backend.accountant.debrief-data')->with('barcodes',$data)
            ->with('endDebrief',$endDebrief ===0)
            ->with('totalPriceExceptReturned',$totalPriceExceptReturned);
    }
    public function endCourierDebrief(User $courier):void
    {
        $courier->barcodesDelivered()->update([
            'end_courier_debrief'=>true ,
            'deliver_courier_id'=>$courier->id
        ]);
         $courier->barcodesReturned()->update([
            'end_courier_debrief'=>true ,
            'return_courier_id'=>$courier->id
        ]);
        $courier->barcodes()->detach();
    }
    public function sellerDebrief():View
    {
        return view('backend.accountant.seller-debrief')
            ->with('areas',Country::all());
    }
    public function getSellerDebrief(User $seller):View
    {

        $data = $seller->sellerBarcodes()->whereIn('status',['Returned','delivered'])->where('end_seller_debrief',false)->get() ;
        $endDebrief = $data->filter(function($barcode){
            return $barcode->status != 'delivered' && $barcode->status !='Returned' ;
        })->count();
        return view('backend.accountant.seller-data')->with('debriefs',$data->groupBy(function($barcode){
            return $barcode->sub_area->name;
        })
        )
            ->with('endDebrief',$endDebrief ===0);
    }
    public function endSellerDebrief(Request $request , User $seller,Invoice $invoice):void
    {

        $invoice = $seller->addNewInvoice($request,$invoice);

        $seller->sellerBarcodes()->whereIn('status',['Returned','delivered'])->where('invoice_id',null)->update([
            'end_seller_debrief'=>true ,
            'payment_method'=>$request->paymentMethod ,
            'invoice_id'=>$invoice->id ,
        ]);

    }
    public function exportSellerDebrief(Request $request):BinaryFileResponse
    {
        return Excel::download( new SellerDebriefExport($request->barcodes_ids) , "seller_debrief_for_$request->seller_name.xlsx");
    }

    public function exportCourierDebrief(Request $request):BinaryFileResponse
    {
        return Excel::download( new CourierDebriefExport($request->barcodes_ids,$request->courier_name) , "courier_debrief_for_$request->courier_name.xlsx");
    }


}
