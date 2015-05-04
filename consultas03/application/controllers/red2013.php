<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Red2013 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('red2013_model', 'red2013');
    }

    public function view_consulta($variable) {
        $data['estaciones'] = $this->red2013->consultar_estaciones($variable);
        $data['variable']=  $this->nombre_variable($variable);
        $data['variable_']=  $variable;
        $vista = 'red2011/view_consulta';
        $this->load->view($vista, $data);
    }

    public function cargar_periodo() {
        if ($this->input->post('estacion')) {
            $estacion = $this->input->post('estacion');
            $variable = $this->input->post('variable');
            $periodo = $this->red2013->periodo($estacion, $variable);
            foreach ($periodo as $item) {
                //$anios[]=array('anio'=>$item['Anio']);
                $i = $item['Anio'];
                $anios[$i] = $item['Anio'];
            }
            echo json_encode($anios);
        }
    }

    public function consultar_informacion() {
        $valores = $this->input->post();
        $data['variable'] = $this->nombre_variable($valores['variable']);
        $data['titulo'] = $this->formar_titulo($valores);
        $data['informacion'] = $this->red2013->consultar_informacion($valores);
        $data['valores'] = $this->input->post();
        $data['medicion'] = $this->formar_fila($valores);
        $this->load->view('red2011/consultar', $data);
    }

    public function formar_titulo($valores) {
        $data_medicion = $this->red2013->consultar_medicion($valores);
        foreach ($data_medicion as $value) {
            $data_titulo[] = $this->meses_format($value['Mes']);
        }
        return $data_titulo;
    }
    public function formar_titulo_completo($valores) {
        $data_medicion = $this->red2013->consultar_medicion($valores);
        $data_titulo[]="Estacion";
        $data_titulo[]="Año";
        $data_titulo[]="Administrador";
        $data_titulo[]="Unidad Hidrica";
        foreach ($data_medicion as $value) {
            $data_titulo[] = $this->meses_format($value['Mes']);
        }
        return $data_titulo;
    }

    public function formar_fila($valores) {
        $data_medicion = $this->red2013->consultar_medicion($valores);
        foreach ($data_medicion as $value) {
            $data_fila[] = $value['Medida'];
        }
        return $data_fila;
    }
    public function formar_fila_completa($valores) {
        $informacion = $this->red2013->consultar_informacion($valores);
        $data_fila[]=$informacion['Estacion'];
        $data_fila[]=$informacion['Anio'];
        $data_fila[]=$informacion['Administrador'];
        $data_fila[]=$informacion['Unidad'];
        $data_medicion = $this->red2013->consultar_medicion($valores);
        foreach ($data_medicion as $value) {
            $data_fila[] = $value['Medida'];
        }
        return $data_fila;
    }

    public function grafica() {
        $valores = $this->input->post();
        $data_medicion = $this->red2013->consultar_medicion($valores);
        foreach ($data_medicion as $item) {
            $row[] = array("v" => $this->meses_format($item['Mes']));
            $row[] = array("v" => number_format($item['Medida'], 2));
            $row[] = array("v" => number_format($item['Medida'], 2));
            $rows[] = array("c" => $row);
            $row = "";
        }
        $cols[] = array("id" => "Meses", "label" => "Meses", "type" => "string");
        $cols[] = array("id" => "Medida", "label" => $this->nombre_variable($valores['variable']), "type" => "number");
        $cols[] = array("id" => "leyenda", "Label" => "", "type" => "number", "role" => "annotation");
        $data = array('cols' => $cols, 'rows' => $rows);
        echo json_encode($data);
    }

    public function generate_excel() {
        $valores = $this->rename_var($this->input->post());
        $titulo = $this->formar_titulo_completo($valores);
        $medicion = $this->formar_fila_completa($valores);
        $variable = $this->nombre_variable($valores['variable']);
        $this->file_xls($titulo, $medicion, $variable);
    }

    function file_xls($titulo, $medicion, $variable) {
        $this->load->helper('php-excel');
        $data_xls[] = array($variable, 'Meses');
        $data_xls[] = $titulo;
        $data_xls[] = $medicion;
        $xls = new Excel_XML;
        $xls->addArray($data_xls);
        $xls->generateXML($variable);
    }

    //generar los datos para el archivo word
    public function generate_word() {
        $valores = $this->rename_var($this->input->post());
        $titulo = $this->formar_titulo_completo($valores);
        $medicion = $this->formar_fila_completa($valores);
        $variable = $valores['variable'];
        $this->file_word($titulo, $medicion, $variable);
        
    }

    function file_word($titulo, $medicion, $variable) {
        $this->load->library('word');
        //our docx will have 'lanscape' paper orientation
        $section = $this->word->createSection(array('orientation' => 'landscape'));
        // Define table style arrays
        $styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
        $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
        // Define cell style arrays
        $styleCell = array('valign' => 'center');
        // Define font style for first row
        $fontStyle = array('bold' => true, 'align' => 'center');
        // Add table style
        $this->word->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
        // Add table
        $table = $section->addTable('myOwnTableStyle');
        $table->addRow();
        $table->addCell(1500, $styleCell)->addText($this->nombre_variable($variable), $fontStyle);
        $table->addCell(1500, $styleCell)->addText('', $fontStyle);
        $table->addCell(1500, $styleCell)->addText('', $fontStyle);
        $table->addCell(1500, $styleCell)->addText('', $fontStyle);
        $table->addCell(1500, $styleCell)->addText("Meses", $fontStyle);
        $n=  count($titulo)-5;
        for ($i=0;$i<$n;$i++) {
            $table->addCell(1500, $styleCell)->addText('', $fontStyle);
        }
        $table->addRow();
        foreach ($titulo as $value) {
            $table->addCell(1500, $styleCell)->addText($value, $fontStyle);
        }
        $table->addRow();
        foreach ($medicion as $value) {
            $table->addCell(1500, $styleCell)->addText($value, $fontStyle);
        }
        // Save File
        $objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2007');
        $objWriter->save($variable.".docx");
    }

    public function rename_var($valores) {
        $data_valores['estacion'] = $valores['estacion01'];
        $data_valores['periodo'] = $valores['periodo01'];
        $data_valores['variable'] = $valores['variable01'];
        return $data_valores;
    }

    public function meses_format($mes) {
        $cad_div = explode(" ", $mes);
        $nom_mes = trim($cad_div[1]);
        return $nom_mes;
    }

    public function nombre_variable($variable) {
        switch ($variable) {
            case "caudal":
                $nombre = "Caudal (m3/s)";
                break;
            case "humed":
                $nombre = "Humedad Relativa (%)";
                break;
            case "nubosid":
                $nombre = "Nubosidad (Octas)";
                break;
            case "precip":
                $nombre = "Precipitación (mm)";
                break;
            case "temp":
                $nombre = "Temperatura (ºC)";
                break;
            case "vel_vien":
                $nombre = "Velocidad del Viento (m/s)";
                break;
            default:
                break;
        }
        return $nombre;
    }

}
