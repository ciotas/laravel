@extends('layouts.app')

@section('content')
    <!-- 引入编辑器代码 -->
    @include('editor::head')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发表帖子</div>
                    <div class="panel-body">
                        @if($errors->any())
                            <ul class="list-group">
                                @foreach($errors->all() as $error)
                                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::model($discussion,['method'=>'PATCH','url'=>'/posts/'.$discussion->id]) !!}

                        @include('forum.form')

                        {!! Form::submit('提交',['class'=>'btn btn-success form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
