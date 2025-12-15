<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalEntryDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'journal_entry_id',
        'account_id',
        'debit',
        'credit',
    ];
    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class);
    }
    public function account()
    {
        return $this->belongsTo(Accounts::class);
    }
}
