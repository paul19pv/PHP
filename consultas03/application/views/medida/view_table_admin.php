<p>Usted tiene la opción de modificar la información de las medidas disponibles, seleccionando directamente en la tabla la opción Editar:</p>
<div style="width: 506px; float: left">
    <p class="indicador">Recuerde que al aplicar la opción, se modificará la base de datos.</p>
</div>
<table cellpadding="0" cellspacing="0" style="table-layout: auto; border: 1px solid #ccc;" >
    <thead>
        <tr class="portafolio">
            <th style="width: 80px;">Sector</th>
            <th style="width: 290px;">Nombre de la Medida</th>
            <th style="width: 80px;">Categoría</th>
            <th style="width: 80px;">Área Intervenida</th>
            <th style="width: 80px;">Plazo de Implementación (días)</th>
            <th style="width: 40px;">Editar</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($medida as $item):
            ?>
            <tr class="rows" style="font-size: 11px;">
                <td style="font-size: 11px;">&nbsp;<?php echo $item['ubi_sector'] ?></td>
                <td style="font-size: 11px;"><?php echo $item['med_nombre'] ?></td>
                <td style="font-size: 11px;">&nbsp;<?php echo $item['pri_categoria'] ?></td>
                <td style="font-size: 11px;">&nbsp;<?php echo $item['med_area_int'] ?></td>
                <td style="font-size: 11px;">&nbsp;<?php echo $item['pla_plazo'] ?></td>
                <td class="options">
                    <a href="medida/view_modificar_medida/<?php echo $item['med_id'] ?> "class="menu tip" title="Modificar">
                        <img src="<?php echo base_url() ?>images/bedit.png" />
                    </a>     
                    <!--
                    <a href="medida/detalle/<?php echo $item['med_id'] ?>" class="menu tip" title="Detalle">
                        <img src="<?php echo base_url() ?>images/bsearch.png" />
                    </a>
                    -->
                </td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>

    </tbody>
</table>

<script>
    $(function() {



        $(".menu").click(function(e) {

            e.preventDefault();
            if ($(this).hasClass('inactivo'))
                return false; // Do something else in here if required
            else {
                $(this).addClass('inactivo');
                //$('#block_content').html('<div class="loading"><img src="images/loading.gif" width="50px" height="50px"/></div>');
                $.ajax({
                    type: "GET",
                    url: this.href,
                    success: function(data) {
                        $("#block_content").html(data);
                        $(".menu").removeClass('inactivo');
                    }
                });
            }
        });



    });
</script>