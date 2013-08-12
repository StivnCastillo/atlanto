<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Red extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(array('red_model'));
	}

	/*
	* funcion inicial del controlador, datos tabulados
	*/
	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_red'), '/red');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$redes = $this->red_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_redes'),
			'content' => 'redes/index_view',
			'breadcrumbs' => $breadcrumbs,
			'redes' => $redes
		);
		$this->load->view('template', $data);
	}

	/*
	* Muestra formulario para agregar nuevo elemento
	*/
	public function nuevo($id_red = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->push($this->lang->line('bre_red'), '/red');
		$this->breadcrumbs->push($this->lang->line('bre_red_nuevo'), '/red/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_redes'),
			'content' => 'redes/save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion_guardar' => site_url('red/guardar'),
			'accion_modificar' => site_url('red/modificar')
		);

		if($id_red){
			$data['red'] = $this->red_model->get_red(array('id' => $id_red));
			$data['id_red'] = $id_red;
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
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('red', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);
			
			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$red = $this->red_model->save($datos);
			//Para abrir la pestaña
			$this->session->set_flashdata('seccion', 'red');
			if($red){
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$datos_recibidos['nombre']." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('red', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('red', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y los envia al modelo para que actualice la informacion
	*/
	public function modificar()
	{
		$this->acceso_restringido();
		$id_red = $this->input->post('id_red');
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
			
			redirect('red', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'descripcion' => $datos_recibidos['descripcion']
			);

			$red = $this->red_model->update($id_red, $datos);

			if($red){
				$link = anchor('red/nuevo/'.$id_red, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('red', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('red', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y envia la peticion para eliminar el registro
	*/
	public function eliminar($id_red)
	{
		$this->acceso_restringido();
		$red = $this->red_model->delete($id_red);
		if(!$red){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_car'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar_car'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('red', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */