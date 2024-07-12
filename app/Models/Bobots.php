<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobots extends Model
{
    use HasFactory;
    protected $fillable = [
        'b1', 'b2', 'b3', 'b4', 'b5', 'user_id',
    ];
}
