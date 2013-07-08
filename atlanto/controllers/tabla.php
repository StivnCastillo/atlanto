<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tabla extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('usuario_model', 'cargo_model', 'departamento_model', 'ubicacion_model'));
	}

	public function index()
	{
		$validador = TRUE;
		$cargos = $this->cargo_model->get_todos();
		$departamentos = $this->departamento_model->get_todos();
		$ubicaciones = $this->ubicacion_model->get_todos();
		$data = array(
			'titulo' => $this->lang->line('titulo_tablas'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'tablas/index_view',
			'validador' => $validador,
			'seccion' => 'cargo',
			'cargos' => $cargos,
			'accion_cargos' => site_url('cargo/guardar'),
			'departamentos' => $departamentos,
			'accion_departamento' => site_url('departamento/guardar'),
			'ubicaciones' => $ubicaciones,
			'accion_ubicacion' => site_url('ubicacion/guardar')
		);

		$this->load->view('template', $data);
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */