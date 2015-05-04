<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>css/cupertino/jquery-ui.css" rel="stylesheet" />



        <script src="<?php echo base_url() ?>js/jquery.js"></script>
        <script src="<?php echo base_url() ?>js/jquery-ui.js"></script>
        
        <script src="<?php echo base_url() ?>js/functions.js"></script>
        <script src="<?php echo base_url() ?>js/jsapi.js"></script>
        <script src="<?php echo base_url() ?>js/js_cambio.js"></script>
        <script src="<?php echo base_url() ?>js/jquery.select_skin.js"></script>

        
        <!--<script src="<?php echo base_url() ?>js/jquery.elevatezoom.js"></script>-->
        <script type="text/javascript">
            
            //google.setOnLoadCallback(drawChart);


        </script>
    </head>
    <body>
        <div id="hld" style="min-height: 380px;">
            <div id="wrap">
                <div id="content" class="block" style="width: 690px;">
                    <div class="block_head">
                        <div class="bheadl"></div>
                        <div class="bheadr"></div>
                        <h2><?php echo $titulo ?> por Unidad Hídrica</h2>
                    </div>

                    <div id="block_content" class="block_content">
                        <p style="width: 650px;">El reporte que se presenta a continuación presenta el grado de  <?php echo $titulo ?> al que esta expuesto cada Unidad Hídrica objeto de estudio.</p>
                        <p class="indicador">Para la selección de resultados por favor seleccione la Unidad Hídrica de interés y amenaza climática:</p>
                        <hr>
                        <h4 style="text-align: center;"><label>Cambio Climático - <?php echo $titulo; ?></label></h4>
                        <?php
                        $form_data = array('id' => 'insertForm',
                            "onsubmit" => "consultar_datos('$factor'); return false;");
                        echo form_open(base_url() . 'CambioClimatico/grafica/' . $factor, $form_data);
                        ?>

                        <div style="float:left; width: 430px">
                            <p><label>Consulta por Unidad Hídrica</label></p>
                        </div>
                        <div style="float:left; width: 210px">
                            <p><label>Fecha de Consulta: </label><?php echo date("d-m-Y") ?></p>
                        </div>
                        <br clear="all">
                        <div style="float:left; width:253px">
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
                        <div style="float:left; width:253px">
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
                        <div style="float:left; width:134px">
                            <p>
                                <label></label><br />
                                <?php
                                $data_buscar = array('type' => 'submit',
                                    'id' => 'nuevo',
                                    'name' => 'nuevo',
                                    'value' => 'Buscar',
                                    'class' => 'submit filtro');
                                echo form_submit($data_buscar);

                                $data_reset = array('type' => 'button',
                                    'name' => 'reset',
                                    'value' => 'Reiniciar',
                                    'class' => 'submit filtro',
                                    "onclick" => "reiniciar('$factor')");
                                echo form_submit($data_reset);
                                ?>
                            </p>

                        </div>
                        <br clear="all">
                        <?php echo form_close(); ?>
                        <div id="progressbar" style="display: none;"><div class="progress-label"></div></div>

                        <p id="introduccion" class="indicador" style="display: none;">A continuación puede observar e interactuar con los resultados para la Unidad Hídrica seleccionada: </p>
                        <div id="div_encabezado">
                            <div class="unidades" id="sanpedro">
                                <img src="<?php echo base_url() ?>images/unidad/sanpedro.jpg"/>
                                <div>
                                    <h3>San Pedro</h3>
                                    <p>Las poblaciones representativas son Machachi, Aloasí, Aloag, Tambillo, Cutuglahua, Conocoto y Uyumbicho. Las hidrozonas identificadas son herbácea, arbórea, arbustiva y cultivos, las precipitaciones varían entre 800 a 1600 mm y los usos principales de sus fuentes de agua son para consumo humano, riego e industrias.</p>
                                </div>
                            </div>
                            <div class="unidades" id="pita" >
                                <img src="<?php echo base_url() ?>images/unidad/pita.jpg"/>
                                <div>
                                    <h3>Pita</h3>
                                    <p>Las poblaciones representativas son Sangolquí, Selva Alegre, Cotogchoa y Tumipamba. Las hidrozonas identificadas son herbácea, arbustiva y cultivos, las precipitaciones varían entre 1200 a 1600 mm y los usos principales de sus fuentes de agua son para consumo humano, riego, hidroelectricidad e industrias.</p>
                                </div>
                            </div>
                            <div class="unidades" id="papallacta" >
                                <img src="<?php echo base_url() ?>images/unidad/papallacta.jpg"/>
                                <div>
                                    <h3>Papallacta</h3>
                                    <p>La población representativa es la de Papallacta y está caracterizada por sus fuentes de agua termal que han dinamizado el turismo en la zona. Las hidrozonas identificadas son herbáceas, arbustivas y zonas con pequeños cultivos, las precipitaciones varían entre 1000 a 1400 mm y los usos principales de sus fuentes de agua son para consumo humano.</p>
                                </div>
                            </div>
                            <div class="unidades" id="antisana" >
                                <img src="<?php echo base_url() ?>images/unidad/antisana.jpg"/>
                                <div>
                                    <h2>Antisana</h2>
                                    <p>El paisaje glaciar y lacustre predomina en esta microcuenca. Las hidrozonas identificadas son herbácea y arbustiva, las precipitaciones varían entre 800 a 1200 mm y el uso principal de sus fuentes de agua es para consumo humano.</p>
                                </div>
                            </div>

                        </div>
                        <div id="div_titulo">
                            <h4 style="text-align: center"></h4>
                        </div>    
                        <div id="div_amenaza">
                            <h4 style="text-align: center">Diagrama Metodológico</h4>
                            <img id="img_amenaza">
                            <p>Fuente: FONAG, 2014.</p>
                        </div>
                        <div id="div_categoria">
                            <h4 id="titulo_categoria" style="text-align: center"></h4>
                            <div id="chart_div" style=" float: left;"></div>
                        </div>   
                        <div id="mapa">

                        </div>
                        <input id="ruta_base" type="hidden" value="<?php echo base_url() ?>"/>

                    </div>
                    <div class="bendl"></div>
                    <div class="bendr"></div>

                </div>

            </div>

        </div>


    </body>
</html>
