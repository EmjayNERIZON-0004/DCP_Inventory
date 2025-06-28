<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DCPDeliveryCondintion extends Model
{
    protected $table = 'dcp_delivery_conditions';
    protected $primaryKey = 'pk_dcp_delivery_conditions_id';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

  
public function dcpBatchItems()
{
    return $this->hasMany(DCPBatchItem::class, 'condition_id', 'pk_dcp_delivery_conditions_id');
}
}
