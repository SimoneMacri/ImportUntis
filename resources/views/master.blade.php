<?php
if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active';
    }
}

?><!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    {!!Html::style('/css/font-awesome.min.css')!!}
    {!!Html::style('/css/font-awesome.min.css')!!}
    {!!Html::style('/css/bootstrap-theme.min.css')!!}
    {!!Html::style('/css/style.css')!!}
    {!!Html::style('https://fonts.googleapis.com/css?family=Lato:100')!!}

    {!!Html::script('/script/jquery-3.1.1.min.js')!!}
    {!!Html::script('/script/bootstrap.min.js')!!}
    {!!Html::script('/script/bootstrap-confirmation.min.js')!!}
    {!!Html::script('/script/tinymce/tinymce.min.js')!!}


    {!!Html::script('/script/script.js')!!}

    {{--Server per tutte le chiamate ajax--}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    {{--!!Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css')!!--}}
    {{--!!Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')!!--}}
    {{--!!Html::script('//code.jquery.com/jquery-1.11.3.min.js')!!--}}

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<div class="container">
    <div class="row">
        @include("include.header")
    </div>
    <div class="content">
        @yield("content")
    </div>
    <div style="height: 230px;"></div>
    <div class="row">
        @include("include.footer")
    </div>
</div>

{!!Html::style(URL::asset('/').'/css/bootstrap.min.css')!!}
</body>
</html>
