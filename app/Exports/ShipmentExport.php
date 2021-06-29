<?php

namespace App\Exports;

use App\Models\Barcode;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ShipmentExport implements FromCollection,WithHeadings
{
    protected $user ;
    protected $status ;
    public function __construct(User $user,$status)
    {
        $this->status = $status ;
        $this->user = $user ;
    }
    public function headings(): array
    {
        return ['id', 'Tracking Number','Client Name','Client Phone ' , 'Address', 'Price' , 'Status' , 'Created At' , 'Seller Name ','Hub' , 'Area'];
    }
    public function collection()
    {

        if($this->user->type =='seller')
        {
            if($this->status ==='created')
                $queryBuilder = Barcode::where('status','created')->where('seller_id',$this->user->id);
            elseif ($this->status ==='progress')
            {
                $queryBuilder = Barcode::where('seller_id',$this->user->id)->whereNotIn('status',['pending','created','Returned','delivered']);

            }
            else{
                $queryBuilder = Barcode::where('seller_id',$this->user->id);
            }
//            if($this->status !='all')
//                $queryBuilder = Barcode::where('status',$this->status)->where('seller_id',$this->user->id);
//            else{
//                $queryBuilder = Barcode::where('seller_id',$this->user->id);
//            }
        }
        else {
            if ($this->status != 'all') {
                $queryBuilder = Barcode::where('status', $this->status);
            }
            else{
                $queryBuilder = Barcode::where('status','!=','pending');
            }
        }

      $data = $queryBuilder->get()->each(function($barcode){
          $barcode->price = $barcode->price . ' EGP' ;
          $barcode->makeHidden(['seller_id','sub_area_id','seller','area','sub_area','payment_method','note','end_seller_debrief',
              'end_courier_debrief','country_id','shipping_price','scheduling_date','scheduling_time','scheduling_times'
          ,'deliver_courier_id','return_courier_id' , 'previous_status','updated_at',
              'content','invoice_id'
          ]);
            //$barcode->seller_name=$barcode->seller->name ;
      });
        return collect($data->toArray());
    }
}
