<?php

namespace App\Services;

use App\Models\DCPBatchItem;

class DCPBatchItemService
{
    public function create($data)
    {
        return DCPBatchItem::create($data);
    }
}
