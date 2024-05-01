<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDetails extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'category_id', // Add any other attributes you want to be mass-assignable
        // Add other fillable attributes as needed
    ];
    public function purchase(){
        return $this->belongsTo(Purchase::class,'purchase_id','id');
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
     public function getOriginalQuantityAttribute()
    {
        return $this->getOriginal('quantity'); // Assuming 'quantity' is the field storing the original quantity
    }
}
