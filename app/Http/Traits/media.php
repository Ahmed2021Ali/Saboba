<?php

namespace App\Http\Traits;

trait media
{


    function downloadImages($images, $model, $folder)
    {
        if (isset($images)) {
            foreach ($images as $image) {
                $model->addMedia($image)->toMediaCollection($folder);
            }
        }
    }


    function updateImages($images, $model, $folder)
    {
        if (isset($images)) {
            $mediaItems = $model->getMedia($folder);
            if ($mediaItems) {
                foreach ($mediaItems as $media) {
                    $media->delete();
                }
            }
            foreach ($images as $image) {
                $model->addMedia($image)->toMediaCollection($folder);
            }
        }
    }
}
