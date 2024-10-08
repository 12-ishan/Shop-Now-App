<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';

    public function options()
    {
        return $this->hasMany(AttributeOptions::class, 'attribute_id');
    }

  

}