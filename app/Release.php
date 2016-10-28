<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    public function recording()
    {
        return $this->belongsTo('App\Recording');
    }

    public function label()
    {
        return $this->belongsTo('App\Label');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function format()
    {
        return $this->belongsTo('App\Format');
    }

    public function archDiscs()
    {
        return $this->belongsToMany('App\ArchDisc', 'archive')->withPivot(['flags', 'notes', 'file_format_id']);
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
