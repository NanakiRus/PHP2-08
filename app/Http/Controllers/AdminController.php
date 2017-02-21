<?php

namespace App\Http\Controllers;

use App\Models\{
    Article,
    Image
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Validator;

class AdminController
    extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (!Auth::user()->isAdmin()) {
                return redirect('/login');
            }

            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.index');
    }

    public function showAllArticle()
    {
        return view('admin.article.all', ['articles' => Article::getAllArticle()]);
    }

    public function showOneArticle($slug)
    {
        return view('admin.article.edit', ['article' => Article::getOneArticle($slug), 'images' => Image::ImageForArticle($slug)]);
    }

    public function edit(Request $request)
    {
        $article = Article::findOrFail($request->get('id'));

        $this->validate($request, [
            'title' => 'required|max:255|min:10',
            'slug' => 'required|max:255',
            'excerpt' => 'required|max:300|min:100',
            'content' => 'required|min:500',
        ]);

        if (is_array(ImageController::testImage($request))) {
            $path = __DIR__ . '/../../../public/upload/aimage-' . $article->id;
            if (!isset($path)) {
                mkdir($path);
            }
            foreach (ImageController::testImage($request) as $image) {
                $image->move($path,
                    $article->id . '-' . $image->getClientOriginalName());
            }
            $article->fill($request->all())->save();
        } elseif (false === ImageController::testImage($request)) {
            $validator = Validator::make($request->all(), [
                'image' => 'mimetypes:image/gif,image/jpeg,image/png',
            ]);

            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $article->fill($request->all())->save();
        }

        return redirect()->back();
    }

    public function destroy($slug)
    {
        $article = Article::whereSlug($slug)->first();
        $article->delete();
        return redirect()->back();
    }

}