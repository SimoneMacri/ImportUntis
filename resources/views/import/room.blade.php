@extends('master')
@section('content')
    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/room/loadFile', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}
    {!! Form::label('roomFile', 'Room.txt:', ['class' => 'control-label']) !!}<br>
    {!! Form::file('roomFile',['class'=>'form-control']) !!}
        {!! Form::submit('Invia',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop