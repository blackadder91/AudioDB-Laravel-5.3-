<?php

namespace App;

use App\Image;
use App\Helpers\ImageHelper;

use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
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

    public function getMainImageUrl($size = 'full')
    {
        $ih = new ImageHelper($this);
        return $ih->getImageUrl('recording_main', $size);
    }

}
