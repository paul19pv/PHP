<script src="<?php echo base_url() ?>js/ajax_concesion.js"></script>

<div>
    <?php
    $form_xls = array('id' => 'form_xls');
    echo form_open('concesion/generate_excel', $form_xls);
    ?>
    <input type="hidden" name="provincia01" value="<?php echo $provincia; ?>">
    <input type="hidden" name="canton01" value="<?php echo $canton; ?>">
    <input type="hidden" name="parroquia01" value="<?php echo $parroquia; ?>">
    <div style="display: none;" >
        <?php
        //print_r($unidades);
        foreach ($unidades as $key=>$value) {
            if ($value) {
                ?>
                <input type="checkbox" class="checkbox" name="unidades01[]" checked="" value="<?php echo $key ?>">
                <?php
            } else {
                ?>
                <input type="checkbox" class="checkbox" name="unidades01[]"  value="<?php echo $key ?>">
                <?php
            }
        }
        ?>
    </div>
    <input type="image" src="<?php echo base_url() ?>/images/Excel-icon.png" style=""  >
    <input id="link_word" type="image" src="<?php echo base_url() ?>/images/Word-icon.png"  >
    <?php echo form_close(); ?>
    <a id="link_descarga" href="<?php echo base_url() ?>consulta_concesiones.docx"></a>
</div>



<table cellpadding="0" cellspacing="0">
    <thead>
        <tr class="tbtitle">
            <th style="background-color: white;"></th>
            <th colspan="10" style="text-align: center; font-size: 12px;">Usos</th>
        </tr>

    </thead>
    <tbody>
        <tr class="tbhead">
            <td>Unidad Hídrica
                <image id="unidades" src="<?php echo base_url() ?>/images/sdd_.jpg" width="12" height="12">
                <div id="list_unidades" class="block_content list_unidades" >

                    <?php
                    $form_data = array('id' => 'searchForm',
                        "onsubmit" => "filtrar_caudal(); return false;");
                    echo form_open('concesion/grafica_caudal', $form_data);
                    ?>
                    <input type="hidden" name="provincia_" id="provincia_" value="<?php echo $provincia; ?>">
                    <input type="hidden" name="canton_" id="canton_" value="<?php echo $canton; ?>">
                    <input type="hidden" name="parroquia_" id="parroquia_" value="<?php echo $parroquia; ?>">
                    <p>
                        <label>Unidades Hidricas</label><br>
                    </p>
                    <ul>
                        <?php
                        //print_r($unidades);
                        foreach ($unidades as $key=>$value) {
                            if ($value) {
                                ?>
                                <li>
                                    <input id="uni_hid" type="checkbox" class="checkbox" name="unidades[]" checked="" value="<?php echo $key; ?>">
                                    <?php echo $key; ?><br>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li>
                                    <input id="uni_hid" type="checkbox" class="checkbox" name="unidades[]"  value="<?php echo $key ?>">
                                    <?php echo $key; ?><br>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>

                    <br clear="all">

                    <?php
                    $data_buscar = array('type' => 'submit',
                        'id' => 'filtrar',
                        'name' => 'filtrar',
                        'value' => 'Filtrar',
                        'class' => 'submit');
                    echo form_submit($data_buscar);

                    $data_reset = array('type' => 'button',
                        'name' => 'Cancelar',
                        'value' => 'Cancelar',
                        'class' => 'submit',
                        "onclick" => "cancelar()");
                    echo form_submit($data_reset);
                    ?>

                </div>
            </td>
            <?php
            foreach ($usos as $item) {
                ?>
                <td><?php echo $item; ?></td>
                <?php
            }
            ?>
        </tr>

        <?php
        foreach ($informacion as $item1=>$value) {
            ?>
            <tr>
                <td><?php echo $item1;?></td>
                <?php
                foreach ($value as $item2) {
                    ?>
                <td><?php echo number_format($item2, 2); ?></td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>
    </tbody>

</table>

