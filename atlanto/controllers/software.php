<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Software extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(
			array(
					'software_model', 
					'estadocomponente_model',
					'tipo_model'
				)
		);
	}

	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_software'), '/software');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$software = $this->software_model->get();

		$data = array(
			'titulo' => $this->lang->line('titulo_software'),
			'content' => 'software/index_view',
			'breadcrumbs' => $breadcrumbs,
			'software' => $software
		);
		$this->load->view('template', $data);
	}

	public function nuevo($id_software = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_software'), '/software');
		$this->breadcrumbs->push($this->lang->line('bre_software_nuevo'), '/software/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$estado = $this->estadocomponente_model->get_todos();
		$tipo = $this->tipo_model->get_sof_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_software'),
			'content' => 'software/save_view',
			'breadcrumbs' => $breadcrumbs,
			'estados' => $estado,
			'tipos' => $tipo,
			'accion_guardar' => site_url('software/guardar'),
			'accion_modificar' => site_url('software/modificar')
		);

		if($id_software){
			$data['software'] = $this->software_model->get($id_software);
			$data['id_software'] = $id_software;
		}

		$this->load->view('template', $data);
	}

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
                     'field' => 'estado',
                     'label' => 'Estado',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'version',
                     'label' => 'Version',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tipo',
                     'label' => 'Tipo',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'n_licencias',
                     'label' => 'Numero de Licencias',
                     'rules' => 'required|number'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('software/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			if(isset($datos_recibidos['aticket'])){
				$ticket = 'si';
			}else{
				$ticket = 'no';
			}

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_estado' => $datos_recibidos['estado'],
				'id_software_tipo' => $datos_recibidos['tipo'],
				'fabricante' => $datos_recibidos['fabricante'],
				'version' => $datos_recibidos['version'],
				'a_ticket' => $ticket,
				'n_licencias' => $datos_recibidos['n_licencias'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			if($datos_recibidos['n_licencias'] == 0){
				$datos['n_licencias_restantes'] = -1;
			}else{
				$datos['n_licencias_restantes'] = $datos_recibidos['n_licencias'];
			}

			$software = $this->software_model->save($datos);

			if($software){
				$link = anchor('software/nuevo/'.$software, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('software/nuevo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('software/nuevo', 'refresh');
			}
		}
	}

	public function modificar()
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
                     'field' => 'estado',
                     'label' => 'Estado',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'version',
                     'label' => 'Version',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tipo',
                     'label' => 'Tipo',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'n_licencias',
                     'label' => 'Numero de Licencias',
                     'rules' => 'required|number'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('software/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			if(isset($datos_recibidos['aticket'])){
				$ticket = 'si';
			}else{
				$ticket = 'no';
			}

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_estado' => $datos_recibidos['estado'],
				'id_software_tipo' => $datos_recibidos['tipo'],
				'fabricante' => $datos_recibidos['fabricante'],
				'version' => $datos_recibidos['version'],
				'a_ticket' => $ticket,
				'n_licencias' => $datos_recibidos['n_licencias'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			if($datos_recibidos['n_licencias'] == 0){
				$datos['n_licencias_restantes'] = -1;
			}else{
				if($datos['n_licencias_restantes'] == -1){
					$datos['n_licencias_restantes'] = $datos_recibidos['n_licencias'];
				}				
			}

			$software = $this->software_model->update($datos_recibidos['id_software'], $datos);

			if($software){
				$link = anchor('software/nuevo/'.$software, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('software', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('software/nuevo'.$datos_recibidos['id_software'], 'refresh');
			}
		}
	}


	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}

}