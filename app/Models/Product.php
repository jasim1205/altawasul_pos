<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function supplier(){
        return $this->hasMany(Supplier::class);
    }
    public function purchase_details(){
        return $this->hasMany(PurchaseDetails::class);
    }
    public function stock(){
        return $this->hasMany(Stock::class);
    }
    public function sale_details(){
        return $this->hasMany(SaleDetails::class,'product','id');
    }
}
