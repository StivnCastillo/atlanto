<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dominio extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(array('dominio_model'));
	}

	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_dominios'), '/dominio');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$dominios = $this->dominio_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_dominios'),
			'content' => 'dominios/index_view',
			'breadcrumbs' => $breadcrumbs,
			'dominios' => $dominios
		);
		$this->load->view('template', $data);
	}

	/*
	* Muestra formulario para agregar nuevo elemento
	*/
	public function nuevo($id_dominio = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_dominios'), '/dominio');
		$this->breadcrumbs->push($this->lang->line('bre_dominios_nuevo'), '/dominio/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_dominios'),
			'content' => 'dominios/save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion_guardar' => site_url('dominio/guardar'),
			'accion_modificar' => site_url('dominio/modificar')
		);

		if($id_dominio){
			$data['dominio'] = $this->dominio_model->get_dominio(array('id' => $id_dominio));
			$data['id_dominio'] = $id_dominio;
		}

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
                     'field' => 'ip_server',
                     'label' => 'IP Server',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('dominio', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);
			
			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'ip_server' => $datos_recibidos['ip_server'],
				'ip_server_opcional' => $datos_recibidos['ip_server_opcional'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$dominio = $this->dominio_model->save($datos);
			//Para abrir la pestaña
			$this->session->set_flashdata('seccion', 'dominio');
			if($dominio){
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$datos_recibidos['nombre']." ".$this->lang->line('msj_ext_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('dominio', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('dominio', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y los envia al modelo para que actualice la informacion
	*/
	public function modificar()
	{
		$this->acceso_restringido();
		$id_dominio = $this->input->post('id_dominio');
		//reglas de validacion de formulario, en el server
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'ip_server',
                     'label' => 'IP Server',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('dominio', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'ip_server' => $datos_recibidos['ip_server'],
				'ip_server_opcional' => $datos_recibidos['ip_server_opcional'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$dominio = $this->dominio_model->update($id_dominio, $datos);

			if($dominio){
				$link = anchor('dominio/nuevo/'.$id_dominio, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('dominio', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('dominio', 'refresh');
			}
		}
	}

	public function eliminar($id_dominio)
	{
		$this->acceso_restringido();
		$dominio = $this->dominio_model->delete($id_dominio);
		if(!$dominio){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_est'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('dominio', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}

}