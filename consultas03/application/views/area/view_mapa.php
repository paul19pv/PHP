<script src="<?php echo base_url() ?>js/jquery.elevatezoom.js"></script>
<h4 id="titulo_mapa" style="text-align: center"><?php echo $titulo; ?></h4>
<img id="zoom_05" src="<?php echo base_url()."images/area/criticas/".$imagen; ?>"  style="width: 540px; float: left; margin-left: 30px;">
<p style="float: left; padding-bottom: 0px; font-size: 10; width: 80px; text-align: center; font-weight: bold; ">Intervención</p>
<div id="leyenda" style="width: 50px; height: 500px; float: left; margin-top: 20px; margin-left: 30px;">
    <img src="<?php echo base_url() ?>images/area/leyenda_criticas.jpg" style="height: 500px" >
</div>
<p style="clear: both;"></p>
<p style=" color: #2c8920;font-weight: bold;">Interpretación</p>
<div id="texto_mapa"><?php echo $texto;?></div>

<script>
    $("#zoom_05").elevateZoom({
        zoomType: "lens", lensShape: "round", lensSize: 200
    });
</script>