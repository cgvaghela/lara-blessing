<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prayedfor extends Model
{
   
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prayedfor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id' , 'prayedfor_date' , 'ip_address'];
}
