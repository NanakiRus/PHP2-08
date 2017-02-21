@extends('layouts.app')

@section('content')
    <h2>Предложить статьию</h2>
    <form action="/article/offer" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"/>
            @if ($errors->has('title'))
                <div class="alert alert-danger">{{$errors->first('title')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="slug">URL</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}"/>
            @if ($errors->has('slug'))
                <div class="alert alert-danger">{{$errors->first('slug')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="excerpt">Короткий текст</label>
            <textarea name="excerpt" id="excerpt" class="form-control">{{ old('excerpt') }}</textarea>
            @if ($errors->has('excerpt'))
                <div class="alert alert-danger">{{$errors->first('excerpt')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="content">Текст</label>
            <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
            @if ($errors->has('content'))
                <div class="alert alert-danger">{{$errors->first('content')}}</div>
            @endif
        </div>
        <input type="hidden" name="published" value="0">
        <div class="form-group">
            <label for="published_at">Дата публикации</label>
            <input type="date" name="published_at" id="<?php echo date('m/d/Y H:i');?>"
                   value="{{ old('published_at') }}" class="form-control">
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
@endsection