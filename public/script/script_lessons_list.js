/**
 * Created by simonemacri on 21.10.16.
 */


function lessonsClick(element) {
    var data = $(element).data();
    var modal = $("#lesson_detail")
    modal.find('.modal-title').text(data.title);
    modal.find('#detail').text(data.detail);
    modal.find('#room').text(data.room);
    modal.find('#start').text(data.start);
    modal.find('#finish').text(data.finish);
}

