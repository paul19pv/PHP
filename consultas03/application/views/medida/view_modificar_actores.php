
<div class="block_form">

    <p class="indicador" style="width: 650px;">Cuarto Paso: Seleccionar los Actores y Ejecutores </p>
    <div id="message" class="message" style="display: none;"></div>
    <?php
    $form_data = array('id' => 'insertFormActor', "onsubmit" => "return false;");
    //$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/view_modificar_medida/'.$med_id, $form_data);
    ?>
    <div style="float:left; width:350px">
        <p id="p_ejecutor">
            <label>Ejecutores:</label><br />
            <?php
            $data_ejecutor = array('id' => 'btn_ejecutor',
                'type' => 'button',
                'name' => 'btn_ejecutor',
                'value' => '...',
                'class' => 'submit filtro');
            echo form_submit($data_ejecutor);
            ?>
        </p>

        <p id="p_beneficiario">
            <label>Beneficiario:</label><br />
            <?php
            $data_beneficiario = array('id' => 'btn_beneficiario',
                'type' => 'button',
                'name' => 'btn_beneficiario',
                'value' => '...',
                'class' => 'submit filtro');
            echo form_submit($data_beneficiario);
            ?>
        </p>



    </div>

    <div style="float:left; width:290px">

        <p id="p_aliado">
            <label>Aliados:</label><br />
            <?php
            $data_aliado = array('id' => 'btn_aliado',
                'type' => 'button',
                'name' => 'btn_aliado',
                'value' => '...',
                'class' => 'submit filtro');
            echo form_submit($data_aliado);
            ?>
        </p>

        <p id="p_responsable">
            <label>Responsable:</label><br />
            <?php
            $data_responsable = array('id' => 'btn_responsable',
                'type' => 'button',
                'name' => 'btn_responsable',
                'value' => '...',
                'class' => 'submit filtro');
            echo form_submit($data_responsable);
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
                'value' => 'Siguiente',
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


<div id="div_ejecutores" title="Seleccionar Ejecutores" class="actor">
    <?php
    $form_eje = array('id' => 'form_ejecutor', "onsubmit" => "return false;");
//$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/insertar_gestion/ejecutor', $form_eje);
    $med_id_data = array('id' => 'med_id',
        'name' => 'med_id',
        'type' => 'hidden',
        'value' => $med_id);
    echo form_input($med_id_data)
    ?>

    <table cellpadding="0" cellspacing="0" style="table-layout: auto;"  >
        <thead>
            <tr class="tbtitle">
                <th></th>
                <th>Codigo</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($ejecutores as $item):
                ?>
                <tr class="rows" style="font-size: 11px;">
                    <td style="font-size: 11px;">
                        <div class="checkboxFour">
                            <input type="checkbox" name="ejecutor[]" id="<?php echo $i; ?>" value="<?php echo $item['act_id'] ?>">
                            <label class="rectangle" for="<?php echo $i; ?>"></label>
                        </div>
                    </td>
                    <td style="font-size: 11px;"><?php echo $item['act_codigo'] ?></td>
                    <td style="font-size: 11px;"><?php echo $item['act_nombre'] ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>

        </tbody>
    </table>
    <?php echo form_close(); ?>
</div>

<div id="div_beneficiarios" title="Seleccionar Beneficiarios" class="actor">
    <?php
    $form_ben = array('id' => 'form_beneficiario', "onsubmit" => "return false;");
//$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/insertar_gestion/beneficiario', $form_ben);
    /*$med_id_data = array('name' => 'med_id',
        'type' => 'hidden',
        'value' => $med_id);
     * 
     */
    echo form_input($med_id_data)
    ?>

    <table cellpadding="0" cellspacing="0" style="table-layout: auto;"   >
        <thead>
            <tr class="tbtitle">
                <th> </th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Representante</th>
                <th>Cargo</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($beneficiarios as $item):
                ?>
                <tr class="rows" style="font-size: 11px;">
                    <td style="font-size: 11px;">
                        <div class="checkboxFour">
                            <input type="checkbox" name="beneficiario[]" id="<?php echo "ben".$i; ?>" value="<?php echo $item['act_id'] ?>">
                            <label class="rectangle" for="<?php echo "ben".$i; ?>"></label>
                        </div>
                    </td>
                    <td style="font-size: 11px;"><?php echo $item['act_codigo'] ?></td>
                    <td style="font-size: 11px;"><?php echo $item['act_nombre'] ?></td>
                    <td style="font-size: 11px;"><?php echo $item['act_representante'] ?></td>
                    <td style="font-size: 11px;"><?php echo $item['act_cargo'] ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>

        </tbody>
    </table>
    <?php echo form_close(); ?>
</div>

<div id="div_aliados" title="Seleccionar Aliados" class="actor">
    <?php
    $form_ali = array('id' => 'form_aliado', "onsubmit" => "return false;");
