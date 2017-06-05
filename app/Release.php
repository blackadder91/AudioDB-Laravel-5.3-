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

    // indirect relationships
    public function artist()
    {
        return $this->recording->artist();
    }

    public function genre()
    {
        return $this->recording->genre();
    }

    public function albumType()
    {
        return $this->recording->albumType();
    }

    public function getMainImageUrl($size = 'full')
    {
        if ($this->getImage('recording_main') != null ) {
            $thumbPath = $size == 'full' ? '' : 'thumbnails/' . $size . '/';
            $imageUri = url('/') . '/images/media/releases/' . $this->slug . '/' . $thumbPath;
            return $imageUri . $this->getImage('recording_main')->filename;
        } else {
            return $this->recording->getMainImageUrl($size);
        }
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
