<div id="div_encabezado" style="margin-bottom: 10px; height: 115">
    <img style="width: 160px; height: 105px; float: left" src="<?php echo base_url() . "images/medida/fotos/" . $medida['ubi_foto'] ?>"/>
    <div class="div_priorizada" id="sanpedro" style="display: block;">
        <div>

            <p><?php echo $medida['med_nombre'] ?></p>
            <p class="indicador">(Descripción y ubicación de la medida)</p>
        </div>
    </div>
</div>
<?php
$form_data = array('id' => 'searchMedida', "onsubmit" => "return false;");
echo form_open('medida/consultar_medida_priorizada/', $form_data);
?>
<div style="float:left; width:160px; margin: 0px 82.5px;">
    <p class="indicador" style="text-align: center;padding-bottom: 0px;">Información Medida</p>
    <p style="text-align: center">
        <?php
        $data_ficha = array('type' => 'button',
            'id' => 'btn_ficha',
            'name' => 'buscar',
            'value' => 'Ver',
            'class' => 'submit');
        echo form_submit($data_ficha);
        ?>
    </p>
</div>
<div style="float:left; width:160px; margin: 0px 82.5px;">
    <p class="indicador" style="text-align: center;padding-bottom: 0px;">Criterios de Priorización</p>
    <p style="text-align: center">
        <?php
        $data_matriz = array('type' => 'button',
            'id'=>'btn_matriz',
            'name' => 'btn_matriz',
            'value' => 'Ver Matriz',
            'class' => 'submit');
        echo form_submit($data_matriz);
        ?>
    </p>

</div>
<br clear="all">

<?php echo form_close(); ?>

<table class="tbl_por" cellpadding="0" cellspacing="0" style="table-layout: auto; border: 1px solid #a1a1a1"   >
    <thead>
        <tr class="portafolio">
            <th style="width: 170px;">Medios de Vida</th>
            <th style="width: 70px;">&nbsp;</th>
            <th style="width: 170px;">Indicadores de Resultados</th>
            <th style="width: 70px;" >Unidad Medida</th>
            <th style="width: 170px;" >Impactos Esperados</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //$i = 0;
        for ($i = 0; $i <= 4; $i++) {
            ?>
            <tr class="rows" style="font-size: 11px;">
                <td style="font-size: 11px;">&nbsp;</td>
                <td style="font-size: 11px;">&nbsp;</td>
                <td style="font-size: 11px;">&nbsp;</td>
                <td style="font-size: 11px;">&nbsp;</td>
                <td style="font-size: 11px;">&nbsp;</td>
            </tr>
            <?php
        }
        ?>

    </tbody>
</table>
<br clear="all">
<p class="indicador" style="color: #000000;">Beneficiarios</p>
<div class="div_priorizada" style="margin-left: 0px; width: 630px;">
    <p class="indicador">Directos</p>
    <br>
    <br>
    <br>
    <p class="indicador">Indirectos</p>
    <br>
    <br>
</div>


