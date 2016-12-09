@extends('master')
@section('content')

    <table class="table-striped table-bordered " id="newsTable">
        <thead>

        <tr class="firstRow">
            <td colspan="7" class="actionBar">
                <a href="{{route('newsCreate')}}" class="btn btn-primary" type="submit">Nuova</a>
            </td>
        </tr>

        <tr class="firstRow">
            <th>Titolo</th>
            <!--<th>Descrizione</th>-->
            <th>Inizio</th>
            <th>Fine</th>
            <th>Importante</th>
            <th colspan="3">Azioni</th>
        </tr>
        </thead>
        @foreach($news as $new)
            <tr>
                <td>{{$new->title}}</td>
            <!--<td>{!! $new->description !!}</td>-->
                <td>{!! $new->start_date !!}</td>
                <td>{!! $new->finish_date !!}</td>
                <td class="importantCell"><i class="fa {{ $new->important ? 'fa-star': 'fa-star-o' }}"
                                             aria-hidden="true"></i></td>
                <td class="action">
                    <a data-toggle="modal" data-id="{{$new->id}}" data-target="#showPreview"><i class="fa fa-eye"
                                                                                                aria-hidden="true"></i></a>
                </td>
                <td class="action">
                    <a href="{{route('newsEdit', $new->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </td>
                <td class="action">
                    <a href="{{route('newsDelete', $new->id)}}"
                       data-toggle="confirmation"
                       data-btn-ok-label="Si"
                       data-btn-ok-icon="fa fa-check"
                       data-btn-ok-class="btn-default"

                       data-btn-cancel-label="No"
                       data-btn-cancel-icon="fa fa-ban"
                       data-btn-cancel-class="btn-default"

                       data-placement="left"
                       data-singleton="true"
                       data-popout="true"
                       data-title="Conferma"
                       data-content="Sei sicuro di voler cancellare?"
                    ><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    <!-- Modal -->
    <div class="modal fade" id="showPreview" role="dialog" data-url="{{route('newsDetail')}}">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Anteprima</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@stop