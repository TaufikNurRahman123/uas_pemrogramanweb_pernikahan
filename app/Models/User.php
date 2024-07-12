<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'nama',
        'id_google',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function alternatifs()
    {
        return $this->hasMany(Alternatif::class);
    }

    public function bobots()
    {
        return $this->hasMany(Bobots::class);
    }

    public function kriterias()
    {
        return $this->hasMany(Kriteria::class);
    }

    public function normalisasi()
    {
        return $this->hasMany(Normalisasi::class);
    }

    public function preferensi()
    {
        return $this->hasMany(Preferensi::class);
    }
}
