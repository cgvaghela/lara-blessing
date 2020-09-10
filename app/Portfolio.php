<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'portfolio';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'title', 'link','description', 'image'];

    public function scopeActive($query) {
        return $query->whereStatus('1');
    }
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
