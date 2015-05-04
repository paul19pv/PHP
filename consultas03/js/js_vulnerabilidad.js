/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
google.load("visualization", "1", {packages: ["corechart"]});
function consultar_datos() {

    var unidad = $("#unidad").val();
    var amenaza = $("#amenaza").val();
    
    if (unidad !== "null" && amenaza !== "null") {
        //var titulo = titulo_grafica(amenaza);
        display_unidad(unidad);
        image_amenaza(amenaza);
        //col=color(factor,amenaza);
        draw_chart();
        //draw_table(titulo, factor);
        draw_map();
    }
    else {
        alert("Debe seleccionar una estacion y un periodo");
    }

    return false;

}
function draw_chart() {
    
    var jsonData = $.ajax({
        url: $("#insertForm").attr("action"),
        type: "POST",
        data: $("#insertForm").serialize(),
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
        height: 220,
        colors: ['#e9ffbe', '#f2eea2', '#f2ce85', '#d19786', '#997062']
    };
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    
    $("#titulo_categoria").html('Categorías de Vulnerabilidad');
    //$("#div_categoria").show();
}

function draw_map(){
    $.ajax({
        url: "/consultas03/vulnerabilidad/consultar",
        type: "POST",
        data: $("#insertForm").serialize(),
        async: false,
        success: function(datos) {
            $("#mapa").html(datos);
        }
    });
    return false;
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
function image_amenaza(amenaza) {
    $("#div_amenaza").show();
    $("#div_titulo h4").html(titulo_grafica(amenaza));
    $("#div_titulo").show();
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