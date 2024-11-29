<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LastDateInterns extends Model
{
    protected $table = 'last_date_interns';
    protected $primaryKey = 'id';
    protected $fillable = [
        'end_date',
        'count',
    ];

    public function queues(): HasMany
    {
        return $this->hasMany(InternQueue::class, 'last_date_id');
    }
}
