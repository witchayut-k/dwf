<?php

namespace App\Helpers;

use File;
use Str;

class UploadHelper
{
    public static function saveFileFromBase64($base64Data)
    {
        $extension = UploadHelper::getBase64Extension($base64Data);
        $filename = substr(md5(microtime()), rand(0, 26), 5) . '.' . $extension;
        $data = UploadHelper::getBase64Content($base64Data);
        file_put_contents($filename, $data);
        return public_path($filename);
    }

    public static function uploadFile($request, $dir = '', $reName = FALSE, $attr = 'file')
    {
        if (!File::exists(public_path() . '/storage/'))
            File::makeDirectory(public_path() . '/storage/');

        if (!empty($dir) && !File::exists(public_path() . '/storage/' . $dir))
            File::makeDirectory(public_path() . '/storage/' . $dir);

        $file = $request->{$attr};
        $destination = public_path() . '/storage/' . $dir;

        if ($reName) {
            $realname = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $fileName = str_slug($realname) . "-" . time() . "." . $extension;
        } else {
            $realname = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $realname . "-" . time() . "." . $extension;
        }

        $file->move($destination, $fileName);
        $imageUrl = empty($dir) ? url('storage/' . $fileName) : url('storage/' . $dir . '/' . $fileName);

        return $imageUrl;
    }

    public static function addMedia($file, $model, $collection)
    {
        $model->clearMediaCollection($collection);
        
        $media = $model->addMedia($file)
            ->sanitizingFileName(function ($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection($collection);

        $names = explode(".", $media->file_name);
        $extension = $names[count($names) - 1];

        $uuid = Str::uuid()->toString();

        $classNames = explode("\\", get_class($model));
        $prefix = $uuid . "-" . strtolower($classNames[count($classNames) - 1]);

        $media->file_name = $prefix . "-" . $model->id . "." . $extension;
        $media->save();
    }

    /**
     * Private Method
     */

    private static function getBase64Extension($base64Data)
    {
        preg_match("/^data:image\/(.*);base64/i", substr($base64Data, 0, 50), $match);
        $extension = $match[1];
        return $extension;
    }

    private static function getBase64Content($data)
    {
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);
        return $data;
    }
}
