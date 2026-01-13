<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesReturnDetails extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'sales_return_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_amount',
    ];
    public function salesReturn()
    {
        return $this->belongsTo(SalesReturn::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
