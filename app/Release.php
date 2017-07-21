<?php

namespace App;

use App\Image;
use App\Helpers\ImageHelper;

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
        $ih = new ImageHelper($this);
        if ($releaseImgUrl = $ih->getImageUrl('recording_main', $size))
            return $releaseImgUrl;

        $ih = new ImageHelper($this->recording);
        return $ih->getImageUrl('recording_main', $size);
    }

}
