<?php


if (!function_exists('upload_img')) {

    function upload_img($file, $folder, $disk = 'public')
    {

        $image = time() . $file->getClientOriginalName();
        $path = $file->storeAs($folder, $image, $disk);
        return $path;
    }
}
