function consultar_datos(variable) {
    var titulo_vertical="";
    var color="";
    switch(variable){
        case "caudal":
            titulo_vertical='Caudal (m3/s)';
            color='#0000FF';
            break;
        case "humed":
            titulo_vertical='Humedad Relativa (%)';
            color='#00CC99';
            break;
        case "nubosid":
            titulo_vertical='Nubosidad (Octas)';
            color='#5F9EA0';
            break;
        case "precip":
            titulo_vertical='Precipitación (mm)';
            color='#1E90FF';
            break;
        case "temp":
            titulo_vertical='Temperatura (ºC)';
            color='#FF8C00';
            break;
        case "vel_vien":
            titulo_vertical='Velocidad del Viento (m/s)';
            color='#7B68EE';
            break;
        default:
            titulo_vertical='Sin Datos';
            color='#000000';
    }
    var estacion=$("#estacion").val();
    var periodo=$("#periodo").val();
    if(periodo!=="null" && estacion!=="null"){
        draw_chart(titulo_vertical,color,variable);
        draw_table(variable);
    }
    else{
        alert("Debe seleccionar una estacion y un periodo");
    }
    return false;

}
function draw_chart(titulo_vertical,color,variable) {
    var jsonData = $.ajax({
        url: $("#insertForm").attr("action"),
        type: "POST",
        data: $("#insertForm").serialize()+"&variable="+variable,
        dataType: "json",
        async: false}).responseText;
    var data = new google.visualization.DataTable(jsonData);
    var options = {
        //title: 'Grafica de Caudal',
        hAxis: {title: 'Meses',
            titleTextStyle: {color: 'black', bold: true},
            textStyle: {color: 'black', fontSize:10}
        },
        vAxis: {
            title: titulo_vertical, 
            titleTextStyle: {color: 'black', bold: true},
            viewWindowMode: 'maximized'
        },
        annotations: {
            textStyle: {
                fontName: 'Arial',
                fontSize: 10,
                //bold: true,
                //italic: true,
                //color: '#871b47', // The color of the text.
                //auraColor: '#d799ae', // The color of the text outline.
                opacity: 0.8          // The transparency of the text.
            }
        },
        colors: [color],
        chartArea: {top: 10, height: 300}
    };
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
function draw_table(variable) {
    
    $.ajax({
        url: "/consultas03/red2011/consultar_informacion",
        type: "POST",
        data: $("#insertForm").serialize()+"&variable="+variable,
        success: function(datos) {
            $("#table_div").html(datos);
            //$("#prueba").html(datos);
        }
    });
    return false;
}
function reiniciar(variable) {
    $(location).attr('href','/consultas03/red2011/view_consulta/'+variable);
     
}
