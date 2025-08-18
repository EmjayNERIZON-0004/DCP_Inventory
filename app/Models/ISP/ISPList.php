<?php

namespace App\Models\ISP;

use App\Models\ISP\ISPDetails;
use Illuminate\Database\Eloquent\Model;

class ISPList extends Model
{
    protected $table = "isp_list";
    protected $primaryKey = "pk_isp_list_id";
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];
    public function ispDetails()
    {
        return $this->hasMany(ISPDetails::class, 'isp_list_id', 'pk_isp_list_id');
    }
}
