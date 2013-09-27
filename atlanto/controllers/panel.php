<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form'));
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('usuario_model', 'tarea_model', 'ticket_model'));
	}

	public function index()
	{
		//Verificar si ya hay una sesion iniciada
		if($this->session->userdata('ingresado')){
			redirect('panel/escritorio', 'refresh');
		}else{
			$validador = FALSE;
		}

		$data = array(
			'titulo' => $this->lang->line('titulo'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'index_view',
			'validador' => $validador,
			'accion_login' => site_url('usuario/login'),
			'accion_ticket' => site_url('ticket/save'),
			'config' => config_general()
		);
		$this->load->view('template', $data);
	}

	public function escritorio()
	{
		$this->acceso_restringido();
		//Traer tareas
		$tareas = $this->tarea_model->get_todos($this->session->userdata('id'), 0);
		//Numero de tareas
		$n_tareas_no_terminadas = $this->tarea_model->get_no_tareas(array('estado' => 0));
		$n_mis_tareas = $this->tarea_model->get_no_tareas(array('estado' => 0, 'id_usuario_asignado' => $this->session->userdata('id')));
		//Numero de Tickets
		$n_tickets_no_resueltos = $this->ticket_model->get_no_tickets(array('id_estado' => 3));
		$n_tickets_espera = $this->ticket_model->get_no_tickets(array('id_estado' => 5));
		$n_mis_tickets = $this->ticket_model->get_no_tickets(array('id_usuario' => $this->session->userdata('id')));

		$data = array(
			'titulo' => $this->lang->line('titulo'),
			'content' => 'escritorio_view',
			'tareas' => $tareas,
			'n_mis_tareas' => $n_mis_tareas,
			'n_tareas_no_terminadas' => $n_tareas_no_terminadas,
			'n_tickets_no_resueltos' => $n_tickets_no_resueltos,
			'n_tickets_espera' => $n_tickets_espera,
			'n_mis_tickets' => $n_mis_tickets
		);
		$this->load->view('template', $data);
	}

	public function error()
	{
		$data = array(
			'titulo' => $this->lang->line('titulo_404'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => '404_view'
		);
		$this->load->view('template', $data);
	}

	public function usuarios()
	{
		$this->acceso_restringido();
		$usuarios = $this->usuario_model->get_todos_usuarios();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_usuarios'), '/panel/usuarios');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_usuarios'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'usuarios/index_view',
			'breadcrumbs' => $breadcrumbs,
			'usuarios' => $usuarios
		);
		$this->load->view('template', $data);
	}

	//id de usuario se le pasa para ver las tareas propias
	public function tareas($id_usuario = FALSE)
	{
		$this->acceso_restringido();
		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_tareas'), '/panel/tareas');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$tareas = $this->tarea_model->get_todos($id_usuario);

		$data = array(
			'titulo' => $this->lang->line('titulo_tareas'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'tareas/index_view',
			'breadcrumbs' => $breadcrumbs,
			'tareas' => $tareas
		);
		$this->load->view('template', $data);
	}

	public function titulos()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_titulos'), '/panel/titulos');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_titulos'),
			'content' => 'titulos/index_view',
			'breadcrumbs' => $breadcrumbs
		);
		$this->load->view('template', $data);
	}



	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */