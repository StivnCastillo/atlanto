<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Computador extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(
			array(
					'computador_model', 
					'dominio_model', 
					'estadocomponente_model', 
					'tipo_model', 
					'so_model', 
					'red_model',
					'monitor_model',
					'impresora_model',
					'dispositivo_model',
					'software_model',
					'componente_model',
					'interfaz_model',
					'historial_model'
				)
		);
	}

	/*
	* funcion inicial del controlador, datos tabulados
	*/
	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_computador'), '/computador');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$computadores = $this->computador_model->get();

		$data = array(
			'titulo' => $this->lang->line('titulo_computadores'),
			'content' => 'computadores/index_view',
			'breadcrumbs' => $breadcrumbs,
			'computadores' => $computadores
		);
		$this->load->view('template', $data);
	}

	/*
	* Muestra formulario para agregar nuevo elemento
	*/
	public function nuevo($id_computador = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_computador'), '/computador');
		$this->breadcrumbs->push($this->lang->line('bre_nuevo_computador'), '/computador/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		//traer dependencias		
		$dominios = $this->dominio_model->get_todos();
		$estados = $this->estadocomponente_model->get_todos();
		$tipos = $this->tipo_model->get_com_todos();
		$sistema_o = $this->so_model->get_todos();
		$redes = $this->red_model->get_todos();

		//monitor
		$tipo_mon = $this->tipo_model->get_mon_todos();
		$interfaz = $this->interfaz_model->get_mon_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_com'),
			'content' => 'computadores/save_view',
			'breadcrumbs' => $breadcrumbs,
			'dominios' => $dominios,
			'redes' => $redes,
			'estados' => $estados,
			'tipos' => $tipos,
			'tipo_mon' => $tipo_mon,
			'interfaz' => $interfaz,
			'sistema_o' => $sistema_o,
			'accion_guardar' => site_url('computador/guardar'),
			'accion_modificar' => site_url('computador/modificar'),
			'accion_ubicacion' => site_url('buscar_ubicacion'),
			'accion_usuario' => site_url('buscar_usuario')
		);

		if($id_computador){

			$data['computador'] = $this->computador_model->get($id_computador);
			$data['id_computador'] = $id_computador;

			//Conexion monitor
			$data['con_monitores'] = $this->computador_model->get_monitor($id_computador);
			//Todos los monitores
			$data['lis_monitores'] = $this->monitor_model->get();
			$data['accion_monitor'] = site_url('monitor/guardar_externo/'.$id_computador);

			//Conexion impresoras
			$data['con_impresoras'] = $this->computador_model->get_impresora($id_computador);
			//Todos los impresoras
			$data['lis_impresoras'] = $this->impresora_model->get();

			//Conexion dispositivos
			$data['con_dispositivos'] = $this->computador_model->get_dispositivo($id_computador);
			//Todos los dispositivos
			$data['lis_dispositivos'] = $this->dispositivo_model->get();

			//Conexion software
			$data['con_software'] = $this->computador_model->get_software($id_computador);
			//Todos los software
			$data['lis_software'] = $this->software_model->get();

			//todos los componentes
				$data['accion_componente'] = site_url('computador/conectar_componente/'.$id_computador);

				//discoduro
				$data['discosduro'] = $this->componente_model->get_discosduro();

				//procesadores
				$data['procesadores'] = $this->componente_model->get_procesador();

				//memorias
				$data['memorias'] = $this->componente_model->get_memoria();

				//memorias
				$data['tvideo'] = $this->componente_model->get_tvideo();

			//componentes conectados
			$data['discoduro_con'] = $this->computador_model->get_discoduro($id_computador);
			$data['memoria_con'] = $this->computador_model->get_memoria($id_computador);
			$data['procesador_con'] = $this->computador_model->get_procesador($id_computador);
			$data['tvideo_con'] = $this->computador_model->get_tvideo($id_computador);

			//historial
			$data['historial'] = $this->historial_model->get_historial($id_computador,'computador');

		}
		$this->load->view('template', $data);
	}

	public function conectar_componente($id_computador)
	{
		$datos = array(
			'cantidad' => $this->input->post('cantidad'),
			'id_componente' => $this->input->post('id_componente'),
			'id_computador' => $id_computador
		);

		if($this->input->post('componente') == 'discoduro'){
			$conexion = $this->computador_model->save_discoduro($datos);
			$componente = $this->componente_model->get_discosduro($this->input->post('id_componente'));
		}

		if($this->input->post('componente') == 'procesador'){
			$conexion = $this->computador_model->save_procesador($datos);
			$componente = $this->componente_model->get_procesador($this->input->post('id_componente'));
		}

		if($this->input->post('componente') == 'memoria'){
			$conexion = $this->computador_model->save_memoria($datos);
			$componente = $this->componente_model->get_memoria($this->input->post('id_componente'));
		}

		if($this->input->post('componente') == 'tvideo'){
			$conexion = $this->computador_model->save_tvideo($datos);
			$componente = $this->componente_model->get_tvideo($this->input->post('id_componente'));
		}
		if($conexion){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador',
				'descripcion' => 'Componente conectado',
				'ant_valor' => '',
				'new_valor' => $componente->nombre
			));

			$this->session->set_flashdata('mensaje_con_componente', 'Componente conectado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');

		}else{
			$this->session->set_flashdata('mensaje_con_componente', 'Ocurrio un error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('computador/nuevo/'.$id_computador, 'refresh');
	}
	/***FALTA*/
	public function desconectar_componente($id_computador, $id_conexion, $componente)
	{
		$this->acceso_restringido();

		$conexion = $this->computador_model->get_conexion($id_conexion, $componente);

		if($componente == 1){
        	$componente_1 = $this->componente_model->get_discosduro($conexion->id_componente);
        }
        if($componente == 2){
            $componente_1 = $this->componente_model->get_memoria($conexion->id_componente);
        }
        if($componente == 3){
            $componente_1 = $this->componente_model->get_procesador($conexion->id_componente);
        }
        if($componente == 4){
            $componente_1 = $this->componente_model->get_tvideo($conexion->id_componente);
        }

		$componente = $this->computador_model->delete_componente($id_conexion, $componente);
		if($componente){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador',
				'descripcion' => 'Componente desconectado',
				'ant_valor' => $componente_1->nombre,
				'new_valor' => ''
			));

			$this->session->set_flashdata('mensaje_con_componente','Componente Desconectado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje_con_componente', 'Ocurrio un Error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('computador/nuevo/'.$id_computador, 'refresh');
	}

	public function conectar_monitor($id_computador)
	{
		$datos = array(
			'id_monitor' => $this->input->post('id_monitor'),
			'id_computador' => $id_computador
		);

		$conexion = $this->computador_model->save_monitor($datos);
		$monitor = $this->monitor_model->get($this->input->post('id_monitor'));

		if($conexion){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador',
				'descripcion' => 'Monitor conectado',
				'ant_valor' => '',
				'new_valor' => $monitor->nombre.' - '.$monitor->n_serie
			));
			$this->session->set_flashdata('mensaje_con_monitor', 'Monitor conectado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje_con_monitor', 'Ocurrio un error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}
	}

	public function conectar_impresora($id_computador)
	{
		$datos = array(
			'id_impresora' => $this->input->post('id_impresora'),
			'id_computador' => $id_computador
		);

		$conexion = $this->computador_model->save_impresora($datos);
		$impresora = $this->impresora_model->get($this->input->post('id_impresora'));
		if($conexion){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador',
				'descripcion' => 'Impresora conectada',
				'ant_valor' => '',
				'new_valor' => $impresora->nombre.' - '.$impresora->n_serie
			));
			$this->session->set_flashdata('mensaje_con_impresora', 'Impresora conectada');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje_con_impresora', 'Ocurrio un error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}
	}

	public function conectar_dispositivo($id_computador)
	{
		$datos = array(
			'id_dispositivo' => $this->input->post('id_dispositivo'),
			'id_computador' => $id_computador
		);

		$conexion = $this->computador_model->save_dispositivo($datos);
		$dispositivo = $this->dispositivo_model->get($this->input->post('id_dispositivo'));
		if($conexion){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador',
				'descripcion' => 'Dispositivo conectada',
				'ant_valor' => '',
				'new_valor' => $dispositivo->nombre.' - '.$dispositivo->n_serie
			));
			$this->session->set_flashdata('mensaje_con_dispositivo', 'Dispositivo conectado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje_con_dispositivo', 'Ocurrio un error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}
	}

	public function conectar_software($id_computador)
	{
		$datos = array(
			'id_software' => $this->input->post('id_software'),
			'id_computador' => $id_computador
		);

		$conexion = $this->computador_model->save_software($datos);
		$software = $this->software_model->get($this->input->post('id_software'));
		if($conexion){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador', 
				'descripcion' => 'Software instalado',
				'ant_valor' => '',
				'new_valor' => $software->nombre.' - '.$software->n_serie
			));
			//Restar licencias de software
			$this->session->set_flashdata('mensaje_con_software', 'Software Instalado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje_con_software', 'Ocurrio un error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}
	}

	public function eliminar_monitor($id_computador, $id_conexion)
	{
		$this->acceso_restringido();
		$conexion_1 = $this->computador_model->get_conexion($id_conexion, 5);
		$monitor = $this->monitor_model->get($conexion_1->id_monitor);

		$conexion = $this->computador_model->delete_monitor($id_conexion);
		if(!$conexion){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador', 
				'descripcion' => 'Monitor desconectado',
				'ant_valor' => $monitor->nombre.' - '.$monitor->n_serie,
				'new_valor' => ''
			));
			$this->session->set_flashdata('mensaje_con_monitor', 'Monitor desconectado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje_con_monitor', 'Ocurrio un error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('computador/nuevo/'.$id_computador, 'refresh');
	}

	public function eliminar_impresora($id_computador, $id_conexion)
	{
		$this->acceso_restringido();

		$conexion_1 = $this->computador_model->get_conexion($id_conexion, 6);
		$impresora = $this->impresora_model->get($conexion_1->id_impresora);

		$conexion = $this->computador_model->delete_impresora($id_conexion);
		if(!$conexion){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador', 
				'descripcion' => 'Impresora desconectada',
				'ant_valor' => $impresora->nombre.' - '.$impresora->n_serie,
				'new_valor' => ''
			));
			$this->session->set_flashdata('mensaje_con_impresora', 'Impresora desconectada');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje_con_impresora', 'Ocurrio un error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('computador/nuevo/'.$id_computador, 'refresh');
	}

	public function eliminar_dispositivo($id_computador, $id_conexion)
	{
		$this->acceso_restringido();

		$conexion_1 = $this->computador_model->get_conexion($id_conexion, 7);
		$dispositivo = $this->dispositivo_model->get($conexion_1->id_dispositivo);

		$conexion = $this->computador_model->delete_dispositivo($id_conexion);
		if(!$conexion){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador', 
				'descripcion' => 'Dispositivo desconectado',
				'ant_valor' => $dispositivo->nombre.' - '.$dispositivo->n_serie,
				'new_valor' => ''
			));
			$this->session->set_flashdata('mensaje_con_dispositivo', 'Dispositivo desconectado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje_con_dispositivo', 'Ocurrio un error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('computador/nuevo/'.$id_computador, 'refresh');
	}

	public function eliminar_software($id_computador, $id_conexion)
	{
		$this->acceso_restringido();

		$conexion_1 = $this->computador_model->get_conexion($id_conexion, 8);
		$software = $this->software_model->get($conexion_1->id_software);

		$conexion = $this->computador_model->delete_software($id_conexion);
		if(!$conexion){
			//Historial**
			$log = $this->historial_model->save(array(
				'fecha' => date("Y-m-d H:i:s"),
				'id_usuario' => $this->session->userdata('id'),
				'id_componente' => $id_computador,
				'componente' => 'computador', 
				'descripcion' => 'Software desinstalado',
				'ant_valor' => $software->nombre.' - '.$software->version,
				'new_valor' => ''
			));
			//Sumar licencias en el software
			$this->session->set_flashdata('mensaje_con_software', 'Software Desinstalado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje_con_software', 'Ocurrio un error');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('computador/nuevo/'.$id_computador, 'refresh');
	}

	/*
	* Procesa los datos y los envia al modelo que guarda en la base de datos
	*/
	public function guardar()
	{
		$this->acceso_restringido();
		
		//reglas de validacion de formulario, en el server
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'ubicacion',
                     'label' => 'Ubicacion',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'usuario',
                     'label' => 'Usuario',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'estado',
                     'label' => 'Estado',
                     'rules' => 'required'
                  ),   
               array(
                     'field' => 'so',
                     'label' => 'SO',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'serie',
                     'label' => 'Serie',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('computador/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'id_tipo' => $datos_recibidos['tipo'],
				'id_dominio' => $datos_recibidos['dominio'],
				'id_red' => $datos_recibidos['red'],
				'id_SO' => $datos_recibidos['so'],
				'id_SO' => $datos_recibidos['so'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$computador = $this->computador_model->save($datos);

			if($computador){

				//Historial** Creacion de computador
				$log = $this->historial_model->save(array(
					'fecha' => date("Y-m-d H:i:s"),
					'id_usuario' => $this->session->userdata('id'),
					'id_componente' => $computador,
					'componente' => 'computador',
					'descripcion' => 'Nuevo Computador',
					'ant_valor' => '',
					'new_valor' => $datos_recibidos['nombre']					
				));

				$link = anchor('computador/nuevo/'.$computador, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('computador/nuevo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('computador/nuevo', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y los envia al modelo para que actualice la informacion
	*/
	public function modificar()
	{
		$this->acceso_restringido();

		$config = array(
           array(
                 'field' => 'nombre',
                 'label' => 'Nombre',
                 'rules' => 'required'
              ),
           array(
                 'field' => 'ubicacion',
                 'label' => 'Ubicacion',
                 'rules' => 'required'
              ),
           array(
                 'field' => 'usuario',
                 'label' => 'Usuario',
                 'rules' => 'required'
              ),
           array(
                 'field' => 'estado',
                 'label' => 'Estado',
                 'rules' => 'required'
              ),   
           array(
                 'field' => 'so',
                 'label' => 'SO',
                 'rules' => 'required'
              ),
           array(
                 'field' => 'serie',
                 'label' => 'Serie',
                 'rules' => 'required'
              )
    	);

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('computador', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			//Estado anterior a modificar computador

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'id_tipo' => $datos_recibidos['tipo'],
				'id_dominio' => $datos_recibidos['dominio'],
				'id_red' => $datos_recibidos['red'],
				'id_SO' => $datos_recibidos['so'],
				'id_SO' => $datos_recibidos['so'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$computadores = $this->computador_model->update($datos_recibidos['id_computador'], $datos);

			if($computadores){

				$computador_ant = $this->computador_model->get($datos_recibidos['id_computador']);
				//Historial** 
				$log = $this->historial_model->save(array(
					'fecha' => date("Y-m-d H:i:s"),
					'id_usuario' => $this->session->userdata('id'),
					'id_componente' => $datos_recibidos['id_computador'],
					'componente' => 'computador',
					'descripcion' => 'Modifica Computador',
					'new_valor' => print_r($computador_ant, TRUE)		
				));

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('computador', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('computador', 'refresh');
			}

		}
		
	}

	/*
	* Procesa los datos y envia la peticion para eliminar el registro
	*/
	public function eliminar($id_computador)
	{
		$this->acceso_restringido();
		$computador = $this->computador_model->delete($id_computador);
		if(!$computador){
			$this->session->set_flashdata('mensaje', 'Computador eliminado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', 'Ocurrio un error al eliminar Computador');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('computador', 'refresh');
	}

	//Busca computadores segun el parametro $valor y las manda a la vista para ser agregado al select
	public function computador_select()
	{
		$nombre = $this->input->post('valor');
		$todos = $this->input->post('todos');
		
		if ($todos == 1) {
			$computadores = $this->computador_model->get_todos();
		}else{
			$computadores = $this->computador_model->buscar($nombre);
		}

		if(!$computadores){
			echo '<option value="">'.$this->lang->line('msj_error_resultado').'</option>';
		}else{
			foreach ($computadores as $row) {
				echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';
			}
		}
	}



	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */