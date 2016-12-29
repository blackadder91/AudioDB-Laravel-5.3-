<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
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

    public function getMainImageUrl()
    {
        return url('/') . '/images/artists/' . $this->getImage('artist_main')->filename;
    }

    public function getImage($imageType, $slug = '')
    {
        $image = $this->images()
            ->join('image_types', 'images.image_type_id', '=', 'image_types.id')
            ->where('image_types.code', $imageType)
            ->where('images.imageable_type', 'App\Artist');

        if ($slug == '')
            $image = $image->inRandomOrder();
        else {
            $image = $image->where('images.slug', '=', $slug);
        }

        return $image->first();
    }

    public function getImages($imageType)
    {
        return $this->images()
            ->join('image_types', 'images.image_type_id', '=', 'image_types.id')
            ->where('image_types.code', $imageType)
            ->where('images.imageable_type', 'App\Artist')
            ->get();
    }
}
