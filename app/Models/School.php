<?php

namespace App\Models;

use App\Models\ISP\ISPDetails;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $primaryKey = 'pk_school_id';


    protected $fillable = [
        'pk_school_id',
        'SchoolID',
        'SchoolName',
        'SchoolLevel',
        'Region',
        'Division',
        'District',
        'image_path',
        'Province',
        'CityMunicipality',
        'SchoolContactNumber',
        'SchoolEmailAddress',
        'PrincipalName',
        'PrincipalContact',
        'PrincipalEmail',
        'ICTName',
        'ICTContact',
        'ICTEmail',
        'CustodianName',
        'CustodianContact',
        'CustodianEmail',
        'created_at',
        'updated_at'
    ];

    public function schoolUser()
    {
        return $this->hasOne(SchoolUser::class, 'pk_school_id', 'pk_school_id');
    }
    public function schoolCoordinates()
    {
        return $this->hasOne(SchoolCoordinates::class, 'pk_school_id', 'pk_school_id');
    }

    public function schoolData()
    {
        return $this->hasMany(SchoolData::class, 'pk_school_id', 'pk_school_id');
    }
    public function ispDetails()
    {
        return $this->hasMany(ISPDetails::class, 'school_id', 'pk_school_id');
    }
}
