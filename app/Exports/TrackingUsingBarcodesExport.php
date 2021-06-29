<?php

namespace App\Exports;

use App\Models\Barcode;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrackingUsingBarcodesExport implements FromCollection,WithHeadings
{
    protected $barcodes_ids ;
    public function __construct($barcodes_ids)
    {
        $this->barcodes_ids = $barcodes_ids;

    }
    public function headings(): array
    {
        return $this->headAttributes();
    }
    public function collection(): Collection
    {
        $barcodes = collect(explode(',',rtrim($this->barcodes_ids,',')))
            ->map(function($barcode_id){
                return  Barcode::where('id',trim($barcode_id))->first();
            })
            ->each(function($barcode){
                $barcode->price = ($barcode->status =='Returned'||$barcode->status =='RTO') ? '0' : $barcode->price .' EGP' ;
                $barcode->courier_name =$barcode->courier()->first() ? $barcode->courier()->first()->name : 'none';
                $barcode->seller_name = $barcode->seller->name  ;
                $barcode->date= $barcode->created_at ;
                $barcode->makeHidden($this->hiddenAttributes());
            });
        return collect($barcodes->toArray());
    }
    protected function headAttributes():array
    {
        return [
            'Tracking Number' ,  'client Name' , 'Client Phone ' ,'Address' , 'price','prev_status' , 'Status'  ,'Courier ','Seller','Date','Hub','Area'
        ];
    }
    protected function hiddenAttributes():array
    {
        return [
            'seller_id','sub_area_id','seller','area','sub_area','payment_method','note','end_seller_debrief',
            'end_courier_debrief','country_id','scheduling_date','scheduling_time','scheduling_times',
            'deliver_courier_id','return_courier_id' , 'updated_at','created_at',
            'content','id','shipping_price','invoice_id'
        ];

    }

}
