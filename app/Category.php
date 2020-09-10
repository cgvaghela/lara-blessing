<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'portfolio_categories';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function scopeActive($query) {
        return $query->whereStatus('1');
    }
    
    public function porfolio(){
        return $this->hasOne('App\Portfolio');
    }
}
