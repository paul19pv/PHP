<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" />
        <script src="<?php echo base_url() ?>js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url() ?>js/jquery-ui-1.10.3.custom.js"></script>

        <script src="<?php echo base_url() ?>js/js_concesion.js"></script>
        <script src="<?php echo base_url() ?>js/functions.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.select_skin.js"></script>
        
        <script src="<?php echo base_url() ?>js/jsapi.js"></script>
        <script type="text/javascript">
            google.load("visualization", "1", {packages: ["corechart"]});
            //google.load("visualization", "1", {packages:["corechart"]});
            //google.setOnLoadCallback(drawChart);
            //google.setOnLoadCallback(drawChart);


        </script>
    </head>
    <body>
        <div id="hld" style="min-height: 520px;">
            <div id="wrap">
                <div id="content" class="block">
                    <div class="block_head">
                        <div class="bheadl"></div>
                        <div class="bheadr"></div>
                        <h2>Por Numero de Concesiones</h2>
                    </div>

                    <div id="block_content" class="block_content">
                        <p style="width: 650px;">El reporte que se presenta a continuación muestra las concesiones registradas en el área de estudio, organizadas por provincia, cantón y parroquia.</p>
                        <div style="float:left; width: 350px">
                            <p><label>Variable Consultada: </label>Caudal(l/s)</p>
                        </div>
                        <div style="float:left; width: 400px">
                            <p><label>Fecha de Consulta: </label><?php echo date("d-m-Y")?></p>
                        </div>
                        <br clear="all">
                        <?php
                        $form_data = array('id' => 'insertForm',
                            "onsubmit" => "informacion_numero(); return false;");
                        echo form_open('concesion/informacion_numero', $form_data);
                        ?>
                        <div style="float:left; width:225px">
                            <p>
                                <label>Provincia:</label><br />
                                <?php echo form_error('concesion_provincia'); ?>
                                <select name="provincia" id="provincia" onchange="cargar_canton();" class="styled">
                                    <option value="null">Todas</option>
                                    <?php
                                    foreach ($provincias as $fila) {
                                        ?>
                                        <option value="<?php echo $fila['PROV_COD'] ?>" ><?php echo $fila['PROV_NOM']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </p>
                        </div>
                        <div style="float:left; width:225px;">
                            <p>
                                <label>Canton:</label><br />
                                <?php echo form_error('usuario_nombres'); ?>
                                <select id="canton" name="canton" onchange="cargar_parroquia()" class="styled">
                                    <option value="null">Todos</option>
                                </select>
                            </p>

                        </div>
                        
                        <div style="float:left; width:225px;">
                            <p id="parr">
                                <label>Parroquia:</label><br />
                                <?php echo form_error('usuario_nombres'); ?>
                                <select id="parroquia" name="parroquia" class="styled">
                                    <option value="null">Todas</option>
                                </select>
                            </p>
                        </div>
                        
                        <p>
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
                                "onclick" => "reiniciar('hidrologica')");
                            echo form_submit($data_reset);
                            ?>
                        </p>
                        <?php echo form_close(); ?>
                        <div id="table_div"></div>
                    </div>
                    <div class="bendl"></div>
                    <div class="bendr"></div>

                </div>

            </div>

        </div>
        <div id="chart_div" style="width: 1000px; height: 500px;"></div>

    </body>
</html>


