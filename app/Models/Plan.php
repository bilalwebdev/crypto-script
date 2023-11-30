<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory, Searchable;

    public $searchable = ['plan_name'];

    protected $casts = ['feature' => 'array'];

    public function subscriptions()
    {
        return $this->hasMany(PlanSubscription::class,'plan_id');
    }

    public function signals()
    {
        return $this->belongsToMany(Signal::class, 'plan_signals');
    }
}
