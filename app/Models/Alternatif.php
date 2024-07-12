<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
   protected $fillable = ['a', 'user_id'];

    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class, 'alternatif_kriterias')->withPivot('value')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
