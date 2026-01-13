<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesReturn extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'sale_id',
        'customer_id',
        'quantity',
        'total_return_amount',
        'reason',
        'return_date',
        'invoice_no'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function salesReturnDetails()
    {
        return $this->hasMany(SalesReturnDetails::class);
    }
}