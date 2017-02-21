<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\{
    Article,
    Image
};
use Validator;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index', ['articles' => Article::getPublishedArticle()]);
    }

    public function show($slug)
    {
        return view('article.indexOne', ['article' => Article::getOneArticle($slug), 'images' => Image::ImageForArticle($slug)]);
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(ArticleRequest $request)
    {

        if (is_array(ImageController::testImage($request))) {

            $articleModel = Article::create($request->all());

            $path = __DIR__ . '/../../../public/upload/aimage-' . $articleModel->id;
            mkdir($path);

            foreach (ImageController::testImage($request) as $image) {
                $image->move($path,
                    $articleModel->id . '-' . $image->getClientOriginalName());
            }
        } elseif (false === ImageController::testImage($request)) {
            $validator = Validator::make($request->all(), [
                'image' => 'mimetypes:image/gif,image/jpeg,image/png',
            ]);

            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            Article::create($request->all());
        }

        return redirect()->route('articles');
    }
}
