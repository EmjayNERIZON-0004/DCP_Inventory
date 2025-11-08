<?php

namespace App\Models\Equipment;

use Illuminate\Database\Eloquent\Model;

class EquipmentInstaller extends Model
{
       protected $table = "equipment_installer";
    protected $primaryKey = "pk_equipment_installer_id";
    protected $fillable = [
          'name',
        'created_at',
        'updated_at',
    ];
    public function equipmentDetails()
    {
        return $this->hasMany(EquipmentDetails::class, 'equipment_installer_id','pk_equipment_installer_id');
    }
}
