<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cargo extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(array('cargo_model', 'rol_model'));
	}

	/*
	* funcion inicial del controlador, datos tabulados
	*/
	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_cargo'), '/cargo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$cargos = $this->cargo_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_cargos'),
			'content' => 'cargos/index_view',
			'validador' => TRUE,
			'breadcrumbs' => $breadcrumbs,
			'cargos' => $cargos
		);
		$this->load->view('template', $data);
	}

	/*
	* Busca departamento segun el parametro $valor y las manda a la vista para ser agregado al select
	*/
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

	/*
	* Muestra formulario para agregar nuevo elemento
	*/
	public function nuevo($id_cargo = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_cargo'), '/cargo');
		$this->breadcrumbs->push($this->lang->line('bre_nuevo_cargo'), '/cargo/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_titulos'),
			'content' => 'cargos/save_view',
			'validador' => TRUE,
			'breadcrumbs' => $breadcrumbs,
			'accion_guardar' => site_url('cargo/guardar'),
			'accion_modificar' => site_url('cargo/modificar')
		);

		$data['cargos'] = $this->cargo_model->get_todos();

		if($id_cargo){
			$data['cargo'] = $this->cargo_model->get_cargo(array('id' => $id_cargo));
			$data['id_cargo'] = $id_cargo;
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
                  )
        );

		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('cargo', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);
			
			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$cargo = $this->cargo_model->save($datos);
			//Para abrir la pestaña
			$this->session->set_flashdata('seccion', 'cargo');
			if($cargo){
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$datos_recibidos['nombre']." ".$this->lang->line('msj_ext_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('cargo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('cargo', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y los envia al modelo para que actualice la informacion
	*/
	public function modificar()
	{
		$this->acceso_restringido();
		$id_cargo = $this->input->post('id_cargo');
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
			
			redirect('cargo', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$cargo = $this->cargo_model->update($id_cargo, $datos);

			if($cargo){
				$link = anchor('cargo/nuevo/'.$id_cargo, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('cargo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('cargo', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y envia la peticion para eliminar el registro
	*/
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

		redirect('cargo', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */