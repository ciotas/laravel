@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h2>分享就是财富!
                <a class="btn btn-lg btn-primary pull-right" href="#" role="button">去分享 »</a>

            </h2>
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($discussions->chunk(5) as $row)
                    @foreach($row as $discussion)
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-circle" with="64" height="64" src="{{ $discussion->user->avatar }}" alt="64*64">
                                </a>
                            </div>
                            <div class="media-body">

                                <h4 class="media-heading"><a href="{{ url('posts',$discussion->id) }}">{{ $discussion->title }}</a></h4>
                                {{ $discussion->user->name }}
                            </div>
                        </div>
                    @endforeach
                @endforeach

                {{ $discussions->appends(['type'=>'discussion'])->render() }}
            </div>

        </div>
    </div>
@endsection
