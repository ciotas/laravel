@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" with="64" height="64" src="{{ $discussion->user->avatar }}" alt="64*64">
                    </a>
                </div>
                <div class="media-body">

                    <h4 class="media-heading">{{ $discussion->title }}</h4>
                    <a class="btn btn-lg btn-primary pull-right" href="#" role="button">修改帖子 »</a>

                    {{ $discussion->user->name }}
                </div>
            </div>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">

                <div class="blog-post">
                    <p>{{ $discussion->body }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
