<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, Searchable;

    public $searchable = ['trx'];


    protected $casts = [
        'payment_proof' => 'array',
        'next_payment_date' => 'datetime'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function gateway()
    {
        return $this->belongsTo(Gateway::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOnlinePayment($query)
    {
        $query->where('type', 1)->where('status', 1);
    }

    public function scopeOfflinePayment($query)
    {
        $query->where('type', 0)->where('status', '!=', 0);
    }
}
