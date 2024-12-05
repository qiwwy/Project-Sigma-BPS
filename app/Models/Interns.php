<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Interns extends Model
{
    protected $table = 'interns';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'mentor_id',
        'identity_number',
        'name',
        'address',
        'school_name',
        'phone_number',
        'email',
        'start_date',
        'end_date',
        'status',
        'image',
    ];

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function logbooks(): HasMany
    {
        return $this->hasMany(LogbookIntern::class, 'intern_id');
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getter
    public function getId() {
        return $this->id;
    }
}
