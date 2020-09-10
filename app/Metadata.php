<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'metadata';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['url', 'title', 'meta_title', 'meta_keywords', 'meta_description', 'created_at', 'updated_at'];

}
