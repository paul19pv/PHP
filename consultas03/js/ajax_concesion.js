function filtrar_caudal() {
    //alert($("#searchForm").serialize());
    $.ajax({
        url: "informacion_caudal",
        type: "POST",
        data: $("#searchForm").serialize(),
        success: function(datos) {
            $("#table_div").html(datos);
            //$("#prueba").html(datos);
        },
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        }
    });

    filtrar_grafica();
    return false;

}
function filtrar_grafica() {
    var jsonData = $.ajax({
        url: "grafica_caudal",
        type: "POST",
        data: $("#searchForm").serialize(),
        dataType: "json",
        error: function(data, errorThrown)
        {
            alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
        },
        async: false}).responseText;
    var data = new google.visualization.DataTable(jsonData);
    var options = {
        hAxis: {title: 'Tipos de Usos',
            titleTextStyle: {color: 'black', bold: true, fontSize: 12},
            textStyle: {color: 'black', fontSize: 10}

        },
        vAxis: {
            title: 'Caudal(l/s)',
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
        legend: {position: 'none'},
        chartArea: {top: 10, height: 400}

    };
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    var n = $("ul li input:checked").length;
    var val_top = (n - 8) * 17;
    //alert(n);
    $("#chart_div").css('top', val_top);
    return false;

}
$(function() {


    $("#link_word").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "generate_word",
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
    $("#unidades").click(function(e) {
        $("#list_unidades").show("slow");

    });



});

