<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Red2013_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function consultar_estaciones($variable) {
        $this->db->select('Estacion');
        $this->db->group_by('Estacion');
        $query = $this->db->get('VW_CUB_MEDICION_'.$variable.'_2013');
        //var_dump($this->db->last_query());
        return $query->result_array();
    }
    function periodo($estacion,$variable) {
        $this->db->select('Anio');
        $this->db->where('Estacion', $estacion);
        $this->db->group_by('Anio');
        $query = $this->db->get('VW_CUB_MEDICION_'.$variable.'_2013');
        //var_dump($this->db->last_query());
        return $query->result_array();
    }
    function consultar_medicion($valores) {
        $this->db->select('avg(Medida) as Medida, Mes');
        $this->db->where('Estacion', $valores['estacion']);
        $this->db->where('Anio', $valores['periodo']);
        $this->db->group_by('Mes');
        $query = $this->db->get('VW_CUB_MEDICION_'.$valores['variable'].'_2013');
        //var_dump($this->db->last_query());
        return $query->result_array();
    }
    function consultar_informacion($valores) {
        $this->db->select('Estacion, Anio, Administrador, Unidad');
        $this->db->where('Estacion', $valores['estacion']);
        $this->db->where('Anio', $valores['periodo']);
        $this->db->limit(1);
        $query = $this->db->get('VW_CUB_MEDICION_'.$valores['variable'].'_2013');
        //var_dump($this->db->last_query());
        return $query->row_array();
    }
}
