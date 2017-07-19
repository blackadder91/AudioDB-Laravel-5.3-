<?php

namespace App;

class Recording extends AbstractRecording
{
    public function __construct()
    {
        $this->metaEntityCode = 'recording';
        parent::__construct();
    }

    public function albumType()
    {
        return $this->belongsTo('App\AlbumType');
    }

    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function label()
    {
        return $this->belongsTo('App\Label');
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
