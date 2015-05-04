<div>

    <p class="indicador" style="width: 650px;">Cuarto Paso: Información de los Medios de Vida</p>

    <?php
    if ($error) {
        ?>
        <div id="message_upload" class="message error">Seleccione al menos un medio de vida</div>
        <?php
    }
    ?>
    <?php
    $form_data = array('id' => 'insertFormCapital', "onsubmit" => "return false;");
    //$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/guardar_capital', $form_data);
    $med_id_data = array('id' => 'med_id',
        'name' => 'med_id',
        'type' => 'hidden',
        'value' => $med_id);
    echo form_input($med_id_data)
    ?>

    <div style="float:left; width:650px">
        <p>
            <label>Capitales:</label>
        </p>
        

        <?php
        $i = 0;
        foreach ($capitales as $fila) {
            ?>
            <div class="checkboxFour">
                <input type="checkbox" name="cap_nombre[]" id="<?php echo $i; ?>" value="<?php echo $fila['nombre'] ?>">

                <label class="rectangle" for="<?php echo $i; ?>"></label>
                <label class="checkboxlabel"><?php echo $fila['nombre'] ?></label>
            </div>



            <?php
            $i++;
        }
        ?>





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
                "onclick" => 'clasificar_vista_prioridad(' . $med_id . ')');
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

<div id="div_capitales"></div>


<script>
    function clasificar_vista_prioridad(med_id) {
        $.ajax({
            url: "medida/clasificar_vista_prioridad/" + med_id,
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

        $("#insertFormCapital").submit(function(e) {
            $.ajax({
                url: $("#insertFormCapital").attr('action'),
                type: "POST",
                data: $("#insertFormCapital").serialize(),
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
