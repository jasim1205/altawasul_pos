<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory,SoftDeletes;
    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
