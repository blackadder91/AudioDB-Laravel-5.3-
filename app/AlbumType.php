<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumType extends Model
{
    public $timestamps = false;


    public function recordings()
    {
        return $this->hasMany('App\Recording');
    }
}
