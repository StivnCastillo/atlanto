<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('config_model'));
	}

	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_config'), '/configuracion');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$config = $this->config_model->get(array('id' => 1));

		$data = array(
			'titulo' => $this->lang->line('titulo_cargos'),
			'content' => 'configuraciones/index_view',
			'validador' => TRUE,
			'breadcrumbs' => $breadcrumbs,
			'config' => $config,
			'accion_general' => site_url('configuracion/modificar/1')
		);
		$this->load->view('template', $data);
	}

	public function nuevo($id_cargo = FALSE)
	{
		
	}

	public function guardar()
	{
		
	}

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