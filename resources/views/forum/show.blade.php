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
                    @if(Auth::check() && Auth::user()->id == $discussion->user_id)
                    <a class="btn btn-lg btn-primary pull-right" href="/posts/{{$discussion->id}}/edit" role="button">修改帖子 »</a>
                    @endif
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
                    <p>{!! $html !!}</p>
                </div>
                <hr>
                @foreach($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="{{ $comment->user->avatar }}" alt="64*64" width="64" height="64">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}</h4>
                            {{ $comment->body }}
                        </div>
                    </div>
                @endforeach
                <hr>
                @if(Auth::check())
                {!! Form::open(['url'=>'/comment']) !!}
                    {!! Form::hidden('discussion_id',$discussion->id) !!}
                    <div class="form-group">
                        {!! Form::textarea('body',null,['class'=>'form-control']) !!}
                    </div>
                {!! Form::submit('提交',['class'=>'btn btn-success pull-right']) !!}

                {!! Form::close() !!}
                @else
                    <a href="{{ url('/user/login') }}" class="btn btn-block btn-success">登陆参与评论</a>
                @endif
            </div>

        </div>
    </div>
@endsection
