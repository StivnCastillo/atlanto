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
	public function nuevo_usuario($id_usuario = 0)
	{
		$this->acceso_restringido();
		
		////Traer los roles
		$roles = $this->rol_model->get_todos();
		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_usuario'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'usuarios/save_view',
			'validador' => TRUE,
			'roles' => $roles,
			'accion_guardar' => site_url('usuario/guardar'),
			'accion_modificar' => site_url('usuario/modificar'),
			'accion_ubicacion' => site_url('buscar_ubicacion'),
			'accion_departamento' => site_url('buscar_departamento'),
			'accion_cargo' => site_url('buscar_cargo')
		);
		//Para cargar los datos del usuario en el formulario
		if ($id_usuario>0) {
			$usuario = $this->usuario_model->get_usuario($id_usuario);

			$data['usuario'] = $usuario;
			$data['id_usuario'] = $id_usuario;
		}

		$this->load->view('template', $data);
	}

	/*
	* Procesa datos de usuario y los guarda en la base de datos
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
                     'field' => 'apellido',
                     'label' => 'Apellido',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'telefono',
                     'label' => 'Telefono',
                     'rules' => 'numeric'
                  ),   
               array(
                     'field' => 'email',
                     'label' => 'Email',
                     'rules' => 'required|valid_email'
                  ),   
               array(
                     'field' => 'usuario',
                     'label' => 'Usuario',
                     'rules' => 'required'
                  ),   
               array(
                     'field' => 'password',
                     'label' => 'Password',
                     'rules' => 'required'
                  ),   
               array(
                     'field' => 'password2',
                     'label' => 'Confirmar Password',
                     'rules' => 'matches[password]'
                  )
        );

		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('usuario/nuevo_usuario', 'refresh');
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
				'apellido' => $datos_recibidos['apellido'],
				'telefono' => $datos_recibidos['telefono'],
				'email' => $datos_recibidos['email'],
				'usuario' => $datos_recibidos['usuario'],
				'pass' => md5($datos_recibidos['password']),
				'activo' => $activado,
				'id_lugar' => $datos_recibidos['ubicacion'],
				'id_cargo' => $datos_recibidos['cargo'],
				'id_departamento' => $datos_recibidos['departamento'],
				'id_rol' => $datos_recibidos['rol'],
				'nota_interna' => $datos_recibidos['nota_interna'],
				'fecha_actualizado' => date('Y-m-d H:i:s')
			);

			$usuario = $this->usuario_model->save($datos);

			if($usuario){
				$link = anchor('usuario/ver/'.$usuario, $datos_recibidos['nombre'].' '.$datos_recibidos['apellido']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('usuario/nuevo_usuario', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('usuario/nuevo_usuario', 'refresh');
			}
		}
	}

	public function modificar()
	{
		$this->acceso_restringido();
		$id_usuario = $this->input->post('id_usuario');
		//reglas de validacion de formulario, en el server
		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'apellido',
                     'label' => 'Apellido',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'telefono',
                     'label' => 'Telefono',
                     'rules' => 'numeric'
                  ),   
               array(
                     'field' => 'email',
                     'label' => 'Email',
                     'rules' => 'required|valid_email'
                  ),   
               array(
                     'field' => 'usuario',
                     'label' => 'Usuario',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'password2',
                     'label' => 'Confirmar Password',
                     'rules' => 'matches[password]'
                  )
        );

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('usuario/nuevo_usuario/'.$id_usuario, 'refresh');
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
				'apellido' => $datos_recibidos['apellido'],
				'telefono' => $datos_recibidos['telefono'],
				'email' => $datos_recibidos['email'],
				'usuario' => $datos_recibidos['usuario'],
				'activo' => $activado,
				'id_lugar' => $datos_recibidos['ubicacion'],
				'id_cargo' => $datos_recibidos['cargo'],
				'id_departamento' => $datos_recibidos['departamento'],
				'id_rol' => $datos_recibidos['rol'],
				'nota_interna' => $datos_recibidos['nota_interna'],
				'fecha_actualizado' => date('Y-m-d H:i:s')
			);

			if($datos_recibidos['password']){
				$datos['pass'] = md5($datos_recibidos['password']);
			}

			$usuario = $this->usuario_model->update($id_usuario, $datos);

			if($usuario){
				$link = anchor('usuario/nuevo_usuario/'.$id_usuario, $datos_recibidos['nombre'].' '.$datos_recibidos['apellido']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('usuario/nuevo_usuario/'.$id_usuario, 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('usuario/nuevo_usuario/'.$id_usuario, 'refresh');
			}
		}
	}

	public function eliminar($id_usuario)
	{
		$this->acceso_restringido();
		$usuario = $this->usuario_model->delete($id_usuario);
		if(!$usuario){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('panel/usuarios/', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */