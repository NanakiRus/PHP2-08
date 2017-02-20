@extends('layouts.app')
@section('content')
    @foreach($article as $value)
        <article>
            <h2>
                {{ $value->title }}
            </h2>
            <div>
                {!! $value->content !!}
            </div>
            @if (isset($images))
                <div>
                @foreach($images as $image)
                    <img width="200" class="img-rounded" src="/public/upload/aimage-{{$value->id}}/{{ $image }}"/>
                @endforeach
                </div>
            @endif
            <footer>
                {!! $value->published_at !!}
            </footer>
        </article>
    @endforeach
@endsection