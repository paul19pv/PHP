<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Medida extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('medida_model', 'medida');
    }

    /* vistas de consulta */

    public function index($msg = "") {
        $data['unidades'] = $this->unidades();
        $data['amenazas'] = $this->amenazas();
        $data['mensaje'] = $msg;
        $this->load->view('medida/view_consultar_admin', $data);
    }
    public function view_login($msg = "") {
        $data['mensaje'] = $msg;
        $this->load->view('medida/view_login', $data);
    }

    public function view_form_admin($msg = "") {
        $data['unidades'] = $this->unidades();
        $data['amenazas'] = $this->amenazas();
        $data['mensaje'] = $msg;
        $this->load->view('medida/view_form_admin', $data);
    }

    public function view_consultar_portafolio() {
        $data['unidades'] = $this->unidades();
        $data['amenazas'] = $this->amenazas();
        $this->load->view('medida/view_consultar_portafolio', $data);
    }

    public function view_consultar_priorizada() {
        $data['unidades'] = $this->unidades();
        $data['amenazas'] = $this->amenazas();
        $this->load->view('medida/view_consultar_priorizada', $data);
    }

    /* primer paso medida */

    public function view_insertar_medida() {
        $data['unidades'] = $this->unidades();
        $data['amenazas'] = $this->amenazas();
        $this->load->view('medida/view_insertar_medida', $data);
    }

    /* segundo paso vista ubicacion */

    public function view_insertar_ubicacion($med_id) {
        $data['med_id'] = $med_id;
        $this->load->view('medida/view_insertar_ubicacion', $data);
    }

    /* tercer paso vista prioridad */

    public function view_insertar_prioridad($med_id) {
        $data['med_id'] = $med_id;
        $this->load->view('medida/view_insertar_prioridad', $data);
    }

    /* cuarto paso vista capital */

    public function view_insertar_capital($med_id, $error = '') {
        $data['med_id'] = $med_id;
        $data['capitales'] = $this->capitales();
        //$data['puntajes'] = $this->puntajes();
        $data['error'] = $error;
        $this->load->view('medida/view_insertar_capital', $data);
    }

    /* quinto paso vista actores */

    public function view_insertar_gestion($med_id) {
        $data['med_id'] = $med_id;
        $data['ejecutores'] = $this->medida->consultar_actor('ejecutor');
        $data['beneficiarios'] = $this->medida->consultar_actor('beneficiario');
        $data['aliados'] = $this->medida->consultar_actor('aliado');
        $data['responsables'] = $this->medida->consultar_actor('responsable');
        $this->load->view('medida/view_insertar_gestion', $data);
    }

    /* sexto paso plazo de implementacion */

    public function view_insertar_plazo($med_id) {
        $data['med_id'] = $med_id;
        $this->load->view('medida/view_insertar_plazo', $data);
    }

    public function view_modificar_medida($med_id) {
        $data = $this->medida->consultar_medida01($med_id);
        $data['med_id'] = $med_id;
        $data['unidades'] = $this->unidades();
        $data['amenazas'] = $this->amenazas();
        $this->load->view('medida/view_modificar_medida', $data);
    }

    public function view_modificar_ubicacion($med_id) {
        $data = $this->medida->consultar_ubicacion($med_id);
        $data['med_id'] = $med_id;
        //$data['foto'] = $this->consultar_archivo($data['ubi_foto']);
        //$data['croquis'] = $this->consultar_archivo($data['ubi_croquis']);
        $this->load->view('medida/view_modificar_ubicacion', $data);
    }

    public function view_modificar_prioridad($med_id) {
        $data = $this->medida->consultar_prioridad($med_id);
        $data['med_id'] = $med_id;
        $this->load->view('medida/view_modificar_prioridad', $data);
    }

    public function view_modificar_capital($med_id, $error = '') {
        $data['med_id'] = $med_id;
        //$data['capitales'] = $this->capitales();
        $cap_ori = $this->capitales();
        $cap_con = $this->medida->consultar_capital($med_id);
        $data['capitales'] = $this->listar_capitales($cap_ori, $cap_con);
        $data['error'] = $error;
        $this->load->view('medida/view_modificar_capital', $data);
    }

    public function view_modificar_gestion($med_id) {
        $data['med_id'] = $med_id;
        $data['medida'] = $this->medida->consultar_medida02($med_id);
        $data['ejecutores'] = $this->listar_actores('ejecutor', $med_id);
        $data['beneficiarios'] = $this->listar_actores('beneficiario', $med_id);
        $data['aliados'] = $this->listar_actores('aliado', $med_id);
        $data['responsables'] = $this->listar_actores('responsable', $med_id);
        $this->load->view('medida/view_modificar_gestion', $data);
    }

    public function view_modificar_plazo($med_id) {

        $data = $this->medida->consultar_plazo($med_id);
        $data['med_id'] = $med_id;
        $this->load->view('medida/view_modificar_plazo', $data);
        //print_r($data);
    }

    //guardar primeros datos de la medida
    public function guardar_medida() {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('medida')) {
                $data = $this->input->post();
                $data['med_estado'] = "inactivo";
                $med_id = $this->medida->insertar_medida($data);
                //$this->mensaje('success','El Banco se ha guardado correctamente');
                //$this->view_insertar_ubicacion($med_id);
                $this->clasificar_vista_ubicacion($med_id);
            } else {
                $this->view_insertar_medida();
            }
        } else {
            show_404();
        }
    }

    /* guardar ubicacion */

    public function guardar_ubicacion() {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $data = $this->input->post();
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('ubicacion')) {
                $this->medida->insertar_ubicacion($data);
                //$this->view_insertar_prioridad($data['med_id']);
                $this->clasificar_vista_prioridad($data['med_id']);
            } else {
                $this->view_insertar_ubicacion($data['med_id']);
            }
        } else {
            show_404();
        }
    }

    //guardar prioridad
    public function guardar_prioridad() {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $data = $this->input->post();
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('prioridad')) {
                unset($data['txt_puntaje']);
                unset($data['txt_categoria']);
                $this->medida->insertar_prioridad($data);
                //$this->view_insertar_capital($data['med_id']);
                $this->clasificar_vista_capital($data['med_id']);
            } else {
                $this->view_insertar_prioridad($data['med_id']);
                //$this->clasificar_vista_prioridad($med_id);
            }
        } else {
            show_404();
        }
    }

    //guardar capital
    public function guardar_capital() {
        $data = $this->input->post();

        if (count($data) > 1) {
            foreach ($data['cap_nombre'] as $value) {
                $data_sql['med_id'] = $data['med_id'];
                $data_sql['cap_nombre'] = $value;
                $this->medida->insertar_capital($data_sql);
            }
            //$this->view_insertar_gestion($data['med_id']);
            $this->clasificar_vista_gestion($data['med_id']);
        } else {
            $this->view_insertar_capital($data['med_id'], true);
        }
    }

    //guardar gestion
    public function guardar_gestion($tipo) {
        $data = $this->input->post();
        $status = "";
        $msg = "";
        if (count($data) > 1) {
            foreach ($data[$tipo] as $value) {
                $data_sql['med_id'] = $data['med_id'];
                $data_sql['act_id'] = $value;
                $this->medida->insertar_gestion($data_sql);
            }
            $status = "success";
            $msg = "Información de la medida actualizada exitosamente";
        } else {
            $status = "error";
            $msg = "Seleccione al menos una actor que intervenga en la medida";
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    //modificar datos de la medidad
    public function modificar_medida_gestion($med_id) {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('medida_gestion')) {
                $data = $this->input->post();
                $this->medida->modificar_medida($data, $med_id);
                //$this->view_insertar_plazo($med_id);
                $this->clasificar_vista_plazo($med_id);
            } else {
                $this->view_insertar_gestion($med_id);
            }
        } else {
            show_404();
        }
    }

    //guardar plazo
    public function guardar_plazo() {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $data = $this->input->post();
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('plazo')) {
                $this->medida->insertar_plazo($data);
                $this->activar_medida($data['med_id']);
                $this->view_form_admin("Medida Almacenada");
                //echo json_encode(array('status' => 'success', 'msg' => 'Medida Almacenada'));
            } else {
                $this->view_insertar_plazo($data['med_id']);
            }
        } else {
            show_404();
        }
    }

    //modificar informacion de la medida 
    public function modificar_medida01($med_id) {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('medida')) {
                $data = $this->input->post();
                $this->medida->modificar_medida($data, $med_id);
                $this->clasificar_vista_ubicacion($med_id);
            } else {
                $this->view_modificar_medida($med_id);
            }
        } else {
            show_404();
        }
    }

    //modificar la informacion de la medida
    //modificar ubicacion
    public function modificar_ubicacion($med_id) {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $data = $this->input->post();
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('ubicacion')) {
                $ubi_id = $data['ubi_id'];
                unset($data['ubi_id']);
                $this->medida->modificar_ubicacion($data, $ubi_id);
                $this->clasificar_vista_prioridad($med_id);
            } else {
                $this->view_modificar_ubicacion($med_id);
            }
        } else {
            show_404();
        }
    }

    public function modificar_prioridad($med_id) {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $data = $this->input->post();
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('prioridad')) {
                $pri_id = $data['pri_id'];
                unset($data['txt_puntaje']);
                unset($data['txt_categoria']);
                unset($data['pri_id']);
                $this->medida->modificar_prioridad($data, $pri_id);
                $this->clasificar_vista_capital($med_id);
            } else {
                $this->view_modificar_prioridad($med_id);
            }
        } else {
            show_404();
        }
    }

    public function modificar_capital($med_id) {
        $data = $this->input->post();
        if (count($data) > 1) {
            $this->medida->eliminar_capital($med_id);
            foreach ($data['cap_nombre'] as $value) {
                $data_sql['med_id'] = $med_id;
                $data_sql['cap_nombre'] = $value;
                $this->medida->insertar_capital($data_sql);
                
            }
            $this->clasificar_vista_gestion($med_id);
        } else {
            $this->view_insertar_capital($data['med_id'], true);
        }
    }

    public function modificar_medida_gestion01($med_id) {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('medida_gestion')) {
                $data = $this->input->post();
                $this->medida->modificar_medida($data, $med_id);
                //$this->view_insertar_plazo($med_id);
                $this->clasificar_vista_plazo($med_id);
            } else {
                $this->view_modificar_gestion($med_id);
            }
        } else {
            show_404();
        }
    }

    //guardar gestion
    public function modificar_gestion($tipo, $med_id) {
        $this->medida->eliminar_gestion($med_id);
        $data = $this->input->post();
        $status = "";
        $msg = "";
        if (count($data) > 1) {
            foreach ($data[$tipo] as $value) {
                $data_sql['med_id'] = $data['med_id'];
                $data_sql['act_id'] = $value;
                $this->medida->insertar_gestion($data_sql);
            }
            $status = "success";
            $msg = "Información de la medida actualizada exitosamente";
        } else {
            $status = "error";
            $msg = "Seleccione al menos una actor que intervenga en la medida";
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    //modificar plazo
    public function modificar_plazo() {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $data = $this->input->post();
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('plazo')) {
                $pla_id = $data['pla_id'];
                unset($data['pla_id']);
                $this->medida->modificar_plazo($data, $pla_id);
                //echo json_encode(array('status' => 'success', 'msg' => 'Medida Modificada'));
                $this->view_form_admin("Medida Modificada");
            } else {
                $this->view_modificar_plazo($data['med_id']);
            }
        } else {
            show_404();
        }
    }

    //calseficar vistas
    public function clasificar_vista_ubicacion($med_id) {
        if ($this->medida->row_consultar_ubicacion($med_id) > 0) {
            $this->view_modificar_ubicacion($med_id);
        } else {
            $this->view_insertar_ubicacion($med_id);
        }
    }

    public function clasificar_vista_prioridad($med_id) {
        if ($this->medida->row_consultar_prioridad($med_id) > 0) {
            $this->view_modificar_prioridad($med_id);
        } else {
            $this->view_insertar_prioridad($med_id);
        }
    }

    public function clasificar_vista_capital($med_id) {
        if ($this->medida->row_consultar_prioridad($med_id) > 0) {
            $this->view_modificar_capital($med_id);
        } else {
            $this->view_insertar_capital($med_id);
        }
    }

    public function clasificar_vista_gestion($med_id) {
        if ($this->medida->row_consultar_gestion($med_id) > 0) {
            $this->view_modificar_gestion($med_id);
        } else {
            $this->view_insertar_gestion($med_id);
        }
    }

    public function clasificar_vista_plazo($med_id) {
        if ($this->medida->row_consultar_plazo($med_id) > 0) {
            $this->view_modificar_plazo($med_id);
        } else {
            $this->view_insertar_plazo($med_id);
        }
    }

    //lista de capitales
    public function listar_capitales($cap_ori, $cap_con) {
        $i = 0;
        foreach ($cap_ori as $value1) {
            foreach ($cap_con as $value2) {
                $index = $value1['nombre'];
                if ($value2['cap_nombre'] === $value1['nombre']) {
                    unset($cap_ori[$i]);
                    $cap_ori[$i] = array("id" => $i, "nombre" => $index, "chk" => true);
                }
            }
            $i++;
        }
        return $cap_ori;
    }

    //lista de actores
    public function listar_actores($tipo, $med_id) {
        $act_ori = $this->medida->consultar_actor($tipo);
        $act_con = $this->medida->consultar_actor_medida($tipo, $med_id);
        $i = 0;
        foreach ($act_ori as $value1) {
            foreach ($act_con as $value2) {
                if ($value2['act_id'] === $value1['act_id']) {
                    unset($act_ori[$i]);
                    $act_ori[$i] = array("act_id" => $value2['act_id'],
                        "act_codigo" => $value2['act_codigo'],
                        "act_nombre" => $value2['act_nombre'],
                        "act_representante" => $value2['act_representante'],
                        "act_cargo" => $value2['act_cargo'],
                        "chk" => true);
                }
            }
            $i++;
        }
        return $act_ori;
    }

    public function activar_medida($med_id) {
        $data['med_estado'] = "activo";
        $this->medida->modificar_medida($data, $med_id);
    }

    public function modificar_medida($med_id) {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->input->is_ajax_request()) {
            if ($this->form_validation->run('medida2')) {
                $data = $this->input->post();
                $data['med_estado'] = "activo";
                $med_id = $this->medida->modificar_medida($data, $med_id);
                //$this->view_table_admin($med_id);
            } else {
                $this->view_modificar_medida($med_id);
            }
        } else {
            show_404();
        }
    }

    public function consultar_portafolio_medida() {
        $data = $this->input->post();
        $data_view['medida'] = $this->medida->consultar_portafolio_medida($data['unidad'], $data['amenaza']);
        $this->load->view('medida/view_table_medida', $data_view);
    }

    public function consultar_medida_priorizada() {
        $data = $this->input->post();
        $data_view['medida'] = $this->medida->consultar_medida_priorizada($data['unidad'], $data['amenaza']);
        $data_view['prioridad'] = $this->medida->consultar_prioridad($data_view['medida']['med_id']);

        $this->load->view('medida/view_ficha_priorizada', $data_view);
    }

    public function consultar_admin_medida() {
        $data = $this->input->post();
        $data_view['medida'] = $this->medida->consultar_admin_medida($data['unidad'], $data['amenaza']);
        $this->load->view('medida/view_table_admin', $data_view);
    }

    /*
      public function consultar_ejecutor() {
      $data = $this->medida->consultar_ejecutor($med_id);
      }
     */

    public function consultar_archivo($arc_id) {
        $data = $this->medida->consultar_archivo($arc_id);
        return $data;
    }

    public function upload_foto() {
        $status = "";
        $msg = "";
        $id = "erro";
        $file_element_name = 'foto_file';
        if ($status != "error") {
            $config['upload_path'] = './images/medida/fotos';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
            $config['max_size'] = '1000';
            $config['max_width'] = '330';
            $config['max_height'] = '210';
            //$config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
                $id="";
            } else {
                $data = $this->upload->data();
                //$file_id = $this->medida->insert_file($data['file_name'], 'foto');
                //$file_id = $this->medida->insert_file($data['file_name'], 'foto');

                /* @var $file_id type */
                $status = "success";
                $msg = "Imagen cargada exitosamente";
                $id = $data['file_name'];
                /*
                  if ($file_id) {
                  $status = "success";
                  $msg = "Imagen cargada exitosamente";
                  $id = $data['file_name'];
                  } else {
                  unlink($data['full_path']);
                  $status = "error";
                  $msg = "Ocurrio un problema inesperado. Intente nuevamente";
                  $id = "error";
                  }
                 * 
                 */
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg, 'id' => $id));
    }

    public function upload_croquis() {
        $status = "";
        $msg = "";
        $id = "error";
        $file_element_name = 'croquis_file';
        if ($status != "error") {
            $config['upload_path'] = './images/medida/croquis';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
            $config['max_size'] = '1000';
            $config['max_width'] = '330';
            $config['max_height'] = '210';
            //$config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $file_id = $this->medida->insert_file($data['file_name'], 'croquis');
                /* @var $file_id type */
                if ($file_id) {
                    $status = "success";
                    $msg = "Croquis de la medida cargado exitosamente";
                    $id = $data['file_name'];
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Ocurrio un problema inesperado. Intente nuevamente";
                    $id = "error";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg, 'id' => $id));
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

    public function capitales() {
        $capital[] = array("id" => "1", "nombre" => "Natural");
        $capital[] = array("id" => "2", "nombre" => "Físico");
        $capital[] = array("id" => "3", "nombre" => "Humano");
        $capital[] = array("id" => "4", "nombre" => "Financiero");
        $capital[] = array("id" => "5", "nombre" => "Social");
        return $capital;
    }

    public function puntajes() {
        $amenaza[] = array("id" => "1", "nombre" => "Alto");
        $amenaza[] = array("id" => "2", "nombre" => "Medio");
        $amenaza[] = array("id" => "3", "nombre" => "Bajo");
        return $amenaza;
    }

}
