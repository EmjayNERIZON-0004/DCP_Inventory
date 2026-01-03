<?php

namespace App\Models\SchoolEquipment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolEquipmentDocumentType extends Model
{
    protected $table = 'school_equipment_document_types';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    public function documents()
    {
        return $this->hasMany(SchoolEquipmentDocument::class, 'document_type_id', 'id');
    }
}
