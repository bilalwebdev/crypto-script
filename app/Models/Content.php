<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $casts = [
        'content' => 'object'
    ];


    public function images()
    {
        return $this->hasOne(FrontendMedia::class, 'content_id');
    }


    public function child()
    {
        return $this->hasMany(Content::class, 'parent_id');
    }
}
