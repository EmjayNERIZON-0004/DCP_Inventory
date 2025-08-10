<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DCPItemBrand extends Model
{
    protected $table = 'dcp_item_brands';
    protected $primaryKey = 'pk_dcp_item_brand_id';
    protected $fillable = [
        'name',
        'updated_at',
        'created_at',
    ];
}
