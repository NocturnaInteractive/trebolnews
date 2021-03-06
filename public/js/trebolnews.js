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

function popupWindow(url, title, w, h) {
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function preventDefault(e) {
    e.preventDefault();
}

$(function(){
    $(document).ajaxStart(function(){ $('html').addClass('wait'); });
    $(document).ajaxStop(function(){ $('html').removeClass('wait'); });

    $('body').on('click', '[popup]', function (e) {
        e.preventDefault();

        $(this).on('click', function(e) {
            e.preventDefault();
        });

        $.ajax({
            url: $(this).attr('popup'),
            type: 'get',
            success: function(data) {
                // debugger;
                $('#popup').html('');
                $('#popup').html(data.popup);
                $('#popup').fadeIn(400);
            }
        });
    });

    $('body').on('click', '[session]', function(e) {
        e.preventDefault();

        var boton = $(this);

        $.ajax({
            url: $('#session_url').val(),
            type: 'post',
            dataType: 'json',
            data: {
                session_data: boton.attr('session')
            },
            success: function(data) {
                if(data.status == 'ok') {
                    window.location = boton.attr('href');
                }
            }
        });
    });

    $('body').on('click', '[preference]', function(e) {
        e.preventDefault();

        var boton = $(this);

        $.ajax({
            url: $('#preference_url').val(),
            type: 'post',
            dataType: 'json',
            data: {
                preference: boton.attr('preference')
            },
            success: function(data) {
                if(data.status == 'ok') {
                    location.reload();
                }
            }
        });
    });

    $('body').one('click', '[ajax]', ajax_handler);

    function ajax_handler(e) {
        e.preventDefault();

        var clicked = $(this);

        clicked.on('click', preventDefault);

        $.ajax({
            type: 'get',
            url: clicked.attr('ajax'),
            dataType: 'json',
            success: function(data) {
                if(data.status == 'ok') {
                    if(data.refresh == 'yes') {
                        location.reload()
                    }
                } else {
                    if(data.validator) {
                        notys(data.validator);
                    }
                }
            },
            complete: function() {
                clicked.one('click', '[ajax]', ajax_handler);
            }
        });
    }

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

/******************************
   Google Universal Analytics
******************************/
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-XXX93874-1', 'auto');
ga('send', 'pageview');
/******************************
 End Google Universal Analytics
******************************/
