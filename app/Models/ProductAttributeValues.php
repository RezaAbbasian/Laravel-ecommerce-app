<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttributeValues extends Pivot
{
public function value(){
    return $this->belongsTo(AttributeValue::class,'value_id','id');
}
}
