$(function () {
    $('.list-group-item').on('hover', function (e) {
        $(this).addClass('hoverable');
    }).on('mouseleave', function (e) {
        $(this).removeClass('hoverable');
    })
});