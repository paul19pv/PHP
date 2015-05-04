<div class="block_form">

    <p class="indicador" style="width: 650px;">Primer Paso: Información de la medida</p>
    <?php
    $form_data = array('id' => 'insertFormMedida', "onsubmit" => "return false;");
    //$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/modificar_medida01/' . $med_id, $form_data);
    ?>
    <div style="float:left; width:350px">
        <p>
            <label>Código:</label><br />
            <?php echo form_error('med_codigo'); ?>
            <?php
            $codigo_data = array('id' => 'med_codigo',
                'name' => 'med_codigo',
                'class' => 'both small',
                'value' => $med_codigo);

            echo form_input($codigo_data)
            ?>
        </p>
        <p>
            <label>Nombre:</label><br />
            <?php echo form_error('med_nombre'); ?>
            <?php
            $nombre_data = array('id' => 'med_nombre',
                'name' => 'med_nombre',
                'style' => 'width:300px',
                'value' => $med_nombre);
            echo form_textarea($nombre_data)
            ?>
        </p>

    </div>

    <div style="float:left; width:290px">
        <p>
            <label>Unidad Hídrica:</label><br />
            <?php echo form_error('med_unidad'); ?>
            <select name="med_unidad" id="med_unidad" class="styled" style="width: 120px;">
                <option value="">Seleccione</option>
                <?php
                $val_unidades = set_value('med_unidad');
                foreach ($unidades as $fila) {

                    if ($med_unidad === (int) $fila['id']) {
                        ?>
                        <option value="<?php echo $fila['id'] ?>" selected="selected" ><?php echo $fila['nombre']; ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $fila['id'] ?>" ><?php echo $fila['nombre']; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </p>

        <p>
            <label>Amenaza Climática:</label><br />
            <?php echo form_error('med_amenaza'); ?>
            <select id="med_amenaza" name="med_amenaza" class="styled" style="width: 120px;">
                <option value="">Seleccione</option>
                <?php
                $val_amenazas = set_value('med_amenaza');
                foreach ($amenazas as $fila) {
                    if ($med_amenaza === (int) $fila['id']) {
                        ?>
                        <option value="<?php echo $fila['id'] ?>" selected="selected" ><?php echo $fila['nombre']; ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $fila['id'] ?>" ><?php echo $fila['nombre']; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
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

    <div style="float:right; width:72px">

        <?php
        $data_guardar = array('type' => 'submit',
            'id' => 'guardar',
            'name' => 'guardar',
            'value' => 'Siguiente',
            'class' => 'submit filtro');
        echo form_submit($data_guardar);

        /*$data_siguiente = array('type' => 'button',
            'name' => 'siguiente',
            'value' => 'Siguiente',
            'class' => 'submit filtro',
            'onclick' => 'clasificar_vista_ubicacion(' . $med_id . ')');
        echo form_submit($data_siguiente);*/
        ?>


    </div>

    <?php echo form_close(); ?>
</div>


<script>
    function clasificar_vista_ubicacion(med_id) {
        $.ajax({
            url: "medida/clasificar_vista_ubicacion/" + med_id,
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
    $(function() {

        /*estilo de los select*/
        $("form select.styled").select_skin();


        $("#insertFormMedida").submit(function(e) {
            $.ajax({
                url: $("#insertFormMedida").attr('action'),
                type: "POST",
                data: $("#insertFormMedida").serialize(),
                success: function(datos) {
                    $("#block_content").html(datos);
                },
                error: function(data, errorThrown)
                {
                    alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
                }
            });
        });


    });
</script>