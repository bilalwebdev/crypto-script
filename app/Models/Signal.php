<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    use HasFactory, Searchable;

    public $searchable = ['id'];

    protected $casts = [
        'published_date' => 'datetime'
    ];

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_signals');
    }

    public function pair()
    {
        return $this->belongsTo(CurrencyPair::class, 'currency_pair_id');
    }

    public function time()
    {
        return $this->belongsTo(TimeFrame::class, 'time_frame_id');
    }

    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->id = rand(1111111, 99999999);
            }
        });
    }
}
