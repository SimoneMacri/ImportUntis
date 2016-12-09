@extends('master')
@section('content')
    <h4>In questa sezinoe si possono importare tutti i file che sono stati esportati da Untis.</h4>
    <h3 class="warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Attenzione!! Tutti i dati
        precedentemente esistenti verranno sovrascritti da quelli nuovi, l'azione sarà irreversibile <i
                class="fa fa-exclamation-triangle" aria-hidden="true"></i></h3>

    @if(isset($error) && count($error) > 0)
        @foreach($error as $err)
            <h1 class="warning">{{$err}}</h1>
        @endforeach
    @endif

    @if(isset($success))
        <h1 class="success">{{$success}}</h1>

    @endif

    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/all/loadFile', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}
    <p>{!! Form::label('classeFile', 'Class.txt:', ['class' => 'control-label']) !!}:
        {!! Form::file('classeFile',['class'=>'form-control']) !!}
    </p>
    <p>
        {!! Form::label('dateFile', 'Date.txt:', ['class' => 'control-label']) !!}:
        {!! Form::file('dateFile',['class'=>'form-control']) !!}
    </p>
    <p>

        {!! Form::label('lessonFile', 'Lesson.txt:', ['class' => 'control-label']) !!}:
        {!! Form::file('lessonFile',['class'=>'form-control']) !!}
    </p>
    <p>

        {!! Form::label('roomFile', 'Room.txt:', ['class' => 'control-label']) !!}:
        {!! Form::file('roomFile',['class'=>'form-control']) !!}
    </p>
    <p>

        {!! Form::label('subjectFile', 'Subject.txt:', ['class' => 'control-label']) !!}:
        {!! Form::file('subjectFile',['class'=>'form-control']) !!}
    </p>
    <p>
        {!! Form::label('teacherFile', 'Teacher.txt:', ['class' => 'control-label']) !!}:
        {!! Form::file('teacherFile',['class'=>'form-control']) !!}
    </p>
    <p>
        {!! Form::label('timeFile', 'Time.txt:', ['class' => 'control-label']) !!}:
        {!! Form::file('timeFile',['class'=>'form-control']) !!}
    </p>

    {!! Form::submit('Invia',['class'=>'btn btn-primary', 'onclick' => 'return confirm(\'È sicuro di voler provedere?\')']) !!}

    {!! Form::close() !!}
@stop