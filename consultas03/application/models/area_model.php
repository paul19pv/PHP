<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Area_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function consultar($valores) {
        $this->db->select('uni_id, ame_id, med_imagen, med_texto');
        $this->db->where('uni_id', $valores['unidad']);
        $this->db->where('ame_id', $valores['amenaza']);
        $this->db->limit(1);
        $query = $this->db->get('ACRI_MED_CRI');
        //var_dump($this->db->last_query());
        return $query->row_array();
    }
    function consultar_medidas($valores) {
        $this->db->select('med_pronta, med_inmediata');
        $this->db->where('uni_id', $valores['unidad']);
        $this->db->where('ame_id', $valores['amenaza']);
        $this->db->limit(1);
        $query = $this->db->get('ACRI_MED_CRI');
        //var_dump($this->db->last_query());
        return $query->row_array();
        
    }
}

