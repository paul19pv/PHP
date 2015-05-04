<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>css/cupertino/jquery-ui.css" rel="stylesheet" />



        <script src="<?php echo base_url() ?>js/jquery.js"></script>
        <script src="<?php echo base_url() ?>js/jquery-ui.js"></script>

        <!--<script src="<?php echo base_url() ?>js/functions.js"></script>-->

        <script src="<?php echo base_url() ?>js/js_medida.js"></script>
        <script src="<?php echo base_url() ?>js/ajaxfileupload.js"></script>
        <script src="<?php echo base_url() ?>js/jquery.select_skin.js"></script>



    </head>
    <body>
        <div id="hld" style="min-height: 380px;">
            <div id="wrap">
                <div id="content" class="block" style="width: 690px;">
                    <div class="block_head">
                        <div class="bheadl"></div>
                        <div class="bheadr"></div>
                        <h2>Administración - Monitoreo de Medidas</h2>
                    </div>


                    <div id="block_content" class="block_content">
                        <?php if ($mensaje != "") { ?>
                            <div id="message" class="message success"><?php echo urldecode($mensaje); ?></div>
                        <?php } ?>

                        <p class="indicador" style="width: 650px;">Para filtrar las medidas disponibles, utilice las opciones listadas a continuación:</p>

                        <?php
                        $form_data = array('id' => 'searchMedida', "onsubmit" => "return false;");
                        echo form_open('medida/consultar_admin_medida', $form_data);
                        ?>
                        <div style="float:left; width:258px">
                            <p>
                                <label>Unidad Hídrica:</label><br />
                                <select name="unidad" id="unidad" class="styled" style="width: 120px;">
                                    <option value="null">Seleccione</option>
                                    <?php
                                    foreach ($unidades as $fila) {
                                        ?>
                                        <option value="<?php echo $fila['id'] ?>" ><?php echo $fila['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </p>
                        </div>
                        <div style="float:left; width:248px">
                            <p>
                                <label>Amenaza Climática:</label><br />
                                <select id="amenaza" name="amenaza" class="styled" style="width: 120px;">
                                    <option value="null">Seleccione</option>
                                    <?php
                                    foreach ($amenazas as $fila) {
                                        ?>
                                        <option value="<?php echo $fila['id'] ?>" ><?php echo $fila['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </p>
                        </div>

                        <div style="float:left; width:144px">
                            <p>
                                <label></label><br />
                                <?php
                                $data_buscar = array('type' => 'submit',
                                    'id' => 'buscar',
                                    'name' => 'buscar',
                                    'value' => 'Buscar',
                                    'class' => 'submit');
                                echo form_submit($data_buscar);
                                $data_reset = array('type' => 'button',
                                    'name' => 'reset',
                                    'value' => 'Cancelar',
                                    'class' => 'submit',
                                    "onclick" => "reiniciar_admin()");
                                echo form_submit($data_reset);
                                ?>
                            </p>

                        </div>
                        <br clear="all">
                        <div style="float:right; width:62px">

                        </div>


                        <?php echo form_close(); ?>
                        <br clear="all">
                        <div id="div_medida">
                            <p>Si usted desea agregar una nueva medida tiene la opción de Agregar.</p>
                            <div style="width: 506; float: left">
                                <p class="indicador">Esta opción modificará la información de la base de datos.</p>
                            </div>
                            <?php
                            $form1_data = array('id' => 'searchMedida', "onsubmit" => "return false;");
                            echo form_open('', $form1_data);
                            ?>
                            <div style="float:left; width:72px">
                                <p>
                                    <?php
                                    $data_reset = array('type' => 'button',
                                        'name' => 'reset',
                                        'value' => 'Agregar',
                                        'class' => 'submit',
                                        "onclick" => "insertar()");
                                    echo form_submit($data_reset);
                                    ?>
                                </p>
                                <?php echo form_close(); ?>
                            </div>

                        </div>
                        <div id="progressbar" style="display: none;"><div class="progress-label"></div></div>





                        <input id="ruta_base" type="hidden" value="<?php echo base_url() ?>">


                    </div>
                    <div class="bendl"></div>
                    <div class="bendr"></div>



                </div>

            </div>

        </div>


    </body>
    <script>
        $(function() {

            /*estilo de los select*/
            $("form select.styled").select_skin();
            
            $('#message').fadeOut(10000);

        });
    </script>
</html>
