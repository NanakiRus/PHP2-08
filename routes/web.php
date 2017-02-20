<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use App\Models\Article;


Route::get('/', ['as' => 'articles', 'uses' => 'ArticleController@index']);

Route::group(['prefix' => 'article'], function () {

    Route::get('/', function () {
        return redirect('/');
    });
    Route::get('/create', ['as' => 'article.create', 'uses' => 'ArticleController@create'])->middleware('auth');
    Route::match(['get', 'post'], '/offer', ['uses' => 'ArticleController@store']);
    Route::get('/{slug}', ['as' => 'article.show', 'uses' => 'ArticleController@show']);

});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@index');

        Route::group(['prefix' => 'article'], function () {
            Route::get('/', ['as' => 'admin.article.all', 'uses' => 'AdminController@showAllArticle']);
            Route::post('/{slug}/save', 'AdminController@edit');
            Route::get('/{slug}/delete', 'AdminController@destroy');
            Route::get('/{slug}/edit', ['as' => 'admin.article.edit', 'uses' => 'AdminController@showOneArticle']);
        });
    });

});

