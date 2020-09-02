<?php

namespace App;

use App\PageSchemaSection;

use Illuminate\Database\Eloquent\Model;

class PageSchema extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'page_id'
    ];

    public function schema_sections()
    {
        return $this->belongsToMany('PageSchemaSection');
    }

    public function stores()
    {
        return $this->belongsToMany('Store');
    }
}
