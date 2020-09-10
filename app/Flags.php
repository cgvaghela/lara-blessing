<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flags extends Model
{
   
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'flags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_id', 'ip_address', 'flagged_date'];
}
