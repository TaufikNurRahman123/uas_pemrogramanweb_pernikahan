<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'alt_id', 'kategori', 'c1', 'c2', 'c3', 'c4', 'c5'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
