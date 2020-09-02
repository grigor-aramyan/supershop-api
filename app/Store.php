<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\VueComponentDetail;
use App\User;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'db_username', 'db_password', 'db_uri', 'store_uri', 'logo_uri', 'slogan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vue_component_details()
    {
        return $this->hasMany('VueComponentDetail');
    }

    public function page_schemas()
    {
        return $this->belongsToMany('PageSchema');
    }
}
