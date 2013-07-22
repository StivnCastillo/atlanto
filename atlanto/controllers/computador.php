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
					'estadocomputador_model', 
					'tipocomputador_model', 
					'so_model', 
					'red_model'
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
			'validador' => TRUE,
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
		$estados = $this->estadocomputador_model->get_todos();
		$tipos = $this->tipocomputador_model->get_todos();
		$sistema_o = $this->so_model->get_todos();
		$sistema_tipo = $this->so_model->get_tipos();
		$redes = $this->red_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_com'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'computadores/save_view',
			'validador' => TRUE,
			'breadcrumbs' => $breadcrumbs,
			'dominios' => $dominios,
			'redes' => $redes,
			'estados' => $estados,
			'tipos' => $tipos,
			'sistema_o' => $sistema_o,
			'sistema_tipo' => $sistema_tipo,
			'accion_guardar' => site_url('computador/guardar'),
			'accion_modificar' => site_url('computador/modificar'),
			'accion_ubicacion' => site_url('buscar_ubicacion'),
			'accion_usuario' => site_url('buscar_usuario'),
			'accion_cargo' => site_url('buscar_cargo')
		);

		$this->load->view('template', $data);
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
                     'field' => 'so_tipo',
                     'label' => 'SO_tipo',
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
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
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
				$link = anchor('computador/nuevo/'.$computador, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('computador/nuevo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('computador/nuevo', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y los envia al modelo para que actualice la informacion
	*/
	public function modificar($tipo)
	{
		$this->acceso_restringido();
		//Configuracion general
		if($tipo == 1){
			$val = array(
	               array(
	                     'field' => 'nombre',
	                     'label' => 'Nombre',
	                     'rules' => 'required'
	                  ),
	               array(
	                     'field' => 'pie_pagina',
	                     'label' => 'pie_pagina',
	                     'rules' => 'required'
	                  ),
	               array(
	                     'field' => 'texto_inicio',
	                     'label' => 'texto_inicio',
	                     'rules' => 'required'
	                  )
	        );

	        $this->form_validation->set_rules($val);
	        if ($this->form_validation->run() == FALSE)
			{
			    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('configuracion', 'refresh');
			}else{
				$datos_recibidos = $this->input->post(NULL, TRUE);

				$datos = array(
					'texto_inicio' => $datos_recibidos['texto_inicio'],
					'texto_pie_pagina' => $datos_recibidos['pie_pagina'],
					'nombre_sistema' => $datos_recibidos['nombre']
				);

				$config = $this->config_model->update(1, $datos);

				if($config){
					$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$this->lang->line('msj_ext_config'));
					$this->session->set_flashdata('tipo_mensaje', 'exito');
					
					redirect('configuracion', 'refresh');
				}else{

					$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
					$this->session->set_flashdata('tipo_mensaje', 'error');
					
					redirect('configuracion', 'refresh');
				}

			}
		}

	}

	/*
	* Procesa los datos y envia la peticion para eliminar el registro
	*/
	public function eliminar($id_cargo)
	{
		
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */