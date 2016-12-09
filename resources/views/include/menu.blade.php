<?php
//error_log(App::make(\App\Http\Controllers\ClasseController)->prova());
?>
<nav id="navBar" class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="{{URL::asset('/img/logo.png')}}"/>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{Request::is('/') ? 'active' : ''}}"><a href="{{URL::asset('/')}}">Home</a></li>
                <li class="dropdown {{Request::is('import/*') ? 'active' : ''}}">
                    <a href="{{route('allImportIndex')}}"><!-- class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true"
                       aria-expanded="false" -->Import </a>
                <!-- <ul class="dropdown-menu">
                       <li class="{{Request::is('import/classe') ? 'active' : ''}}">
                            <a href="{{route('classeImportIndex')}}">Classi</a>
                        </li>
                        <li class="{{Request::is('import/date') ? 'active' : ''}}">
                            <a href="{{route('dateImportIndex')}}">Date</a>
                        </li>
                        <li class="{{Request::is('import/room') ? 'active' : ''}}">
                            <a href="{{route('roomImportIndex')}}">Aule</a>
                        </li>
                        <li class="{{Request::is('import/time') ? 'active' : ''}}">
                            <a href="{{route('timeImportIndex')}}">Orario giorni</a>
                        </li>
                        <li class="{{Request::is('import/teacher') ? 'active' : ''}}">
                            <a href="{{route('teacherImportIndex')}}">Docenti</a>
                        </li>
                        <li class="{{Request::is('import/subject') ? 'active' : ''}}">
                            <a href="{{route('subjectImportIndex')}}">Materie</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="{{Request::is('import/lesson') ? 'active' : ''}}">
                            <a href="{{route('lessonImportIndex')}}">Orario</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="{{Request::is('import/all') ? 'active' : ''}}">
                            <a href="{{route('allImportIndex')}}">Tutto</a></li>
                    </ul>-->
                </li>
                <li class="{{Request::is('news') ? 'active' : ''}}"><a href="{{route('newsIndex')}}">Eventi</a>
                </li>
            </ul>

            {{--}}{!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/classe/loadFile', 'class'=>'navbar-form navbar-right', 'enctype'=>'multipart/form-data')) !!}
            <div class="form-group">
                {{ Form::label("user", "User:") }}
                {{ Form::text('user',null,['class'=>'form-control', 'placeholder'=>'User']) }}
                {{ Form::label("password", "Password:") }}
                {{ Form::password('password',['class'=>'form-control', 'placeholder'=>'password']) }}
            </div>
            {{ Form::submit('Send',['class'=>'btn btn-default']) }}
            {{ Form::close() }}
            {{--}}
        </div>
        <!-- /.navbar-collapse -->


    </div><!-- /.container-fluid -->
</nav>