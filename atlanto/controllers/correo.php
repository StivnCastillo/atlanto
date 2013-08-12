<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correo extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('correo_model'));
	}

	public function index()
	{
		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_usuarios'), '/panel/correo_corporativo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_correo'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'correo_view',
			'validador' => FALSE,
			'accion' => site_url('correo'),
			'accion_entrar' => site_url('panel/correo_administrar'),
			'config' => config_general(),
			'breadcrumbs' => $breadcrumbs
		);

		if($this->input->post('cedula')){
			$this->load->model('correo_model');

			$datos = array('cedula' => $this->input->post('cedula'));
			$correo = $this->correo_model->get($datos);

			$data['correo'] = $correo;

			if($correo){
				$exito = TRUE;
			}else{
				$exito = FALSE;
			}

			$data['exito'] = $exito;
		}

		$this->load->view('template', $data);
	}

	public function correos()
	{
		$this->acceso_restringido();
		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_usuarios'), '/correo/correos');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel');
		$breadcrumbs = $this->breadcrumbs->show();

		$correos = $this->correo_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_correo'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'correo/tabla_view',
			'breadcrumbs' => $breadcrumbs,
			'correos' => $correos
		);

		$this->load->view('template', $data);
	}


	public function nuevo()
	{
		$this->acceso_restringido();
		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_correo'), '/correo/correos');
		$this->breadcrumbs->push($this->lang->line('bre_correo_nuevo'), '/correo/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_correo'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'correo/save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion' => site_url('correo/guardar')
		);

		$this->load->view('template', $data);
	}

	public function guardar()
	{
		$this->acceso_restringido();
		//reglas de validacion de formulario, en el server
		$config = array(
			   array(
                     'field' => 'cedula',
                     'label' => 'Cedula',
                     'rules' => 'required|numeric'
                  ),
               array(
                     'field' => 'nombre1',
                     'label' => 'Nombre1',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'apellido1',
                     'label' => 'Apellido1',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'apellido2',
                     'label' => 'Apellido2',
                     'rules' => 'required'
                  ) ,
               array(
                     'field' => 'cargo',
                     'label' => 'Cargo',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config); 
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('correo/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);
			$nombre = strtoupper($datos_recibidos['apellido1']." ".$datos_recibidos['apellido2']." ".$datos_recibidos['nombre1']." ".$datos_recibidos['nombre2']);

			$datos = array(
				'nombre' => $nombre,
				'cedula' => $datos_recibidos['cedula'],
				'cargo' => strtoupper($datos_recibidos['cargo']),
				'correo' => $datos_recibidos['correofinal'],
				'creado' => 0,
				'eliminado' => 0
			);

			$correos = $this->correo_model->save($datos);

			if($correos){
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('correo/nuevo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('correo/nuevo', 'refresh');
			}
		}

	}
	

	public function cambiar_estado()
	{
		$this->acceso_restringido();
		$id = $this->input->post('id');
		$valor = $this->input->post('valor');
		$tarea = $this->correo_model->update($id, array('creado' => $valor));
		echo $tarea;
	}

	public function buscar()
	{
		$correo = $this->input->post('correo');
		$datos = array('correo' => $correo);
		$correos = $this->correo_model->get($datos);
		echo ($correos) ? '1' : '0';
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */