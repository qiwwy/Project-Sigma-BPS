<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'actor_id',
        'username',
        'password'
    ];

    public function intern(): BelongsTo
    {
        return $this->belongsTo(Interns::class);
    }
}
