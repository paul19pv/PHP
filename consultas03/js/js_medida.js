/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function insertar() {
    var ruta = $("#ruta_base").val() + "medida/view_insertar_medida";
    //alert(ruta);
    $.ajax({
        url: ruta,
        //url: "medida/view_insertar_ubicacion/1",
        type: "POST",
        //data: $("#insertForm").serialize(),
        success: function(datos) {
            $("#block_content").html(datos);
        },
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        }
    });

}
function reiniciar() {
    /*
     $.ajax({
     //url: "view_insertar_medida",
     url: "medida/view_form_admin",
     type: "POST",
     //data: $("#insertForm").serialize(),
     success: function(datos) {
     $("#block_content").html(datos);
     },
     error: function(data, errorThrown)
     {
     alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
     }
     });
     */
    $(location).attr('href', '/consultas03/medida');
}
function reiniciar_portafolio() {
    $(location).attr('href', '/consultas03/medida/view_consultar_portafolio');
}
function reiniciar_admin() {
    $(location).attr('href', '/consultas03/medida');
}

$(function() {
    $("#searchMedida").submit(function(e) {
        var unidad = $("#unidad").val();
        var amenaza = $("#amenaza").val();
        if (unidad !== "null" && amenaza !== "null") {
            $.ajax({
                url: $("#searchMedida").attr('action'),
                type: "POST",
                data: $("#searchMedida").serialize(),
                success: function(datos) {
                    $("#div_medida").html(datos);
                },
                error: function(data, errorThrown)
                {
                    alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
                }
            });
        }
        else {
            alert("Debe seleccionar una unidad y una amenaza");
        }

    });


    $(".menu").click(function(e) {

        e.preventDefault();
        if ($(this).hasClass('inactivo'))
            return false; // Do something else in here if required
        else {
            $(this).addClass('inactivo');
            //$('#block_content').html('<div class="loading"><img src="images/loading.gif" width="50px" height="50px"/></div>');
            $.ajax({
                type: "GET",
                url: this.href,
                success: function(data) {
                    $("#block_content").html(data);
                    $(".menu").removeClass('inactivo');
                }
            });
        }
    });

    



});