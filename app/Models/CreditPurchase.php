<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditPurchase extends Model
{
    use HasFactory,SoftDeletes;

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
}
