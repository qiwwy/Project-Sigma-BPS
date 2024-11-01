<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    protected $table = "divisions";
    protected $primaryKey = 'id';

    protected $fillable = [
        'division_name'
    ];

    public function mentors(): HasMany
    {
        return $this->hasMany(Mentor::class, 'mentor_id');
    }
}
