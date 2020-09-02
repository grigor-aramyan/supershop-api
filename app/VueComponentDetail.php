<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\VueComponent;
use App\Store;
use App\PageSchemaSection;

class VueComponentDetail extends Model
{
    //

    // public function page_schema_section()
    // {
    //     return $this->belongsTo('PageSchemaSection');
    // }

    // public function vue_component()
    // {
    //     return $this->belongsTo('VueComponent');
    // }

    public function store()
    {
        return $this->belongsTo('Store');
    }
}
