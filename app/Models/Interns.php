<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interns extends Model
{
    protected $table = 'interns';
    protected $primaryKey = 'id';

    protected $fillable = [
        'mentor_id',
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

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }
}
