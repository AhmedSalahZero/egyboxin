<?php

namespace App\Http\Controllers;


use App\Events\BarcodeReceived;
use App\Models\Barcode;
use App\Models\Country;
use App\Models\SubArea;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;


class OperatorController extends Controller
{
    public function newOrders()
    {
        return view('backend.operator.newOrders')->with('sellers',User::sellers()->get())
                                                      ->with('areas',Country::all());
    }
    public function getAreaSeller(Country $area)
    {
        $areaSellers = $area->sellers ;
        return response()->json([
            'sellers'=>$areaSellers ,
            'NoSellers'=>count($areaSellers),
            'status'=>true

        ]);
    }

    public function getSubAreaSeller(SubArea $subArea)
    {


        $areaSellers = $subArea->area->sellers ;
        return response()->json([
            'sellers'=>$areaSellers ,
            'NoSellers'=>count($areaSellers),
            'status'=>true

        ]);
    }

    public function getSellerSubAreas(User $seller)
    {


        $areaSellers =$seller->area->subAreas ;
        return response()->json([
            'sellers'=>$areaSellers ,
            'NoSellers'=>count($areaSellers),
            'status'=>true

        ]);
    }



    public function getProductsForSeller(Country $area , User $seller):JsonResponse
    {
        $ProductsInThisArea = $seller->createdProductsInThisArea($area->id) ;
       return response()->json([
           'productsInThisArea'=>$ProductsInThisArea ,
           'NoProductsInThisArea'=>count($ProductsInThisArea) ,
           'seller'=>$seller,

       ]);
    }

    public function getCreatedShipmentsForThisArea(Country $area ):JsonResponse
    {
        $ProductsInThisArea = $this->createdProductsInThisArea($area->id) ;
        return response()->json([
            'productsInThisArea'=>$ProductsInThisArea ,
            'NoProductsInThisArea'=>count($ProductsInThisArea) ,


        ]);
    }

    public function getAllCreatedShipmentsForThisArea($areaId)
    {
        $products = Barcode::where('status','created')->where('country_id',$areaId)->get()->groupBy(function($shipment){
            return $shipment->seller->name . ',' . $shipment->seller->phone .','. $shipment->seller->address ;
        });

        return response()->json([
            'productsInThisArea'=>$products ,
            'NoProductsInThisArea'=>count($products),

        ]);
    }

