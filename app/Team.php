<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'team';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'role', 'description', 'image', 'facebook', 'twitter', 'linkedin', 'googleplus', 'stackoverflow'];
    
    public function scopeActive($query) {
        return $query->whereStatus('1');
    }

}
