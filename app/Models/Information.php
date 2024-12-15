<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Information extends Model
{
    protected $table = 'informations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'type',
        'target',
        'division_id',
        'document',
        'start_date',
        'end_date'
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Information::class);
    }
}
