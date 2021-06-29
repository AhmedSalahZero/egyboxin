<?php

namespace App\Http\Controllers;
use App\Events\BarcodeDeleted;
use App\Events\BarcodeUpdated;
use App\Exports\ShipmentExport;
use App\Models\Barcode;
use App\Models\Country;
use App\Models\SubArea;
use App\Models\User;
use App\Rules\NotEqualToZeroAreaRule;
use App\Rules\SellerIdRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarcodeController extends Controller
{

//    public function index()
//    {
//        $barcodes = Barcode::where('seller_id',Auth()->user()->id)->where('status','pending')->get();
//        return view('backend.barcodes.index')->with('barcodes',$barcodes);
//    }
    public function showPendingShipments()
    {
        $barcodes = Barcode::where('seller_id',Auth()->user()->id)->where('status','pending')->get()->load(['area','sub_area']);
        return view('backend.barcodes.pending')->with('barcodes',$barcodes)->with('barcodesExcelType','pending');
    }
    public function showCreatedShipments()
    {
        $barcodes = Barcode::where('seller_id',Auth()->user()->id)->where('status','created')->get()->load(['area','sub_area']);
        return view('backend.barcodes.index')->with('barcodes',$barcodes)->with('barcodesExcelType','created');
    }
    public function showInProgressShipments()
    {
        if(Auth::user()->isAdmin())
        {
            $barcodes = Barcode::whereNotIn('status',['pending','created','Returned','delivered'])->get()->load(['area','sub_area']);

        }
        else{
            $barcodes = Barcode::where('seller_id',Auth()->user()->id)->whereNotIn('status',['pending','created','Returned','delivered'])->get()->load(['area','sub_area']);
        }
        return view('backend.barcodes.index')->with('barcodes',$barcodes)->with('barcodesExcelType','progress');
    }

    public function showAllShipments()
    {
        if(Auth()->user()->type =='admin')
            $barcodes = Barcode::whereNotIn('status',['pending','created'])->get()->load(['seller','courier','area','sub_area','logs']);
        else{
            $barcodes = Barcode::where('seller_id',Auth()->user()->id)->get()->load(['seller','courier','area','sub_area','logs']);
        }
        return view('backend.barcodes.index')->with('barcodes',$barcodes)->with('barcodesExcelType','all');
    }
    public function create()
    {
        $countries = Country::get();
        $sellers= User::where('type','seller')->get();
        return view('backend.barcodes.create')->with('countries' , $countries)->with('sellers',$sellers)
            ->with('subAreas',Auth::user()->area->subAreas)
            ->with('barcodes',Barcode::where([
              [  'seller_id',Auth()->user()->id  ] ,
                ['status' , '=' ,'pending' ] ,
            ])->get());

    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'string|required|max:100',
            'address' => 'string|required',
            'price' => 'required|numeric',
            'phone' => 'required|numeric',
            'sub_area_id'=>['required',new NotEqualToZeroAreaRule()],
            'seller_id'=>new SellerIdRule()
        ]);
        $user = User::firstorfail();
        $data = [
            'country_id' => SubArea::where('id',$request->sub_area_id)->first()->area->id,
        'barcode_number' =>time(),
        'client_name' => $request->client_name,
        'phone' => $request->phone,
        'address' => $request->address,
        'price' => $request->price,
        'content' => $request->content,
        'seller_id'=>Auth()->user()->isAdmin() ? $request->seller_id : Auth()->user()->id,
            'sub_area_id'=>$request->sub_area_id,

        // add Shipping Price Or Not ? ? ?? ? ? ?? ? ? ?

            //    'shippingPrice'

        ];
        if($request->status)
        {
            $status = [
                'status'=>$request->status
            ] ;
        }
        else
        {
            $status = [
                'status'=>'pending'
            ] ;
        }

        $data = array_merge($data , $status);


        $barcode = Barcode::create($data);

        return redirect()->route('barcodes.create');

    }
    public function edit(Barcode $barcode)
    {
        return view('backend.barcodes.edit')->with('barcode' , $barcode)
            ->with('subAreas',$barcode->seller->area->subAreas);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'client_name' => 'string|required|max:100',
            'address' => 'string|required',
            'price' => 'required|numeric',
            'phone' => 'required|numeric',
            'sub_area_id'=>['required',new NotEqualToZeroAreaRule()]
        ]);
        $barcode = Barcode::findorfail($id);
      //  $user = User::firstorfail();

        $data = [
            'country_id' => SubArea::where('id',$request->sub_area_id)->first()->area->id,
        'client_name' => $request->client_name,
        'phone' => $request->phone,
        'address' => $request->address,
        'price' => $request->price,
        'content' => $request->content,
            'sub_area_id'=>$request->sub_area_id,
        ];
        if($request->status)
        {
            $status = [
                'status'=>$request->status
            ] ;
        }
        else
        {
            $status = [
                'status'=>'pending'
            ] ;
        }
        $data = array_merge($data , $status);
        if($barcode->status =='created')
             Event(new BarcodeUpdated($barcode , Auth()->user()));
        $barcode->update($data);
        return redirect()->route('barcodes.all')->with('success','Shipment Has Been Updated Successfully');

    }

    public function destroy(Barcode $barcode)
    {

        if($barcode->logs){
            $barcode->logs()->delete();
        }

        if($barcode->courier)
        {
            $barcode->courier()->detach();
        }
        $barcode->delete();
    //    Event(new BarcodeDeleted($barcode , Auth()->user()));
        return response()->json([
            'success'=>true ,

        ]);
    }
    public function printShipment(Barcode $shipment)
    {
       return view('backend.barcodes.printOne')->with('barcode',$shipment);
    }
    public function exportExcel($status)
    {
        return Excel::download( new ShipmentExport(Auth()->user(),$status) , 'shipments.xlsx');
    }

}
