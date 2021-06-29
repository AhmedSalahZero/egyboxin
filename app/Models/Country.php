<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'price',
    ];
    public function users()
    {
        return $this->hasMany(User::class , 'area_id','id');
    }
    public function sellers()
    {
        return $this->hasMany(User::class , 'area_id','id')->where('type','seller');
    }
    public function couriers()
    {
        return $this->hasMany(User::class , 'area_id','id')->where('type','courier');
    }
    public function operators()
    {
        return $this->hasMany(User::class , 'area_id','id')->where('type','operator');
    }
    public function subAreas()
    {
        return $this->hasMany(SubArea::class ,'area_id','id');
    }
}
