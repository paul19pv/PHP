<table class="tbl_por" cellpadding="0" cellspacing="0" style="table-layout: auto; border: 1px solid #a1a1a1"   >
    <thead>
        <tr class="portafolio">
            <th style="width: 290px;">Nombre de la Medida</th>
            <th style="width: 120px;">Medios de Vida</th>
            <th style="width: 120px;">Plazo de Implementación (días)</th>
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
<br clear="all">
<div style="float: left; width: 240px; margin: 0px 42.5px">
    <p class="indicador" style="padding-bottom: 5px; text-align: center;">Plazo de Implementación</p>
</div>
<div style="float: left; width: 240px; margin: 0px 42.5px">
    <p class="indicador" style="padding-bottom: 5px; text-align: center;">Ejecutores</p>
</div>
<br clear="all">
<div class="div_portafolio" style="">
    <p style="color: #776ace; padding-bottom: 5px;">Corto Plazo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6 meses-1 año</p>
    <p style="color: #e1742a; padding-bottom: 5px;">Mediano Plazo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 a 5 años</p>
    <p style="color: #a87e7e; padding-bottom: 5px;">Largo Plazo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5 a 10 años</p>
</div>

<div class="div_portafolio" style="">
    <p style="padding-bottom: 5px;">FONAG-Organización(es)</p>
</div>