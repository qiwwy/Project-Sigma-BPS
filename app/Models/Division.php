<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    protected $table = 'divisions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'division_name'
    ];

    public function interns(): HasMany
    {
        return $this->hasMany(Interns::class, 'division_id');
    }

    public function informations(): HasMany
    {
        return $this->hasMany(Information::class, 'division_id');
    }
}
