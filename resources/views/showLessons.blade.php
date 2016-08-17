<style>
    table, tr, td {
        border: 1px solid black;

    }

    td {
        height: 100px;
        width: 100px;
        text-align: center;
    }

    thead, tr > td:first-child {
        background: #ccc;
    }
</style>
<table>
    <thead>
    <td></td>
    @foreach($days as $day)
        <td>{{$day->name}}</td>
    @endforeach
    </thead>

    @foreach($times as $time)
        <tr>
            <td>
                {{$time->start_hour}} - {{$time->finish_hour}}
            </td>
            @foreach($days as $day)
                <td>
                    @if(isset($lessons[$time->start_hour][$day->id]))
                        {{ $lessons[$time->start_hour][$day->id]->teacher_id}}
                        - {{ $lessons[$time->start_hour][$day->id]->room_id}}
                    @else
                        &nbsp;
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</table>