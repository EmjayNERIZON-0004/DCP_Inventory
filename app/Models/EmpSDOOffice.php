<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpSDOOffice extends Model
{
    protected $table = 'school_employee_sdo_office';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    public function employees()
    {
        return $this->hasMany(SchoolEmployee::class, 'sdo_office_id', 'id');
    }
}
