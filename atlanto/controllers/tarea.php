<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		$this->load->library('clasefechas');
		$this->load->model(array('tarea_model', 'rol_model', 'usuario_model'));
	}

	public function index()
	{
		
	}

	/*
	* Muestra formulario para la creacion de una nueva tarea
	 */
	public function nueva_tarea($id_tarea = 0)
	{
		$this->acceso_restringido();
		
		//Traer los usuarios administradores
		$usuarios = $this->usuario_model->get_administradores();

		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_usuario'),
			'titulo_menu' => $this->lang->line('index_titulo_menu'),
			'content' => 'tareas/save_view',
			'validador' => TRUE,
			'usuarios' => $usuarios,
			'accion_guardar' => site_url('tarea/guardar')
		);
		//Para cargar los datos de la tarea en el formulario
		if ($id_tarea) {
			$tarea = $this->tarea_model->get_tarea(array("id" => $id_tarea));

			$data['tarea'] = $tarea;
			$data['id_tarea'] = $id_tarea;
		}

		$this->load->view('template', $data);
	}

	public function guardar()
	{
		$this->acceso_restringido();
		//reglas de validacion de formulario, en el server
		$config = array(
				array(
					'field' => 'titulo',
					'label' => 'Titulo',
					'rules' => 'required'
				),
				array(
					'field' => 'fecha_inicio',
					'label' => 'Fecha Inicio',
					'rules' => 'required'
				),
				array(
					'field' => 'descripcion',
					'label' => 'Descripcion',
					'rules' => 'required'
				),
				array(
					'field' => 'nota',
					'label' => 'Nota',
					'rules' => 'required'
				)
        );

		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('panel/tareas', 'refresh');
		}
		else
		{
			$datos_recibidos = $this->input->post(NULL, TRUE);
			
			if($datos_recibidos['fecha_fin'] == ""){
				$estado = 0;
				$duracion = NULL;
			}else{
				$estado = 1;
				//Calcula la duracion que tuvo la tarea
				$this->clasefechas->setMySQLDateTime($datos_recibidos['fecha_inicio']);
	    		$tiempo = $this->clasefechas->diff_MySQL($datos_recibidos['fecha_fin']);
	    		//Duracion separada por comas (,). meses,dias,horas,minutos
	    		$duracion = round($tiempo['weeks'],0,PHP_ROUND_HALF_DOWN).",".round($tiempo['days'],0,PHP_ROUND_HALF_DOWN).",".round($tiempo['hours'],0,PHP_ROUND_HALF_DOWN).",".round($tiempo['minutes'],0,PHP_ROUND_HALF_DOWN);
			}

			$datos = array(
				'titulo' => $datos_recibidos['titulo'],
				'fecha_inicio' => $datos_recibidos['fecha_inicio'],
				'fecha_fin' => $datos_recibidos['fecha_fin'],
				'duracion' => $duracion,
				'id_usuario_asignado' => $datos_recibidos['id_usuario'],
				'nota' => $datos_recibidos['nota'],
				'estado' => $estado,
				'descripcion' => $datos_recibidos['descripcion']
			);

			$tarea = $this->tarea_model->save($datos);

			if($tarea){
				$link = anchor('tarea/nueva_tarea/'.$tarea, $datos_recibidos['titulo']);
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('panel/tareas', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('panel/tareas', 'refresh');
			}
		}
	}

	public function cambiar_estado()
	{
		$id = $this->input->post('id');
		$valor = $this->input->post('valor');
		$tarea = $this->tarea_model->update($id, array('estado' => $valor));
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */