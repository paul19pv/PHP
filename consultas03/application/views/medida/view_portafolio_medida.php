<table cellpadding="0" cellspacing="0" style="table-layout: auto;"  >
    <thead>
        <tr class="tbtitle">
            <th style="width: 290px;">Nombre de la Medida</th>
            <th style="width: 120px;">Medios de Vida</th>
            <th style="width: 120px;">Plazo de Implementación</th>
            <th style="width: 120px;" >Ejecutores</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($medida as $item):
            ?>
            <tr class="rows" style="font-size: 11px;">
                <td style="font-size: 11px;"><?php echo $item['med_nombre'] ?></td>
                <td style="font-size: 11px;">&nbsp;</td>
                <td style="font-size: 11px;">&nbsp;<?php echo $item['pla_plazo'] ?></td>
                <td style="font-size: 11px;">&nbsp; </td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>

    </tbody>
</table>