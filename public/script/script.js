/**
 * Created by simonemacri on 21.10.16.
 */

$(function (e) {
    $('#showPreview').on('shown.bs.modal', function (e) {
            var modal = $(this);
            modal.find(".modal-body").html("Caricamento...");
            $.ajax({
                url: $(this).data('url'),
                method: 'post',
                datatype: 'json',
                data: {
                    id_news: $(e.relatedTarget).data('id')
                },
                beforeSend: function () {
                },
                success: function (data) {
                    console.log($(this));
                    modal.find(".modal-body").html(data.description);
                }
            })
        }
    );

    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        container: 'body'
    });
    $('[data-toggle=confirmation-singleton]').confirmation({
        rootSelector: '[data-toggle=confirmation-singleton]',
        container: 'body'
    });
    $('[data-toggle=confirmation-popout]').confirmation({
        rootSelector: '[data-toggle=confirmation-popout]',
        container: 'body'
    });
    $('#confirmation-delegate').confirmation({
        selector: 'button'
    });

    //$(".deleteButton").confirmation('toggle');

    /*$(".deleteButton").click(function (e) {

     $.ajax({
     url: $(this).data('url'),
     method: 'delete',
     datatype: 'json',
     beforeSend:function () {
     },
     success: function (data) {
     console.log($(this));
     }
     });

     });*/

});
