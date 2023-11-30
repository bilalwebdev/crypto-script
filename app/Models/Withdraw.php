<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $casts = [
        'proof' => 'array'
    ];

    protected $guarded = [];


    public function withdrawMethod()
    {
        return $this->belongsTo(WithdrawGateway::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
