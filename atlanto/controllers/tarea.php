<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		$this->load->library(array('clasefechas', 'email'));
		$this->load->model(array('tarea_model', 'usuario_model', 'mail_model'));
	}

	public function index()
	{
		/*$config = $this->config_model->get(array('id' => 1));
		$predefinido = $this->mail_model->get_predefinido(array('id' => 1, 'id_tipo' => 1));
		echo $config->nombre_sistema;
		echo "<br>";
		echo $config->correo_sistema;
		echo "<br>";
		echo $predefinido->mensaje;
		echo "<br>";	
		echo $config->firma_sistema;
		echo "<br>";*/
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
			'accion_guardar' => site_url('tarea/guardar'),
			'accion_modificar' => site_url('tarea/modificar')
		);
		//Para cargar los datos de la tarea en el formulario
		if ($id_tarea) {
			$tarea = $this->tarea_model->get_tarea(array("id" => $id_tarea));

			$data['tarea'] = $tarea;
			$data['id_tarea'] = $id_tarea;
			$data['modificar'] = TRUE;
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
	    		$duracion = floor($tiempo['weeks']).",".floor($tiempo['days']).",".floor($tiempo['hours']).",".floor($tiempo['minutes']);
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

				$usuario = $this->usuario_model->get_usuario(array('id' => $datos_recibidos['id_usuario']));
				//Enviar correo a usuario asignado

				//variables para archivo de configuracion
				$this->email->from('informatica@blancoynegromasivo.com.co', 'informatica');
				$this->email->to($usuario->email);

				$this->email->subject('Alerta Nueva Tarea');
				$this->email->message($datos_recibidos['descripcion']);

				$this->email->send();

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

	public function enviar()
	{
		# code...
	}

	public function modificar()
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
	    		$duracion = floor($tiempo['weeks']).",".floor($tiempo['days']).",".floor($tiempo['hours']).",".floor($tiempo['minutes']);
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

			$tarea = $this->tarea_model->update($datos_recibidos['id_tarea'], $datos);

			if($tarea){
				$link = anchor('tarea/nueva_tarea/'.$tarea, $datos_recibidos['titulo']);
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('panel/tareas', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('panel/tareas', 'refresh');
			}
		}
	}

	public function cambiar_estado()
	{
		$id = $this->input->post('id');
		$valor = $this->input->post('valor');
		$tarea = $this->tarea_model->update($id, array('estado' => $valor, 'fecha_fin' => date('Y-m-d H:i:s'), 'nota' => $this->lang->line('tar_sin_nota')));

	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */