<script src="<?php echo base_url() ?>js/jquery.elevatezoom.js"></script>
<h4 id="titulo_mapa" style="text-align: center"><?php echo $titulo; ?></h4>
<img id="zoom_05" src="<?php echo base_url()."images/clima/".$imagen.".jpg"; ?>"  style="width: 640px;">
<p></p>
<p style=" color: #2c8920;font-weight: bold;">Interpretación</p>
<div id="texto_mapa"><?php echo $texto;?></div>

<script>
    $("#zoom_05").elevateZoom({
        zoomType: "lens", lensShape: "round", lensSize: 200
    });
</script>