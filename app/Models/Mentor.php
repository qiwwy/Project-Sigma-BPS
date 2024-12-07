<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mentor extends Model
{
    protected $table = 'mentors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'password',
        'role',
        'identity_number',
        'name',
        'address',
        'phone_number',
        'division',
        'email',
        'image'
    ];

    public function interns(): HasMany
    {
        return $this->hasMany(interns::class);
    }
}
