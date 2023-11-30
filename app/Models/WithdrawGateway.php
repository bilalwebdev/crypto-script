<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawGateway extends Model
{
    use HasFactory;

    public function withdrawLogs()
    {
        return $this->hasMany(Withdraw::class,'withdraw_method_id');
    }
}
