<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form'));
		//$this->load->helper(array('form'));
		//$this->load->library('form_validation');
		$this->load->model(array('estadoticket_model'));
	}

	public function index()
	{
		
	}

	public function nuevo()
	{
		$this->acceso_restringido();

		$this->breadcrumbs->push('Nuevo Ticket', '/ticket/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => 'Nuevo Ticket',
			'content' => 'tickets/save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion' => site_url('ticket/guardar')
		);

		$this->load->view('template', $data);
	}

	public function guardar()
	{
		
	}

	public function modificar()
	{
		
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}