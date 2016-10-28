<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function artists()
    {
        return $this->morphedByMany('App\Artist', 'taggable');
    }

    public function recordings()
    {
        return $this->morphedByMany('App\Recording', 'taggable');
    }

    public function releases()
    {
        return $this->morphedByMany('App\Release', 'taggable');
    }
}