//$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/insertar_gestion/aliado', $form_ali);
    
    echo form_input($med_id_data)
    ?>

    <table cellpadding="0" cellspacing="0" style="table-layout: auto;"  >
        <thead>
            <tr class="tbtitle">
                <th></th>
                <th>Codigo</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($aliados as $item):
                ?>
                <tr class="rows" style="font-size: 11px;">
                    <td style="font-size: 11px;">
                        <div class="checkboxFour">
                            <input type="checkbox" name="aliado[]" id="<?php echo "ali".$i; ?>" value="<?php echo $item['act_id'] ?>">
                            <label class="rectangle" for="<?php echo "ali".$i; ?>"></label>
                        </div>
                    </td>
                    <td style="font-size: 11px;"><?php echo $item['act_codigo'] ?></td>
                    <td style="font-size: 11px;"><?php echo $item['act_nombre'] ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>

        </tbody>
    </table>
    <?php echo form_close(); ?>
</div>

<div id="div_responsables" title="Seleccionar Responsables" class="actor">
    <?php
    $form_res = array('id' => 'form_responsable', "onsubmit" => "return false;");
//$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/insertar_gestion/responsable', $form_res);
    
    echo form_input($med_id_data)
    ?>

    <table cellpadding="0" cellspacing="0" style="table-layout: auto;"  >
        <thead>
            <tr class="tbtitle">
                <th></th>
                <th>Codigo</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($responsables as $item):
                ?>
                <tr class="rows" style="font-size: 11px;">
                    <td style="font-size: 11px;">
                        <div class="checkboxFour">
                            <input type="radio" name="responsable[]" id="<?php echo "res".$i; ?>" value="<?php echo $item['act_id'] ?>">
                            <label class="rectangle" for="<?php echo "res".$i; ?>"></label>
                        </div>
                    </td>
                    <td style="font-size: 11px;"><?php echo $item['act_codigo'] ?></td>
                    <td style="font-size: 11px;"><?php echo $item['act_nombre'] ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>

        </tbody>
    </table>
    <?php echo form_close(); ?>
</div>


<script>
    function insertar_gestion(idformulario,idboton,idp) {
        $.ajax({
            url: $(idformulario).attr('action'),
            type: "POST",
            data: $(idformulario).serialize(),
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                if(obj.status==="success"){
                    $("#message").addClass("success");
                    $( idboton ).hide();
                    $( idp ).append( '<div class="error" style="color:#555">Registro(s) Actualizado</div>' );
                }else{
                    $("#message").addClass("error");
                }
                $("#message").html(obj.msg);
                $("#message").show();
                $('#message').fadeOut(5000);
            },
            error: function(data, errorThrown)
            {
                alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
            }
        });
        //e.preventDefault();

    }
    

    

    $(function() {

        


        $("#insertFormActor").submit(function(e) {
            $.ajax({
                url: $("#insertFormActor").attr('action'),
                type: "POST",
                data: $("#insertFormActor").serialize(),
                success: function(datos) {
                    $("#block_content").html(datos);
                },
                error: function(data, errorThrown)
                {
                    alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
                }
            });
        });



        $("#div_ejecutores").dialog({
            autoOpen: false,
            width: 600,
            modal: true,
            buttons: {
                "Aceptar": function() {
                    insertar_gestion("#form_ejecutor","#btn_ejecutor","#p_ejecutor");
                    $(this).dialog("close");
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            },
            close: function() {
                $(this).dialog("close");
            }
        });

        $("#btn_ejecutor").click(function() {
            $("#div_ejecutores").dialog("open");
        });


        $("#div_beneficiarios").dialog({
            autoOpen: false,
            width: 600,
            modal: true,
            buttons: {
                "Aceptar": function() {
                    insertar_gestion("#form_beneficiario","#btn_beneficiario","#p_beneficiario");
                    $(this).dialog("close");
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            },
            close: function() {
                $(this).dialog("close");
            }
        });

        $("#btn_beneficiario").click(function() {
            $("#div_beneficiarios").dialog("open");
        });
        
        $("#div_aliados").dialog({
            autoOpen: false,
            width: 600,
            modal: true,
            buttons: {
                "Aceptar": function() {
                    insertar_gestion("#form_aliado","#btn_aliado","#p_aliado");
                    $(this).dialog("close");
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            },
            close: function() {
                $(this).dialog("close");
            }
        });

        $("#btn_aliado").click(function() {
            $("#div_aliados").dialog("open");
        });
        
        
        $("#div_responsables").dialog({
            autoOpen: false,
            width: 600,
            modal: true,
            buttons: {
                "Aceptar": function() {
                    insertar_gestion("#form_responsable","#btn_responsable","#p_responsable");
                    $(this).dialog("close");
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            },
            close: function() {
                $(this).dialog("close");
            }
        });

        $("#btn_responsable").click(function() {
            $("#div_responsables").dialog("open");
        });
        
        
    });
</script>
