<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if (!function_exists('uploadFile')) {
    function uploadFile($path, $image, $currentImage = false)
    {
        if ($image) {
            if ($currentImage) {
                Storage::disk('public')->delete("images/$path/$currentImage");
            }
            $imageName = Str::random(20).time() . '.png';
            $imageUploaded = Image::make($image)->encode('png', 75);
            $imageUploaded->resize(530, 470, function ($constraint) {
                $constraint->upsize();
            });
            Storage::disk('public')->put("images/$path/$imageName", $imageUploaded->stream());

            return $imageName;
        } else {
            return false;
        }
    }
}

if (!function_exists('uploadNewFile')) {
    function uploadNewFile($path, $file, $currentFile = false)
    {
        if ($file) {
            if ($currentFile) {
                Storage::disk('public')->delete("files/$path/$currentFile");
            }
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(20).time();

            Storage::disk('public')->putFileAs("files/$path", $file, $fileName.'.'.$extension);

            return $fileName.'.'.$extension;
        } else {
            return false;
        }
    }
}
