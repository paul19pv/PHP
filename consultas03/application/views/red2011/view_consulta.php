<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" />
        <script src="<?php echo base_url() ?>js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url() ?>js/jquery-ui-1.10.3.custom.js"></script>
        <script src="<?php echo base_url() ?>js/functions.js"></script>
        <script src="<?php echo base_url() ?>js/js_red.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.select_skin.js"></script>
        
        <script src="<?php echo base_url() ?>js/jsapi.js"></script>
        <script type="text/javascript">
            google.load("visualization", "1", {packages: ["corechart"]});
            //google.setOnLoadCallback(drawChart);


        </script>
    </head>
    <body>
        <div id="hld" style="min-height: 380px;">
            <div id="wrap">
                <div id="content" class="block">
                    <div class="block_head">
                        <div class="bheadl"></div>
                        <div class="bheadr"></div>
                        <h2>Medicion <?php echo $variable?></h2>
                    </div>

                    <div id="block_content" class="block_content">
                        <p style="width: 650px;">El reporte que se presenta a continuación muestra las mediciones de <?php echo $variable ?> registradas por las estaciones ubicadas en la zona de estudio. Para la presentación de datos seleccione la estación y año de interés.</p>

                        <p>Más información sobre la funcionalidad y operación de la herramienta de reportes aquí --->
                            <a href="javascript:void(0);" onclick="javascript: window.open('http://www.infoagua-guayllabamba.ec/sirhcg/index2.php?option=com_content&amp;view=article&amp;id=58&amp;Itemid=22', 'titulo', 'top=30,left=30,toolbar=no,location=no,status=no, menubar=no, scrollbars=yes, resizable=yes,width=800,height=600');"> Ayuda.</a>
                        </p>
                        <?php
                        $form_data = array('id' => 'insertForm',
                            "onsubmit" => "consultar_datos('$variable_'); return false;");
                        echo form_open(base_url().'red2011/grafica/'.$variable_, $form_data);
                        ?>
                        <div style="float:left; width: 400px">
                            <p><label>Variable Consultada: </label><?php echo $variable;?></p>
                        </div>
                        <div style="float:left; width: 350px">
                            <p><label>Fecha de Consulta: </label><?php echo date("d-m-Y") ?></p>
                        </div>
                        <br clear="all">
                        <div style="float:left; width:200px">
                            <p>
                                <label>Estacion:</label><br />
                                <select name="estacion" id="estacion" onchange="cargar_periodo('<?php echo $variable_;?>');" class="styled" style="width: 100px;">
                                    <option value="null">Seleccione</option>
                                    <?php
                                    foreach ($estaciones as $fila) {
                                        ?>
                                        <option value="<?php echo $fila['Estacion'] ?>" ><?php echo $fila['Estacion']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </p>
                        </div>
                        <div style="float:left; width:200px">
                            <p>
                                <label>Año:</label><br />
                                <select id="periodo" name="periodo" class="styled" style="width: 100px;">
                                    <option value="">Seleccione</option>
                                </select>
                            </p>
                        </div>
                        <div style="float:left; width:200px">
                            <p>
                                <label></label><br />
                                <?php
                                $data_buscar = array('type' => 'submit',
                                    'id' => 'nuevo',
                                    'name' => 'nuevo',
                                    'value' => 'Buscar',
                                    'class' => 'submit');
                                echo form_submit($data_buscar);

                                $data_reset = array('type' => 'button',
                                    'name' => 'reset',
                                    'value' => 'Reiniciar',
                                    'class' => 'submit',
                                    "onclick" => "reiniciar('$variable_')");
                                echo form_submit($data_reset);
                                ?>
                            </p>

                        </div>
                        <br clear="all">

                        <hr>
                        <?php echo form_close(); ?>
                        <div id="table_div"></div>
                    </div>
                    <div class="bendl"></div>
                    <div class="bendr"></div>

                </div>

            </div>

        </div>
        <div id="chart_div" style="width: 700px; height: 400px;"></div>
        <div id="prueba"></div>
    </body>
</html>
