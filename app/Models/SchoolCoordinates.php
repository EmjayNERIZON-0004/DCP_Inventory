<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolCoordinates extends Model
{
    protected $table = 'school_coordinates';
    protected $primaryKey = 'CoorID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'CoorID',
        'pk_school_id',
        'Latitude',
        'Longitude',
        'created_at',
        'updated_at'
    ];
    public function school()
    {
        return $this->belongsTo(School::class, 'pk_school_id', 'pk_school_id');
    }
   
   

}
