<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departamento extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('departamento_model', 'rol_model'));
	}

	public function index()
	{

	}

	//Busca departamento segun el parametro $valor y las manda a la vista para ser agregado al select
	public function departamento_select()
	{
		$nombre = $this->input->post('valor');
		$todos = $this->input->post('todos');
		
		if ($todos == 1) {
			$departamentos = $this->departamento_model->get_todos();
		}else{
			$departamentos = $this->departamento_model->buscar($nombre);
		}		
		
		if(!$departamentos){
			echo '<option value="">'.$this->lang->line('msj_error_resultado').'</option>';
		}else{
			foreach ($departamentos as $row) {
				echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */