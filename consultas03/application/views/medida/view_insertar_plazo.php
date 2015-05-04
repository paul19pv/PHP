<div class="block_form">

    <p class="indicador" style="width: 650px;">Sexto Paso: Plazo de implementación la medida</p>
    <?php
    $form_data = array('id' => 'updateFormMedida', "onsubmit" => "return false;");
    //$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/guardar_plazo/', $form_data);
    $med_id_data = array('id' => 'med_id',
        'name' => 'med_id',
        'type' => 'hidden',
        'value' => $med_id);
    echo form_input($med_id_data)
    ?>
    <div style="float:left; width:350px">

        <p>
            <label>Fecha de Inicio:</label><br />
            <?php echo form_error('pla_inicio'); ?>
            <?php
            $inicio_data = array('id' => 'pla_inicio',
                'name' => 'pla_inicio',
                'class' => 'both small',
                'value' => set_value('pla_inicio'));
            echo form_input($inicio_data)
            ?>
        </p>

        <p>
            <label>Fecha de Finalización:</label><br />
            <?php echo form_error('pla_fin'); ?>
            <?php
            $fin_data = array('id' => 'pla_fin',
                'name' => 'pla_fin',
                'class' => 'both small',
                'value' => set_value('pla_fin'));
            echo form_input($fin_data)
            ?>
        </p>






    </div>

    <div style="float:left; width:290px">


        <p>
            <label>Plazo(días):</label><br />
            <?php echo form_error('pla_plazo'); ?>
            <?php
            $plazo_data = array('id' => 'pla_plazo',
                'name' => 'pla_plazo',
                'class' => 'both small',
                'value' => set_value('pla_plazo'),
                'readonly' => 'readonly');
            echo form_input($plazo_data)
            ?>
        </p>



    </div>
    <br clear="all">
    <hr>

    <div style="float:left; width:134px">
        <?php
        $data_reset = array('type' => 'button',
            'name' => 'reset',
            'value' => 'Cancelar',
            'class' => 'submit filtro',
            "onclick" => "reiniciar()");
        echo form_submit($data_reset);
        ?>
    </div>
    <div style="float:right; width:134px">
        <p>
            <?php
            $data_anterior = array('type' => 'button',
                'name' => 'reset',
                'value' => 'Anterior',
                'class' => 'submit filtro',
                "onclick" => 'clasificar_vista_gestion(' . $med_id . ')');
            echo form_submit($data_anterior);

            $data_guardar = array('type' => 'submit',
                'id' => 'guardar',
                'name' => 'guardar',
                'value' => 'Siguiente',
                'class' => 'submit filtro');
            echo form_submit($data_guardar);
            ?>
        </p>

    </div>
    <?php echo form_close(); ?>
</div>


<script>
    function clasificar_vista_gestion(med_id) {
        $.ajax({
            url: "medida/clasificar_vista_gestion/" + med_id,
            //url: "medida/view_modificar_ubicacion/1",
            type: "POST",
            //data: $("#insertFormMedida").serialize(),
            success: function(datos) {
                $("#block_content").html(datos);
            },
            error: function(data, errorThrown)
            {
                alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
            }
        });
    }
    restaFechas = function(f1, f2)
    {
        var aFecha1 = f1.split('/');
        var aFecha2 = f2.split('/');
        var fFecha1 = Date.UTC(aFecha1[2], aFecha1[1] - 1, aFecha1[0]);
        var fFecha2 = Date.UTC(aFecha2[2], aFecha2[1] - 1, aFecha2[0]);
        var dif = fFecha2 - fFecha1;
        var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
        return dias;
    }
    $(function() {



        $("#updateFormMedida").submit(function(e) {
            $.ajax({
                url: $("#updateFormMedida").attr('action'),
                type: "POST",
                data: $("#updateFormMedida").serialize(),
                success: function(datos) {
                    $("#block_content").html(datos);
                    //var obj = jQuery.parseJSON(datos);
                    //$(location).attr('href', '/consultas03/medida/index/' + obj.msg);
                },
                error: function(data, errorThrown)
                {
                    alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
                }
            });
        });



        $("#pla_inicio").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            onClose: function(selectedDate) {
                $("#pla_fin").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#pla_fin").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            onClose: function(selectedDate) {
                $("#pla_inicio").datepicker("option", "maxDate", selectedDate);
            }
        });
        $("#pla_fin").change(function() {
            var f1 = $("#pla_inicio").val();
            var f2 = $("#pla_fin").val();
            var f3 = restaFechas(f1, f2)
            $("#pla_plazo").val(f3);
        });

    });
</script>