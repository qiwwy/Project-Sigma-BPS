<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrasferedRegistrationView extends Model
{
    protected $table = "transfered_registration_view";
    protected $id = "id";

    protected $fillable = [
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
