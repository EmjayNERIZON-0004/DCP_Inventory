<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SchoolUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'school_users';

    protected $fillable = [
        'SchoolID', 'username', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function school()
{
    return $this->belongsTo(School::class, 'SchoolID', 'SchoolID');
}
}
