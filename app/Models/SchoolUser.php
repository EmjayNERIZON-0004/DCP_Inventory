<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SchoolUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'school_users';

    protected $fillable = [
        'pk_school_id',
        'username',
        'email',
        'password',
        'default_password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'pk_school_id', 'pk_school_id');
    }
}
