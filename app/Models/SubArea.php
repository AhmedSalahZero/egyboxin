<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubArea extends Model
{
    protected $fillable =['name','area_id','deliver_price','return_price'];
    public function area()
    {
        return $this->belongsTo(Country::class , 'area_id','id');
    }
    public function barcodes()
    {
        return $this->hasMany(Barcode::class,'sub_area_id','id');
    }
   // use HasFactory;
}
