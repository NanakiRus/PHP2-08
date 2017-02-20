<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{

    public static function testImage($request)
    {
        $types = [
            'image/gif',
            'image/jpeg',
            'image/pjpeg',
            'image/png',
        ];

        $image = false;

        if (!empty($request->file('image'))) {
            foreach ($request->file('image') as $key => $item) {
                $fileType = $request->file('image.' . $key)->getMimeType();
                if (in_array($fileType, $types)) {
                    $image[] = $request->file('image.' . $key);
                }
            }
        } else {
            return true;
        }

        return $image;
    }

}
