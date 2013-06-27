<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('usuario_model', 'rol_model', 'ubicacion_model'));
	}

	/*
	* Funcion index, aun sin funcionar
	 */
	
	public function index()
	{
		$data = array(
			'titulo' => $this->lang->line('titulo'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'index_view',
		);
		$this->load->view('template', $data);
	}

	/*
	* Crea una sesion del usuario
	 */

	public function login()
	{
		$datos = array(
			'usuario' => $this->input->post('usuario'),
			'pass' => md5($this->input->post('password')),
			'activo' => '1'
		);
		//verificar los datos del usuario
		$user = $this->usuario_model->get_usuario($datos);
		if(!$user){
			//Si el usuario es incorrecto
			//Guardar log de error
			$datos_log = array(
				'tipo' => $this->lang->line('log_tipo_error'),
				'titulo' => $this->lang->line('log_error_login'),
				'descripcion' => 'Usuario: '.$this->input->post('usuario').' IP: '.get_ip_cliente(),
				'direccion_ip' => get_ip_cliente(),
				'fecha' => date("Y-m-d H:i:s")
			);
			$this->log_model->save($datos_log);
			//redireccionar
			$this->session->set_flashdata('error_login', TRUE);
			redirect('panel', 'refresh');
		}else{
			$id_usuario = $user->id;
			$this->usuario_model->update($id_usuario, array('ultimo_ingreso' => date("Y-m-d H:i:s")));

			//Guarda datos de sesion		
			$datos_sesion = array(
               'nombre'  => $user->nombre." ".$user->apellido,
               'id'     => $user->id,
               'ingresado' => TRUE,
               'rol' => $user->id_rol
			);
			$this->session->set_userdata($datos_sesion); 

			redirect('panel/escritorio', 'refresh');
		}
	}

	/*
	* Destruye sesion de usuario
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('panel', 'refresh');
	}

	/*
	* Muestra formulario para la creacion de un nuevo usuario
	 */
	
	public function nuevo_usuario()
	{
		//Traer los roles
		$roles = $this->rol_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'usuarios/save_view',
			'validador' => TRUE,
			'roles' => $roles,
			'accion_ubicacion' => site_url('buscar_ubicacion'),
			'accion_departamento' => site_url('buscar_departamento'),
			'accion_cargo' => site_url('buscar_cargo')
		);
		$this->load->view('template', $data);
	}

	/*
	* Procesa datos de usuario y los guarda en la base de datos
	 */
	
	public function guardar()
	{
		# code...
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */