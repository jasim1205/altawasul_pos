<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory,SoftDeletes;
    public function product(){
        return $this->belongsToMany(Product::class);
    }
    public function purchase(){
        return $this->hasOne(Purchase::class);
    }
}
