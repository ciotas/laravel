@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $article->title }}</h1>
        <div class="body">
            {{ $article->body }}
            <ul>
                @foreach($article->tags as $tag)
                    <li>{{ $tag->tagname }}</li>
                @endforeach
            </ul>
        </div>
        <div class="media-conversation-meta pull-right">
            <span class="media-conversation-replies">
            <a href="{{ route('articles.edit',$article->id) }}">编辑</a>
            </span>
        </div>
    </div>
@endsection