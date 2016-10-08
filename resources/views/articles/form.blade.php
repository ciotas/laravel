<div class="form-group">
    {!! Form::label('title','Title:') !!}
    {!! Form::text('title',null,['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('body','Body:') !!}
    {!! Form::textarea('body',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('tag_list','Tag_list:') !!}
    {!! Form::select('tag_list[]',@$tags,null,['class'=>'form-control js-example-basic-multiple','multiple'=>'multiple']) !!}
</div>