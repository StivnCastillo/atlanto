<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('email'));
		$this->load->library(array('clasefechas'));
		$this->load->model(array('tarea_model', 'usuario_model', 'mail_model'));
	}

	/*
	* Muestra formulario para la creacion de una nueva tarea
	 */
	public function nueva_tarea($id_tarea = 0)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_tareas'), '/panel/tareas');
		$this->breadcrumbs->push($this->lang->line('bre_nueva_tarea'), '/tarea/nueva_tarea');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();
		
		//Traer los usuarios administradores
		$usuarios = $this->usuario_model->get_administradores();

		$data = array(
			'titulo' => $this->lang->line('men_sub_nueva'),
			'content' => 'tareas/save_view',
			'breadcrumbs' => $breadcrumbs,
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
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
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
				'fecha_creado' => date('Y-m-d H:s:i'),
				'duracion' => $duracion,
				'id_usuario_asignado' => $datos_recibidos['id_usuario'],
				'id_usuario_asignador' => $this->session->userdata('id'),
				'nota' => $datos_recibidos['nota'],
				'estado' => $estado,
				'descripcion' => $datos_recibidos['descripcion']
			);

			$tarea = $this->tarea_model->save($datos);

			if($tarea){
				//Si el usuario asignador es el mismo que el asignado, no se envia correo, de lo contrario se envia
				if ($datos_recibidos['id_usuario'] != $this->session->userdata('id')){
					//**enviar correo
					$usuario = $this->usuario_model->get_usuario(array('id' => $datos_recibidos['id_usuario']));

					$html = nueva_tarea('Tarea #'.$tarea, $datos_recibidos['descripcion'], $datos_recibidos['descripcion']);

					if(enviar_email('SCI - Nueva Tarea', $html, $usuario->email, 'informatica@blancoynegromasivo.com.co', 'Informatica')){
						
						$link = anchor('tarea/nueva_tarea/'.$tarea, $datos_recibidos['titulo']);
						$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
						$this->session->set_flashdata('tipo_mensaje', 'exito');
						
						redirect('panel/tareas', 'refresh');
					}
				}

				$link = anchor('tarea/nueva_tarea/'.$tarea, $datos_recibidos['titulo']);
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('panel/tareas', 'refresh');

			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('panel/tareas', 'refresh');
			}
		}
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
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
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
				$tareas = $this->tarea_model->get_tarea(array('id' => $datos_recibidos['id_tarea']));
				//Si el usuario asignador es el mismo que el asignado, no se envia correo, de lo contrario se envia
				if ($tareas->id_usuario_asignador != $this->session->userdata('id')){
					$usuario_asignador = $this->usuario_model->get_usuario(array('id' => $tareas->id_usuario_asignador));
					//enviar correo
					$usuario_asignado = $this->usuario_model->get_usuario(array('id' => $datos_recibidos['id_usuario']));
					
					//Creo el htlm que ira en el correo
					$html2 = "El usuario ".$usuario_asignado->nombre." ".$usuario_asignado->apellido." Modificó la tarea '".$datos_recibidos['descripcion']."' <br><br> <i>".$datos_recibidos['nota']."</i>";
					$html = nueva_tarea(
						'Tarea #'.$datos_recibidos['id_tarea'], 
						'SCI - Alerta en la Tarea', 
						$html2
					);
					//Se envia el correo
					if(enviar_email('SCI - Alerta en la Tarea', $html, $usuario_asignador->email, 'informatica@blancoynegromasivo.com.co', 'Informatica')){
						
						$link = anchor('tarea/nueva_tarea/'.$tarea, $datos_recibidos['titulo']);
						$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_modificar_usu'));
						$this->session->set_flashdata('tipo_mensaje', 'exito');
						
						redirect('panel/tareas', 'refresh');
					}
				}

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
		$fecha = $this->input->post('fecha');

		if($valor == 1){
			//Calcula la duracion que tuvo la tarea
			$this->clasefechas->setMySQLDateTime($fecha);
			$tiempo = $this->clasefechas->diff_MySQL(date('Y-m-d H:i:s'));
			//Duracion separada por comas (,). meses,dias,horas,minutos
			$duracion = floor($tiempo['weeks']).",".floor($tiempo['days']).",".floor($tiempo['hours']).",".floor($tiempo['minutes']);

			$tarea = $this->tarea_model->update($id, array('estado' => $valor, 'fecha_fin' => date('Y-m-d H:i:s'), 'nota' => $this->lang->line('tar_sin_nota'), 'duracion' => $duracion));
		}elseif ($valor == 0) {
			$tarea = $this->tarea_model->update($id, array('estado' => $valor, 'fecha_fin' => "0000-00-00 00:00:00", 'nota' => "", 'duracion' => NULL));
		}
		if($tarea){
			$tareas = $this->tarea_model->get_tarea(array('id' => $id));
			//Si el usuario asignador es el mismo que el asignado, no se envia correo, de lo contrario se envia
			if ($tareas->id_usuario_asignador != $this->session->userdata('id')){
				$usuario_asignador = $this->usuario_model->get_usuario(array('id' => $tareas->id_usuario_asignador));
				//enviar correo
				$usuario_asignado = $this->usuario_model->get_usuario(array('id' => $tareas->id_usuario_asignado));

				//Creo el htlm que ira en el correo
					$html2 = "El usuario ".$usuario_asignado->nombre." ".$usuario_asignado->apellido.", Cambió el estado de la Tarea #".$id;
					$html = nueva_tarea(
						'Tarea #'.$datos_recibidos['id_tarea'], 
						'SCI - Alerta en la Tarea', 
						$html2
					);
					//Se envia el correo
					if(enviar_email('SCI - Alerta en la Tarea', $html, $usuario_asignador->email, 'informatica@blancoynegromasivo.com.co', 'Informatica')){
		
					}
			}
		}
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */