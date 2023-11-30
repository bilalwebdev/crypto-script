<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendMedia extends Model
{
    use HasFactory;

    protected $casts = [
        'media' => 'object'
    ];
}
