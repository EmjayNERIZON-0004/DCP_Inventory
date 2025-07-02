<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DCPBatchItem extends Model
{
protected $table = 'dcp_batch_items';
  protected $primaryKey = 'pk_dcp_batch_items_id';
protected $fillable = [
    'dcp_batch_id', 
    'item_type_id',
     'generated_code', 
     'quantity', 
     'unit', 
     'condition_id',
    'brand',
     'serial_number',
      'iar_ref_code', 
      'iar_value', 
      'itr_value', 
      'iar_date', 
      'itr_ref_code',
       'itr_date',
    'certificate_of_completion',
     'date_approved'
];
public function dcpBatch()
{
    return $this->belongsTo(DCPBatch::class, 'dcp_batch_id', 'pk_dcp_batches_id');  
}
public function dcpItemType()
{
    return $this->belongsTo(DCPItemTypes::class, 'item_types_id', 'pk_dcp_item_types_id');
}
public function dcpCondition()
{
    return $this->belongsTo(DCPDeliveryCondintion::class, 'condition_id', 'pk_dcp_condition_id');
}
}