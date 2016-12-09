<html>
<head>
    {!!Html::style('/css/font-awesome.min.css')!!}
    {!!Html::style('/css/bootstrap-theme.min.css')!!}

    {!!Html::style(URL::asset('/').'/css/bootstrap.min.css')!!}
    {!!Html::style('/css/lessons_style.css')!!}

    {!!Html::script('/script/jquery-3.1.1.min.js')!!}
    {!!Html::script('/script/bootstrap.min.js')!!}
    {!!Html::script('/script/script_lessons_list.js')!!}

    <meta name="viewport" content="width=device-width, user-scalable=no,
initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

</head>
<body>

<div class="firstRow">
    <table>
        <tr class="headerTable">
            @foreach($days as $day)
                <td class="day">{{$day->name}}</td>
            @endforeach
        </tr>
    </table>
</div>

<div class="body">
    <table>
        <tr class="contentTable">
            @foreach($days as $day)
                <td class="lessons" rowspan="{{count($times)}}">
                    @if(isset($lessons[$day->id]))
                        @foreach($lessons[$day->id] as $less)
                            <?php
                            $detail = "";
                            $room = "";
                            if (isset($less->detail)) {
                                foreach ($less->detail as $det) {

                                    if (isset($det->teacherName)) {
                                        if ($detail != '') $detail .= ' - ';
                                        $detail .= $det->teacherName;
                                    }

                                    if (isset($det->roomName)) {
                                        if ($room != '') $room .= ' - ';
                                        $room .= $det->roomId;
                                    }

                                    if (isset($det->classeId)) {
                                        if ($detail != '') $detail .= ' - ';
                                        $detail .= $det->classeId;
                                    }
                                }
                            }

                            $start = date_format(date_create($less->start), "H:i");
                            $finish = date_format(date_create($less->finish), "H:i");
                            ?>
                            <div class="hour-{{$less->startHourId}} day-{{$day->id}} during-{{$less->hour_id - $less->startHourId }}"
                                 data-toggle="modal" data-target="#lesson_detail"
                                 data-title="{{$less->subject_name}}" data-detail="{{$detail}}" data-room="{{$room}}"
                                 data-start="{{$start}}" data-finish="{{$finish}}"
                                 onclick="lessonsClick(this);">

                                {{$start}} - {{$finish}}
                                <br>
                                {{$less->subject_id}} - {{$room}}
                            </div>


                        @endforeach
                    @endif
                </td>
            @endforeach
        </tr>
    </table>
</div>

<div id="lesson_detail" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Dettaglio:</td>
                        <td id="detail"></td>
                    </tr>
                    <tr>
                        <td>Aula:</td>
                        <td id="room"></td>
                    </tr>
                    <tr>
                        <td>Inizio:</td>
                        <td id="start"></td>
                    </tr>
                    <tr>
                        <td>Fine:</td>
                        <td id="finish"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>
        </div>

    </div>
</div>
</body>
</html>
