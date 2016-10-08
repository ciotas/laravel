@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($article,['method'=>'PATCH', 'url'=>url('/articles/'.$article->id)]) !!}

        @include('articles.form')

        {!! Form::submit('Create',['class'=>'btn btn-primary form-control']) !!}
        {!! Form::close() !!}


        </div>
    </div>

    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>
@endsection