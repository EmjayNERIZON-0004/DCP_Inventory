<?php

namespace App\Models\SchoolEquipment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolEquipmentClassification extends Model
{
    protected $table = 'school_equipment_classifications';
    protected $primaryKey = 'id';
    public $timestamps = true; // Set false if table doesn't have created_at/updated_at
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    public function schoolEquipments()
    {
        return $this->hasMany(SchoolEquipment::class, 'classification_id', 'id');
    }
}
