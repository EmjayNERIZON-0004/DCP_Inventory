<?php

namespace App\Models\Equipment;

use Illuminate\Database\Eloquent\Model;

class EquipmentLocation extends Model
{
    protected $table = "equipment_location";
    protected $primaryKey = "pk_equipment_location_id";
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    public function equipmentDetails()
    {
        return $this->hasMany(EquipmentDetails::class, 'equipment_location_id','pk_equipment_location_id');
    }
}
