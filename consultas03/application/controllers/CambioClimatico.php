<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class CambioClimatico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clima_model', 'clima');
        $this->load->model('red2011_model', 'red2011');
    }

    public function view_consulta($factor) {
        $data['unidades'] = $this->unidades();
        $data['amenazas'] = $this->amenazas();
        $data['titulo'] = $this->titulo_consulta($factor);
        $data['factor'] = $factor;
        $vista = 'climatico/view_consulta';
        $this->load->view($vista, $data);
    }

    public function consultar01() {
        $valores = $this->input->post();
        $data = $this->clima->consultar($valores);
        echo json_encode($data);
    }

    public function consultar() {
        $valores = $this->input->post();
        $data_medicion = $this->clima->consultar($valores);
        $data['titulo'] = $this->amenaza($data_medicion['tipo_id'], $data_medicion['ame_id']);
        $data['imagen'] = $data_medicion['med_imagen'];
        $data['texto'] = $data_medicion['med_texto'];
        $this->load->view('climatico/view_mapa', $data);
    }

    public function view_amenaza() {
        $valores = $this->input->post();
        $data['imagen'] = $this->imagen_amenaza($valores['factor'], $valores['amenaza']);
        $this->load->view('climatico/view_amenaza', $data);
    }

    public function grafica($factor) {
        $valores = $this->input->post();
        $data_medicion = $this->convertir_medidas($valores);
        foreach ($data_medicion as $item) {
            $row[] = array('v' => $item['clase']);
            $row[] = array('v' => $item['valor']);
            $rows[] = array('c' => $row);
            $row = "";
        }
        $cols[] = array('id' => 'clases', 'label' => 'Clases', 'type' => 'string');
        $cols[] = array('id' => 'medida', 'label' => $this->titulo_consulta($valores['factor']), 'type' => 'number');
        $data = array('cols' => $cols, 'rows' => $rows);
        echo json_encode($data);
    }

    public function convertir_medidas($valores) {
        $data = $this->clima->consultar_medidas($valores);
        $data_med[] = array("clase" => "Ligera", "valor" => $data['med_ligera']);
        $data_med[] = array("clase" => "Suave", "valor" => $data['med_suave']);
        $data_med[] = array("clase" => "Moderada", "valor" => $data['med_moderada']);
        $data_med[] = array("clase" => "Alta", "valor" => $data['med_alta']);
        $data_med[] = array("clase" => "Muy Alta", "valor" => $data['med_muyalta']);
        return $data_med;
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

    public function titulo_consulta($factor) {
        $titulo = "";
        switch ($factor) {
            case "1":
                $titulo = "Exposición";
                break;
            case "2":
                $titulo = "Sensibilidad";
                break;
            case "3":
                $titulo = "Capacidad de Adaptación";
                break;
            default:
                $titulo = "Sin Factor";
                break;
        }
        return $titulo;
    }

    public function amenaza($factor, $amenaza) {
        $titulo = "";
        switch ($factor) {
            case "1":
                $titulo = "Mapa de Exposición a ";
                break;
            case "2":
                $titulo = "Mapa de Sensibilidad a ";
                break;
            case "3":
                $titulo = "Mapa de Capacidad de Adaptación frente a ";
                break;
            default:
                $titulo = "Sin Factor";
                break;
        }
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

    public function imagen_amenaza($factor, $amenaza) {
        $imagen = "";
        switch ($factor) {
            case "1":
                $imagen = "exposicion/";
                break;
            case "2":
                $imagen = "sensibilidad/";
                break;
            case "3":
                $imagen = "capacidad/";
                break;
            default:
                $imagen = "Sin Factor";
                break;
        }
        switch ($amenaza) {
            case "1":
                $imagen.="movimiento.png";
                break;
            case "2":
                $imagen.="inundacion.png";
                break;
            case "3":
                $imagen.="sequia.png";
                break;
            default:
                $imagen.="Sin Factor";
                break;
        }
        return $imagen;
    }

}
