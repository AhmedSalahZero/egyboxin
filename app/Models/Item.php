<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $casts = [
        'barcode_id' => 'array',
    ];
    protected $fillable = [
        'barcode_id',
    ];
}
