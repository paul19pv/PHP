
function cargar_periodo(variable) {
    var estacion = $("#estacion").val();
    $("#periodo").find('option').remove().end().append('<option value="null">Seleccione</option>').val('');
    $.ajax({
        url: "/consultas03/red2011/cargar_periodo",
        type: "POST",
        //los datos a enviar a la url 
        data: "estacion=" + estacion + "&variable=" + variable,
        success: function(datos) {
            per_data = JSON.parse(datos);
            $.each(per_data, function(index, value) {
                $("#periodo").append('<option value="' + index + '">' + value + '</option>');
            });
        },
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        }
    });
    $(".cmf-skinned-text").html("Seleccione");
    return false;
}

//funciones para el modulo de concesiones
function cargar_canton() {
    var provincia = $("#provincia").val();
    $.ajax({
        url: "cargar_cantones",
        type: "POST",
        //los datos a enviar a la url 
        data: "provincia=" + provincia,
        success: function(datos) {
            $("#canton").html(datos);
        },
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        }
    });
    //$("#.cmf-skinned-text").text("Seleccione");
    //$("#canton option[value=null]").attr("selected", true);
    $(".cmf-skinned-text").html("Seleccione");
    $("#parroquia").val("null");
    //cargar_parroquia();
    return false;
}
function cargar_parroquia() {
    var canton = $("#canton").val();
    var provincia = $("#provincia").val();
    //alert(canton)
    $.ajax({
        url: "cargar_parroquias",
        type: "POST",
        //los datos a enviar a la url 
        data: "canton=" + canton + "&provincia=" + provincia,
        success: function(datos) {
            $("#parroquia").html(datos);
        },
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        }
    });
    //$(".cmf-skinned-text").text("Seleccione");
    $("#parroquia option[value=null]").attr("selected", true);
    $("#parr .cmf-skinned-text").html("Seleccione");
    return false;
}

$(function() {

    /*estilo de los select*/
    $("form select.styled").select_skin();


});






