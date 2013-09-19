<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ticket extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array(
			'form',
			'email',
			'download'
		));
		$this->load->model(array(
			'ticket_model',
			'estadoticket_model',
			'prioridad_model',
			'usuario_model'
		));
	}

	
	/***** PANEL ADMINISTRADOR *****/
	public function index($admin = FALSE)
	{
		$this->acceso_restringido();
		
		$this->breadcrumbs->push('Tickets', '/ticket');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		if ($admin) {
			$tickets = $this->ticket_model->get_tickets(FALSE, $this->session->userdata('id'));
		}else{
			$tickets = $this->ticket_model->get_tickets();			
		}

		$data = array(
			'titulo' => 'Tickets',
			'content' => 'tickets/admin/index_view',
			'breadcrumbs' => $breadcrumbs,
			'tickets' => $tickets
		);
		
		$this->load->view('template', $data);
	}
	
	public function ver_ticket($id)
	{
		$this->acceso_restringido();
		
		$this->breadcrumbs->push('Tickets', '/ticket');
		$this->breadcrumbs->push('Ticket #'.$id, '/ticket/ver_ticket/'.$id);
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$ticket = $this->ticket_model->get_tickets($id);
		$prioridad = $this->prioridad_model->get_todos();
		$mensajes = $this->ticket_model->get_mensajes($id);
		$archivos = $this->ticket_model->get_archivos(array('id_ticket' => $id));
		$admin = $this->usuario_model->get_administradores();
		
		$data = array(
			'titulo' => 'Ticket #'.$id,
			'content' => 'tickets/admin/ver_view',
			'breadcrumbs' => $breadcrumbs,
			'accion' => site_url('ticket/responder_admin'),
			'accion_asignar' => site_url('ticket/asignar/'.$id),
			'accion_prioridad' => site_url('ticket/cambiar_prioridad/'.$id),
			'ticket' => $ticket,
			'archivos' => $archivos,
			'mensajes' => $mensajes,
			'prioridad' => $prioridad,
			'admin' => $admin
		);
		
		$this->load->view('template', $data);
	}

	public function asignar($id)
	{
		$this->acceso_restringido();
		$datos_recibidos = $this->input->post(NULL, TRUE);

		$datos = array(
			'id_usuario_asignado' => $datos_recibidos['usuario']
		);
		$this->ticket_model->update($id, $datos);
		//enviar correo

		$this->session->set_flashdata('mensaje', 'El ticket fue asignado.');
		$this->session->set_flashdata('tipo_mensaje', 'exito');
		
		redirect('ticket/ver_ticket/'.$id, 'refresh');
	}

	public function cambiar_prioridad($id)
	{
		$this->acceso_restringido();
		$datos_recibidos = $this->input->post(NULL, TRUE);

		$datos = array(
			'id_prioridad' => $datos_recibidos['prioridad']
		);
		$this->ticket_model->update($id, $datos);
		//enviar correo

		$this->session->set_flashdata('mensaje', 'Prioridad del ticket ha sido cambiada');
		$this->session->set_flashdata('tipo_mensaje', 'exito');
		
		redirect('ticket/ver_ticket/'.$id, 'refresh');
	}

	public function responder_admin()
	{
		$this->acceso_restringido();
		$datos_recibidos = $this->input->post(NULL, TRUE);
		$config = array(
			array(
				'field' => 'mensaje',
				'label' => 'Mensaje',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('ticket/ver_ticket/'.$datos_recibidos['id_ticket'], 'refresh');
		}else{
			$datos = array(
				'id_ticket' => $datos_recibidos['id_ticket'],
				'mensaje' => $datos_recibidos['mensaje'],
				'fecha' => date('Y-m-d H:i:s'),
				'id_usuario' => $this->session->userdata('id')
			);

			if (isset($datos_recibidos['estado'])) {
				$this->ticket_model->update($datos_recibidos['id_ticket'], array('id_estado' => $datos_recibidos['estado']));
			}else{
				$this->ticket_model->update($datos_recibidos['id_ticket'], array('id_estado' => 1));
			}
			
			$mensaje = $this->ticket_model->save_mensaje($datos);

			if($mensaje){
				/**ENVIAR CORREO*/
				$this->session->set_flashdata('mensaje', 'Su respuesta ha sido enviada.');
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				redirect('ticket/ver_ticket/'.$datos_recibidos['id_ticket'], 'refresh');
			}
		}
	}

	/***** PANEL USUARIO *****/
	public function mis_tickets()
	{
		$this->acceso_restringido();
		
		$this->breadcrumbs->push('Mis Tickets', '/ticket');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();
		
		$tickets = $this->ticket_model->get_mis_tickets($this->session->userdata('id'));
		
		$data = array(
			'titulo' => 'Tickets',
			'content' => 'tickets/user/mis_tickets_view',
			'breadcrumbs' => $breadcrumbs,
			'tickets' => $tickets
		);
		
		$this->load->view('template', $data);
	}

	public function ver($id)
	{
		$this->acceso_restringido();
		
		$this->breadcrumbs->push('Mis Ticket', '/ticket/mis_tickets');
		$this->breadcrumbs->push('Ticket #'.$id, '/ticket/ver/'.$id);
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$ticket = $this->ticket_model->get_mis_tickets($this->session->userdata('id'), $id);
		$mensajes = $this->ticket_model->get_mensajes($id);
		$archivos = $this->ticket_model->get_archivos(array('id_ticket' => $id));
		
		$data = array(
			'titulo' => 'Ticket #'.$id,
			'content' => 'tickets/user/ver_view',
			'breadcrumbs' => $breadcrumbs,
			'accion' => site_url('ticket/responder'),
			'ticket' => $ticket,
			'archivos' => $archivos,
			'mensajes' => $mensajes
		);
		
		$this->load->view('template', $data);
	}

	public function responder()
	{
		$this->acceso_restringido();
		$datos_recibidos = $this->input->post(NULL, TRUE);
		$config = array(
			array(
				'field' => 'mensaje',
				'label' => 'Mensaje',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('ticket/ver/'.$datos_recibidos['id_ticket'], 'refresh');
		}else{
			$datos = array(
				'id_ticket' => $datos_recibidos['id_ticket'],
				'mensaje' => $datos_recibidos['mensaje'],
				'fecha' => date('Y-m-d H:i:s'),
				'id_usuario' => $this->session->userdata('id')
			);
			
			$mensaje = $this->ticket_model->save_mensaje($datos);

			if($mensaje){
				/**ENVIAR CORREO*/
				$this->session->set_flashdata('mensaje', 'Su respuesta ha sido enviada.');
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				redirect('ticket/ver/'.$datos_recibidos['id_ticket'], 'refresh');
			}
		}
	}
	
	public function nuevo()
	{
		$this->acceso_restringido();
		
		$this->breadcrumbs->push('Nuevo Ticket', '/ticket/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();
		
		$data = array(
			'titulo' => 'Nuevo Ticket',
			'content' => 'tickets/user/save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion' => site_url('ticket/guardar')
		);
		
		$this->load->view('template', $data);
	}
	
	public function guardar()
	{
		$this->acceso_restringido();
		$config = array(
			array(
				'field' => 'asunto',
				'label' => 'Asunto',
				'rules' => 'required'
			),
			array(
				'field' => 'mensaje',
				'label' => 'Mensaje',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('ticket/nuevo', 'refresh');
		} else {
			$datos_recibidos = $this->input->post(NULL, TRUE);
			
			$datos = array(
				'asunto' => $datos_recibidos['asunto'],
				'mensaje' => $datos_recibidos['mensaje'],
				'id_origen' => 1,
				'id_usuario' => $this->session->userdata('id'),
				'id_estado' => 3,
				'id_prioridad' => 2,
				'ip' => get_ip_cliente(),
				'fecha_creado' => date('Y-m-d H:i:s')
			);
			
			$ticket = $this->ticket_model->save($datos);
			if ($ticket) {
				//Configuracion para subir archivo
				$config['upload_path']   = "./file/";
				$config['allowed_types'] = "jpg|png|doc|docx|xls|xlsx|txt|pdf";
				$config['max_size']      = '4000';
				
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('archivo')) {
					$data['error'] = $this->upload->display_errors();
					$this->session->set_flashdata('mensaje', 'Error al intentar adjuntar el archivo. ' . $this->upload->display_errors() . ' El ticket fue creado, por favor no crear otro.');
					$this->session->set_flashdata('tipo_mensaje', 'error');
				} else {
					$archivo       = $this->upload->data();
					$datos_archivo = array(
						'nombre' => $archivo['file_name'],
						'url' => 'file/' . $archivo['file_name'],
						'mime' => $archivo['file_type'],
						'extension' => $archivo['file_ext'],
						'peso' => $archivo['file_size'],
						'id_ticket' => $ticket
					);
					$archivo       = $this->ticket_model->save_archivo($datos_archivo);
				}
				$link = anchor('ticket/ver/' . $ticket, 'Ticket #' . $ticket);
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito') . " " . $link . " " . $this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				redirect('ticket/nuevo', 'refresh');
			} else {
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('ticket/nuevo', 'refresh');
			}
			
		}
	}

	public function descargar($nombre, $datos)
	{
		force_download($nombre, $datos);
	}

	public function enviar()
	{
		$html = nueva_tarea('Mensaje de Prueba', 'Titulo de prueba', 'Ola k ase');
		if(enviar_email('Prueba', $html, 'stiven.castillo@blancoynegromasivo.com.co', 'informatica@blancoynegromasivo.com.co', 'Informatica')){
			echo $this->email->print_debugger();
		}
	}
	
	public function acceso_restringido()
	{
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}