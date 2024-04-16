<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory,SoftDeletes;

    public function category(){
        return $this->hasMany(Category::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function purchase_details(){
        return $this->hasMany(PurchaseDetails::class,'company_id','id');
    }
}
