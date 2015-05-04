<?php

$config = array(
    'medida' => array(//VALIDACION POR FORMULARIO campo nombre (name  )
        array(
            'field' => 'med_codigo',
            'label' => 'Codigo de Medida',
            'rules' => 'required|alpha_dash|max_length[10]'
        ),
        array(
            'field' => 'med_nombre',
            'label' => 'Nombre de la Medida',
            'rules' => 'required'
        ),
        array(
            'field' => 'med_unidad',
            'label' => 'Unidad Hídrica',
            'rules' => 'required'
        ),
        array(
            'field' => 'med_amenaza',
            'label' => 'Nombre de la Amenaza',
            'rules' => 'required'
        )
    ),
    'ubicacion' => array(
        array(
            'field' => 'ubi_sector',
            'label' => 'Sector',
            'rules' => 'required|alpha'
        ),
        array(
            'field' => 'ubi_longitud',
            'label' => 'Longitud',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'ubi_latitud',
            'label' => 'Latitud',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'ubi_altura',
            'label' => 'Altura',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'ubi_foto',
            'label' => 'Foto',
            'rules' => 'required'
        ),
        array(
            'field' => 'ubi_croquis',
            'label' => 'Croquis',
            'rules' => 'required'
        )
    ),
    'prioridad' => array(
        array(
            'field' => 'pri_c1',
            'label' => 'C1',
            'rules' => 'required|numeric|less_than[0.35001]'
        ),
        array(
            'field' => 'pri_c2',
            'label' => 'C2',
            'rules' => 'required|numeric|less_than[0.25001]'
        ),
        array(
            'field' => 'pri_c3',
            'label' => 'C3',
            'rules' => 'required|numeric|less_than[0.2001]'
        ),
        array(
            'field' => 'pri_c4',
            'label' => 'C4',
            'rules' => 'required|numeric|less_than[0.1001]'
        ),
        array(
            'field' => 'pri_c5',
            'label' => 'C5',
            'rules' => 'required|numeric|less_than[0.1001]'
        )
    ),
    'medida2' => array(
        array(
            'field' => 'med_num_direc',
            'label' => 'Número de beneficiarios directos',
            'rules' => 'numeric'),
        array(
            'field' => 'med_num_indir',
            'label' => 'Número de beneficiarios indirectos',
            'rules' => 'numeric'),
        array(
            'field' => 'med_alcance',
            'label' => 'Alcance',
            'rules' => 'alpha_dash'),
        array(
            'field' => 'med_restriccion',
            'label' => 'Restricción',
            'rules' => 'alpha_dash'),
        array(
            'field' => 'med_riesgo',
            'label' => 'Riesgo',
            'rules' => 'alpha_dash'),
        array(
            'field' => 'med_observacion',
            'label' => 'Observaciones',
            'rules' => 'alpha_dash')
    ),
    
    'medida_gestion' => array(
        array(
            'field' => 'med_area_int',
            'label' => 'Área Intervenida',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'med_area_tot',
            'label' => 'Área Total a Intervenir',
            'rules' => 'required|numeric'),
        array(
            'field' => 'med_area_por',
            'label' => 'Porcentaje',
            'rules' => 'required')
    ),
    'plazo' => array(
        array(
            'field' => 'pla_inicio',
            'label' => 'Inicio',
            'rules' => 'required'
        ),
        array(
            'field' => 'pla_fin',
            'label' => 'Finalización',
            'rules' => 'required'
        ),
        array(
            'field' => 'pla_plazo',
            'label' => 'Plazo',
            'rules' => 'required'
        )
    ),
    'banco' => array(
        array('field' => 'banco_nombre',
            'label' => 'Banco',
            'rules' => 'required|alpha_numeric'
        )
    ),
    'cuenta' => array(
        array('field' => 'cuenta_numero',
            'label' => 'Numero',
            'rules' => 'numeric|required|max_length[25]'
        ),
        array('field' => 'cuenta_tipo',
            'label' => 'Tipo',
            'rule' => 'alpha_numeric|required|max_length[25]'
        ),
        array('field' => 'banco_id',
            'label' => 'Id',
            'rule' => 'numeric|required'
        )
    ),
    'dispositivo' => array(
        array('field' => 'servicio_id',
            'label' => 'Servicio',
            'rules' => 'required'
        ),
        array('field' => 'dispositivo_nombre',
            'label' => 'Nombre',
            'rules' => 'required'
        ),
        array('field' => 'dispositivo_numero',
            'label' => 'Nombre',
            'rules' => 'required|numeric'
        )
    ),
    'retiro' => array(
        array('field' => 'banco',
            'label' => 'Banco',
            'rules' => 'required'
        ),
        array('field' => 'cuenta_id',
            'label' => 'Cuenta',
            'rules' => 'required'
        ),
        array('field' => 'retiro_valor',
            'label' => 'Valor',
            'rules' => 'required'
        ),
        array('field' => 'retiro_concepto',
            'label' => 'Concepto',
            'rules' => 'required'
        ),
        array('field' => 'retiro_tipo',
            'label' => 'Tipo',
            'rules' => 'required'
        )
    ),
    'acreditacion' => array(
        array('field' => 'usuario',
            'label' => 'usuario',
            'rules' => 'required'
        ),
        array('field' => 'acreditacion_valor',
            'label' => 'Valor',
            'rules' => 'required|decimal'
        ),
        array('field' => 'acreditacion_tipo',
            'label' => 'Tipo',
            'rules' => 'required'
        )
    ),
    'abono' => array(
        array('field' => 'usuario',
            'label' => 'usuario',
            'rules' => 'required'
        ),
        array('field' => 'abono_valor',
            'label' => 'Valor',
            'rules' => 'required|decimal'
        )
    ),
    'trabajador' => array(
        array('field' => 'usuario_cedula',
            'label' => 'Cédula',
            'rules' => 'required|exact_length[10]'
        ),
        array(
            'field' => 'usuario_nombres',
            'label' => 'Nombres',
            'rules' => 'required|min_length[4]|alpha_dash'
        ),
        array(
            'field' => 'usuario_apellidos',
            'label' => 'Apellidos',
            'rules' => 'required|min_length[4]'
        ),
        array(
            'field' => 'usuario_telefonocelular',
            'label' => 'Telefono Celular',
            'rules' => 'required|numeric|exact_length[10]'
        ),
        array(
            'field' => 'usuario_direccion',
            'label' => 'Dirección',
            'rules' => 'required|max_length[150]'
        )
    ),
    'transferencia' => array(
        array(
            'field' => 'recarga_celular',
            'label' => 'Celular',
            'rules' => 'required'
        ),
        array(
            'field' => 'recarga_operador',
            'label' => 'Operador',
            'rules' => 'required'
        ),
        array(
            'field' => 'usuario_transferencia',
            'label' => 'Usuario',
            'rules' => 'required'
        ),
        array(
            'field' => 'recarga_valor',
            'label' => 'Valor',
            'rules' => 'required'
        )
    ),
    'servicio' => array(
        array('field' => 'servicio_id',
            'label' => 'Servicio',
            'rules' => 'required'
        ),
        array('field' => 'compra_valor',
            'label' => 'Valor',
            'rules' => 'required')
    ),
    'recarga_dispositivo' => array(
        array('field' => 'dispositivo_id',
            'label' => 'Dispositivo',
            'rules' => 'required'
        ),
        array('field' => 'recarga_valor',
            'label' => 'Valor',
            'rules' => 'required|numeric'
        )
    ),
    'deposito' => array(
        array('field' => 'banco',
            'label' => 'Banco',
            'rules' => 'required'
        ),
        array('field' => 'cuenta_id',
            'label' => 'Cuenta',
            'rules' => 'required'
        ),
        array('field' => 'deposito_numero',
            'label' => 'Numero',
            'rules' => 'required'
        ),
        array('field' => 'deposito_valor',
            'label' => 'Valor',
            'rules' => 'required|decimal'
        ),
        array('field' => 'deposito_concepto',
            'label' => 'Concepto',
            'rules' => 'required'
        )
    ),
    'chip' => array(
        array('field' => 'chip_icc',
            'label' => 'ICC',
            'rules' => 'required|numeric')
    ),
    'oferta' => array(
        array('field' => 'servicio_id',
            'label' => 'Servicio',
            'rules' => 'required'
        ),
        array('field' => 'oferta_titulo',
            'label' => 'Oferta',
            'rules' => 'required'
        ),
        array('field' => 'oferta_fechainicio',
            'label' => 'Fecha Inicial',
            'rules' => 'required'
        ),
        array('field' => 'oferta_fechafin',
            'label' => 'Fecha Final',
            'rules' => 'required'
        ),
        array('field' => 'oferta_descripcion',
            'label' => 'descripción',
            'rules' => 'required'
        )
    ),
    'cambio_clave' => array(
        array('field' => 'clave_actual',
            'label' => 'Clave Actual',
            'rules' => 'required'
        ),
        array('field' => 'usuario_clave',
            'label' => 'Nueva Clave',
            'rules' => 'required'
        ),
        array('field' => 'clave_nueva',
            'label' => 'Confirmación de Clave',
            'rules' => 'required'
        )
    ),
    'telefono' => array(
        array('field' => 'telefono_nombres',
            'label' => 'Nombres',
            'rules' => 'required|alpha_numeric'
        ),
        array('field' => 'telefono_apellidos',
            'label' => 'Apellidos',
            'rules' => 'required|alpha_numeric'
        ),
        array('field' => 'telefono_cedula',
            'label' => 'Cedula',
            'rules' => 'required|numeric|exact_length[10]'
        ),
        array('field' => 'telefono_numero',
            'label' => 'Número',
            'rules' => 'required|numeric'
        ),
        array('field' => 'telefono_valor',
            'label' => 'Valor',
            'rules' => 'required|numeric|decimal|max_length[6]'
        )
    ),
    'luz' => array(
        array('field' => 'luz_nombres',
            'label' => 'Nombres',
            'rules' => 'required'
        ),
        array('field' => 'luz_apellidos',
            'label' => 'Apellidos',
            'rules' => 'required'
        ),
        array('field' => 'luz_cedula',
            'label' => 'Cedula',
            'rules' => 'required|numeric|exact_length[10]'
        ),
        array('field' => 'luz_medidor',
            'label' => 'Número',
            'rules' => 'required|numeric'
        ),
        array('field' => 'luz_valor',
            'label' => 'Valor',
            'rules' => 'required|numeric|decimal|max_length[6]'
        )
    ),
    'solicitud_acreditacion' => array(
        array('field' => 'acreditacion_valor',
            'label' => 'Valor',
            'rules' => 'required|numeric|decimal|max_length[6]'
        ),
        array('field' => 'acreditacion_banco',
            'label' => 'Banco',
            'rules' => 'required'
        ),
        array('field' => 'acreditacion_documento',
            'label' => 'Documento',
            'rules' => 'required')
    ),
    'reinicio_clave' => array(
        array('field' => 'usuario',
            'label' => 'Usuario',
            'rules' => 'required|numeric|exact_length[10]'
        )
    ),
    'bloqueo' => array(
        array('field' => 'usuario_bloqueo',
            'label' => 'Usuario',
            'rules' => 'required|numeric|exact_length[10]'
        )
    ),
    'bloqueo_administrador' => array(
        array('field' => 'admin_bloqueo',
            'label' => 'Usuario',
            'rules' => 'required|numeric|exact_length[10]'
        )
    ),
    'reposicion' => array(
        array('field' => 'reposicion_icc',
            'label' => 'Icc',
            'rules' => 'required|numeric|max_length[25]'
        ),
        array('field' => 'reposicion_numero',
            'label' => 'Número',
            'rules' => 'required|numeric|exact_length[10]'
        ),
        array('field' => 'reposicion_cedula',
            'label' => 'Cédula',
            'rules' => 'required|numeric|exact_length[10]'
        ),
        array('field' => 'reposicion_nombres',
            'label' => 'Nombres',
            'rules' => 'required|alpha|max_length[50]'
        ),
        array('field' => 'reposicion_apellidos',
            'label' => 'Apellidos',
            'rules' => 'required|alpha|max_length[50]'
        ),
        array('field' => 'reposicion_ultimallamada',
            'label' => 'Última Llamada',
            'rules' => 'required|numeric|exact_length[10]'
        ),
        array('field' => 'reposicion_ultimarecarga',
            'label' => 'Última Recarga',
            'rules' => 'required|decimal|max_length[6]'
        )
    ),
    'pinpuk' => array(
        array('field' => 'chip_pin',
            'label' => 'Pin',
            'rules' => 'required|numeric'
        ),
        array('field' => 'chip_puk',
            'label' => 'Puk',
            'rules' => 'required|numeric'
        )
    )
);
?>