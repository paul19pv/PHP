$(function() {


    $("#link_word").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "/consultas03/red2011/generate_word",
            type: "POST",
            data: $("#form_xls").serialize(),
            success: function(data) {
                $(location).attr('href', $("#link_descarga").attr("href"));
            },
            error: function(data, errorThrown)
            {
                alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
            }
        });
    });



});