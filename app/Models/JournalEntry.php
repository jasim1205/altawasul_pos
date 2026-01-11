<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalEntry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'description',
        'reference_type',
        'reference_id',
        'source_type',
        'source_id',
    ];
    public function journalDetails()
    {
        return $this->hasMany(JournalEntryDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
