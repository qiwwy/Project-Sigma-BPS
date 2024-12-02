<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogbookIntern extends Model
{
    protected $table = 'logbook_intern';
    protected $primaryKey = 'id';

    protected $fillable = [
        'intern_id',
        'date_logbook',
        'job_description',
        'completion_stat',
        'documentation',
        'accept_stat'
    ];

    public function intern(): BelongsTo
    {
        return $this->belongsTo(Interns::class);
    }
}
