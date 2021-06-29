<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller_id',/* 'courier_id' , */'main_price','discount','payment_method','total','id'
    ];
//    public function courier()
//    {
//        return $this->belongsTo(User::class,'courier_id','id');
//    }
    public function seller()
    {
        return $this->belongsTo(User::class,'seller_id','id');
    }
    public function barcodes()
    {
        return $this->hasMany(Barcode::class,'invoice_id','id');
    }
}
