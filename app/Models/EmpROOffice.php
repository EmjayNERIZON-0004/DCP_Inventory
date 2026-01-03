<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpROOffice extends Model
{
    protected $table = 'school_employee_ro_office';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    public function employees()
    {
        return $this->hasMany(SchoolEmployee::class, 'ro_office_id', 'id');
    }
}
