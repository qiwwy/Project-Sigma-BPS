<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    protected $table = 'schools';
    protected $primaryKey = 'id';

    protected $fillable = [
        'school_name',
        'type_school'
    ];

    public function registers(): HasMany
    {
        return $this->hasMany(InternRegister::class);
    }
}
