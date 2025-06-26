<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $primaryKey = 'SchoolID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'SchoolID', 'SchoolName', 'Region', 'Division',
        'District', 'SchoolHead', 'ContactNumber', 'Email'
    ];
}

