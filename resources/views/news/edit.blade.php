@extends('master')
@section('content')
    <script>tinymce.init({
            selector: 'textarea',
            height: "100%",
            plugins: [
                'advlist autolink lists charmap print preview anchor',
                'searchreplace visualblocks fullscreen',
                'table contextmenu paste',
                'textcolor colorpicker'
            ],
            toolbar: 'undo redo | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor',
            language: 'it',
            table_default_styles: {
                width: '100%'
            },
            content_css: "{{URL::asset('/')}}css/tinyMCE.css"
        });
    </script>
    <?php
    /**
     * @var $news \App\News
     */
    if (!isset($news)) {
        $news = new stdClass();
    }
    ?>
    {!! Form::model($news, array( 'method'=> 'POST', 'route'=> array('newsStore', isset($news->id) ? $news->id : null), 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}

    <table id="newsDetailFormTable">
        <tr>
            <td>
                {!! Form::label('title', 'Titolo:', ['class' => 'control-label', 'required']) !!}:
                {!! Form::text('title', null, ['class'=>'form-control', 'required' => 'true']) !!}
                <br>

                {!! Form::label('classi', 'Classe:', ['class' => 'control-label']) !!}
                <table class="selectInputTable">
                    <tr>
                        <td>
                            Esclusi
                        </td>
                        <td>

                        </td>
                        <td>
                            Inclusi
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::select('classeSource', $classi, null, ['multiple', 'id'=>'classeSource', 'class' => 'form-control']) !!}
                        </td>
                        <td>
                            {{Form::button('<i class="fa fa-arrow-left" aria-hidden="true"></i>', ['class'=> 'listMoveElement btn', 'data-target' => 'classeSource', 'data-source' => 'classeDest'])}}
                            {{Form::button('<i class="fa fa-arrow-right" aria-hidden="true"></i>', ['class'=> 'listMoveElement btn', 'data-target' => 'classeDest', 'data-source' => 'classeSource'])}}
                        </td>
                        <td>
                            {!! Form::select('classi[]',  isset($news->classi) ? $news->classi : array(), null, ['multiple', 'id'=>'classeDest', 'class' => 'form-control']) !!}
                        </td>
                    </tr>
                </table>
                <br>

                {!! Form::label('teacher', 'Docente:', ['class' => 'control-label']) !!}
                <table class="selectInputTable">
                    <tr>
                        <td>
                            Esclusi
                        </td>
                        <td>

                        </td>
                        <td>
                            Inclusi
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::select('teacherSource', $teachers, null, ['multiple', 'id'=>'teacherSource', 'class' => 'form-control']) !!}
                        </td>
                        <td>
                            {{Form::button('<i class="fa fa-arrow-left" aria-hidden="true"></i>', ['class'=> 'listMoveElement btn', 'data-target' => 'teacherSource', 'data-source' => 'teacherDest'])}}
                            {{Form::button('<i class="fa fa-arrow-right" aria-hidden="true"></i>', ['class'=> 'listMoveElement btn', 'data-target' => 'teacherDest', 'data-source' => 'teacherSource'])}}
                        </td>
                        <td>
                            {!! Form::select('teacher[]',  isset($news->teacher) ? $news->teacher : array(), null, ['multiple', 'id'=>'teacherDest', 'class' => 'form-control']) !!}
                        </td>
                    </tr>
                </table>

                <br>

                {!! Form::label('start_date', 'Dal:', ['class' => 'control-label']) !!}:
                {!! Form::date('start_date') !!}

                -

                {!! Form::label('finish_date', 'Al:', ['class' => 'control-label']) !!}:
                {!! Form::date('finish_date') !!}
                <br>

                {!! Form::label('important', 'Importante:', ['class' => 'control-label']) !!}:
                {!! Form::checkbox('important') !!}
                <br>


            </td>
        </tr>
        <tr>
            <td>
                {!! Form::submit('Salva',['class'=>'btn btn-primary submitButton']) !!}
                <br>
                <h4 class="warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Attenzione!! La
                    visualizzazione dell'immagine è solo per AppleTV (Albo all'entrata) <i
                            class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
                <h5 class="warning"> La vista mostra una visione approssimativa di come potrebbe apparire. </h5>
                {!! Form::label('imgFile', 'Immagine:', ['class' => 'control-label']) !!}:
                {!! Form::file('imgFile', ['class' => 'form-control', 'accept' => 'image/*']) !!}

                <br>
            </td>
        </tr>
    </table>
    <?php
    $classe = '';

    switch ($news->imgPosition) {
        case 't':
            $classe = 'topStyle';
            break;
        case 'l':
            $classe = 'leftStyle';
            break;
        case 'r':
            $classe = 'rightStyle';
            break;
        case 'b':
            $classe = 'bottomStyle';
            break;
        case 'd':
            $classe = 'disableStyle';
            break;
    }

    ?>
    <div id="positionButton">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default {{ $news->imgPosition == 't' ? 'active' : ''}}">
                {!! Form::radio('imgPosition', 't', ($news->imgPosition == 't')) !!} Top
            </label>
            <label class="btn btn-default {{ $news->imgPosition == 'l' ? 'active' : ''}}">
                {!! Form::radio('imgPosition', 'l') !!} Left
            </label>
            <label class="btn btn-default {{ $news->imgPosition == 'r' ? 'active' : ''}}">
                {!! Form::radio('imgPosition', 'r') !!} Right
            </label>
            <label class="btn btn-default {{ $news->imgPosition == 'b' ? 'active' : ''}}">
                {!! Form::radio('imgPosition', 'b') !!} Bottom
            </label>
            @if ($news->imgFilePath && file_exists($news->imgFilePath))
                <label class="btn btn-default {{ $news->imgPosition == 'd' ? 'active' : ''}}">
                    {!! Form::radio('imgPosition', 'd') !!} Disable
                </label>
            @endif
        </div>
    </div>

    <br>

    <div id="appleTVView" class="{{$classe}}">


        @if ($news->imgFilePath && file_exists($news->imgFilePath))
            <?php
            $extension = pathinfo($news->imgFilePath, PATHINFO_EXTENSION);
            $base64 = base64_encode(file_get_contents($news->imgFilePath));
            $imgString = "data:image/$extension;base64,$base64";
            ?>
            <div id="img" style="background-image: url({{$imgString}})">
                <!-- È per far si che l'immagine venga mostrata al centro--></div>
        @endif

        {!! Form::textarea('description', null,['id'=>'descriptionTextArea', 'class'=>'form-control']) !!}
        <br>
    </div>

    <br>
    {!! Form::submit('Salva',['class'=>'btn btn-primary submitButton']) !!}


    {!! Form::close() !!}
    <script>
        $(function (e) {
            $(".listMoveElement").click(function (e) {
                console.log($(this).data());
                var target = $(this).data('target');
                var source = $(this).data('source');
                $("#" + target).append($("#" + source + " option:selected").remove());


                toSortSource = $("#" + source + " option");
                //console.log(toSort);
                toSortSource.sort(function (a, b) {
                    if (a.text > b.text) return 1;
                    if (a.text < b.text) return -1;
                    return 0;
                });
                $("#" + source).empty().append(toSortSource);

                toSortTarget = $("#" + target + " option");
                //console.log(toSort);
                toSortTarget.sort(function (a, b) {
                    if (a.text > b.text) return 1;
                    if (a.text < b.text) return -1;
                    return 0;
                });
                $("#" + target).empty().append(toSortTarget);
                // console.log(toSort);
            });


            $(".form").submit(function (e) {
                $("#classeDest option").prop('selected', true);
                $("#teacherDest option").prop('selected', true);
            });

            // executes when HTML-Document is loaded and DOM is ready
            setTimeout(resize, 1000);

            $('input[name=imgPosition]').change(function (e) {
                console.log(this);

                $('#appleTVView').removeClass(function () {
                    return $(this).attr("class");
                });

                switch ($(this).val()) {
                    case't':
                        $('#appleTVView').addClass('topStyle');
                        break;
                    case'l':
                        $('#appleTVView').addClass('leftStyle');
                        break;
                    case'r':
                        $('#appleTVView').addClass('rightStyle');
                        break;
                    case'b':
                        $('#appleTVView').addClass('bottomStyle');
                        break;
                    case'd':
                        $('#appleTVView').addClass('disableStyle');
                        break;
                }
                resize();
            });
        });

        function resize() {
            // Main container
            var max = $('.mce-tinymce').parent().innerHeight();
            // Menubar
            max -= $('.mce-menubar.mce-toolbar').outerHeight();

            // Toolbar
            max -= $('.mce-toolbar-grp').outerHeight();
            max -= $('.mce-last').outerHeight();
            //Padding
            max -= parseInt($('.mce-tinymce').parent().css('padding-top').replace("px", "")) * 2;
            max -= parseInt($('.mce-tinymce').parent().css('padding-bottom').replace("px", ""));

            if ($('#appleTVView').hasClass('bottomStyle') || $('#appleTVView').hasClass('topStyle')) {
                max *= 0.5;
            }


            // Set the new height
            $('.mce-edit-area').height(max);

        }
    </script>

@stop