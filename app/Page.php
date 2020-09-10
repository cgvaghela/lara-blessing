<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'title', 'content'];

    public function scopeSlug($query, $filename) {
        return $query->whereSlug($filename);
    }

    public function scopeActive($query) {
        return $query->whereStatus('1');
    }

}
