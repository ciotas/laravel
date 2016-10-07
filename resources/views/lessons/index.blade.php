@extends('layouts.app')

@section('content')
    <div class="container">
    @foreach($lessons->chunk(3) as $row)
        <div class="row">
            @foreach($row as $lesson)
            <article class="col-md-4">
                <h2>{{ $lesson->title }}</h2>
                <img src="{{ $lesson->image }}" alt="" width="360">
                <div class="body">
                    {!! Form::open(['url'=>url('/favourite')]) !!}
                    {!! Form::hidden('lesson_id',$lesson->id) !!}
                    <button type="submit"><i class="fa fa-heart {{ in_array($lesson->id,$favourites)?'favourited':'not-favourited' }}"></i></button>
                    {!! Form::close() !!}
                    {{ $lesson->intro }}
                </div>
            </article>
            @endforeach
        </div>
    @endforeach
        {!! $lessons->appends(['type'=>'article','price'=>500])->render() !!}}
    </div>
@endsection