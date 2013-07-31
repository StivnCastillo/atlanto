<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estado extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(array('estadocomputador_model'));
	}

	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_estados'), '/estado');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$estados = $this->estadocomputador_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_estados'),
			'content' => 'estados/index_view',
			'breadcrumbs' => $breadcrumbs,
			'estados' => $estados
		);
		$this->load->view('template', $data);
	}

	/*
	* Muestra formulario para agregar nuevo elemento
	*/
	public function nuevo($id_estado = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_estados'), '/estado');
		$this->breadcrumbs->push($this->lang->line('bre_estados_nuevo'), '/estado/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_estados'),
			'content' => 'estados/save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion_guardar' => site_url('estado/guardar'),
			'accion_modificar' => site_url('estado/modificar')
		);

		if($id_estado){
			$data['estado'] = $this->estadocomputador_model->get_estado(array('id' => $id_estado));
			$data['id_estado'] = $id_estado;
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
			
			redirect('estado', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);
			
			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$estado = $this->estadocomputador_model->save($datos);
			//Para abrir la pestaña
			$this->session->set_flashdata('seccion', 'estado');
			if($estado){
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$datos_recibidos['nombre']." ".$this->lang->line('msj_ext_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('estado', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('estado', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y los envia al modelo para que actualice la informacion
	*/
	public function modificar()
	{
		$this->acceso_restringido();
		$id_estado = $this->input->post('id_estado');
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
			
			redirect('estado', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$estado = $this->estadocomputador_model->update($id_estado, $datos);

			if($estado){
				$link = anchor('estado/nuevo/'.$id_estado, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('estado', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('estado', 'refresh');
			}
		}
	}

	public function eliminar($id_estado)
	{
		$this->acceso_restringido();
		$estado = $this->estadocomputador_model->delete($id_estado);
		if(!$estado){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_est'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('estado', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */