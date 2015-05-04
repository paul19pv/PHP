
<div class="block_form">

    <p class="indicador" style="width: 650px;">Cuarto Paso: Llenar la información de los Medios de Vida</p>
    <?php
    $form_data = array('id' => 'insertFormCapital', "onsubmit" => "return false;");
    //$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/guardar_prioridad', $form_data);
    $med_id_data = array('id' => 'med_id',
        'name' => 'med_id',
        'type' => 'hidden',
        'value' => $med_id);
    echo form_input($med_id_data)
    ?>
    <div style="float:left; width:350px">
        <p>
            <label>Capital:</label><br />
            <?php echo form_error('cap_nombre'); ?>
            <select name="cap_nombre" id="cap_nombre" class="styled" style="width: 120px;">
                <option value="">Seleccione</option>
                <?php
                $val_capital = set_value('cap_nombre');
                foreach ($capitales as $fila) {

                    if ($val_capital === $fila['id']) {
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
            <label>Nivel:</label><br />
            <?php echo form_error('cap_puntaje'); ?>
            <select name="cap_puntaje" id="cap_puntaje" class="styled" style="width: 120px;">
                <option value="">Seleccione</option>
                <?php
                $val_puntaje = set_value('cap_puntaje');
                foreach ($puntajes as $fila) {

                    if ($val_puntaje === $fila['id']) {
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

    <div style="float:left; width:290px">
        <p>
            <label>Indicadores de Resultados:</label><br />
            <?php echo form_error('cap_indicador'); ?>
            <?php
            $indicador_data = array('id' => 'cap_indicador',
                'name' => 'cap_indicador',
                'style' => 'width:300px',
                'value' => set_value('cap_indicador'));
            echo form_textarea($indicador_data)
            ?>
        </p>

        <p>
            <label>Unidad de Medidad:</label><br />
            <?php echo form_error('cap_uni_med'); ?>
            <?php
            $c5_data = array('id' => 'cap_uni_med',
                'name' => 'cap_uni_med',
                'class' => 'both small',
                'value' => set_value('cap_uni_med'));
            echo form_input($c5_data)
            ?>
        </p>
        
        <p>
            <label>Impactos Esperado:</label><br />
            <?php echo form_error('cap_impacto'); ?>
            <?php
            $impacto_data = array('id' => 'cap_impacto',
                'name' => 'cap_impacto',
                'style' => 'width:300px',
                'value' => set_value('cap_impacto'));
            echo form_textarea($impacto_data)
            ?>
        </p>

        

       

    </div>
    <br clear="all">
    <hr>


    <div style="float:right; width:134px">
        <p>
            <?php
            $data_guardar = array('type' => 'submit',
                'id' => 'guardar',
                'name' => 'guardar',
                'value' => 'Guardar',
                'class' => 'submit filtro');
            echo form_submit($data_guardar);

            $data_reset = array('type' => 'button',
                'name' => 'reset',
                'value' => 'Cancelar',
                'class' => 'submit filtro',
                "onclick" => "reiniciar()");
            echo form_submit($data_reset);
            ?>
        </p>

    </div>

    <?php echo form_close(); ?>
</div>

<div id="div_capitales"></div>


<script>

    function calcular_prioridad() {
        var c1 = +$("#pri_c1").val();
        var c2 = +$("#pri_c2").val();
        var c3 = +$("#pri_c3").val();
        var c4 = +$("#pri_c4").val();
        var c5 = +$("#pri_c5").val();
        var puntaje = c1+c2+c3+c4+c5;
        var categoria = "";
        if (puntaje >= 0.7)
            categoria = "A";
        else if ((puntaje >= 5) && (puntaje < 7))
            categoria = "B";
        else
            categoria = "C";
        $("#txt_puntaje").val(puntaje)
        $("#pri_puntaje").val(puntaje)
        $("#txt_categoria").val(categoria)
        $("#pri_categoria").val(categoria)
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


        $("#pri_c1").change(function() {
            calcular_prioridad();

        });
        
        $("#pri_c2").change(function() {
            calcular_prioridad();

        });
        
        $("#pri_c3").change(function() {
            calcular_prioridad();

        });
        
        $("#pri_c4").change(function() {
            calcular_prioridad();

        });
        $("#pri_c5").change(function() {
            calcular_prioridad();

        });

    });




</script>
