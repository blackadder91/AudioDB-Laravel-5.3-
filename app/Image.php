<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;
use App\ImageType;

class Image extends Model
{

    protected $fillable = array('image_type_id', 'imageable_type', 'imageable_id', 'filename', 'slug', 'title' );

    protected $imageSizes = array(
        'medium' => '250',
    );

    protected $entitySlug = '';

    public function image_type()
    {
        return $this->belongsTo('App\ImageType');
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
