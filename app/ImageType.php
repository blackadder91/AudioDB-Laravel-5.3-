<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
    public $timestamps = false;


    public function images() {
        return $this->hasMany('App\Image');
    }
}
