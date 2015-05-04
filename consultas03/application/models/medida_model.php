<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Medida_model extends CI_Model{
    public function insert_file($filename, $title)
    {
        $data = array(
            'arc_nombre'      => $filename,
            'arc_tipo'         => $title
        );
        $this->db->insert('MED_ARCHIVO', $data);
        return $this->db->insert_id();
    }
    
    public function insertar_medida($datos){
        $this->db->insert('MED_MEDIDA', $datos);
        return $this->db->insert_id();
    }
    public function insertar_ubicacion($datos){
        return $this->db->insert('MED_UBICACION', $datos);
    }
    
    public function insertar_prioridad($datos){
        return $this->db->insert('MED_PRIORIDAD', $datos);
    }
    public function insertar_capital($datos){
        return $this->db->insert('MED_CAPITAL', $datos);
    }
    public function insertar_gestion($datos){
        return $this->db->insert('MED_GESTION', $datos);
    }
    public function insertar_plazo($datos){
        return $this->db->insert('MED_PLAZO', $datos);
    }
    public function consultar_actor($tipo) {
        $fields = array('act_id','act_codigo', 'act_nombre','act_representante','act_cargo');
        $this->db->select($fields);
        $this->db->where('act_tipo', $tipo);
        $query = $this->db->get('MED_ACTOR');
        return $query->result_array();   
    }
    public function consultar_actor_medida($tipo,$med_id) {
        $fields = array('MED_ACTOR.act_id','act_codigo', 'act_nombre','act_representante','act_cargo');
        $this->db->select($fields);
        $this->db->where('act_tipo', $tipo);
        $this->db->where('MED_GESTION.med_id', $med_id);
        $this->db->join('MED_GESTION', 'MED_GESTION.act_id = MED_ACTOR.act_id','left');
        $query = $this->db->get('MED_ACTOR');
        //var_dump($this->db->last_query());
        return $query->result_array();   
    }
    
    public function consultar_portafolio_medida($unidad,$amenaza) {
        $campos=array('med_nombre','pla_plazo');
        $this->db->select($campos);
        $this->db->where('med_unidad', $unidad);
        $this->db->where('med_amenaza',$amenaza);
        $this->db->where('med_estado !=','inactivo');
        $this->db->join('MED_PLAZO', 'MED_PLAZO.med_id = MED_MEDIDA.med_id','left');
        $query = $this->db->get('MED_MEDIDA');
        //var_dump($this->db->last_query());
        return $query->result_array();
        
    }
    public function consultar_admin_medida($unidad,$amenaza){
        $campos=array('distinct(MED_MEDIDA.med_id)','ubi_sector','med_nombre','pri_categoria','med_area_int','pla_plazo');
        $this->db->select($campos);
        $this->db->where('med_unidad', $unidad);
        $this->db->where('med_amenaza',$amenaza);
        $this->db->where('med_estado !=','inactivo');
        $this->db->join('MED_PLAZO', 'MED_PLAZO.med_id = MED_MEDIDA.med_id','left');
        $this->db->join('MED_PRIORIDAD', 'MED_PRIORIDAD.med_id = MED_MEDIDA.med_id','left');
        $this->db->join('MED_UBICACION', 'MED_UBICACION.med_id = MED_MEDIDA.med_id','left');
        $query = $this->db->get('MED_MEDIDA');
        //var_dump($this->db->last_query());
        return $query->result_array();
    }
    public function consultar_medida_priorizada($unidad,$amenaza) {
        $campos=array('MED_MEDIDA.med_id','med_nombre','pla_plazo','ubi_foto','ubi_croquis','med_alcance','med_riesgo','med_restriccion');
        $this->db->select($campos);
        $this->db->where('med_unidad', $unidad);
        $this->db->where('med_amenaza',$amenaza);
        $this->db->where('med_estado =','priorizada');
        $this->db->join('MED_PLAZO', 'MED_PLAZO.med_id = MED_MEDIDA.med_id','left');
        $this->db->join('MED_UBICACION', 'MED_UBICACION.med_id = MED_MEDIDA.med_id','left');
        $query = $this->db->get('MED_MEDIDA');
        //var_dump($this->db->last_query());
        return $query->row_array();
        
    }
    /*public function consultar_prioridad($med_id){
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_PRIORIDAD');
        var_dump($this->db->last_query());
        return $query->row_array();
    }
*/
    public function consultar_medida01($med_id){
        $campos=array('med_id','med_codigo','med_nombre','med_unidad','med_amenaza');
        $this->db->select($campos);
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_MEDIDA');
        //var_dump($this->db->last_query());
        return $query->row_array();
    }
    public function consultar_medida02($med_id){
        $campos=array('med_id','med_area_int','med_area_tot','med_area_por');
        $this->db->select($campos);
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_MEDIDA');
        //var_dump($this->db->last_query());
        return $query->row_array();
    }
    public function consultar_ubicacion($med_id){
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_UBICACION');
        //var_dump($this->db->last_query());
        return $query->row_array();
    }
    public function consultar_prioridad($med_id){
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_PRIORIDAD');
        //var_dump($this->db->last_query());
        return $query->row_array();
    }
    public function consultar_plazo($med_id){
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_PLAZO');
        //var_dump($this->db->last_query());
        return $query->row_array();
    }

    public function consultar_capital($med_id){
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_CAPITAL');
        //var_dump($this->db->last_query());
        return $query->result_array();
    }
    public function row_consultar_ubicacion($med_id){
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_UBICACION');
        return $query->num_rows();
    }
    public function row_consultar_prioridad($med_id){
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_PRIORIDAD');
        return $query->num_rows();
    }
    public function row_consultar_plazo($med_id){
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_PLAZO');
        return $query->num_rows();
    }
    public function row_consultar_gestion($med_id){
        $this->db->where('med_id', $med_id);
        $query = $this->db->get('MED_GESTION');
        return $query->num_rows();
    }
    public function consultar_archivo($arc_id){
        $this->db->where('arc_id', $arc_id);
        $query = $this->db->get('MED_ARCHIVO');
        return $query->row_array();
        
    }

    public function modificar_medida($data,$id){
        $this->db->where('med_id' , $id);
        $this->db->update('MED_MEDIDA', $data);
        //var_dump($this->db->last_query());
    }
    public function modificar_ubicacion($data,$id){
        $this->db->where('ubi_id' , $id);
        $this->db->update('MED_UBICACION', $data);
        //var_dump($this->db->last_query());
    }
    public function modificar_prioridad($data,$id){
        $this->db->where('pri_id' , $id);
        $this->db->update('MED_PRIORIDAD', $data);
        //var_dump($this->db->last_query());
    }
    public function modificar_plazo($data,$id){
        $this->db->where('pla_id' , $id);
        $this->db->update('MED_PLAZO', $data);
        //var_dump($this->db->last_query());
    }
    public function eliminar_capital($id) {
        $this->db->where('med_id',$id);
        $this->db->delete('MED_CAPITAL');
    }
    public function eliminar_gestion($id) {
        $this->db->where('med_id',$id);
        $this->db->delete('MED_GESTION');
    }
}
