<?php
namespace App\Helpers;

use App\Image;
use App\ImageType;

class ImageHelper
{
    private static $allowedFileTypes = array('gif', 'jpg', 'png');
    public static function upload($file, $imageableType, $imageType, $imageTitle, $entity) {
        if (!in_array($file->getClientOriginalExtension(), self::$allowedFileTypes))
            return false;

        $image = new Image;
        $image->imageable_id = $entity->id;
        $image->imageable_type = $imageableType;
        $image->title = $imageTitle;

        $imageType = !empty($imageType) ? $imageType : 'misc';
        $image->image_type_id = ImageType::where('code', $imageType)->first()->id;

        $image->upload($file, $entity->slug);
        $image->save();
        return true;
    }
}
