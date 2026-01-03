<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpPosition extends Model
{
    protected $table = 'school_employee_position';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    public function employees()
    {
        return $this->hasMany(SchoolEmployee::class, 'position_id', 'id');
    }
}
