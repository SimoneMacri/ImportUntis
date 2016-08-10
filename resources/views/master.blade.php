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
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }

        .container {
        }

        .content {
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>
    {!!Html::script('//code.jquery.com/jquery-1.11.3.min.js')!!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!!Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css')!!}
    {!!Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')!!}

</head>
<body>
<div class="container">
    <div class="row">
        @include("include.header")
    </div>
    <div class="content">
        <!--<div class="title">Laravel 5</div>-->
        @yield("content")
    </div>
    <div class="row">
        @include("include.footer")
    </div>
</div>

{!!Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')!!}
</body>
</html>
