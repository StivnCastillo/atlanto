<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ubicacion extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('ubicacion_model', 'rol_model'));
	}

	public function index()
	{

	}

	//Busca ubicaciones segun el parametro $valor y las manda a la vista para ser agregado al select
	public function ubicaciones_select()
	{
		$nombre = $this->input->post('valor');
		$todos = $this->input->post('todos');
		
		if ($todos == 1) {
			$ubicaciones = $this->ubicacion_model->get_todos();
		}else{
			$ubicaciones = $this->ubicacion_model->buscar($nombre);
		}

		if(!$ubicaciones){
			echo '<option value="">'.$this->lang->line('msj_error_resultado').'</option>';
		}else{
			foreach ($ubicaciones as $row) {
				echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */