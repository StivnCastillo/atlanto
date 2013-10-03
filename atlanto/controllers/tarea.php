<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('email'));
		$this->load->library(array('horas'));
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
	    		$horas = new Horas();
	    		$tiempo = $horas->calcular($datos_recibidos['fecha_inicio'], $datos_recibidos['fecha_fin']);
	    		$duracion = $tiempo['minutos'];
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

					$html = '<p>'.$datos_recibidos['descripcion'].'</p>';

					if(enviar('SCI - Nueva Tarea - #'.$tarea, 'Tarea #'.$tarea, $html, $usuario->email, array('correo' => 'informatica@blancoynegromasivo.com.co','nombre' => 'Informatica'))){
						
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

	public function mod()
	{
		$tareas = $this->tarea_model->get_todos_2();
		$horas = new Horas();
		foreach ($tareas as $row) {
    		$tiempo = $horas->calcular($row->fecha_inicio, $row->fecha_fin);
    		$duracion = $tiempo['minutos'];
    		$datos = array(
				'duracion' => $duracion
			);
			$tarea = $this->tarea_model->update($row->id, $datos);
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
	    		$horas = new Horas();
	    		$tiempo = $horas->calcular($datos_recibidos['fecha_inicio'], $datos_recibidos['fecha_fin']);
	    		$duracion = $tiempo['minutos'];
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
					$nombre = $usuario_asignado->nombre." ".$usuario_asignado->apellido;
					$html = "<p>El usuario ".$nombre." Modificó la tarea #'".$datos_recibidos['id_tarea']."' <hr> <i>".$datos_recibidos['nota']."</i>";					
					//Se envia el correo
					if(enviar('SCI - Alerta en Tarea - #'.$datos_recibidos['id_tarea'], 'Tarea #'.$datos_recibidos['id_tarea'], $html, $usuario_asignador->email, array('correo' => 'informatica@blancoynegromasivo.com.co','nombre' => 'Informatica'))){
						
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
			$horas = new Horas();
    		$tiempo = $horas->calcular($fecha, date('Y-m-d H:i:s'));
    		$duracion = $tiempo['minutos'];

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
				$html = "El usuario ".$usuario_asignado->nombre." ".$usuario_asignado->apellido.", Ha Cambiado el estado de la Tarea #".$id;
				//Se envia el correo
				if(enviar('SCI - Alerta en Tarea - #'.$id, 'Tarea #'.$id, $html, $usuario_asignador->email, array('correo' => 'informatica@blancoynegromasivo.com.co','nombre' => 'Informatica'))){
					echo "Listo";
				}
			}
		}
	}

	public function eliminar($id_tarea)
	{
		$this->acceso_restringido();
		$tarea = $this->tarea_model->delete($id_tarea);
		if(!$tarea){
			$this->session->set_flashdata('mensaje', 'Tarea #'.$id_tarea.' eliminada');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', 'Ocurrio un error al eliminar Tarea');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('panel/tareas', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */