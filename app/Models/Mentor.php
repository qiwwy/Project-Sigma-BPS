<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mentor extends Model
{
    protected $table = 'mentors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'division_id',
        'identity_number',
        'name',
        'address',
        'phone_number',
        'email',
        'image'
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function interns(): HasMany
    {
        return $this->hasMany(interns::class);
    }
}
