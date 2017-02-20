<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public static function ImageForArticle($slug)
    {
        $article = Article::getOneArticle($slug)[0];
        $path = __DIR__ . '/../../public/upload/aimage-' . $article->id;

        if (is_dir($path)) {
            return array_diff(scandir($path), ['.', '..']);
        }

    }
}
