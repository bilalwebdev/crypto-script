<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycDocs extends Model
{
    use HasFactory;

    protected $table = "kyc_docs";

    protected $fillable = ['type', 'file', 'user_id'];




    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
