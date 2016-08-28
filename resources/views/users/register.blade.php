{{--@extends('layouts.app')--}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>'/user']) !!}

                            <div class="form-group">
                                {!! Form::label('name','Name:') !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email','Email:') !!}
                                {!! Form::email('email',null,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password','Password:') !!}
                                {!! Form::password('password',['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password_confirmation','Password_confirmation:') !!}
                                {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                            </div>
                        {!! Form::submit('注册',['class'=>'btn btn-success form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
