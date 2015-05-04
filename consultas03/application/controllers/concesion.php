<?php
if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}
    

class Concesion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('concesion_model', 'concesion');
    }

    //vista consulta por caudal concesionado
    public function view_consulta_caudal() {
        $data['provincias'] = $this->concesion->provincias();
        $this->load->view('concesion_caudal', $data);
    }

    //vista consulta por numero de concesiones
    public function view_consulta_numero() {
        $data['provincias'] = $this->concesion->provincias();
        $this->load->view('concesion_numero', $data);
    }

    public function cargar_cantones() {
        ?><option value="null">Todos</option><?php
        if ($this->input->post('provincia') and $this->input->post('provincia')!="null" ) {
            $provincia = $this->input->post('provincia');
            $cantones = $this->concesion->cantones($provincia);
            foreach ($cantones as $item) {
                ?>
                <option value="<?php echo $item['CANT_COD']; ?>"><?php echo $item['CANT_NOM']; ?> </option>
                <?php
            }
        }
    }

    public function cargar_parroquias() {
        ?><option value="null">Todos</option><?php
        if ($this->input->post('canton') and $this->input->post('canton')!="null") {
            $canton = $this->input->post('canton');
            $provincia = $this->input->post('provincia');
            $parroquias = $this->concesion->parroquias($canton, $provincia);
            foreach ($parroquias as $item) {
                ?>
                <option value="<?php echo $item['PARR_COD']; ?>"><?php echo $item['PARR_NOM']; ?> </option>
                <?php
            }
        }
    }

    //consulta por caudal concesionado
    public function informacion_caudal() {
        if ($this->input->post('provincia')) {
            $provincia = $this->input->post('provincia');
        } else {
            $provincia = $this->input->post('provincia_');
        }
        if ($this->input->post('canton')) {
            $canton = $this->input->post('canton');
        } else {
            $canton = $this->input->post('canton_');
        }
        if ($this->input->post('parroquia')) {
            $parroquia = $this->input->post('parroquia');
        } else {
            $parroquia = $this->input->post('parroquia_');
        }
        if ($this->input->post('unidades')) {
            $uni_hid = $this->array_unidades($this->input->post('unidades'));
        } else {
            $uni_hid = $this->filtrar_unidades($provincia, $canton, $parroquia);
        }
        $unidades = $this->filtrar_unidades($provincia, $canton, $parroquia);
        $data['unidades'] = $this->list_unidades($unidades, $uni_hid);
        $data['provincia'] = $provincia;
        $data['canton'] = $canton;
        $data['parroquia'] = $parroquia;
        $data['usos'] = $this->array_usos();
        $data['informacion'] = $this->formar_tabla_cau($provincia, $canton, $parroquia, $uni_hid);
        $this->load->view('caudal/consultar_', $data);
    }

    public function numero_unidades() {
        $provincia = $this->input->post('provincia');
        $canton = $this->input->post('canton');
        $parroquia = $this->input->post('parroquia');
        $unidades = $this->filtrar_unidades($provincia, $canton, $parroquia);
        $numero = count($unidades);
        $id = 'valor';
        $data = array($id => $numero);
        echo json_encode($data);
    }

    //consulta por Numero de Concesiones
    public function informacion_numero() {
        $provincia = $this->input->post('provincia');
        $canton = $this->input->post('canton');
        $parroquia = $this->input->post('parroquia');
        $data['provincia'] = $provincia;
        $data['canton'] = $canton;
        $data['parroquia'] = $parroquia;
        $data['unidades'] = $this->filtrar_unidades($provincia, $canton, $parroquia);
        $data['informacion'] = $this->formar_tabla_num($provincia, $canton, $parroquia);
        $this->load->view('numero/consultar', $data);
        //print_r($data['informacion']);
    }

    //cadena json para la grafica de barras
    public function grafica_caudal() {
        if ($this->input->post('provincia')) {
            $provincia = $this->input->post('provincia');
        } else {
            $provincia = $this->input->post('provincia_');
        }
        if ($this->input->post('canton')) {
            $canton = $this->input->post('canton');
        } else {
            $canton = $this->input->post('canton_');
        }
        if ($this->input->post('parroquia')) {
            $parroquia = $this->input->post('parroquia');
        } else {
            $parroquia = $this->input->post('parroquia_');
        }
        if ($this->input->post('unidades')) {
            $uni_hid = $this->array_unidades($this->input->post('unidades'));
        } else {
            $uni_hid = $this->filtrar_unidades($provincia, $canton, $parroquia);
        }
        $data_tabla = $this->formar_tabla_cau($provincia, $canton, $parroquia, $uni_hid);
        $data_total = $data_tabla['Total'];
        $data_usos = $this->array_usos();
        $color = $this->list_color();
        $i = 0;
        foreach ($data_usos as $item) {
            $row[] = array('v' => $item);
            $row[] = array('v' => $data_total[$i]);
            $row[] = array('v' => $color[$i]);
            $row[] = array('v' => (string) number_format($data_total[$i], 2));
            $rows[] = array('c' => $row);
            unset($row);
            $i++;
        }
        $cols[] = array("id" => "Usos", "Label" => "Usos", "type" => "string");
        $cols[] = array("id" => "Valor", "Label" => "", "type" => "number");
        $cols[] = array("id" => "estilo", "Label" => "", "type" => "string", "role" => "style");
        $cols[] = array("id" => "leyenda", "Label" => "", "type" => "string", "role" => "annotation");
        $data = array('cols' => $cols, 'rows' => $rows);
        echo json_encode($data);
        
    }

    public function grafica_numero() {
        $provincia = $this->input->post('provincia');
        $canton = $this->input->post('canton');
        $parroquia = $this->input->post('parroquia');
        $data_total = $this->concesion->agrupar_unidad($provincia, $canton, $parroquia, "null");
        $color = $this->list_color();
        $i = 0;
        foreach ($data_total as $item) {
            $row[] = array('v' => $item['UNI_HID']);
            $row[] = array('v' => $item['NUMERO']);
            $row[] = array('v' => $color[$i]);
            $row[] = array('v' => $item['NUMERO']);
            $rows[] = array('c' => $row);
            unset($row);
            $i++;
        }
        $cols[] = array("id" => "Usos", "Label" => "Usos", "type" => "string");
        $cols[] = array("id" => "Valor", "Label" => "", "type" => "number");
        $cols[] = array("id" => "estilo", "Label" => "", "type" => "string", "role" => "style");
        $cols[] = array("id" => "leyenda", "Label" => "", "type" => "string", "role" => "annotation");
        $data = array('cols' => $cols, 'rows' => $rows);
        echo json_encode($data);
    }
    
    public function grafica_numero01() {
        $provincia = $this->input->post('provincia');
        $canton = $this->input->post('canton');
        $parroquia = $this->input->post('parroquia');
        $uni_hid = $this->filtrar_unidades($provincia, $canton, $parroquia);
        $data_tabla = $this->formar_tabla_cau01($provincia, $canton, $parroquia, $uni_hid);
        unset($data_tabla['Total']);
        //$color = $this->list_color();
        $i = 0;
        
        foreach ($data_tabla as $key01=>$value01) {
            $row[]=array('v'=>$key01);
            foreach ($value01 as $value02) {
                $row[]=array('v'=>$value02,);
            }
            $row[]=array('v'=>'');
            $rows[] = array('c' => $row);
            unset($row);
            $i++;
        }
        $cols[] = array("id" => "unidad", "label" => "Unidad", "type" => "string");
        $data_usos=  $this->array_usos();
        foreach ($data_usos as $key => $value) {
            $cols[] = array("id" => $key, "label" => $value, "type" => "number");
        }
        
        //$cols[] = array("id" => "estilo", "Label" => "", "type" => "string", "role" => "style");
        $cols[] = array("id" => "leyenda", "Label" => "", "type" => "string", "role" => "annotation");
        $data = array('cols' => $cols, 'rows' => $rows);
        echo json_encode($data);
    }

    public function formar_tabla_cau($provincia, $canton, $parroquia, $unidades) {
        //$data_unidades=  $this->filtrar_unidades($provincia, $canton, $parroquia);
        $data_unidades = $unidades;
        $data_suma = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($data_unidades as $unidad) {
            $data_fila = $this->concesion->agrupar_uso($provincia, $canton, $parroquia, $unidad);
            $data_tabla[$unidad] = $this->formar_fila_cau($data_fila);
            $data_suma = $this->sumar_array($data_suma, $data_tabla[$unidad]);
        }
        $data_tabla['Total'] = $data_suma;
        return $data_tabla;
    }
    public function formar_tabla_cau01($provincia, $canton, $parroquia, $unidades) {
        //$data_unidades=  $this->filtrar_unidades($provincia, $canton, $parroquia);
        $data_unidades = $unidades;
        $data_suma = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($data_unidades as $unidad) {
            $data_fila = $this->concesion->agrupar_uso01($provincia, $canton, $parroquia, $unidad);
            $data_tabla[$unidad] = $this->formar_fila_cau($data_fila);
            $data_suma = $this->sumar_array($data_suma, $data_tabla[$unidad]);
        }
        $data_tabla['Total'] = $data_suma;
        return $data_tabla;
    }

    public function formar_tabla_num($provincia, $canton, $parroquia) {
        $unidades = $this->filtrar_unidades($provincia, $canton, $parroquia);
        $data_usos = $this->array_usos();
        $data_suma = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($data_usos as $key => $value) {
            $data_fila = $this->concesion->agrupar_unidad($provincia, $canton, $parroquia, $key);
            $data_tabla[$value] = $this->formar_fila_num($data_fila, $unidades);
            $data_suma = $this->sumar_array($data_suma, $data_tabla[$value]);
        }
        $data_tabla['Total'] = $data_suma;
        return $data_tabla;
    }

    public function formar_fila_cau($data_fila) {
        $data_usos = $this->array_usos();
        foreach ($data_usos as $key => $value) {
            foreach ($data_fila as $fila) {
                if ($fila['USO'] === $key) {
                    $data_aux[$value] = $fila['CAUDAL'];
                    unset($data_usos[$key]);
                }
            }
        }
        $data_aux = $this->completar_ordenar($data_aux, $data_usos, $this->array_usos());
        return $data_aux;
    }

    public function formar_fila_num($data_fila, $unidades) {
        $data_unidades = $unidades;
        $data_aux=array();
        foreach ($data_unidades as $unidad) {
            foreach ($data_fila as $fila) {
                if ($fila['UNI_HID'] === $unidad) {
                    $data_aux[$unidad] = $fila['NUMERO'];
                    unset($data_unidades[$unidad]);
                }
            }
        }
        $data_aux = $this->completar_ordenar($data_aux, $data_unidades, $unidades);
        return $data_aux;
    }

    public function completar_ordenar($data1, $data2, $data3) {
        foreach ($data2 as $item) {
            $data1[$item] = 0;
        }
        foreach ($data3 as $item) {
            $data_com[] = $data1[$item];
        }
        return $data_com;
    }

    public function sumar_array($data1, $data2) {
        $data3 = array();
        foreach ($data2 as $key => $value) {
            $data3[] = $value + $data1[$key];
        }
        return $data3;
    }

    //retorna un array de los usos 
    public function array_usos() {
        $data_usos['A'] = 'Abrevadero';
        $data_usos['D'] = 'Domestico';
        $data_usos['F'] = 'Fuerza Mecanica';
        $data_usos['H'] = 'Hidroelectricidad';
        $data_usos['I'] = 'Industria';
        $data_usos['M'] = 'Agua de Mesa';
        $data_usos['P'] = 'Potable';
        $data_usos['R'] = 'Riego';
        $data_usos['S'] = 'Psicultura';$data_usos['T'] = 'Termal';
        return $data_usos;
    }

    //consultar y transformar en un array de la forma nombre=>valor
    public function filtrar_unidades($provincia, $canton, $parroquia) {
        $uni_hid = $this->concesion->consultar_unidades($provincia, $canton, $parroquia);
        $data_unidades = array();
        foreach ($uni_hid as $item) {
            $index = $item['UNI_HID'];
            $data_unidades[$index] = $item['UNI_HID'];
        }
        return $data_unidades;
    }

    //transformar en un array de la forma nombre=>valor
    public function array_unidades($unidades) {
        $data_unidades = array();
        foreach ($unidades as $item) {
            $index = $item;
            $data_unidades[$index] = $item;
        }
        return $data_unidades;
    }

    //generar la lista de unidades para el filtro
    public function list_unidades($unidades, $uni_hid) {
        $data_unidades = $unidades;
        foreach ($data_unidades as $item1) {
            foreach ($uni_hid as $item2) {
                if ($item1 === $item2) {
                    $data_list[$item1] = TRUE;
                    unset($data_unidades[$item2]);
                }
            }
        }
        $data_list = $this->completar_unidades($data_list, $data_unidades, $unidades);
        return $data_list;
    }

    public function completar_unidades($data1, $data2, $data3) {
        foreach ($data2 as $item) {
            $data1[$item] = FALSE;
        }
        foreach ($data3 as $item) {
            $data_com[$item] = $data1[$item];
        }
        return $data_com;
    }

    public function list_color() {
        $data_color[0] = "color:#FF5050";
        $data_color[1] = "color:#FF9933";
        $data_color[2] = "color:#FFFF00";
        $data_color[3] = "color:#99FF33";
        $data_color[4] = "color:#33CC33";
        $data_color[5] = "color:#00FF99";
        $data_color[6] = "color:#33CCCC";
        $data_color[7] = "color:#0099FF";
        $data_color[8] = "color:#3366FF";$data_color[9] = "color:#9966FF";
        return $data_color;
    }

    public function generate_excel() {
        $provincia = $this->input->post('provincia01');
        $canton = $this->input->post('canton01');
        $parroquia = $this->input->post('parroquia01');
        if ($this->input->post('unidades01')) {
            $uni_hid = $this->array_unidades($this->input->post('unidades01'));
            $data_table = $this->formar_tabla_cau($provincia, $canton, $parroquia, $uni_hid);
            $data_usos = $this->array_usos();
            $this->file_xls('Unidad Hidrica', $data_usos, $data_table, 'caudal_concesionado');
        } else {
            $data_table = $this->formar_tabla_num($provincia, $canton, $parroquia);
            $data_unidades = $this->filtrar_unidades($provincia, $canton, $parroquia);
            $this->file_xls('Usos', $data_unidades, $data_table, 'numero_concesiones');
        }
    }

    function file_xls($title, $data_title, $data_table, $filename) {
        $this->load->helper('php-excel');
        $data_xls[] = array('Caudal(l/s)', 'Uso');
        $data_row[] = $title;
        foreach ($data_title as $value) {
            $data_row[] = $value;
        }
        $data_xls[] = $data_row;
        unset($data_row);
        foreach ($data_table as $key => $value) {
            $data_row[] = $key;
            foreach ($value as $value2) {
                $data_row[] = number_format($value2, 2, ',', ' ');
            }
            $data_xls[] = $data_row;
            unset($data_row);
        }
        $xls = new Excel_XML;
        $xls->addArray($data_xls);
        $xls->generateXML($filename);
    }

    //generar los datos para el archivo word
    public function generate_word() {
        $provincia = $this->input->post('provincia01');
        $canton = $this->input->post('canton01');
        $parroquia = $this->input->post('parroquia01');
        if ($this->input->post('unidades01')) {
            $uni_hid = $this->array_unidades($this->input->post('unidades01'));
            $data_table = $this->formar_tabla_cau($provincia, $canton, $parroquia, $uni_hid);
            $data_usos = $this->array_usos();
            $this->file_word('Unidad Hidrica', $data_usos, $data_table);
        } else {
            $data_table = $this->formar_tabla_num($provincia, $canton, $parroquia);
            $data_unidades = $this->filtrar_unidades($provincia, $canton, $parroquia);
            $this->file_word('Usos', $data_unidades, $data_table);
        }
    }

    function file_word($title, $data_title, $data_table) {
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
        $table->addCell(1500, $styleCell)->addText($title, $fontStyle);
        foreach ($data_title as $value) {
            $table->addCell(1500, $styleCell)->addText($value, $fontStyle);
        }
        foreach ($data_table as $key => $value) {
            $table->addRow();
            $table->addCell(1500, $styleCell)->addText($key, $fontStyle);
            foreach ($value as $value2) {
                $table->addCell(1500, $styleCell)->addText(number_format($value2, 2, ',', ' '));
            }
        }
        // Save File
        $objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2007');
        $objWriter->save('consulta_concesiones.docx');
    }

}
