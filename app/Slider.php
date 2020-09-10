<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sliders';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image_name', 'imgPath' , 'link' , 'order'];
    
    public function scopeActive($query) {
        return $query->whereStatus('1');
    }
}
