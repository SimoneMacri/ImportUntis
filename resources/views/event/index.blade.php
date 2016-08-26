@extends('master')
@section('content')
    <?php
    ?>
    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'news/create', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}

    {!! Form::label('title', 'Titolo:', ['class' => 'control-label']) !!}:
    {!! Form::text('title', "", ['class'=>'form-control']) !!}
    <br>

    {!! Form::label('description', 'Descrizione:', ['class' => 'control-label']) !!}:
    {!! Form::textarea('description', "",['class'=>'form-control']) !!}
    <br>

    {!! Form::label('classe', 'Classe:', ['class' => 'control-label']) !!}:
    {!! Form::select('classe[]', array(null=>'--------------------') + $classi, null, ['multiple']) !!}
    <br>

    {!! Form::label('teacher', 'Docente:', ['class' => 'control-label']) !!}:
    {!! Form::select('teacher[]', array(null=>'--------------------') + $teachers, null, ['multiple']) !!}
    <br>

    {!! Form::label('start_date', 'Data inizio:', ['class' => 'control-label']) !!}:
    {!! Form::date('start_date') !!}
    <br>

    {!! Form::label('finish_date', 'Data fineinizio:', ['class' => 'control-label']) !!}:
    {!! Form::date('finish_date') !!}
    <br>

    {!! Form::submit('Invia',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop