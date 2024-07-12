<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preferensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'kr_id', 'v'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
