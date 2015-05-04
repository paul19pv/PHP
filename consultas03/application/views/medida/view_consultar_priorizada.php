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
                        <h2>Medidas Priorizadas por Unidad Hídrica</h2>
                    </div>


                    <div id="block_content" class="block_content">
                        <p style="width: 650px;">La medida que se presenta a continuación es la más viable y adecuada que se puede implementar frente a la amenaza climática (movimientos en masa, inundaciones y sequías), con el fin de afrontar los posibles impactos al cambio climático.</p>
                        <p class="indicador">Para la selección de resultados por favor seleccione la Unidad Hídrica de interés y amenaza climática:</p>
                        <hr>
                        <h4 style="text-align: center;"><label>Medidas de Adaptación Priorizadas</label></h4>

                        <?php
                        $form_data = array('id' => 'searchMedida', "onsubmit" => "return false;");
                        echo form_open('medida/consultar_medida_priorizada/', $form_data);
                        ?>
                        <div style="float:left; width: 430px">
                            <p><label>Consulta por Unidad Hídrica</label></p>
                        </div>
                        <div style="float:left; width: 210px">
                            <p><label>Fecha de Consulta: </label><?php echo date("d-m-Y") ?></p>
                        </div>
                        <br clear="all">
                        <div style="float:left; width:248px">
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
                                    'value' => 'Reiniciar',
                                    'class' => 'submit',
                                    "onclick" => "reiniciar_portafolio()");
                                echo form_submit($data_reset);
                                ?>
                            </p>

                        </div>
                        <br clear="all">
                        
                        <?php echo form_close(); ?>
                        <br clear="all">
                        <div id="div_medida"></div>
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

        });
    </script>
</html>
