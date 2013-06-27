<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cargo extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('cargo_model', 'rol_model'));
	}

	public function index()
	{

	}

	//Busca departamento segun el parametro $valor y las manda a la vista para ser agregado al select
	public function cargo_select()
	{
		$nombre = $this->input->post('valor');
		$todos = $this->input->post('todos');
		
		if ($todos == 1) {
			$cargos = $this->cargo_model->get_todos();
		}else{
			$cargos = $this->cargo_model->buscar($nombre);
		}

		if(!$cargos){
			echo '<option value="">'.$this->lang->line('msj_error_resultado').'</option>';
		}else{
			foreach ($cargos as $row) {
				echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */