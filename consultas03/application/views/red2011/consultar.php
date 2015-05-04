<script src="<?php echo base_url() ?>js/ajax_red2011.js"></script>
<div>
    <?php
    $form_xls = array('id' => 'form_xls');
    echo form_open('red2011/generate_excel', $form_xls);
    ?>
    <input type="hidden" name="estacion01" value="<?php echo $valores['estacion']; ?>">
    <input type="hidden" name="periodo01" value="<?php echo $valores['periodo']; ?>">
    <input type="hidden" name="variable01" value="<?php echo $valores['variable']; ?>">
    <input type="image" src="<?php echo base_url() ?>/images/Excel-icon.png" style=""  >
    <input id="link_word" type="image" src="<?php echo base_url() ?>/images/Word-icon.png"  >
    <?php echo form_close(); ?>
    <a id="link_descarga" href="<?php echo base_url().$valores['variable'].".docx"; ?>"></a>
</div>
<?php
    $num_col=  count($medicion);
?>
<table cellpadding="0" cellspacing="0" style="table-layout: auto; width: <?php echo $num_col*60+320;?>"  >
    <thead>
        <tr class="tbtitle">
            <th colspan="4" style="background-color: #ffffff; color: #333; width: 320px;"><?php echo $variable;?></th>
            <th colspan="<?php echo count($titulo); ?>" > Meses</th>
        </tr>

    </thead>
    <tbody>
        <tr class="tbhead">
            <td style="width: 30px" >Estación</td>
            <td style="width: 30px" >Año</td>
            <td style="width: 130px" >Administrador</td>
            <td style="width: 130px">Unidad Hídrica</td>
            <?php
            foreach ($titulo as $key => $value) {
                ?>
            <td style="width: 60px"><?php echo $value ?></td>
                    <?php
            }
            ?>
        </tr>
        <tr>
            <td><?php echo $informacion['Estacion']?></td>
            <td><?php echo $informacion['Anio']?></td>
            <td><?php echo $informacion['Administrador']?></td>
            <td><?php echo $informacion['Unidad']?></td>
            <?php
            foreach ($medicion as $key=>$value) {
                
                ?>
            <td><?php echo number_format($value,2); ?></td>
                <?php
            }
            ?>
        </tr>
    </tbody>
</table>
