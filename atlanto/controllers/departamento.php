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
		$this->acceso_restringido();

		$departamentos = $this->departamento_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_departamentos'),
			'content' => 'departamentos/index_view',
			'validador' => TRUE,
			'departamentos' => $departamentos
		);
		$this->load->view('template', $data);
	}

	public function nuevo($id_departamento = FALSE)
	{
		$this->acceso_restringido();
		$data = array(
			'titulo' => $this->lang->line('titulo_titulos'),
			'content' => 'departamentos/save_view',
			'validador' => TRUE,
			'accion_guardar' => site_url('departamento/guardar'),
			'accion_modificar' => site_url('departamento/modificar')
		);

		$data['departamentos'] = $this->departamento_model->get_todos();

		if($id_departamento){
			$data['departamento'] = $this->departamento_model->get_departamento(array('id' => $id_departamento));
			$data['id_departamento'] = $id_departamento;
		}

		$this->load->view('template', $data);
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
			
			redirect('departamento', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$departamento = $this->departamento_model->save($datos);
			//Para abrir la pestaña
			$this->session->set_flashdata('seccion', 'departamento');
			if($departamento){
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$datos_recibidos['nombre']." ".$this->lang->line('msj_ext_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('departamento', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('departamento', 'refresh');
			}
		}
	}

	public function modificar()
	{
		$this->acceso_restringido();
		$id_departamento = $this->input->post('id_departamento');
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
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('departamento', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$departamento = $this->departamento_model->update($id_departamento, $datos);

			if($departamento){
				$link = anchor('departamento/nuevo/'.$id_departamento, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('departamento', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('departamento', 'refresh');
			}
		}
	}

	public function eliminar($id_departamento)
	{
		$this->acceso_restringido();
		$usuario = $this->departamento_model->delete($id_departamento);
		if(!$usuario){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_car'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar_car'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('departamento', 'refresh');
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

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */