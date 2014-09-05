$(function(){
    $(document).ajaxStart(function(){ $('html').addClass('wait'); });
    $(document).ajaxStop(function(){ $('html').removeClass('wait'); });

    $('[popup]').on('click', function (e) {
        e.preventDefault();

        $(this).on('click', function(e) {
            e.preventDefault();
        });

        $.ajax({
            url: $(this).attr('popup'),
            type: 'get',
            success: function(data) {
                $('#popup').html('');
                $('#popup').html(data.popup);
                $('#popup').fadeIn(400);
            }
        });
    });

    $('[session]').on('click', function(e) {
        e.preventDefault();

        var boton = $(this);

        $.ajax({
            url: $('#session_url').val(),
            type: 'post',
            dataType: 'json',
            data: {
                session_data: $(this).attr('session')
            },
            success: function(data) {
                if(data.status == 'ok') {
                    window.location = boton.attr('href');
                }
            }
        });
    });

    $('body').on('click', '#cerrar_popup', function(e) {
        e.preventDefault();

        $('#popup').fadeOut(400, function() {
            $('#popup').html('');
        });
    });

    $(document).keyup(function(e) {
        if(e.keyCode == 27) {
            $('#cerrar_popup').trigger('click');
        }
    });
});

function notys(pack) {
    $.each(pack, function(i, v) {
        noty({
            text: v,
            layout: 'topCenter',
            timeout: 5000,
            maxVisible: 10
        });
    });
}