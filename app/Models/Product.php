<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'product_name',
        'product_model',
        'location_rak',
        'cost_code',
        'oem',
        'cross_reference',
        'origin',
        'cost_unit_price',
        'sale_price_one',
        'sale_price_two',
        'description',
        'size',
        'product_image',
        'product_image_two',
        'product_image_three',
        'product_image_four',
        'qr_code',
        // এখানে অন্য যে কলামগুলো একসাথে সাবমিট করবে, সেগুলোও যোগ করো
    ];
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
        return $this->hasOne(Stock::class);
    }
    public function sale_details(){
        return $this->hasMany(SaleDetails::class,'product','id');
    }
}
