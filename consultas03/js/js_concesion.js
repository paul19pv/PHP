
//consultar informacion por caudal concesionado
function informacion_caudal() {
    $.ajax({
        url: "informacion_caudal",
        type: "POST",
        data: $("#insertForm").serialize(),
        success: function(datos) {
            $("#table_div").html(datos);
            //$("#prueba").html(datos);
        },
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        }
    });

    var numData = $.ajax({
        url: "numero_unidades",
        type: "POST",
        data: $("#insertForm").serialize(),
        dataType: "json",
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        },
        async: false}).responseText;
    data = JSON.parse(numData);
    n = data['valor'];
    var val_top = (n - 8) * 18;
    $("#chart_div").css('top', val_top);
    grafica_caudal();
    return false;
}
function grafica_caudal() {
    var jsonData = $.ajax({
        url: "grafica_caudal",
        type: "POST",
        data: $("#insertForm").serialize(),
        dataType: "json",
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        },
        async: false}).responseText;
    
    var data = new google.visualization.DataTable(jsonData);
    var options = {
        hAxis: {
            titleTextStyle: {color: 'black', bold: true, fontSize: 12},
            textStyle: {color: 'black', fontSize: 10}

        },
        vAxis: {
            title: 'Caudal(l/s)',
            titleTextStyle: {color: 'black', bold: true},
            textStyle: {color: 'black', fontSize: 10, fontName: 'Arial'},
            viewWindowMode: 'maximized'
        },
        annotations: {
            textStyle: {
                fontName: 'Arial',
                fontSize: 10,
                //bold: true,
                //italic: true,
                color: '#871b47', // The color of the text.
                //auraColor: '#d799ae', // The color of the text outline.
                opacity: 0.8          // The transparency of the text.
            }
        },
        legend: {position: 'none'},
        chartArea: {top: 10, height: 400}

    };
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    //var n = $( "div input:checked" ).length;
    //var val_top=(n-9)*18;
    //alert(n);
    //$("#chart_div").css('top',val_top);
    /*
     $.ajax({
     url: "grafica_caudal",
     type: "POST",
     data: $("#insertForm").serialize(),
     success: function(datos) {
     $("#chart_div").html(datos);
     }
     });
     */
    return false;

}
function cancelar() {
    $("#list_unidades").hide("slow")
}
//consultar informacion por numero de concesiones
function informacion_numero() {
    $.ajax({
        url: "informacion_numero",
        type: "POST",
        data: $("#insertForm").serialize(),
        success: function(datos) {
            $("#table_div").html(datos);
        },
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        }
    });
    grafica_numero();
    return false;
}
function grafica_numero() {

    var jsonData = $.ajax({
        url: "grafica_numero01",
        type: "POST",
        data: $("#insertForm").serialize(),
        dataType: "json",
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        },
        async: false}).responseText;
    var data = new google.visualization.DataTable(jsonData);
    var num_rows=data.getNumberOfRows();
    var h=num_rows*40;
    //$("#chart_div").css('height', h+100);
    var options = {
        hAxis: {title: 'Concesiones',
            titleTextStyle: {color: 'black', bold: true, fontSize: 12},
            textStyle: {color: 'black', fontSize: 10},
            viewWindowMode: 'maximized'

        },
        vAxis: {
            title: 'Unidades Hidricas',
            titleTextStyle: {color: 'black', bold: true},
            textStyle: {color: 'black', fontSize: 10},
            viewWindowMode: 'maximized'
        },
        annotations: {
            textStyle: {
                fontName: 'Arial',
                fontSize: 10,
                //bold: true,
                //italic: true,
                color: '#871b47', // The color of the text.
                //auraColor: '#d799ae', // The color of the text outline.
                opacity: 0.8          // The transparency of the text.
            }
        },
        bar: { groupWidth: '50%' },
        chartArea: {top: 10},
        isStacked: true,

    };
    // Instantiate and draw our chart, passing in some options.
    //var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));chart.draw(data, options);

    /*
     $.ajax({
     url: "grafica_numero",
     type: "POST",
     data: $("#insertForm").serialize(),
     success: function(datos) {
     $("#chart_div").html(datos);
     }
     });
     */
    return false;

}
$(function() {

    /*estilo de los select*/
});