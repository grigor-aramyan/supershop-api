<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\PageSchemaSection;
use App\VueComponentDetail;

class VueComponent extends Model
{
    //

    // public function vue_component_details()
    // {
    //     return $this->hasMany('VueComponentDetail');
    // }

    public function schema_sections()
    {
        return $this->belongsToMany('PageSchemaSection');
    }
}
