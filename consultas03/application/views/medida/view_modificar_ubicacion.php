
<div class="block_form">

    <p class="indicador" style="width: 650px;">Segundo Paso: Ubicación de la medida</p>
    <div id="message_upload" class="message" style="display: none;"></div>
    <?php
    $form_data = array('id' => 'insertFormUbicacion', "onsubmit" => "return false;");
    //$form_data = array('id' => 'insertFormMedida');
    echo form_open('medida/modificar_ubicacion/' . $med_id, $form_data);
    $ubi_id_data = array('id' => 'ubi_id',
        'name' => 'ubi_id',
        'type' => 'hidden',
        'value' => $ubi_id);
    echo form_input($ubi_id_data)
    ?>
    <div style="float:left; width:350px">
        <p>
            <label>Sector:</label><br />
            <?php echo form_error('ubi_sector'); ?>
            <?php
            $sector_data = array('id' => 'ubi_sector',
                'name' => 'ubi_sector',
                'class' => 'both small',
                'value' => $ubi_sector);
            echo form_input($sector_data)
            ?>
        </p>
        <p>
            <label>Longitud:</label><br />
            <?php echo form_error('ubi_longitud'); ?>
            <?php
            $longitud_data = array('id' => 'ubi_longitud',
                'name' => 'ubi_longitud',
                'class' => 'both small',
                'value' => $ubi_longitud,
                'placeholder'=>'WGS 1984 UTM 17S');
            echo form_input($longitud_data)
            ?>
        </p>
        <p>
            <label>Latitud:</label><br />
            <?php echo form_error('ubi_latitud'); ?>
            <?php
            $latitud_data = array('id' => 'ubi_latitud',
                'name' => 'ubi_latitud',
                'class' => 'both small',
                'value' => $ubi_latitud,
                'placeholder'=>'WGS 1984 UTM 17S');
            echo form_input($latitud_data)
            ?>
        </p>


    </div>

    <div style="float:left; width:290px">
        <p>
            <label>Altura(m):</label><br />
            <?php echo form_error('ubi_altura'); ?>
            <?php
            $altura_data = array('id' => 'ubi_altura',
                'name' => 'ubi_altura',
                'class' => 'both small',
                'value' => $ubi_altura);
            echo form_input($altura_data)
            ?>
        </p>

        <p id="p_foto">
            <label>Foto:</label><br>
            <?php echo form_error('ubi_foto'); ?>
            <?php
            $data_foto = array('id' => 'btn_foto',
                'type' => 'button',
                'name' => 'reset',
                'value' => 'Cambiar',
                'class' => 'submit filtro');
            echo form_submit($data_foto);

            $foto_data = array('id' => 'ubi_foto',
                'name' => 'ubi_foto',
                'type' => 'hidden',
                'value' => $ubi_foto);
            echo form_input($foto_data)
            ?>
        </p>

        <p id="p_croquis" >
            <label>Croquis:</label><br>
            <?php echo form_error('ubi_croquis'); ?>
            <?php
            $data_croquis = array('id' => 'btn_croquis',
                'type' => 'button',
                'name' => 'btn_croquis',
                'value' => 'Cambiar',
                'class' => 'submit filtro');
            echo form_submit($data_croquis);

            $croquis_data = array('id' => 'ubi_croquis',
                'name' => 'ubi_croquis',
                'type' => 'hidden',
                'value' => $ubi_croquis);
            echo form_input($croquis_data)
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
            "onclick" => 'clasificar_vista_medida(' . $med_id . ')');
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

<div id="div_foto" title="Subir Imagen">
    <?php
    $form_foto = array('id' => 'form_foto');
    echo form_open_multipart('medida/upload_foto', $form_foto);
    ?>
    <p>
        <label><b>Archivo:</b></label>
    </p>
    <?php
    $text_foto_data = array('id' => 'txt_foto',
        'name' => 'txt_foto',
        'class' => 'both small',
        'style' => 'float:left',
        'disabled' => 'disabled');
    echo form_input($text_foto_data)
    ?>
    <div class="fileUpload">
        <span>Examinar</span>
        <?php
        $subir_data = array('id' => 'foto_file',
            'name' => 'foto_file',
            'type' => 'file',
            'class' => 'file'
        );
        echo form_input($subir_data)
        ?>
    </div>
    <p>*Las dimensiones del archivo deben ser de 160x110 con un tamaño maximo de 1mb</p>
    <?php echo form_close(); ?>
    <div>
        <img src="<?php echo base_url() . "images/medida/fotos/" . $ubi_foto; ?>" height="105" width="160">
    </div>
</div>

