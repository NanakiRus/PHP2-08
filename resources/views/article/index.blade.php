@extends('layouts.app')
@section('content')
    @foreach($articles as $article)
        <article class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title">
                    <a href="{{ url('/article/' . $article->slug) }}">{{ $article->title }}</a>
                </h2>
            </div>
            <div class="panel-body">
                {!! $article->excerpt !!}
            </div>
            <footer class="panel-footer">
                {!! $article->published_at !!}
            </footer>
        </article>
    @endforeach
    {{ $articles->links() }}
@endsection