<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
       "*"
    ];
    public function sale(){
        return $this->hasMany(Sale::class);
    }

    public function creditSale(){
        return $this->hasMany(CreditSale::class);
    }
}
