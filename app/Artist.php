<?php

namespace App;

use App\Helpers\ImageHelper;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function recordings()
    {
        return $this->hasMany('App\Recording');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function releases()
    {
        return $this->hasManyThrough('App\Release', 'App\Recording');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value, '-');
    }

    public function getMainImageUrl($size = 'full')
    {
        $ih = new ImageHelper($this);
        return $ih->getImageUrl('artist_main', $size);
    }


}
