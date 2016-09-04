@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">登陆</div>
                    <div class="panel-body">
                        @if($errors->any())
                            <ul class="list-group">
                                @foreach($errors->all() as $error)
                                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if(Session::has('user_login_failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('user_login_failed') }}
                            </div>
                        @endif
                        {!! Form::open(['url'=>url('/user/login')]) !!}

                        <div class="form-group">
                            {!! Form::label('email','邮箱:') !!}
                            {!! Form::email('email',null,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password','密码:') !!}
                            {!! Form::password('password',['class'=>'form-control']) !!}
                        </div>

                        {!! Form::submit('登陆',['class'=>'btn btn-success form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
