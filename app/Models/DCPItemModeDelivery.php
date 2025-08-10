<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DCPItemModeDelivery extends Model
{
    protected $table = 'dcp_item_mode_delivery';
    protected $primaryKey = 'pk_dcp_item_mode_delivery_id';
    protected $fillable = [
        'name',
        'updated_at',
        'created_at',
    ];
}
