<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AreasCriticas extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('area_model', 'area');
    }
    
    public function view_consulta() {
        $data['unidades'] = $this->unidades();
        $data['amenazas'] = $this->amenazas();
        $vista = 'area/view_consulta';
        $this->load->view($vista, $data);
    }
    
    public function consultar() {
        $valores = $this->input->post();
        $data_medicion = $this->area->consultar($valores);
        $data['titulo'] = $this->amenaza($data_medicion['ame_id']);
        $data['imagen'] = $data_medicion['med_imagen'];
        $data['texto'] = $data_medicion['med_texto'];
        $this->load->view('area/view_mapa', $data);
    }
    
    public function grafica() {
        $valores = $this->input->post();
        $data_medicion = $this->convertir_medidas($valores);
        foreach ($data_medicion as $item) {
            $row[] = array('v' => $item['clase']);
            $row[] = array('v' => $item['valor']);
            $row[] = array('v' => $item['color']);
            $row[] = array('v' => $item['annot']);
            $rows[] = array('c' => $row);
            $row = "";
        }
        $cols[] = array('id' => 'clases', 'label' => 'Clases', 'type' => 'string');
        $cols[] = array('id' => 'medida', 'label' => '% Área', 'type' => 'number');
        $cols[] = array("id" => "estilo", "Label" => "", "type" => "string", "role" => "style");
        $cols[] = array("id" => "leyenda", "Label" => "", "type" => "string", "role" => "annotation");
        $data = array('cols' => $cols, 'rows' => $rows);
        echo json_encode($data);
    }
    
    
    public function convertir_medidas($valores) {
        $data = $this->area->consultar_medidas($valores);
        $data_med[] = array("clase" => "6-12 Meses", "valor" => $data['med_pronta'],"color"=>"#ffff54","annot"=>"Pronta");
        $data_med[] = array("clase" => "1-6 Meses", "valor" => $data['med_inmediata'],"color"=>"#ff7f7e","annot"=>"Inmediata");
        return $data_med;
    }
    
    public function amenaza($amenaza) {
        $titulo = "Mapa de Áreas Críticas frente a ";
        switch ($amenaza) {
            case "1":
                $titulo.="Movimientos de Masa";
                break;
            case "2":
                $titulo.="Inundaciones";
                break;
            case "3":
                $titulo.="Sequías";
                break;
            default:
                $titulo.="Sin Factor";
                break;
        }
        return $titulo;
    }
    public function unidades() {
        $unidad[] = array("id" => "1", "nombre" => "San Pedro");
        $unidad[] = array("id" => "2", "nombre" => "Pita");
        $unidad[] = array("id" => "3", "nombre" => "Papallacta");
        $unidad[] = array("id" => "4", "nombre" => "Antisana");
        return $unidad;
    }

    public function amenazas() {
        $amenaza[] = array("id" => "1", "nombre" => "Mov. en Masa");
        $amenaza[] = array("id" => "2", "nombre" => "Inundaciones");
        $amenaza[] = array("id" => "3", "nombre" => "Sequías");
        return $amenaza;
    }
}