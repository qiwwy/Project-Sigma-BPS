<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskSubmission extends Model
{
    protected $table = 'task_submissions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'intern_id',
        'information_id',
        'file_path',
        'note'
    ];

    public function information(): BelongsTo
    {
        return $this->belongsTo(Information::class);
    }
    public function intern(): BelongsTo
    {
        return $this->belongsTo(Interns::class);
    }
}
