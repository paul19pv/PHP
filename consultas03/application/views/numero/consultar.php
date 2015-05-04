<script src="<?php echo base_url() ?>js/ajax_concesion.js"></script>

<div>
    <?php
    $form_xls = array('id' => 'form_xls');
    echo form_open('concesion/generate_excel', $form_xls);
    ?>
    <input type="hidden" name="provincia01" value="<?php echo $provincia; ?>">
    <input type="hidden" name="canton01" value="<?php echo $canton; ?>">
    <input type="hidden" name="parroquia01" value="<?php echo $parroquia; ?>">
    <input type="image" src="<?php echo base_url() ?>/images/Excel-icon.png" style=""  >
    <input id="link_word" type="image" src="<?php echo base_url() ?>/images/Word-icon.png"  >
    <?php echo form_close(); ?>
    <a id="link_descarga" href="<?php echo base_url() ?>consulta_concesiones.docx"></a>
</div>
<?php
$num_col = count($unidades);
?>


<table cellpadding="0" cellspacing="0" style="width:<?php echo ($num_col+1)*100?>" >
    <thead>
        <tr class="tbtitle">
            <th  style="background-color: white;"></th>

            <th colspan="<?php echo $num_col ?>">Unidades Hidricas</th>
        </tr>

    </thead>
    <tbody>
        <tr class="tbhead">
            <td>Uso</td>
            <?php
            foreach ($unidades as $item) {
                ?>
                <td><?php echo $item; ?></td>
                <?php
            }
            ?>
        </tr>

        <?php
        foreach ($informacion as $item1 => $value) {
            ?>
            <tr>
                <td><?php echo $item1; ?></td>
                <?php
                foreach ($value as $item2) {
                    ?>
                    <td><?php echo $item2; ?></td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>
    </tbody>

</table>

