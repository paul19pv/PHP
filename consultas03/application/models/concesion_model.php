<?php

Class Concesion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function provincias() {
        $this->db->select('PROV_COD,PROV_NOM');
        $this->db->group_by('PROV_COD,PROV_NOM');
        $query = $this->db->get('INV_PART_2012_');
        return $query->result_array();
    }

    function cantones($codigo_provincia) {
        $this->db->select('CANT_COD,CANT_NOM');
        $this->db->where('PROV_COD', $codigo_provincia);
        $this->db->group_by('CANT_COD,CANT_NOM');
        $query = $this->db->get('INV_PART_2012_');
        return $query->result_array();
    }

    function parroquias($codigo_canton, $provincia_canton) {
        $this->db->select('PARR_COD,PARR_NOM');
        $this->db->where('CANT_COD', $codigo_canton);
        $this->db->where('PROV_COD', $provincia_canton);
        $this->db->group_by('PARR_COD,PARR_NOM');
        $query = $this->db->get('INV_PART_2012_');
        return $query->result_array();
    }

    function unidades_hidricas() {
        $this->db->select('NOMBRE');
        $this->db->order_by('ID');
        $query = $this->db->get('INV_UNI_HID');
        return $query->result_array();
    }

    function consultar_caudal($provincia, $canton, $parroquia) {
        $this->db->select('NOMBRE,USO,SUM(CAUDAL_MED) AS CAUDAL');
        if ($provincia != "null") {
            $this->db->where('PROV_COD', $provincia);
        }
        if ($canton != "null") {
            $this->db->where('CANT_COD', $canton);
        }
        if ($parroquia != "null") {
            $this->db->where('PARR_COD', $parroquia);
        }
        $this->db->join('INV_UNI_HID','INV_PART_2012_.UNI_HID=INV_UNI_HID.ID');
        $this->db->group_by('NOMBRE,USO');
        $this->db->order_by('USO');
        $query = $this->db->get('INV_PART_2012_');
        return $query->result_array();
    }
    function agrupar_uso($provincia, $canton, $parroquia,$unidad) {
        $this->db->select('USO,SUM(CAUDAL_MED) AS CAUDAL');
        $this->db->join('INV_UNI_HID','INV_PART_2012_.UNI_HID=INV_UNI_HID.ID');
        if ($provincia != "null") {
            $this->db->where('PROV_COD', $provincia);
        }
        if ($canton != "null") {
            $this->db->where('CANT_COD', $canton);
        }
        if ($parroquia != "null") {
            $this->db->where('PARR_COD', $parroquia);
        }
        if($unidad!="null"){
            $this->db->where('NOMBRE',$unidad);
        }
        $this->db->group_by('USO');
        $this->db->order_by('USO');
        $query = $this->db->get('INV_PART_2012_');
        return $query->result_array();
    }
    function agrupar_uso01($provincia, $canton, $parroquia,$unidad) {
        $this->db->select('USO,COUNT(*) AS CAUDAL');
        $this->db->join('INV_UNI_HID','INV_PART_2012_.UNI_HID=INV_UNI_HID.ID');
        if ($provincia != "null") {
            $this->db->where('PROV_COD', $provincia);
        }
        if ($canton != "null") {
            $this->db->where('CANT_COD', $canton);
        }
        if ($parroquia != "null") {
            $this->db->where('PARR_COD', $parroquia);
        }
        if($unidad!="null"){
            $this->db->where('NOMBRE',$unidad);
        }
        $this->db->group_by('USO');
        $this->db->order_by('USO');
        $query = $this->db->get('INV_PART_2012_');
        return $query->result_array();
    }
    
    function agrupar_unidad($provincia, $canton, $parroquia,$uso) {
        $this->db->select('NOMBRE AS UNI_HID,COUNT(*) AS NUMERO');
        $this->db->join('INV_UNI_HID','INV_PART_2012_.UNI_HID=INV_UNI_HID.ID');
        if ($provincia != "null") {
            $this->db->where('PROV_COD', $provincia);
        }
        if ($canton != "null") {
            $this->db->where('CANT_COD', $canton);
        }
        if ($parroquia != "null") {
            $this->db->where('PARR_COD', $parroquia);
        }
        if($uso!="null"){
            $this->db->where('USO',$uso);
        }
        $this->db->group_by('NOMBRE,INV_UNI_HID.ID');
        $this->db->order_by('INV_UNI_HID.ID');
        $query = $this->db->get('INV_PART_2012_');
        return $query->result_array();
    }
    function consultar_unidades($provincia, $canton, $parroquia) {
        $this->db->select('NOMBRE AS UNI_HID');
        $this->db->join('INV_UNI_HID','INV_PART_2012_.UNI_HID=INV_UNI_HID.ID');
        if ($provincia != "null") {
            $this->db->where('PROV_COD', $provincia);
        }
        if ($canton != "null") {
            $this->db->where('CANT_COD', $canton);
        }
        if ($parroquia != "null") {
            $this->db->where('PARR_COD', $parroquia);
        }
        $this->db->group_by('NOMBRE,INV_UNI_HID.ID');
        $this->db->order_by('INV_UNI_HID.ID');
        $query = $this->db->get('INV_PART_2012_');
        return $query->result_array();
    }

}
