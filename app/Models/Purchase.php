<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory,SoftDeletes;
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function purchase_details(){
        return $this->hasOne(PurchaseDetails::class);
    }
    public function stock(){
        return $this->hasMany(Stock::class);
    }
    
}