<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use HasFactory,SoftDeletes;

    public function saledetails(){
        return $this->hasMany(SaleDetails::class, 'sale_id','id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
