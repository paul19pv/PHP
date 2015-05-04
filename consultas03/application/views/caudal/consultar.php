<script src="<?php echo base_url() ?>js/ajax_concesion.js"></script>

<div>
    <?php
    $form_xls = array('id' => 'form_xls');
    echo form_open('concesion/file_xls', $form_xls);
    ?>
    <input type="hidden" name="provincia01" value="<?php echo $provincia; ?>">
    <input type="hidden" name="canton01" value="<?php echo $canton; ?>">
    <input type="hidden" name="parroquia01" value="<?php echo $parroquia; ?>">
    <div style="display: none;" >
        <?php
        //print_r($unidades);
        foreach ($unidades as $item) {
            if ($item['CHECKED']) {
                ?>
                <input type="checkbox" class="checkbox" name="unidades01[]" checked="" value="<?php echo $item['UNI_HID'] ?>">
                <?php
            } else {
                ?>
                <input type="checkbox" class="checkbox" name="unidades01[]"  value="<?php echo $item['UNI_HID'] ?>">
                <?php
            }
        }
        ?>
    </div>
    <input type="image" src="<?php echo base_url() ?>/images/Excel-icon.png" style=""  >
    <input id="link_word" type="image" src="<?php echo base_url() ?>/images/Word-icon.png"  >
    <?php echo form_close(); ?>
    <a id="link_descarga" href="<?php echo base_url() ?>caudal_concesionado.docx"></a>

</div>



<table cellpadding="0" cellspacing="0" width="100%" >
    <thead>
        <tr class="tbtitle">
            <th>Caudal</th>
            <th colspan="10"> Uso</th>
        </tr>

    </thead>
    <tbody>
        <tr class="tbhead">
            <td>Unidad Hidrica
                <image id="unidades" src="<?php echo base_url() ?>/images/sdd_.jpg" width="12" height="12">
                <!--<div id="list_unidades" class="list_unidades">-->
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
                        foreach ($unidades as $item) {
                            if ($item['CHECKED']) {
                                ?>
                                <li>
                                    <input type="checkbox" class="checkbox" name="unidades[]" checked="" value="<?php echo $item['UNI_HID'] ?>">
                                    <?php echo $item['UNI_HID'] ?><br>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li>
                                    <input type="checkbox" class="checkbox" name="unidades[]"  value="<?php echo $item['UNI_HID'] ?>">
                                    <?php echo $item['UNI_HID'] ?><br>
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

            <td>Abrevadero</td>
            <td>Doméstico</td>
            <td>Fuerza Mécanica</td>
            <td>Hidroelectricidad</td>
            <td>Industrias</td>
            <td>Agua de Mesa</td>
            <td>Potable</td>
            <td>Riego</td>
            <td>Psicultura</td>
            <td>Termal</td>
        </tr>

        <?php
        foreach ($informacion as $item) {
            ?>
            <tr>
                <td><?php echo $item['UNI_HID']; ?></td>
                <td><?php echo number_format($item['A'], 2); ?></td>
                <td><?php echo number_format($item['D'], 2); ?></td>
                <td><?php echo number_format($item['F'], 2); ?></td>
                <td><?php echo number_format($item['H'], 2); ?></td>
                <td><?php echo number_format($item['I'], 2); ?></td>
                <td><?php echo number_format($item['M'], 2); ?></td>
                <td><?php echo number_format($item['P'], 2); ?></td>
                <td><?php echo number_format($item['R'], 2); ?></td>
                <td><?php echo number_format($item['S'], 2); ?></td>
                <td><?php echo number_format($item['T'], 2); ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>

</table>
