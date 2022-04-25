
// to do initialization

$(function () {
    "use strict";

    $('#todo-list').sortable({
        placeholder: "sorting-placeholder",
        over: function() {
            $('.sorting-placeholder').stop().animate({
                height: 0
            }, 400);
        },
        change: function() {
            $('.sorting-placeholder').stop().animate({
                height: 50
            }, 400);
        }
    });

    $('.chk-todo input').iCheck({
        checkboxClass: 'icheckbox_minimal-green',
        radioClass: 'icheckbox_minimal-green'
    });
    $('.chk-todo input').on('ifChecked', function (event) {

        $(this).parents('li').addClass('todo-done');
    });
    $('.chk-todo input').on('ifUnchecked', function (event) {


        $(this).parents('li').removeClass('todo-done');
    });

    $('.todo-remove').on('click', function (event) {
        event.preventDefault();
        $(this).parents('.action-todo').parents('li').remove();
    });

});

