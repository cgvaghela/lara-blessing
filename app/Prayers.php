<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prayers extends Model
{
   
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prayers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'anon', 'email', 'authcode', 'submitted', 'closed', 'closed_comment', 'title', 'body', 'notify', 'ip_address', 'active'];
}
