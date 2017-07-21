<?php
namespace App\Helpers;

use Intervention\Image\ImageManager;

use App\Image;
use App\ImageType;

class ImageHelper
{

    protected $allowedFileExt = array('gif', 'jpg', 'jpeg', 'png');
    protected $entity;
    protected $entityAlias;
    protected $entitySlug;
    protected $fileExt;
    protected $imageableType;
    protected $imageTitleMap = array(
        'App\\Release' => 'catalog_no',
        'default' => 'slug',
    );
    protected $imageSizes = array(
        'medium' => '250',
    );

    private function getEntityAlias()
    {
        $entityClass = get_class($this->entity);
        $match = array();
        preg_match('/App\\\\(.*)/', $entityClass, $match);
        if (isset($match[1]))
            return strtolower($match[1]);
    }

    public function getImageUrl($imageType, $size = 'full')
    {
        $entityAlias = $this->getEntityAlias();
        $imagesUri = url('/') . '/images/media/' .  $entityAlias . 's/';
        $thumbPath = $size == 'full' ? '' : 'thumbnails/' . $size . '/';

        if($image = $this->getImage($imageType)) {
            return $imagesUri . $this->entity->slug . '/' . $thumbPath . $image->filename;
        } else {
            return null;
        }
    }

    public function getImage($imageType)
    {
        $image = Image::join('image_types', 'images.image_type_id', '=', 'image_types.id')
            ->where('image_types.code', $imageType)
            ->where('images.imageable_type', 'like', '%' . ucfirst($this->entityAlias) . '%')
            ->where('imageable_id', $this->entity->id)
            ->inRandomOrder();

        return $image->first();
    }

    public function __construct($entity)
    {
        $this->entity = $entity;
        $this->imageableType = get_class($entity);
        $this->entitySlug = $entity->slug;
        $this->entityAlias = $this->getEntityAlias();
    }

    private function _isFileExtAllowed()
    {
        if (in_array($this->fileExt, $this->allowedFileExt))
            return true;
        else
            return false;
    }

    private function _getFileExt($file, $fileSrcType = 'file_obj')
    {
        switch($fileSrcType) {
            case "file_obj":
                return $this->fileExt = $file->getClientOriginalExtension();
            case "url":
                return $this->fileExt = $this->_getFileExtFromUrl($file);
                break;
        }
        return false;
    }

    private function _getFileExtFromUrl($url)
    {
        $urlParts = explode('/', $url);
        if (count($urlParts) == 0)
            return false;

        $filename = end($urlParts);

        $match = array();
        preg_match("/\.(.*)/", $filename, $match);
        if (isset($match[1])) {
            $filenameParts = explode('.', $filename);
            return count($filenameParts) > 1 ? end($filenameParts) : false;
        }

        return false;
    }
    private function _getImageTitle()
    {
        $imageTitleField = in_array($this->imageableType, $this->imageTitleMap) ?
            $this->imageTitleMap[$this->imageableType] : $this->imageTitleMap['default'];
        return $this->entity->$imageTitleField;
    }

    private function _getImageType($imageType)
    {
        return ImageType::where('code', $imageType)->first();
    }

    public function update($file, $imageType, $fileSrcType = 'file_obj')
    {
        if(!$imageTypeObj = $this->_getImageType($imageType))
            return 'Invalid image type';

        $image = Image::where('image_type_id', $imageTypeObj->id)
            ->where('imageable_type', $this->imageable_type)
            ->where('imageable_id', $this->entity->id)
            ->first();

        if (!$image)
            return $this->upload($file, $imageType, $fileSrcType);

        // TODO:
        // Remove old image file
        // Create new one
        // Update db
    }

    public function upload($file, $imageType, $fileSrcType = 'file_obj')
    {
        if(!$imageType = $this->_getImageType($imageType))
            return 'Invalid image type';

        $this->image = new Image;
        $this->image->imageable_id = $this->entity->id;
        $this->image->imageable_type = $this->imageableType;
        $this->image->title = $this->_getImageTitle();
        $this->image->image_type_id = $imageType->id;
        $fileUploadResult = $this->_uploadFile($file, $fileSrcType);

        if ($fileUploadResult == false) {
            $this->image->save();
            return false;
        } else
            return $fileUploadResult;
    }

    private function _uploadFile($file, $fileSrcType)
    {
        if (!$this->_getFileExt($file, $fileSrcType))
            return 'Failed to retrieve file extension';

        if (!$this->_isFileExtAllowed())
            return 'File extension not allowed';

        $fileDirectory = $this->_getFileDirectory();
        $fileSubdirectory = $this->_getFileSubdirectory();
        $token =  sprintf('%x', time());
        $this->image->slug = $this->image->image_type->code . '_' . $token;
        $this->image->filename = $this->image->slug . '.' . $this->fileExt;

        if (!file_exists($fileSubdirectory))
            mkdir($fileSubdirectory);

        switch($fileSrcType) {
            case "file_obj":
                if($file->isValid()) {
                    $file->move($fileDirectory, $this->image->filename);
                    $this->generateThumbnails();
                    return false;
                } else
                    return 'Invalid file';
                break;
            case "url":
                try{
                    if(!$file = file_get_contents($file))
                        throw new Exception('Failed to read file from url ' . $url);

                    $hFile = fopen($fileDirectory . '/' . $this->image->filename, 'a');
                    fwrite($hFile, $file);
                    fclose($hFile);
                } catch(Exception $e) {
                    return $e->getMessage();
                }
                break;
        }
        $this->generateThumbnails();
        return false;
    }

    private function _getFileDirectory($imageSize = 'full')
    {
        $subDirectory = $this->_getFileSubdirectory();
        if($imageSize == 'full')
            return public_path($subDirectory);
        else {
            return public_path($subDirectory . "/thumbnails/{$imageSize}/");
        }
    }

    private function _getFileSubdirectory()
    {
        $dir = 'images/media/'
            . ltrim(strtolower(strstr($this->image->imageable_type, '\\')), '\\')
            . 's';

        if ($this->entitySlug != '')
            $dir .= '/' . $this->entitySlug;

        return $dir;
    }

    public function generateThumbnails($entitySlug = '')
    {
        if ($entitySlug != '')
            $this->entitySlug = $entitySlug;

        $fileDirectory = $this->_getFileDirectory();
        $fileSubdirectory = $this->_getFileDirectory();
        $imageManager = new ImageManager;
        $fileSubdirectory .=  '/thumbnails';
        if (!file_exists($fileSubdirectory))
            mkdir($fileSubdirectory);

        foreach($this->imageSizes as $type => $dim)
        {
            $thumbDir = $fileSubdirectory . "/{$type}";
            if (!file_exists($thumbDir))
                mkdir($thumbDir);

            $imageManager->make($fileDirectory . '\\' . $this->image->filename)
                ->resize($dim, $dim, function($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($thumbDir . '/' . $this->image->filename);
        }

        return $thumbDir . '/' . $this->image->filename;
    }

}
