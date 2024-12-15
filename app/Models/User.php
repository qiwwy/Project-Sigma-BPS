<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Harus mewarisi Authenticatable
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable // Harus mewarisi Authenticatable untuk autentikasi
{
    protected $table = 'users'; // Menentukan tabel yang digunakan
    protected $primaryKey = 'id'; // Menentukan primary key

    // Kolom yang dapat diisi mass-assignment
    protected $fillable = [
        'interns_id',
        'username',
        'password',
    ];

    // Menentukan relasi dengan model Interns
    public function intern(): BelongsTo
    {
        return $this->belongsTo(Interns::class, 'interns_id'); // Menggunakan relasi belongsTo
    }

    public function presences(): HasMany
    {
        return $this->hasMany(Presence::class, 'user_id');
    }
}
