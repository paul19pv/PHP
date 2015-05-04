/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
google.load("visualization", "1", {packages: ["corechart"]});
function consultar_datos(factor) {

    var unidad = $("#unidad").val();
    var amenaza = $("#amenaza").val();
    var col="";
    if (unidad !== "null" && amenaza !== "null") {
        //var titulo = titulo_grafica(amenaza);
        display_unidad(unidad);
        //alert(factor+" "+amenaza)
        
        col=color(factor,amenaza);
        image_amenaza(amenaza);
        draw_chart(factor,col);
        //draw_table(titulo, factor);
        draw_map(factor);
        draw_amenaza(factor);
    }
    else {
        alert("Debe seleccionar una estacion y un periodo");
    }

    return false;

}
function draw_chart(factor,color) {
    
    var jsonData = $.ajax({
        url: $("#insertForm").attr("action"),
        type: "POST",
        data: $("#insertForm").serialize() + "&factor=" + factor,
        dataType: "json",
        async: false}).responseText;
    jsonData = jQuery.parseJSON(jsonData);
    var data = new google.visualization.DataTable(jsonData);
    var options = {
        
        chartArea: {left: 40, top: 20, width: '100%', height: '100%'},
        pieSliceText: 'none',
        sliceVisibilityThreshold: 1/3600,
        legend: {position: 'right', alignment: 'center'},
        width: 340,
        height: 300,
        colors: color
    };
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    
    var titulo_f = titulo_factor(factor);
    $("#titulo_categoria").html('Categorías de ' + titulo_f);
    //$("#div_categoria").show();
}

function draw_map(factor){
    $.ajax({
        url: "/consultas03/CambioClimatico/consultar",
        type: "POST",
        data: $("#insertForm").serialize() + "&factor=" + factor,
        async: false,
        success: function(datos) {
            $("#mapa").html(datos);
        }
    });
    return false;
}
function draw_amenaza(factor){
    $.ajax({
        url: "/consultas03/CambioClimatico/view_amenaza",
        type: "POST",
        data: $("#insertForm").serialize() + "&factor=" + factor,
        async: false,
        success: function(datos) {
            $("#div_amenaza").html(datos);
        }
    });
    return false;
}
function reiniciar(factor) {
    $(location).attr('href', '/consultas03/CambioClimatico/view_consulta/' + factor);
}
function titulo_grafica(amenaza) {
    var titulo = "";
    switch (amenaza) {
        case "1":
            titulo = 'Movimientos en Masa';
            break;
        case "2":
            titulo = 'Inundaciones';
            break;
        case "3":
            titulo = 'Sequías';
            break;
        default:
            titulo = 'Sin Datos';
            break;
    }
    return titulo;
}
function titulo_factor(factor) {
    var titulo = "";
    switch (factor) {
        case "1":
            titulo = 'Exposición';
            break;
        case "2":
            titulo = 'Sensibilidad';
            break;
        case "3":
            titulo = 'Capacidad de Adaptación';
            break;
        default:
            titulo = 'Sin Datos';
            break;
    }
    return titulo;
}
function display_unidad(unidad) {
    switch (unidad) {
        case "1":
            $("#pita").css("display", "none");
            $("#papallacta").css("display", "none");
            $("#antisana").css("display", "none");
            $("#sanpedro").css("display", "block");
            break;
        case "2":
            $("#sanpedro").css("display", "none");
            $("#papallacta").css("display", "none");
            $("#antisana").css("display", "none");
            $("#pita").css("display", "block");
            break;
        case "3":
            $("#sanpedro").css("display", "none");
            $("#pita").css("display", "none");
            $("#antisana").css("display", "none");
            $("#papallacta").css("display", "block");
            break;
        case "4":
            $("#sanpedro").css("display", "none");
            $("#pita").css("display", "none");
            $("#papallacta").css("display", "none");
            $("#antisana").css("display", "block");
            break;
        default:
            $("#sanpedro").css("display", "none");
            $("#pita").css("display", "none");
            $("#papallacta").css("display", "none");
            $("#antisana").css("display", "none");
            break;
    }
    $("#introduccion").show();
}



function image_amenaza(amenaza){
    //alert(ame1);
    $("#div_amenaza").show();
    $("#div_titulo h4").html(titulo_grafica(amenaza));
    $("#div_titulo").show();
}
function color(factor,amenaza){
    //alert(amenaza);
    var color="";
    if (factor === "1") {
        switch (amenaza) {
            case "1":
                color=['#E6FCB3', '#8BDAB2', '#FDB687', '#FFFD88', '#D89F8B'];
                break;
            case "2":
                color=["#E8F7F0","#A8E3DC","#DAC8FD","#73C352","#84844F"];
                break;
            case "3":
                color=["#ACC1F3","#A5F7DB","#FEFEC0","#FDD85A","#EDAD71"];
                break;
        }
    }
    else if (factor === "2") {
        switch (amenaza) {
            case "1":
                color=["#D1FD7B", "#A9A722", "#FDA92A", "#FD8080", "#E30D19"];
                break;
            case "2":
                color=["#D4EEDF","#3DCE9B","#77D9DD","#ABC8FD","#0A4D72"];
                break;
            case "3":
                color=["#E9FEC1","#8DCF28","#FFFD38","#FED286","#FB0F1C"];
                break;
        }
    }
    else if (factor === "3") {
        switch (amenaza) {
            case "1":
                color=["#4776B3", "#A2B4BD", "#FFFEC2", "#F2986E", "#D4312E"];
                break;
            case "2":
                color=["#4776B3","#A2B4BD","#FFFEC2","#F2986E","#D3312E"];
                break;
            case "3":
                color=["#4776B3","#A2B4BD","#FFFEC2","#F2986D","#D4312E"];
                break;
        }
    }
    else{
        
    }
    return color;
}
$(document).ready(function () {
    /*$("#progressbar").progressbar({
        value: 37
    });*/
    var progressbar = $( "#progressbar" ),
      progressLabel = $( ".progress-label" );
    $(document).ajaxStart(function () {
        $("#introduccion").css("display", "none");
        $("#div_encabezado").css("display", "none");
        $("#div_titulo").css("display", "none");
        $("#div_amenaza").css("display", "none");
        $("#div_categoria").css("display", "none");
        $("#mapa").css("display", "none");
        
        $("#progressbar").css("display", "block");
        progress();
    });
    $(document).ajaxComplete(function () {
        $("#introduccion").css("display", "block");
        $("#div_encabezado").css("display", "block");
        $("#div_titulo").css("display", "block");
        $("#div_amenaza").css("display", "block");
        $("#div_categoria").css("display", "block");
        $("#mapa").css("display", "block");
        $("#progressbar").css("display", "none");
        progressbar.progressbar( "value", 0 );
    });
    
    
    
    
 
    progressbar.progressbar({
      value: false,
      change: function() {
        progressLabel.text( progressbar.progressbar( "value" ) + "%" );
      },
      complete: function() {
        progressLabel.text( "Complete!" );
      }
    });
 
    function progress() {
      var val = progressbar.progressbar( "value" ) || 0;
 
      progressbar.progressbar( "value", val + 2 );
 
      if ( val < 99 ) {
        setTimeout( progress, 80 );
      }
    }
 
    //setTimeout( progress, 2000 );


});
