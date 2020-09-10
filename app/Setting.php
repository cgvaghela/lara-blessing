<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
   
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['site_title', 'logo', 'email', 'phone', 'address', 'map', 'facebook', 'twitter', 'linkedin', 'googleplus'];
}
