<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileFormat extends Model
{
    public $timestamps = false;


    public function archDiscs()
    {
        return $this->hasMany('App\ArchDisc');
    }
}
