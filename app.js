$(document).ready(function () {
    $('.nav-link').on('click', function() {
        let source = $(this).children('img').attr('src');
        $('a-sky').attr('src', source);

        $('.active').removeClass('active');
        $(this).parent().addClass('active');
    })
})