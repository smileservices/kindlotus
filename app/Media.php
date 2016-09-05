<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use File;

use App\Cause;
use App\Update;
use Image;
use Mockery\CountValidator\Exception;

class Media extends Model
{
    protected $table = 'media';
    protected $fillable = [
        'type', 'url', 'name', 'primary'
    ];

    public function mediaable()
    {
        return $this->morphTo();
    }

    /*
     * Save Images
     *
     * */
    public static function addImages(Cause $cause, Update $update = null, $images)
    {
        foreach ($images as $imageUpload) {
            $path = 'storage/causes/';
            $ownerFolder = 'cause' . $cause->id;
            $imageExtension = $imageUpload->guessExtension();
            $imageName = uniqid('img_') . '.' . $imageExtension;
            $thumbName = 'thumb_'.$imageName;
            $fullPath = $path.$ownerFolder.'/'.$imageName;
            $thumbPath = $path.$ownerFolder.'/'.$thumbName;
            $imageUpload->move($path.$ownerFolder, $imageName);
            // resize
            $width = null;
            $height = null;
            if (getimagesize($fullPath)[0] > getimagesize($fullPath)[1]) {
                $width = 1600;
            } else {
                $height = 1600;
            }
            $image = Image::make($fullPath);
            $image->resize($width, $height, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save();
            // make thumbnail
            $image->resize(90, 90, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save($thumbPath);
            //save image to db
            $media = new Media([
                'type' => 'image',
                'url' => $path.$ownerFolder.'/',
                'name' => $imageName,
                'primary' => 0
            ]);
            if ($update) {
                $update->media()->save($media);
            } else {
                $cause->media()->save($media);
            }
        }
    }

    public static function addVideo($owner, $video)
    {
        $code = substr($video, strlen($video)-11);
        $media = new Media([
            'type' => 'youtube',
            'url' => $code,
            'name' => 'video',
            'primary' => 0
        ]);
        $owner->media()->save($media);
    }

    /*
     * Delete Video or Image
     *
     * If $media is not provided, then all media will be deleted
     *
     * */
    public static function deleteMedia($owner, $media = null)
    {
        if ($media == null) {
            $owner->media()->delete();
        } else {
            $file = public_path($media->url).$media->name;
            $thumb = public_path($media->url).'thumb_'.$media->name;
            if(file_exists($file)) {
                unlink($file);
            }
            if(file_exists($thumb)) {
                unlink($thumb);
            }
            $media->delete();
        }
    }

    /*
     * Deletes all the media associated to an update
     * */
    public static function deleteUpdateMedia($update)
    {
        $medias = $update->media;
        try {
            foreach ($medias as $media) {
                Media::deleteMedia($update, $media);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return true;
    }

    public function scopeImage($query){
        return $query->where('type', 'image')->get();
    }
    public function scopeVideo($query){
        return $query->where('type', 'youtube')->get();
    }
}
