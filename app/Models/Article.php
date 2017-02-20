<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id',
        'title',
        'slug',
        'excerpt',
        'content',
        'published',
        'published_at',
        'updated_at',
        'created_at',
    ];

    public static function getPublishedArticle()
    {
        return self::where('published', '=', 1)
            ->orderBy('published_at', 'desc')
            ->where('published_at', '<=', Carbon::now())
            ->paginate(10);
    }

    public static function getOneArticle($slug)
    {
        return self::where('slug', '=', $slug)->get();
    }

    public function getAllArticle()
    {
        return $this->latest('published_at')->paginate(10);
    }

}
