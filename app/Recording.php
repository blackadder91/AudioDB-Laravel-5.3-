<?php

namespace App;

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
        $thumbPath = $size == 'full' ? '' : 'thumbnails/' . $size . '/';
        return url('/') . '/images/media/recordings/' . $this->slug . '/' . $thumbPath . $this->getImage('recording_main')->filename;
    }

    public function getImage($imageType, $slug = '')
    {
        $image = $this->images()
            ->join('image_types', 'images.image_type_id', '=', 'image_types.id')
            ->where('image_types.code', $imageType)
            ->where('images.imageable_type', get_class());

        if ($slug == '')
            $image = $image->inRandomOrder();
        else
            $image = $image->where('images.slug', '=', $slug);

        return $image->first();
    }

    public function getImages($imageType)
    {
        return $this->images()
            ->join('image_types', 'images.image_type_id', '=', 'image_types.id')
            ->where('image_types.code', $imageType)
            ->where('images.imageable_type', get_class())
            ->get();
    }

}
