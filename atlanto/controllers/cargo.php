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

	public function guardar()
	{
		$this->acceso_restringido();
		//reglas de validacion de formulario, en el server
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('tabla', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			if (isset($datos_recibidos['activado'])) {
				$activado = 1;
			}else
			{
				$activado = 2;
			}
			
			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$cargo = $this->cargo_model->save($datos);

			if($cargo){
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$datos_recibidos['nombre']." ".$this->lang->line('msj_ext_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('tabla', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('tabla', 'refresh');
			}
		}
	}

	//modificar va en la siguiente version

	public function eliminar($id_cargo)
	{
		$this->acceso_restringido();
		$usuario = $this->cargo_model->delete($id_cargo);
		if(!$usuario){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_car'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar_car'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('tabla', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */