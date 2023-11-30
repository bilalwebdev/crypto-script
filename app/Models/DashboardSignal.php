<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardSignal extends Model
{
    use HasFactory;

    public function signal()
    {
        return $this->belongsTo(Signal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
