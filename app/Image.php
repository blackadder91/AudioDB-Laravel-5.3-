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

    public function upload($file, $entitySlug = '')
    {
        if($file->isValid())
        {
            $this->entitySlug = $entitySlug;
            $fileDirectory = $this->_getFileDirectory();
            $fileSubdirectory = $this->_getFileSubdirectory();
            $token =  sprintf('%x', time());
            $this->slug = $this->image_type->code . '_' . $token;
            $this->filename = $this->slug . '.' . $file->getClientOriginalExtension();

            if (!file_exists($fileSubdirectory))
                mkdir($fileSubdirectory);

            // Save
            $file->move($fileDirectory, $this->filename);

            // Generate thumbnails
            $this->generateThumbnails();
            // $imageManager = new ImageManager;
            // $fileSubdirectory .=  '/thumbnails';
            // if (!file_exists($fileSubdirectory))
            //     mkdir($fileSubdirectory);
            //
            // foreach($this->imageSizes as $type => $dim)
            // {
            //     $thumbDir = $fileSubdirectory . "/{$type}";
            //     if (!file_exists($thumbDir))
            //         mkdir($thumbDir);
            //
            //     $imageManager->make($fileDirectory . '\\' . $this->filename)
            //         ->resize($dim, $dim, function($constraint) {
            //             $constraint->aspectRatio();
            //         })
            //         ->save($thumbDir . '/' . $this->filename);
            // }
        }
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
            . ltrim(strtolower(strstr($this->imageable_type, '\\')), '\\')
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
        $fileSubdirectory = $this->_getFileDirectory(); //$this->_getFileSubdirectory();
        $imageManager = new ImageManager;
        $fileSubdirectory .=  '/thumbnails';
        if (!file_exists($fileSubdirectory))
            mkdir($fileSubdirectory);

        foreach($this->imageSizes as $type => $dim)
        {
            $thumbDir = $fileSubdirectory . "/{$type}";
            if (!file_exists($thumbDir))
                mkdir($thumbDir);

            $imageManager->make($fileDirectory . '\\' . $this->filename)
                ->resize($dim, $dim, function($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($thumbDir . '/' . $this->filename);
        }

        return $thumbDir . '/' . $this->filename;

        // $fileDirectory = $this->_getFileDirectory();
        // $fileSubdirectory = $this->_getFileDirectory();
        // $imageManager = new ImageManager;
        // $fileSubdirectory .=  '/thumbnails';
        // echo 'x: ' . $fileDirectory . '\\' . $this->filename . '|';
        // if (!file_exists($fileSubdirectory))
        //     mkdir($fileSubdirectory);
        //
        // foreach($this->imageSizes as $type => $dim)
        // {
        //     $thumbDir = $fileSubdirectory . "/{$type}";
        //     if (!file_exists($thumbDir))
        //         mkdir($thumbDir);
        //
        //     $imageManager->make($fileDirectory . '\\' . $this->filename)
        //         ->resize($dim, $dim, function($constraint) {
        //             $constraint->aspectRatio();
        //         })
        //         ->save($thumbDir . '/' . $this->filename);
        // }
    }

}
