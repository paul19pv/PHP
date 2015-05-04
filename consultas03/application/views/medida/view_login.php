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
                        <p style="width: 650px; text-align: justify;">Los usuarios autorizados pueden añadir, actualizar y consultar las medidas de adaptación al cambio climático registradas en el Sistema de Monitoreo. Para continuar se requiere un usuario y contraseña autorizados. Si no dispone de esta información, por favor contactese al correo electrónico:</p>
                        <p style="color: #0033CC"><u>contactenos@infoagua-guayllabamba.com</u></p>
                        <?php if ($mensaje != "") { ?>
                            <div id="message" class="message success"><?php echo urldecode($mensaje); ?></div>
                        <?php } ?>
                        <p class="indicador" style="width: 650px; text-align: center;">Ingrese su usuario y contraseña</p>
                        <div id="div_login">
                            <?php
                            $form_data = array('id' => 'searchMedida', "onsubmit" => "return false;");
                            echo form_open('medida/login', $form_data);
                            ?>
                            <div style="float:left; width:120px; margin-left: 40px;">
                                <p>
                                    <label>Usuario:</label><br />
                                    <?php echo form_error('usu_usuario'); ?>
                                    <?php
                                    $usuario_dato = array('id' => 'usu_usuario',
                                        'name' => 'usu_usuario',
                                        'class' => 'both small',
                                        'value' => set_value('usu_usuario'));
                                    echo form_input($usuario_dato)
                                    ?>
                                </p>
                                <p>
                                    <label>Contraseña:</label><br />
                                    <?php echo form_error('usu_password'); ?>
                                    <?php
                                    $longitud_data = array('id' => 'usu_password',
                                        'name' => 'usu_password',
                                        'class' => 'both small',
                                        'value' => set_value('usu_password'));
                                    echo form_password($longitud_data)
                                    ?>
                                </p>

                            </div>
                            <br clear="all">

                            <div style="float:left; width:72px; margin-left: 69px; ">
                                <p>
                                    <?php
                                    $data_guardar = array('type' => 'button',
                                        'id' => 'guardar',
                                        'name' => 'guardar',
                                        'value' => 'Login',
                                        'class' => 'submit',
                                        'onclick' => 'reiniciar_admin()');
                                    echo form_submit($data_guardar);
                                    ?>
                                </p>

                            </div>


                            <?php echo form_close(); ?>
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
