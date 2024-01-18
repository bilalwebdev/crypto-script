<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommisionSetting extends Model
{
    use HasFactory;


    protected $fillable = ['account_type', 'commision_percentage'];
}
