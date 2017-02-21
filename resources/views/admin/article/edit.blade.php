@extends('admin.index')
@section('content')
    @foreach($article as $value)
        <form action="{{ url('/admin/article/' . $value->slug . '/save') }}" method="post"
              enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $value->id }}">
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $value->title }}"/>
                @if ($errors->has('title'))
                    <div class="alert alert-danger">{{$errors->first('title')}}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="slug">URL</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $value->slug }}"/>
                @if ($errors->has('slug'))
                    <div class="alert alert-danger">{{$errors->first('slug')}}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="excerpt">Короткий текст</label>
                <textarea name="excerpt" id="excerpt" class="form-control">{!! $value->excerpt !!}</textarea>
                @if ($errors->has('excerpt'))
                    <div class="alert alert-danger">{{$errors->first('excerpt')}}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">Текст</label>
                <textarea name="content" id="content" class="form-control">{!! $value->content !!}</textarea>
                @if ($errors->has('content'))
                    <div class="alert alert-danger">{{$errors->first('content')}}</div>
                @endif
            </div>
            <input type="hidden" name="published" value="0">
            <div class="form-group">
                <label for="published_at">Дата публикации</label>
                <input type="datetime" name="published_at" id="{{ $value->published_at }}"
                       value="{{ $value->published_at }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="created_at">Дата создания</label>
                <p name="created_at" class="form-control">{{ $value->created_at }}</p>
            </div>
            <div class="form-group">
                <label for="updated_at">Дата последнего обновления</label>
                <p name="updated_at" class="form-control">{{ $value->updated_at }}</p>
            </div>
            <div class="form-group">
                <label for="published">Опубликовать?</label>
                <select name="published" id="{{ $value->published }}" class="form-control">
                    <option @if(0 === $value->published)selected @endif value="0">Нет</option>
                    <option @if(1 === $value->published)selected @endif value="1">Да</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Предложить изображения для статьи</label>
                <input type="file" name="image[]" multiple="true" min="1" max="5"/>
                @if ($errors->has('image'))
                    <div class="alert alert-danger">{{$errors->first('image')}}</div>
                @endif
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="Отправить">
            </div>
        </form>
        @if (isset($images))
            @foreach($images as $image)
                <img width="200" class="img-rounded" src="/public/upload/aimage-{{$value->id}}/{{ $image }}"/>
            @endforeach
        @endif
    @endforeach
@endsection