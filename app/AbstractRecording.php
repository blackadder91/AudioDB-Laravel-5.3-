<?php
namespace App;

use App\Image;
use App\Helpers\ImageHelper;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRecording extends Model
{
    protected $imagesUri;
    protected $metaEntityCode;
    protected $recording;

    public function __construct()
    {
        $this->imagesUri = url('/') . '/images/media/'. $this->metaEntityCode .'s/';
    }

    private function _getClass()
    {
        return ucfirst($this->metaEntityCode);
    }

    public function getMainImageUrl($size = 'full')
    {
        $ih = new ImageHelper($this);
        return $ih->getImageUrl($this, 'recording_main', $size)
    }

    public function getImages($imageType)
    {
        return $this->images()
            ->join('image_types', 'images.image_type_id', '=', 'image_types.id')
            ->where('image_types.code', $imageType)
            ->where('images.imageable_type', 'like', '%' . $this->_getClass() . '%')
            ->get();
    }

}
