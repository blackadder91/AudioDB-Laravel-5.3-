<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    public function releases()
    {
        return $this->hasMany('App\Release');
    }

    public function recordings()
    {
        return $this->hasMany('App\Recording');
    }

}