<div id="div_croquis" title="Subir Croquis">
    <?php
    $form_croquis = array('id' => 'form_croquis');
    echo form_open_multipart('medida/upload_croquis', $form_croquis);
    ?>
    <p>
        <label><b>Archivo:</b></label>

    </p>
    <?php
    $text_croquis_data = array('id' => 'txt_croquis',
        'name' => 'txt_croquis',
        'class' => 'both small',
        'style' => 'float:left',
        'disabled' => 'disabled');
    echo form_input($text_croquis_data)
    ?>
    <div class="fileUpload">
        <span>Examinar</span>
        <?php
        $subir_data02 = array('id' => 'croquis_file',
            'name' => 'croquis_file',
            'type' => 'file',
            'class' => 'file'
        );
        echo form_input($subir_data02)
        ?>
    </div>
    <p>*Las dimensiones del archivo deben ser de 160x110 con un tamaño maximo de 1mb</p>
    <?php echo form_close(); ?>
    <div>
        <img src="<?php echo base_url() . "images/medida/croquis/" . $ubi_croquis; ?>" height="105" width="160">
    </div>
</div>

<script>
    function clasificar_vista_medida(med_id) {
        $.ajax({
            url: "medida/view_modificar_medida/" + med_id,
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
*/
    function subir_foto() {
        //e.preventDefault();
        $.ajaxFileUpload({
            url: './medida/upload_foto/',
            secureuri: false,
            fileElementId: 'foto_file',
            dataType: 'json',
            success: function(data)
            {
                if (data.status !== 'error')
                {
                    $("#message_upload").addClass('success');
                    $("#ubi_foto").val(data.id);
                    $('#btn_foto').attr("disabled", true);
                    $("#btn_foto").hide();
                    $("#p_foto").append('<div class="error" style="color:#555">Archivo Cargado</div>');
                }
                else {
                    $("#message_upload").addClass('error');
                    $("#ubi_foto").val('');
                }
                $("#message_upload").html(data.msg);
                $("#message_upload").show();
                $('#message_upload').fadeOut(5000);


            }
        });
        return false;
    }

    function subir_croquis() {
        //e.preventDefault();
        $.ajaxFileUpload({
            url: './medida/upload_croquis/',
            secureuri: false,
            fileElementId: 'croquis_file',
            dataType: 'json',
            success: function(data)
            {
                if (data.status !== 'error')
                {
                    $("#message_upload").addClass('success');
                    $("#ubi_croquis").val(data.id);
                    $('#btn_croquis').attr("disabled", true);
                    $("#btn_croquis").hide();
                    $("#p_croquis").append('<div class="error" style="color:#555">Archivo Cargado</div>');
                }
                else {
                    $("#message_upload").addClass('error');
                    $("#ubi_croquis").val('');
                }
                $("#message_upload").html(data.msg);
                $("#message_upload").show();
                $('#message_upload').fadeOut(5000);


            }
        });
        return false;
    }

    $(function() {

        /*estilo de los select*/
        $("form select.styled").select_skin();


        $("#insertFormUbicacion").submit(function(e) {
            $.ajax({
                url: $("#insertFormUbicacion").attr('action'),
                type: "POST",
                data: $("#insertFormUbicacion").serialize(),
                success: function(datos) {
                    $("#block_content").html(datos);
                },
                error: function(data, errorThrown)
                {
                    alert('Respuesta Fallida del Servidor. Intente el proceso mas tarde');
                }
            });
        });


        /*$("#imageForm").submit(function(e) {
         e.preventDefault();
         $.ajaxFileUpload({
         url: './medida/upload_foto/',
         secureuri: false,
         fileElementId: 'foto_file',
         dataType: 'json',
         success: function(data)
         {
         if (data.status !== 'error')
         {
         $('#files').html('<p>Reloading files...</p>');
         $("#message_upload").addClass('error');
         $("#message_upload").html(data.msg);
         
         }
         $("#ubi_foto").val(data.id);
         $("#message_upload").addClass('success');
         $("#message_upload").html(data.msg);
         
         }
         });
         return false;
         });
         */

        $("#div_foto").dialog({
            autoOpen: false,
            width: 600,
            modal: true,
            buttons: {
                "Aceptar": function() {
                    subir_foto();
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

        $("#btn_foto").click(function() {
            $("#div_foto").dialog("open");
        });


        $("#div_croquis").dialog({
            autoOpen: false,
            width: 600,
            modal: true,
            buttons: {
                "Aceptar": function() {
                    subir_croquis();
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

        $("#btn_croquis").click(function() {
            $("#div_croquis").dialog("open");
        });


        $("#foto_file").change(function() {
            $("#txt_foto").val($(this).val())

        });

        $("#croquis_file").change(function() {
            $("#txt_croquis").val($(this).val())

        });

    });
</script>
