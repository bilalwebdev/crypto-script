<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $casts = [
        'fonts' => 'object',
        'email_config' => 'object',
        'seo_tags' => 'array',
        'kyc' => 'array',
        'color' => 'array'
    ];
}
