<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternRegister extends Model
{
    protected $table= 'intern_registers';
    protected $primaryKey= 'id';

    protected $fillable= [
        'identity_number',
        'name',
        'address',
        'school_name',
        'phone_number',
        'email',
        'start_date',
        'end_date',
        'cover_letter',
        'image',
        'token'
    ];
}
