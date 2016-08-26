<style>

    /* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/

    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }

    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
        display: block;
    }

    body {
        line-height: 1;
    }

    ol, ul {
        list-style: none;
    }

    blockquote, q {
        quotes: none;
    }

    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    /*finish reset*/
    html, body, table {
        width: 100%;
        height: 100%;
    }

    table, tr, td {
        border: 1px solid black;
    }

    td {
        height: calc(100% / 11);
        width: calc(100% / 8);
        text-align: center;
        vertical-align: middle;
    }

    td.lessons div.subject {
        font-weight: bold;
        font-size: small;
    }

    td.lessons div.detail {
        font-weight: lighter;
        font-size: x-small;
    }

    td.time {
        font-size: x-small;
    }

    thead, tr > td:first-child {
        background: #ccc;
    }
</style>
<table>
    <thead>
    <td></td>
    @foreach($days as $day)
        <td class="day">{{$day->name}}</td>
    @endforeach
    </thead>

    @foreach($times as $time)
        <tr>
            <td class="time">
                {{$time->start_hour}}<br>
                -<br>
                {{$time->finish_hour}}
            </td>
            @foreach($days as $day)
                <td class="lessons">
                    @if(isset($lessons[$time->start_hour][$day->id]))
                        <div class="subject">{{ $lessons[$time->start_hour][$day->id]->subject_id}}</div>
                        <div class="detail">
                            {{ $lessons[$time->start_hour][$day->id]->room_id}}
                            - {{ $lessons[$time->start_hour][$day->id]->teacher_id}}
                        </div>
                    @else
                        &nbsp;
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</table>