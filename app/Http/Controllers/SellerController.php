<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use App\Models\Invoice;
use App\Models\User;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function inProgress(User $user)
    {
        $data = $user->sellerBarcodes()->where('end_seller_debrief',false)->whereNotIn('status',['delivered','Returned','pending','created'])->get() ;
        $mainPrice = $data->whereNotIn('status',['RTO','Return to seller','canceled'])->whereNotIn('previous_status',['RTO','Return to seller'])->sum('price');
        return view('backend.seller.inProgress')->with('debriefs',$data->groupBy(function($barcode){
            return $barcode->sub_area->name ;
        }))->with('mainPrice',$mainPrice);
    }
    public function finished(User $user)
    {
        //finished but not debriefed yet [not seller debriefed]
        if(Auth::user()->isAdmin())
        {
           $data = Barcode::whereIn('status',['delivered','Returned'])->where([
               ['end_courier_debrief',true],
                ['end_seller_debrief',false],
            ])->get() ;

        }
        else{
            $data = $user->sellerBarcodes()->whereIn('status',['delivered','Returned'])->where([
                ['end_courier_debrief',true],
                ['end_seller_debrief',false],
            ])->get() ;


        }
        $total = $data->sum(function($item){
            if($item->status =='Returned')
                return $item->sub_area->return_price ;
            return $item->price ;
        });
        return view('backend.seller.finished')->with('debriefs',$data->load('sub_area'))->
            with('total',$total);

        // grouped
//        $data = $user->sellerBarcodes()->whereIn('status',['delivered','Returned'])->where('end_seller_debrief',false)->get() ;
//        return view('backend.seller.finished')->with('debriefs',$data->groupBy(function($barcode){
//            return $barcode->sub_area->name;
//        }));

            }
    // postponed [finished but debriefed] ;
//    public function xyz(User $user)
//    {
//        $data = $user->sellerBarcodes()->where('end_seller_debrief',true)->get() ;
//        return view('backend.seller.finished')->with('debriefs',$data->groupBy(function($barcode){
//            return $barcode->sub_area->name;
//        }));
//    }
    public function invoices()
    {
        return view('backend.seller.Invoices')->with('invoices',(Auth()->user()->isAdmin() ? Invoice::with('barcodes')->get() :Auth()->user()->sellerInvoices->load('barcodes') ));
    }
}
