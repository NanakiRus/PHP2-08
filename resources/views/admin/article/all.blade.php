@extends('admin.index')
@section('content')
    @foreach($articles as $article)
        <article class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title">
                    {{ $article->title }}
                </h2>
            </div>
            <div class="panel-body">
                {!! $article->excerpt !!}
                <div class="col-md-2 col-md-offset-10">
                    <a type="button" class="btn btn-primary btn-sm"
                       href="{{ url('/admin/article/' . $article->slug) . '/edit' }}">Редактировать</a>
                    <br/><br />
                    <a type="submit" class="btn btn-danger btn-sm"
                       href="{{ url('/admin/article/' . $article->slug) . '/delete' }}">Удалить</a>
                </div>
            </div>
            <footer class="panel-footer">
                @if(1 === $article->published)
                    <p class="bg-success">Статья опубликована</p>
                @else
                    <p class="bg-danger">Статья не опубликована</p>
                @endif
                <p>Дата публикации:<br/>
                    {!! $article->published_at !!}</p>
                <p>Дата создания:<br/>
                    {!! $article->created_at !!}</p>
            </footer>
        </article>
    @endforeach
    {{ $articles->links() }}
@endsection