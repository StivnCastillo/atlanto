<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sistema_operativo extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(array('so_model', 'tipo_model'));
	}

	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_so'), '/sistema_operativo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$so = $this->so_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_so'),
			'content' => 'so/index_view',
			'breadcrumbs' => $breadcrumbs,
			'so' => $so
		);
		$this->load->view('template', $data);
	}

	/*
	* Muestra formulario para agregar nuevo elemento
	*/
	public function nuevo($id_sistema_operativo = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_so'), '/sistema_operativo');
		$this->breadcrumbs->push($this->lang->line('bre_so_nuevo'), '/sistema_operativo/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$tipos = $this->tipo_model->get_so_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_estados'),
			'content' => 'so/save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion_guardar' => site_url('sistema_operativo/guardar'),
			'accion_modificar' => site_url('sistema_operativo/modificar'),
			'tipos' => $tipos
		);

		if($id_sistema_operativo){
			$data['sistema_operativo'] = $this->so_model->get_so($id_sistema_operativo);
			$data['id_sistema_operativo'] = $id_sistema_operativo;
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
                  ),
               array(
                     'field' => 'version',
                     'label' => 'Version',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tipo',
                     'label' => 'Tipo',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('sistema_operativo', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);
			
			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'version' => $datos_recibidos['version'],
				'id_tipo_sistema' => $datos_recibidos['tipo'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$sistema_operativo = $this->so_model->save($datos);
			//Para abrir la pestaña
			$this->session->set_flashdata('seccion', 'sistema_operativo');
			if($sistema_operativo){
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$datos_recibidos['nombre']." ".$this->lang->line('msj_ext_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('sistema_operativo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('sistema_operativo', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y los envia al modelo para que actualice la informacion
	*/
	public function modificar()
	{
		$this->acceso_restringido();
		$id_sistema_operativo = $this->input->post('id_sistema_operativo');
		//reglas de validacion de formulario, en el server
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'version',
                     'label' => 'Version',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tipo',
                     'label' => 'Tipo',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('sistema_operativo', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'version' => $datos_recibidos['version'],
				'id_tipo_sistema' => $datos_recibidos['tipo'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$sistema_operativo = $this->so_model->update($id_sistema_operativo, $datos);

			if($sistema_operativo){
				$link = anchor('sistema_operativo/nuevo/'.$id_sistema_operativo, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('sistema_operativo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('sistema_operativo', 'refresh');
			}
		}
	}

	public function eliminar($id_sistema_operativo)
	{
		$this->acceso_restringido();
		$sistema_operativo = $this->so_model->delete($id_sistema_operativo);
		if(!$sistema_operativo){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_so'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('sistema_operativo', 'refresh');
	}


	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}