<div id="div_ficha" title="Información de la medida">
    <div style="float: left;width: 200px;">
        <p class="indicador" style="color: #000000;">Foto:</p>
        <img style="width: 160px; height: 105px; float: left" src="<?php echo base_url() . "images/medida/fotos/" . $medida['ubi_foto'] ?>"/>
    </div>
    <div style="float: left;width: 200px;">
        <p class="indicador" style="color: #000000;">Croquis:</p>
        <img style="width: 160px; height: 105px; float: left" src="<?php echo base_url() . "images/medida/croquis/" . $medida['ubi_croquis'] ?>"/>
    </div>
    <div style="float: left;width: 200px; margin-top: 20px;">
        <?php
        $form_ficha = array('id' => 'searchMedida', "onsubmit" => "return false;");
        echo form_open('medida/consultar_medida_priorizada/', $form_ficha);
        ?>
        <p class="indicador" style="color: #000000;">Implementación:</p>
        <p class="indicador" style="color: #000000;">&nbsp;&nbsp;Plazo:&nbsp;&nbsp;
            <?php
            $plazo_data = array('id' => 'ubi_sector',
                'name' => 'ubi_sector',
                'class' => 'both small',
                'readonly' => 'readonly',
                'style' => 'width:140px;');
            echo form_input($plazo_data)
            ?>
        </p>
        <p class="indicador" style="color: #000000;">&nbsp;&nbsp;Estado:
            <?php
            $estado_data = array('id' => 'ubi_sector',
                'name' => 'ubi_sector',
                'class' => 'both small',
                'readonly' => 'readonly',
                'style' => 'width:140px;');
            echo form_input($estado_data)
            ?>
        </p>
        <?php echo form_close(); ?>
    </div>
    <br>
    <p></p>
    <div class="div_priorizada" style="margin-left: 0px; margin-top: 10px;width: 630px;">
        <p class="indicador" style="color: #000000;">Nombre de la medida:</p>
        <p><?php echo $medida['med_nombre'] ?></p>
        <p class="indicador" style="color: #000000;">Alcance:</p>
        <p class="indicador" style="font-weight: normal;">(Lo que incluye)</p>
        <br>
        <p class="indicador" style="color: #000000;">Restricciones:</p>
        <p class="indicador" style="font-weight: normal;">(Lo que no incluye)</p>
        <br>
        <p class="indicador" style="color: #000000;">Riesgos:</p>
        <p class="indicador" style="font-weight: normal;">(Situaciones o factores externos que contribuyen al cumplimiento)</p>
        <br>

    </div>
</div>

<br clear="all">
<div id="div_matriz" title="Criterios de priorización" >
    

    <table class="tbl_por" cellpadding="0" cellspacing="0" style="table-layout: auto; border: 1px solid #a1a1a1"   >
        <thead>
            <tr class="portafolio" style="color: #3b9f30;">
                <th style="width: 170px;font-size: 11px;">C1: Importancia para conservación de fuentes de agua</th>
                <th style="width: 170px;font-size: 11px;">C2: Importancia por los  beneificios directos a población</th>
                <th style="width: 170px;font-size: 11px;">C3: Importantancia por los  beneficios indirectos a la población</th>
                <th style="width: 170px;font-size: 11px;">C4: Importancia para enfrentar los efectos del cambio climático</th>
                <th style="width: 170px;font-size: 11px;">C5: Importancia para los tomadores de decisiones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="rows" style="font-size: 11px;">
                <td style="font-size: 11px; text-align: center"><?php echo $prioridad['pri_c1'] ?></td>
                <td style="font-size: 11px; text-align: center"><?php echo $prioridad['pri_c2'] ?></td>
                <td style="font-size: 11px; text-align: center"><?php echo $prioridad['pri_c3'] ?></td>
                <td style="font-size: 11px; text-align: center"><?php echo $prioridad['pri_c4'] ?></td>
                <td style="font-size: 11px; text-align: center"><?php echo $prioridad['pri_c5'] ?></td>
            </tr>
        </tbody>
    </table>
    
    
    <div style="float: left;width: 650px; margin-top: 20px;">
        <div style="float:left; width:160px; margin: 0px 82.5px;">
            <p class="indicador" style="color: #000000;">Puntaje:<?php echo $prioridad['pri_puntaje'] ?> </p>
        </div>
        <div style="float:left; width:160px; margin: 0px 82.5px;">
            <p class="indicador" style="color: #000000;w">Categoria:<?php echo $prioridad['pri_puntaje'] ?></p>
        </div>
        
                
        
        
    </div>
</div>

<script>
    $("#div_ficha").dialog({
        autoOpen: false,
        width: 670,
        modal: true,
        buttons: {
            "Aceptar": function() {
                //insertar_gestion("#form_responsable","#btn_responsable","#p_responsable");
                $(this).dialog("close");
            },
            "Cancelar": function() {
                $(this).dialog("close");
            }
        },
        close: function() {
            $(this).dialog("close");
        }
    });

    $("#btn_ficha").click(function() {
        $("#div_ficha").dialog("open");
    });
    $("#div_matriz").dialog({
        autoOpen: false,
        width: 690,
        modal: true,
        buttons: {
            
            "Cancelar": function() {
                $(this).dialog("close");
            }
        },
        close: function() {
            $(this).dialog("close");
        }
    });

    $("#btn_matriz").click(function() {
        $("#div_matriz").dialog("open");
    });
</script>