<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternRegister extends Model
{
    protected $table = 'intern_registers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'identity_number',
        'name',
        'address',
        'school_id',
        'phone_number',
        'email',
        'start_date',
        'end_date',
        'cover_letter',
        'image',
        'token',
        'is_sent'
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
