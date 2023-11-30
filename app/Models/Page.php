<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $casts = ['seo_keywords' => 'array'];

    public function widgets()
    {
        return $this->hasMany(PageSection::class,'page_id');
    }
}
