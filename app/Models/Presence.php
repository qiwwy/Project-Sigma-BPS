<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presence extends Model
{
    protected $table = 'presences';
    protected $primaryKey = 'id';

    protected $fillable = [
        'intern_id',
        'value',
        'presence_time',
        'presence_date',
        'status'
    ];

    public function intern(): BelongsTo
    {
        return $this->belongsTo(Interns::class);
    }
}
