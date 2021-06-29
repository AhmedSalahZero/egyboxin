<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class Barcode extends Model
{
    use HasFactory;

    protected $appends = ['seller_name','hub_name','sub_area_name'];
    public function getSellerNameAttribute()
    {
        return $this->seller->name ;
    }
    public function getHubNameAttribute()
    {
        return $this->area->name ;
    }
    public function getSubAreaNameAttribute()
    {
        return $this->sub_area->name ;
    }
    public function getPriceAttribute($val)
    {
        if (Auth()->user()->isSeller() && ($this->end_courier_debrief || $this->end_seller_debrief) && $this->status == 'Returned')
        {

            return '0';
        }
        elseif ((!Auth()->user()->isSeller()) && ( $this->status == 'RTO' || $this->status =='Return to Seller' || $this->status =='Returned' || $this->status =='canceled' || $this->previous_status =='Return to seller' || $this->previous_status =='RTO' )  )
            return '0' ;
        else
            return $val ;
    }
    public function getShippingPriceAttribute($val)
    {
        if(Auth::user()->isSeller() &&! in_array($this->status ,$this->SellerAllowedStatus()) && ( ! $this->end_courier_debrief ||  ! $this->end_seller_debrief) )
        {
            return $val ;
        }
        elseif (Auth::user()->isSeller() && $this->end_courier_debrief && $this->status =='Returned' || Auth::user()->isSeller() && $this->end_seller_debrief && $this->status =='Returned')
        {
            return $this->sub_area->return_price ;
        }
        elseif($this->status == 'RTO' || $this->status =='Return to Seller' || $this->status =='Returned' || $this->status =='canceled' || $this->previous_status =='Return to seller' || $this->previous_status =='RTO'  )
            return $this->sub_area->return_price ;
        return $val ;
    }
    public function getStatusAttribute($status):string
    {
        if(! Auth()->user()->isSeller() || (Auth()->user()->isSeller() && in_array($status ,$this->SellerAllowedStatus() ) && $this->previous_status !='reschedule' || $this->end_courier_debrief|| $this->end_seller_debrief) )
        {
            return $status ;
        }
        return 'out to deliver' ;
    }
    private function SellerAllowedStatus():array
    {
        return [
            'created' ,
            'pending',
            'received hub',
            'out to delivery'
        ];
    }

    protected $fillable = [
        'country_id', 'barcode_number', 'client_name' ,  'phone', 'address', 'price' , 'content' , 'status','seller_id','note',
        'scheduling_date','scheduling_time','previous_status','scheduling_times','sub_area_id',
        'end_courier_debrief','end_seller_debrief','deliver_courier_id','return_courier_id','shipping_price',
        'payment_method','invoice_id'
    ];

    public function logs()
    {
        return $this->hasMany(Log::class ,'barcode_id','id');

    }
    public function seller():BelongsTo
    {
        return $this->belongsTo(User::class ,'seller_id' , 'id');
    }
    public function area():BelongsTo
    {
        return $this->belongsTo(Country::class , 'country_id','id');
    }
    public function sub_area():BelongsTo
    {
        return $this->belongsTo(SubArea::class , 'sub_area_id','id');
    }
    public function getCreatedAtAttribute($date)
    {
        return date('l , d F Y ' , strtotime($date)) ;
    }
     public function scopeValidReceivedItem($query , $barcodeNo)
     {
         return $query
             ->whereIn('barcode_number',[$barcodeNo])
             ->whereIn('status',['created','transfer','reschedule','canceled'])
             ->get();

     }
     public function scopeValidAssignItem($query , $barcodeNo)
     {
         return $query->where('status','received hub')
             ->where('barcode_number',$barcodeNo)
             ->whereIn('previous_status',['reschedule','created'])
             ->first() ;
     }
    public function scopeValidReturnedItem($query , $barcodeNo)
    {
        return $query->whereIn('status',['RTO'])
            ->where('barcode_number',$barcodeNo)
            ->whereIn('previous_status',['canceled','reschedule','RTS'])
            ->get();
    }
    public function scopeValidTransferItem($query , $barcodeNo)
    {
        return $query->where('status','received hub')
            ->where('barcode_number',$barcodeNo)
            ->get() ;
    }

    public  function courier():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'barcode_couriers', 'barcode_number', 'courier_id'
        ,'barcode_number','id'
        );
    }
    public function scopeGetPossibleStatus($query):array
    {
        return [
            'created','received hub','out to deliver','RTO','reschedule',
            'transfer','delivered','Returned','canceled' , 'Return to seller'
        ];
    }
    public function scopeGetPossiblePreviousStatus($query):array
    {
        return [
            'created','received hub','out to deliver',
            'delivered','RTO','reschedule','Returned','canceled',
            'transfer','Return to seller'
        ];
    }
    public function govern()
    {
        return $this->belongsTo(Country::class ,'country_id','id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }

    public function resetStatus()
    {

        $this->deleteLogsExceptPending();

        if($this->courier->count())

            $this->courier()->detach();

        $this->update([
            'status'=>'created' ,
            'previous_status'=>'pending',
        ]);

    }

    private function deleteLogsExceptPending():void
    {
        $this->logs()->where('status','not like','% Has Add New Shipment')->delete();
    }



}
