<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function purchase_details(){
        return $this->hasMany(PurchaseDetails::class);
    }
    public function sale_details(){
        return $this->hasMany(SaleDetails::class,'category_id','id');
    }
}
