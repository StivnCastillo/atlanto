<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ubicacion extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('ubicacion_model'));
	}

	public function index()
	{
		$this->acceso_restringido();
		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_ubicacion'), '/ubicacion');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$ubicaciones = $this->ubicacion_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_ubicaciones'),
			'content' => 'ubicaciones/index_view',
			'validador' => TRUE,
			'breadcrumbs' => $breadcrumbs,
			'ubicaciones' => $ubicaciones
		);
		$this->load->view('template', $data);
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
				echo '<option value="'.$row->id.'">'.$row->nombre.' '.$row->apellido.'</option>';
			}
		}
	}

	public function nuevo($id_ubicacion = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_ubicacion'), '/ubicacion');
		$this->breadcrumbs->push($this->lang->line('bre_nueva_ubicacion'), '/ubicacion/nueva');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();
		
		$data = array(
			'titulo' => $this->lang->line('titulo_titulos'),
			'content' => 'ubicaciones/save_view',
			'validador' => TRUE,
			'breadcrumbs' => $breadcrumbs,
			'accion_guardar' => site_url('ubicacion/guardar'),
			'accion_modificar' => site_url('ubicacion/modificar')
		);

		$data['ubicaciones'] = $this->ubicacion_model->get_todos();

		if($id_ubicacion){
			$data['ubicacion'] = $this->ubicacion_model->get_ubicacion(array('id' => $id_ubicacion));
			$data['id_ubicacion'] = $id_ubicacion;
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
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('ubicacion', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);
			//Verificar nivel
			if ($datos_recibidos['id_padre'] != 0) {
				$datos_u = array('id' => $datos_recibidos['id_padre']);
				$ubicacion = $this->ubicacion_model->get_ubicacion($datos_u);
				$nivel = $ubicacion->nivel + 1;
			}else{
				$nivel = 1;
			}
			

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_padre' => $datos_recibidos['id_padre'],
				'descripcion' => $datos_recibidos['descripcion'],
				'nivel' => $nivel,
				'piso' => $datos_recibidos['piso']
			);

			$ubicacion = $this->ubicacion_model->save($datos);
			//Para abrir la pestaña
			$this->session->set_flashdata('seccion', 'ubicacion');
			if($ubicacion){
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$datos_recibidos['nombre']." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('ubicacion', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('ubicacion', 'refresh');
			}
		}
	}

	public function modificar()
	{
		$this->acceso_restringido();
		$id_ubicacion = $this->input->post('id_ubicacion');
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
			
			redirect('ubicacion', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_padre' => $datos_recibidos['id_padre'],
				'piso' => $datos_recibidos['piso'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$ubicacion = $this->ubicacion_model->update($id_ubicacion, $datos);

			if($ubicacion){
				$link = anchor('ubicacion/nuevo/'.$id_ubicacion, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('ubicacion', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('ubicacion', 'refresh');
			}
		}
	}

	public function eliminar($id_ubicacion)
	{
		$this->acceso_restringido();
		$usuario = $this->ubicacion_model->delete($id_ubicacion);
		if(!$usuario){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_ubi'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar_ubi'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('ubicacion', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */