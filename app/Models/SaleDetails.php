<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetails extends Model
{
    use HasFactory,SoftDeletes;
    public function sale(){
        return $this->belongsTo(Sales::class, 'sale_id','id');
    }
    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
