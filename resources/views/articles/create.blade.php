@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['url'=>'/articles']) !!}

        @include('articles.form')

        {!! Form::submit('Create',['class'=>'btn btn-primary form-control']) !!}
        {!! Form::close() !!}
    </div>

    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>
@endsection