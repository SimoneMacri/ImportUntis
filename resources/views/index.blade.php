@extends('master')
@section('content')
    <div class="jumbotron text-center">
        <h1>Gestionale per CSIAPP</h1>
        <p>
            Gestionae per l'App CSIA
        </p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a href="{{route('allImportIndex')}}" class="thumbnail home-thumb">
                <img src="{{URL::asset('/img/orario.png')}}">
            </a>
            <h2>Importa il nuovo orario</h2>
            <p>Ti permette di caricare un nuovo set di file esportati da Untis.</p>
        </div>
        <div class="col-md-4">
            <a href="{{route('newsIndex')}}" class="thumbnail home-thumb">
                <img src="{{URL::asset('/img/listNews.png')}}">
            </a>
            <h2>Gestisci l'albo</h2>
            <p>Ti permette di gestire le notizie create in precedenza.</p>
        </div>
        <div class="col-md-4">
            <a href="{{route('newsCreate')}}" class="thumbnail home-thumb">
                <img src="{{URL::asset('/img/news.png')}}">
            </a>
            <h2>Crea una nuova notizia personalizzata</h2>
            <p>Ti eprmette di creare una nuova notizia con un click.</p>
        </div>
    </div>


@stop