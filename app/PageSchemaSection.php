<?php

namespace App;

use App\PageSchema;
use App\VueComponent;
use App\VueComponentDetail;

use Illuminate\Database\Eloquent\Model;

class PageSchemaSection extends Model
{
    //

    // public function vue_component_details()
    // {
    //     return $this->hasMany('VueComponentDetail');
    // }

    public function vue_components()
    {
        return $this->belongsToMany('VueComponent');
    }

    public function page_schemas()
    {
        return $this->belongsToMany('PageSchema');
    }
}
