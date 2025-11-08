<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolEmployee extends Model
{
    protected $table = 'schools_employee';
    protected $primaryKey = 'pk_schools_employee_id';
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'birthdate',
        'employee_number',
        'position_title_id',
        'salary_grade',
        'school_id',
        'sex',
        'deped_email',
        'deped_email_status',
        'm365_email_status',
        'canva_login_status',
        'lr_portal_status',
        'l4t_recipient',
        'smart_tv_recipient',
        'l4nt_recipient',
        'created_at',
        'updated_at'
    ];
    public function positionTitle(){
        return $this->belongsTo(EmployeePosition::class,'position_title_id','pk_position_title_id');
    }
    public function schoolOfEmployee(){
        return $this->belongsTo(School::class,'school_id','pk_school_id');
    }
}
