@extends('master')
@section('content')
    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/classe/loadFile', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}
    {!! Form::label('classeFile', 'Class.txt:', ['class' => 'control-label']) !!}<br>
    {!! Form::file('classeFile',['class'=>'form-control']) !!}
        {!! Form::submit('Invia',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop