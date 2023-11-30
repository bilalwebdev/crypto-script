<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCommission extends Model
{
    use HasFactory;

    public function whoGetTheMoney(){
        return $this->belongsTo(User::class,'commission_to');
    }

    public function whoSendTheMoney(){
        return $this->belongsTo(User::class,'commission_from');
    }
}
