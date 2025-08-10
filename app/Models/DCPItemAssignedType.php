<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DCPItemAssignedType extends Model
{
    protected $table = 'dcp_assignment_types';
    protected $primaryKey = 'pk_dcp_assignment_types_id';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    public function dcpAssignedUsers()
    {
        return $this->hasMany(DCPItemAssignedUser::class, 'assignment_type_id', 'pk_dcp_assignment_types_id');
    }
}
