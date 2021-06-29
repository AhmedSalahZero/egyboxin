<?php

namespace App\Exports;

use App\Models\Barcode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CourierDebriefExport implements FromCollection,WithHeadings
{
    protected $barcodes_ids ;
    protected $courierName ;
    public function __construct($barcodes_ids,$courierName)
    {
        $this->barcodes_ids = $barcodes_ids;
        $this->courierName = $courierName ;
    }
    public function headings(): array
    {
        return $this->headAttributes();
    }
    public function collection()
    {
        $barcodes = collect(explode(',',rtrim($this->barcodes_ids,',')))
            ->map(function($barcode_id){
                return  Barcode::where('id',trim($barcode_id))->first();
            })
            ->each(function($barcode){
                $barcode->price = ($barcode->status =='Returned'||$barcode->status =='RTO') ?'0' : $barcode->price .' EGP' ;
                $barcode->courier_name = $this->courierName;
                $barcode->makeHidden($this->hiddenAttributes());
            });
        return collect($barcodes->toArray());
    }
    protected function headAttributes():array
    {
        return [
            'Tracking Number' ,  'client Name' , 'Client Phone ' ,'Address' , 'price', 'Status'  ,'Courier ','Seller','Hub','Area'
        ];
    }
    protected function hiddenAttributes():array
    {
        return [
            'seller_id','sub_area_id','seller','area','sub_area','payment_method','note','end_seller_debrief',
            'end_courier_debrief','country_id','scheduling_date','scheduling_time','scheduling_times'
            ,'deliver_courier_id','return_courier_id' , 'previous_status','updated_at','created_at',
            'content','id','shipping_price','invoice_id'
        ];

    }

}