    public function showReceiveOrder()
    {
        return view('backend.operator.ReceiveOrder');

    }
    public function CheckItemTrackingNumberForReceiving($trackingNo): JsonResponse
    {
        $itemsForReceive = Barcode::validReceivedItem(trim($trackingNo)) ;
        if (count($itemsForReceive))
        {
            $itemsForReceive->first()->seller_name = $itemsForReceive->first()->seller->name ;
            $itemsForReceive->first()->area_name = $itemsForReceive->first()->sub_area->name ;
            $itemsForReceive->first()->hub_name = $itemsForReceive->first()->area->name ;
            return response()->json([
                'status'=>true,
                'items'=>$itemsForReceive
            ]);
        }
        return response()->json(['status'=>false]);

    }
    public function makeAsReceived($barcodes):JsonResponse
    {
        collect(explode(',',$barcodes))->each(function($barcodeNo){
            $barcode = Barcode::where('barcode_number',trim($barcodeNo))->first();
            Event(new BarcodeReceived($barcode , Auth()->user()));
            $barcode->update([
                'previous_status'=>$this->getPreviousStatus($barcode) ,
                'status'=>$this->getStatus($barcode),
            ]);


//            $barcode->update([
//               'previous_status'=>($barcode->previous_status=='RTO') ? 'RTO' :$barcode->status ,
//               'status'=>($barcode->status == 'canceled' ? 'RTO' : 'received hub'),
//           ]);
            if ($barcode->previous_status == 'reschedule' || $barcode->previous_status =='canceled'|| $barcode->previous_status =='RTO')
            {
                $barcode->courier->first()->barcodes()->detach($barcode->barcode_number);
            }
        });
        return response()->json([
            'status'=>true
        ]);
    }
    protected function getPreviousStatus($barcode):string
    {
        if($barcode->status == 'transfer')
            return $barcode->previous_status ;
        elseif ($barcode->status == 'RTO')
            return 'RTO' ;
        else
            return $barcode->status;
    }
    protected function getStatus($barcode):string
    {
        if ($barcode->status == 'canceled')
             return 'RTO';
            return 'received hub';
    }
    public function AssignToCourier()
    {
        return view('backend.operator.assignToCourier')->with('areas',Country::all());
    }
    public function getAreaCouriers(Country $area):JsonResponse
    {
        $areaCouriers = $area->couriers ;
        return response()->json([
            'couriers'=>$areaCouriers ,
            'NoCouriers'=>count($areaCouriers),
            'status'=>true

        ]);
    }
    public function CheckItemTrackingNumberForAssign($trackingNo)
    {
        $itemForReceive = Barcode::validAssignItem($trackingNo) ;
        if ($itemForReceive->exists()){
            $itemForReceive->area_name = $itemForReceive->area->name;
            $itemForReceive->seller_name = $itemForReceive->seller->name;

            return response()->json([
                    'status'=>true,
                    'item'=>$itemForReceive
            ]);
        }

        return response()->json(['status'=>false]);
    }
    public function assignToUser($barcodes,User $courier):void
    {

        collect($this->getBarcodesIds($barcodes))->each(function($barcodeNo) use ($courier){
            $courier->barcodes()->attach([
                'barcode_number'=>$barcodeNo  ,
            ],
            ['seller_id'=>Barcode::where('barcode_number',$barcodeNo)->first()->seller_id ,
            ]

            );
            $barcode = Barcode::where('barcode_number',$barcodeNo)->first() ;
            $barcode->update([
                'previous_status'=>$barcode->status  ,
                'status'=>'out to deliver' ,
            ]);

        });
    }
    public function getBarcodesIds($barcodes):array
    {
        return explode(',',$barcodes);
    }
    public function ReturnToSeller()
    {
        return view('backend.operator.returnToSeller')->with('areas',Country::all());
    }
    public function CheckItemTrackingNumberForReturnToSeller($trackingNo):JsonResponse
    {
        $itemsToReturnToSellers = Barcode::validReturnedItem($trackingNo) ;
        if (count($itemsToReturnToSellers))
            return response()->json([
                'status'=>true,
                'items'=>$itemsToReturnToSellers
            ]);
        return response()->json(['status'=>false]);
    }
    public function assignToUserToReturnToSeller($barcodes,User $courier):void
    {

        collect($this->getBarcodesIds($barcodes))->each(function($barcodeNo) use ($courier){
            $courier->barcodes()->attach(['barcode_number'=>$barcodeNo],
            [
                'seller_id'=>Barcode::where('barcode_number',$barcodeNo)->first()->seller_id ,
            ]);
            Barcode::where('barcode_number',$barcodeNo)->first()->update([
                'status'=>'Return to seller' ,
                'previous_status'=>'RTO',
            ]);

        });
    }
    public function Transfer()
    {
        return view('backend.operator.transferOrders')->with('areas',Country::all());
    }
    public function CheckItemTrackingNumberForTransfer($trackingNo):JsonResponse
    {
        $itemsForTransfer = Barcode::validTransferItem($trackingNo) ;

        if (count($itemsForTransfer))
            return response()->json([
                'status'=>true,
                'to_areas'=>$this->getDeliverableAreas($this->getCurrentAreaId($trackingNo)),
                'from_area'=>Country::where('id',$this->getCurrentAreaId($trackingNo))->first(),
            ]);
        return response()->json(['status'=>false]);
    }
    protected function getDeliverableAreas($areaID)
    {
       return Country::all()->filter(function($area) use ($areaID){
           return $area->id != $areaID;
       }
       );
    }
    protected function getCurrentAreaId($barcodeNo)
    {
        return Barcode::where('barcode_number',$barcodeNo)->first()->area->id;
    }
    public function getProductInfo($barcode):JsonResponse
    {
        $barcode= Barcode::where('barcode_number',$barcode)->first() ;
        return response()->json([
            'info'=>collect($barcode)->merge(new collection([
                'seller_name'=>$barcode->seller->name
            ]))
        ]);
    }
    public function markAsTransfer(Request $request )
    {

        collect($request->data)->each(function($item){
            $barcode = Barcode::where('barcode_number',$item['barcode_no'])->first();
            $barcode->update([
                'status'=>'transfer' ,
                'previous_status'=>$barcode->previous_status,
                'country_id'=>$item['area']
            ]);
        });
    }
    public function showTrackingOrders()
    {
        return view('backend.operator.trackingOrders')
            ->with('areas',Country::all())
            ->with('status',Barcode::getPossibleStatus())
            ->with('previous_status',Barcode::getPossiblePreviousStatus())
            ->with('sellers',User::sellers()->get())
            ->with('couriers',User::couriers()->get());
    }
    public function showTrackingOrdersByTrackingNumber()
    {
        return view('backend.operator.trackingOrdersByNo');
    }
    public function searchItems(Request $request)
    {

       $data =  Barcode::where('status','!=','pending')->where(function($query) use($request){
            foreach ($request->search_fields as $field)
            {
                if($field['name'] == 'date_from')
                {
                    $query->whereDate('created_at' , '>=', $field['val']);
                }
                elseif ($field['name'] =='date_to')
                {
                    $query->whereDate('created_at' , '<=', $field['val']);
                }
                else{
                    $query->where($field['name'] , trim($field['val']));
                }
            }
        })->get();
       $data->each(function($barcode)
       {
           $barcode->area_name = $barcode->area->name;
           $barcode->barcode_seller_name = $barcode->seller->name;
           $barcode->courier_name = count($barcode->courier) ?$barcode->courier()->first()->name :'None' ;
       });
     return response()->json([
         'search_result'=>$data ,
         'no_search_result'=>count($data)
     ]);

       // Another Way using collection each function
//        $data =  Barcode::where(function($query) use($request){
//            collect($request->search_fields)->each(function($field) use($query){
//                $query->where($field['name'] , $field['val']);
//            });
//        })->get();


        //dd($request->search_fields);

    }
    public function searchByTrackingNumbers(Request $request): JsonResponse
    {
        $data = Barcode::where(function($query) use ($request){
            foreach ($this->getBarcodesIds($request->search_field) as $key=>$barcodesId) {
                    $query->orWhere('barcode_number',trim($barcodesId));
            }
        })->get();
        $data->each(function($barcode){
            $barcode->area_name = $barcode->area->name;
            $barcode->sub_area_name = $barcode->sub_area->name;
            $barcode->barcode_seller_name = $barcode->seller->name;
            $barcode->courier_name = count($barcode->courier) ?$barcode->courier()->first()->name :'None' ;
        });

        return response()->json([
            'search_result'=>$data ,
            'no_search_result'=>count($data)
        ]);


    }

}
