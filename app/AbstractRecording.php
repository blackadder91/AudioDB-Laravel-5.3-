<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRecording extends Model
{
    protected $imagesUri;
    protected $metaEntityCode;

    public function __construct()
    {
        $this->imagesUri = url('/') . '/images/media/'. $this->metaEntityCode .'s/';
    }

    private function _getClass()
    {
        return 'App\\' . ucfirst($this->metaEntityCode);
    }

    public function getMainImageUrl($size = 'full')
    {
        $thumbPath = $size == 'full' ? '' : 'thumbnails/' . $size . '/';
        if($image = $this->getImage('recording_main'))
            return $this->imagesUri . $this->slug . '/' . $thumbPath . $image->filename;
        else
            return '';
    }

    public function getImage($imageType, $slug = '')
    {
        $image = $this->images()
            ->join('image_types', 'images.image_type_id', '=', 'image_types.id')
            ->where('image_types.code', $imageType)
            ->where('images.imageable_type', $this->_getClass());

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
            ->where('images.imageable_type', $this->_getClass())
            ->get();
    }

}
