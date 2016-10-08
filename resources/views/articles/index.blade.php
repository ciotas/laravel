@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($articles->chunk(5) as $row)
                    @foreach($row as $article)
                        <div class="media">
                            <div class="media-body">

                                <h4 class="media-heading"><a href="{{ url('/articles',$article->id) }}">{{ $article->title }}</a>

                                </h4>
                                {{ $article->body }}
                                <br>
                                @foreach($article->tags as $tag)
                                    <span>{{ $tag->tagname }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endforeach

                {{ $articles->appends(['type'=>'1'])->render() }}
            </div>

        </div>
    </div>
    @endsection