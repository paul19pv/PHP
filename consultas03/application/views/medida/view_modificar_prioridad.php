
<div class="block_form">

    <p class="indicador" style="width: 650px;">Tercer Paso: Priorización de la medida</p>
    <?php
    $form_data = array('id' => 'insertFormMedida', "onsubmit" => "return false;");
    //$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/modificar_prioridad/'.$med_id, $form_data);
    $pri_id_data = array('id' => 'pri_id',
        'name' => 'pri_id',
        'type' => 'hidden',
        'value' => $pri_id);
    echo form_input($pri_id_data)
    ?>
    <div style="float:left; width:350px">
        <p>
            <label>C1:Importancia para conservación de fuentes de agua</label><br />
            <?php echo form_error('pri_c1'); ?>
            <?php
            $c1_data = array('id' => 'pri_c1',
                'name' => 'pri_c1',
                'class' => 'both small',
                'value' => $pri_c1,
                'placeholder' => 'Valor máximo 0.35');
            echo form_input($c1_data)
            ?>
        </p>

        <p>
            <label>C2:Importancia por los  beneficios directos a población</label><br />
            <?php echo form_error('pri_c2'); ?>
            <?php
            $c2_data = array('id' => 'pri_c2',
                'name' => 'pri_c2',
                'class' => 'both small',
                'value' => $pri_c2,
                'placeholder' => 'Valor máximo 0.25');
            echo form_input($c2_data)
            ?>
        </p>
        <p>
            <label>C3:Importantancia por los  beneficios indirectos a la población</label><br />
            <?php echo form_error('pri_c3'); ?>
            <?php
            $c3_data = array('id' => 'pri_c3',
                'name' => 'pri_c3',
                'class' => 'both small',
                'value' => $pri_c3,
                'placeholder' => 'Valor máximo 0.2');
            echo form_input($c3_data)
            ?>
        </p>
        <p>
            <label>C4:Importancia para enfrentar los efectos del cambio climático</label><br />
            <?php echo form_error('pri_c4'); ?>
            <?php
            $c4_data = array('id' => 'pri_c4',
                'name' => 'pri_c4',
                'class' => 'both small',
                'value' => $pri_c4,
                'placeholder' => 'Valor máximo 0.1');
            echo form_input($c4_data)
            ?>
        </p>

        <p>
            <label>C5:Importancia para los tomadores de decisiones</label><br />
            <?php echo form_error('pri_c5'); ?>
            <?php
            $c5_data = array('id' => 'pri_c5',
                'name' => 'pri_c5',
                'class' => 'both small',
                'value' => $pri_c5,
                'placeholder' => 'Valor máximo 0.1');
            echo form_input($c5_data)
            ?>
        </p>

    </div>

    <div style="float:left; width:120px; margin-left: 85px;">
        <p>
            <br>
            <br>
            <br>
            <br>
            <br>
        </p>
        <p>
            <label style="color: #2c8920">Puntaje Total:</label><br />
            <?php echo form_error('pri_puntaje'); ?>
            <?php
            $pun_data = array('id' => 'txt_puntaje',
                'name' => 'txt_puntaje',
                'class' => 'both small',
                'disabled' => 'disabled',
                'value' => $pri_puntaje);
            echo form_input($pun_data)
            ?>

            <?php
            $total_data = array('id' => 'pri_puntaje',
                'type' => 'hidden',
                'name' => 'pri_puntaje',
                'class' => 'both small',
                'value' => $pri_puntaje);
            echo form_input($total_data)
            ?>
        </p>

        <p>
            <label style="color: #2c8920">Categoría:</label><br />
            <?php
            $cat_data = array('id' => 'txt_categoria',
                'name' => 'txt_categoria',
                'class' => 'both small',
                'disabled' => 'disabled',
                'value' => $pri_categoria);
            echo form_input($cat_data)
            ?>
            <?php
            $categoria_data = array('id' => 'pri_categoria',
                'type' => 'hidden',
                'name' => 'pri_categoria',
                'class' => 'both small',
                'value' => $pri_categoria);
            echo form_input($categoria_data)
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


    <div style="float:right; width:144px">

        <?php
        $data_anterior = array('type' => 'button',
            'name' => 'reset',
            'value' => 'Anterior',
            'class' => 'submit filtro',
            "onclick" => 'clasificar_vista_ubicacion(' . $med_id . ')');
        echo form_submit($data_anterior);
        $data_guardar = array('type' => 'submit',
            'id' => 'guardar',
            'name' => 'guardar',
            'value' => 'Siguiente',
            'class' => 'submit filtro');
        echo form_submit($data_guardar);
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
    /*
    function clasificar_vista_capital(med_id) {
        $.ajax({
            url: "medida/clasificar_vista_capital/" + med_id,
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
    */
    function calcular_prioridad() {
        var c1 = +$("#pri_c1").val();
        var c2 = +$("#pri_c2").val();
        var c3 = +$("#pri_c3").val();
        var c4 = +$("#pri_c4").val();
        var c5 = +$("#pri_c5").val();
        var puntaje = c1 + c2 + c3 + c4 + c5;
        var categoria = "";
        if (puntaje >= 0.7)
            categoria = "A";
        else if ((puntaje >= 5) && (puntaje < 7))
            categoria = "B";
        else
            categoria = "C";
        $("#txt_puntaje").val(puntaje);
        $("#pri_puntaje").val(puntaje);
        $("#txt_categoria").val(categoria);
        $("#pri_categoria").val(categoria);
    }




    $(function() {

        /*estilo de los select*/

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

