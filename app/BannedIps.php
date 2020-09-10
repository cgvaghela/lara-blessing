<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannedIps extends Model
{
   
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banned_ips';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip_address', 'banned_date', 'reason'];
}
