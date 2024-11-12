<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternQueue extends Model
{
    protected $table = 'intern_queues';
    protected $primaryKey = 'id';
    protected $fillable = [
        'last_date_id',
        'identity_number',
        'name',
        'address',
        'school_name',
        'phone_number',
        'email',
        'start_date',
        'end_date',
        'image',
    ];

    public function lastDate(): BelongsTo
    {
        return $this->belongsTo(LastDateInterns::class);
    }
}
