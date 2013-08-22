<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Componente extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(array('componente_model', 'interfaz_model', 'tipo_model'));
	}

	/*
	* funcion inicial del controlador, datos tabulados
	*/
	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_componente'), '/componente');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_componentes'),
			'content' => 'componentes/index_view',
			'breadcrumbs' => $breadcrumbs
		);
		$this->load->view('template', $data);
	}

	/*
	* Discoduro
	*/
	public function index_discoduro()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_componente'), '/componente');
		$this->breadcrumbs->push($this->lang->line('bre_componente_dd'), '/componente/discoduro');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$discos = $this->componente_model->get_discosduro();

		$data = array(
			'titulo' => $this->lang->line('titulo_comp_dd'),
			'content' => 'componentes/discoduro_index_view',
			'breadcrumbs' => $breadcrumbs,
			'discos' => $discos
		);
		$this->load->view('template', $data);
	}

	public function nuevo_discoduro($id_discoduro = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_componente'), '/componente');
		$this->breadcrumbs->push($this->lang->line('bre_componente_dd'), '/componente/discoduro');
		$this->breadcrumbs->push($this->lang->line('bre_componente_dd_nuevo'), '/componente/nuevo_discoduro');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$interfaz = $this->interfaz_model->get_comp_todos();

		$data = array(
			'titulo' => $this->lang->line('bre_componente_dd_nuevo'),
			'content' => 'componentes/discoduro_save_view',
			'breadcrumbs' => $breadcrumbs,
			'interfaz' => $interfaz,
			'accion_guardar' => site_url('componente/guardar_discoduro'),
			'accion_modificar' => site_url('componente/modificar_discoduro')
		);

		if($id_discoduro){
			$data['componente'] = $this->componente_model->get_discosduro($id_discoduro);
			$data['id_discoduro'] = $id_discoduro;
		}

		$this->load->view('template', $data);
	}
	
	public function guardar_discoduro()
	{
		$this->acceso_restringido();
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'cache',
                     'label' => 'Caché',
                     'rules' => 'required|number'
                  ),
               array(
                     'field' => 'rpm',
                     'label' => 'RPM',
                     'rules' => 'required|number'
                  ), 
               array(
                     'field' => 'interfaz',
                     'label' => 'Interfaz',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'capacidad',
                     'label' => 'Capacidad',
                     'rules' => 'required|number'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('componente/nuevo_discoduro', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_interfaz' => $datos_recibidos['interfaz'],
				'fabricante' => $datos_recibidos['fabricante'],
				'capacidad' => $datos_recibidos['capacidad'],
				'rpm' => $datos_recibidos['rpm'],
				'cache' => $datos_recibidos['cache'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$componente = $this->componente_model->save_discoduro($datos);

			if($componente){
				$link = anchor('componente/nuevo_discoduro/'.$componente, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('componente/nuevo_discoduro', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('componente/nuevo_discoduro', 'refresh');
			}
		}
	}

	public function modificar_discoduro()
	{
		$this->acceso_restringido();
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'cache',
                     'label' => 'Caché',
                     'rules' => 'required|number'
                  ),
               array(
                     'field' => 'rpm',
                     'label' => 'RPM',
                     'rules' => 'required|number'
                  ), 
               array(
                     'field' => 'interfaz',
                     'label' => 'Interfaz',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'capacidad',
                     'label' => 'Capacidad',
                     'rules' => 'required|number'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('componente/nuevo_discoduro', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_interfaz' => $datos_recibidos['interfaz'],
				'fabricante' => $datos_recibidos['fabricante'],
				'capacidad' => $datos_recibidos['capacidad'],
				'rpm' => $datos_recibidos['rpm'],
				'cache' => $datos_recibidos['cache'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$componente = $this->componente_model->update_discoduro($datos_recibidos['id_discoduro'],$datos);

			if($componente){
				$link = anchor('componente/nuevo_discoduro/'.$componente, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('componente/discoduro', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('componente/discoduro', 'refresh');
			}
		}
	}

	public function eliminar_discoduro($id)
	{
		$this->acceso_restringido();
		$componente = $this->componente_model->delete_discoduro($id);
		if(!$componente){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_dd'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('componente/discoduro', 'refresh');
	}


	/*
	* Procesador
	*/
	public function index_procesador()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_componente'), '/componente');
		$this->breadcrumbs->push($this->lang->line('bre_componente_procesador'), '/componente/procesador');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$procesador = $this->componente_model->get_procesador();

		$data = array(
			'titulo' => $this->lang->line('titulo_comp_pro'),
			'content' => 'componentes/procesador_index_view',
			'breadcrumbs' => $breadcrumbs,
			'procesador' => $procesador
		);
		$this->load->view('template', $data);
	}

	public function nuevo_procesador($id_procesador = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_componente'), '/componente');
		$this->breadcrumbs->push($this->lang->line('bre_componente_procesador'), '/componente/procesador');
		$this->breadcrumbs->push($this->lang->line('bre_componente_pro_nuevo'), '/componente/nuevo_procesador');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('bre_componente_dd_nuevo'),
			'content' => 'componentes/procesador_save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion_guardar' => site_url('componente/guardar_procesador'),
			'accion_modificar' => site_url('componente/modificar_procesador')
		);

		if($id_procesador){
			$data['componente'] = $this->componente_model->get_procesador($id_procesador);
			$data['id_procesador'] = $id_procesador;
		}

		$this->load->view('template', $data);
	}

	public function guardar_procesador()
	{
		$this->acceso_restringido();
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'frecuencia',
                     'label' => 'Frecuencia',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('componente/nuevo_procesador', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'frecuencia' => $datos_recibidos['frecuencia'],
				'fabricante' => $datos_recibidos['fabricante'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$componente = $this->componente_model->save_procesador($datos);

			if($componente){
				$link = anchor('componente/nuevo_procesador/'.$componente, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('componente/nuevo_procesador', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('componente/nuevo_procesador', 'refresh');
			}
		}
	}

	public function modificar_procesador()
	{
		$this->acceso_restringido();
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'frecuencia',
                     'label' => 'Frecuencia',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('componente/nuevo_procesador', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'frecuencia' => $datos_recibidos['frecuencia'],
				'fabricante' => $datos_recibidos['fabricante'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$componente = $this->componente_model->update_procesador($datos_recibidos['id_procesador'],$datos);

			if($componente){
				$link = anchor('componente/nuevo_procesador/'.$componente, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('componente/procesador', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('componente/procesador', 'refresh');
			}
		}
	}

	public function eliminar_procesador($id)
	{
		$this->acceso_restringido();
		$componente = $this->componente_model->delete_procesador($id);
		if(!$componente){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_dd'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('componente/procesador', 'refresh');
	}

	/*
	* Memoria
	*/
	public function index_memoria()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_componente'), '/componente');
		$this->breadcrumbs->push($this->lang->line('bre_componente_memoria'), '/componente/memoria');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$memoria = $this->componente_model->get_memoria();

		$data = array(
			'titulo' => $this->lang->line('titulo_comp_mem'),
			'content' => 'componentes/memoria_index_view',
			'breadcrumbs' => $breadcrumbs,
			'memoria' => $memoria
		);
		$this->load->view('template', $data);
	}

	public function nuevo_memoria($id_memoria = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_componente'), '/componente');
		$this->breadcrumbs->push($this->lang->line('bre_componente_memoria'), '/componente/memoria');
		$this->breadcrumbs->push($this->lang->line('bre_componente_mem_nuevo'), '/componente/nuevo_memoria');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$tipo = $this->tipo_model->get_mem_todos();

		$data = array(
			'titulo' => $this->lang->line('bre_componente_mem_nuevo'),
			'content' => 'componentes/memoria_save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion_guardar' => site_url('componente/guardar_memoria'),
			'accion_modificar' => site_url('componente/modificar_memoria'),
			'tipo' => $tipo
		);

		if($id_memoria){
			$data['componente'] = $this->componente_model->get_memoria($id_memoria);
			$data['id_memoria'] = $id_memoria;
		}

		$this->load->view('template', $data);
	}

	public function guardar_memoria()
	{
		$this->acceso_restringido();
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tipo',
                     'label' => 'Tipo',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tamano',
                     'label' => 'tamano',
                     'rules' => 'required|number'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('componente/nuevo_memoria', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'frecuencia' => $datos_recibidos['frecuencia'],
				'tamano' => $datos_recibidos['tamano'],
				'id_memoria_tipo' => $datos_recibidos['tipo'],
				'fabricante' => $datos_recibidos['fabricante'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$componente = $this->componente_model->save_memoria($datos);

			if($componente){
				$link = anchor('componente/nuevo_memoria/'.$componente, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('componente/nuevo_memoria', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('componente/nuevo_memoria', 'refresh');
			}
		}
	}

	public function modificar_memoria()
	{
		$this->acceso_restringido();
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tipo',
                     'label' => 'Tipo',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tamano',
                     'label' => 'tamano',
                     'rules' => 'required|number'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('componente/memoria', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'frecuencia' => $datos_recibidos['frecuencia'],
				'tamano' => $datos_recibidos['tamano'],
				'id_memoria_tipo' => $datos_recibidos['tipo'],
				'fabricante' => $datos_recibidos['fabricante'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$componente = $this->componente_model->update_memoria($datos_recibidos['id_memoria'],$datos);

			if($componente){
				$link = anchor('componente/nuevo_memoria/'.$componente, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('componente/memoria', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('componente/memoria', 'refresh');
			}
		}
	}

	public function eliminar_memoria($id)
	{
		$this->acceso_restringido();
		$componente = $this->componente_model->delete_memoria($id);
		if(!$componente){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_dd'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('componente/memoria', 'refresh');
	}

	/*
	* Tarjeta de Video
	*/
	public function index_tvideo()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_componente'), '/componente');
		$this->breadcrumbs->push($this->lang->line('bre_componente_tvideo'), '/componente/tvideo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$tvideo = $this->componente_model->get_tvideo();

		$data = array(
			'titulo' => $this->lang->line('titulo_comp_tvideo'),
			'content' => 'componentes/tvideo_index_view',
			'breadcrumbs' => $breadcrumbs,
			'tvideo' => $tvideo
		);
		$this->load->view('template', $data);
	}

	public function nuevo_tvideo($id_tvideo = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_componente'), '/componente');
		$this->breadcrumbs->push($this->lang->line('bre_componente_tvideo'), '/componente/tvideo');
		$this->breadcrumbs->push($this->lang->line('bre_componente_tarjeta_nuevo'), '/componente/nuevo_tvideo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$interfaz = $this->componente_model->get_interfaz_tarjeta();

		$data = array(
			'titulo' => $this->lang->line('bre_componente_mem_nuevo'),
			'content' => 'componentes/tvideo_save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion_guardar' => site_url('componente/guardar_tvideo'),
			'accion_modificar' => site_url('componente/modificar_tvideo'),
			'interfaz' => $interfaz
		);

		if($id_tvideo){
			$data['componente'] = $this->componente_model->get_tvideo($id_tvideo);
			$data['id_tvideo'] = $id_tvideo;
		}

		$this->load->view('template', $data);
	}
	public function guardar_tvideo()
	{
		$this->acceso_restringido();
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'interfaz',
                     'label' => 'Interfaz',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('componente/nuevo_tvideo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'memoria' => $datos_recibidos['memoria'],
				'id_interfaz' => $datos_recibidos['interfaz'],
				'fabricante' => $datos_recibidos['fabricante'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$componente = $this->componente_model->save_tvideo($datos);

			if($componente){
				$link = anchor('componente/nuevo_tvideo/'.$componente, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('componente/tarjeta_video', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('componente/tarjeta_video', 'refresh');
			}
		}
	}

	public function modificar_tvideo()
	{
		$this->acceso_restringido();
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'interfaz',
                     'label' => 'Interfaz',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('componente/tarjeta_video', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'memoria' => $datos_recibidos['memoria'],
				'id_interfaz' => $datos_recibidos['interfaz'],
				'fabricante' => $datos_recibidos['fabricante'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$componente = $this->componente_model->update_tvideo($datos_recibidos['id_tvideo'],$datos);

			if($componente){
				$link = anchor('componente/nuevo_tvideo/'.$componente, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('componente/tarjeta_video', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('componente/tarjeta_video', 'refresh');
			}
		}
	}

	public function eliminar_tvideo($id)
	{
		$this->acceso_restringido();
		$componente = $this->componente_model->delete_tvideo($id);
		if(!$componente){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_dd'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('componente/tarjeta_video', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}