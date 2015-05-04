<div class="block_form">

    <p class="indicador" style="width: 650px;">Quinto Paso: Llenar la información adicional de la medida</p>
    <?php
    $form_data = array('id' => 'updateFormMedida', "onsubmit" => "return false;");
    //$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/modificar_medida/'.$med_id, $form_data);
    ?>
    <div style="float:left; width:350px">
        
        
        
        <p>
            <label>Alcance:</label><br />
            <?php echo form_error('med_alcance'); ?>
            <?php
            $alcance_data = array('id' => 'med_alcance',
                'name' => 'med_alcance',
                'style' => 'width:300px',
                'value' => set_value('med_alcance'));
            echo form_textarea($alcance_data)
            ?>
        </p>
        
        <p>
            <label>Restricciones:</label><br />
            <?php echo form_error('med_restriccion'); ?>
            <?php
            $restriccion_data = array('id' => 'med_restriccion',
                'name' => 'med_restriccion',
                'style' => 'width:300px',
                'value' => set_value('med_restriccion'));
            echo form_textarea($restriccion_data)
            ?>
        </p>
        
        

    </div>

    <div style="float:left; width:290px">
        
        <p>
            <label>Número de Beneficiarios Directos:</label><br />
            <?php echo form_error('med_num_direc'); ?>
            <?php
            $dir_data = array('id' => 'med_num_direc',
                'name' => 'med_num_direc',
                'class' => 'both small',
                'value' => set_value('med_num_direc'));
            echo form_input($dir_data)
            ?>
        </p>
        
        <p>
            <label>Número de Beneficiarios Indirectos:</label><br />
            <?php echo form_error('med_num_indir'); ?>
            <?php
            $ind_data = array('id' => 'med_num_indir',
                'name' => 'med_num_indir',
                'class' => 'both small',
                'value' => set_value('med_num_indir'));
            echo form_input($ind_data)
            ?>
        </p>
        
        <p>
            <label>Riesgos:</label><br />
            <?php echo form_error('med_riesgo'); ?>
            <?php
            $riesgo_data = array('id' => 'med_riesgo',
                'name' => 'med_riesgo',
                'style' => 'width:300px',
                'value' => set_value('med_riesgo'));
            echo form_textarea($riesgo_data)
            ?>
        </p>
        
        <p>
            <label>Observaciones:</label><br />
            <?php echo form_error('med_observacion'); ?>
            <?php
            $observacion_data = array('id' => 'med_observacion',
                'name' => 'med_observacion',
                'style' => 'width:300px',
                'value' => set_value('med_observacion'));
            echo form_textarea($observacion_data)
            ?>
        </p>
        
        

    </div>
    <br clear="all">
    <hr>


    <div style="float:right; width:134px">

        <?php
        $data_guardar = array('type' => 'submit',
            'id' => 'guardar',
            'name' => 'guardar',
            'value' => 'Finalizar',
            'class' => 'submit filtro');
        echo form_submit($data_guardar);

        $data_reset = array('type' => 'button',
            'name' => 'reset',
            'value' => 'Cancelar',
            'class' => 'submit filtro',
            "onclick" => "reiniciar()");
        echo form_submit($data_reset);
        ?>


    </div>

    <?php echo form_close(); ?>
</div>


<script>
    $(function() {



        $("#updateFormMedida").submit(function(e) {
            $.ajax({
                url: $("#updateFormMedida").attr('action'),
                type: "POST",
                data: $("#updateFormMedida").serialize(),
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