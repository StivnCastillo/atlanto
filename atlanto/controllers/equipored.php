<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipored extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(array(
					'equipored_model', 
					'estadocomponente_model',
					'dominio_model', 
					'estadocomponente_model', 
					'red_model'));
	}

	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_equipored'), '/requipored');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$equipos = $this->equipored_model->get_todos_equipos();

		$data = array(
			'titulo' => $this->lang->line('titulo_equipored'),
			'content' => 'equiposred/index_view',
			'breadcrumbs' => $breadcrumbs,
			'equipos' => $equipos
		);
		$this->load->view('template', $data);
	}

	public function nuevo($id_equipored = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_equipored'), '/equipored');
		$this->breadcrumbs->push($this->lang->line('bre_equipored_nuevo'), '/equipored/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$dominios = $this->dominio_model->get_todos();
		$estados = $this->estadocomponente_model->get_todos();
		$redes = $this->red_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_equipored'),
			'content' => 'equiposred/save_view',
			'breadcrumbs' => $breadcrumbs,
			'dominios' => $dominios,
			'redes' => $redes,
			'estados' => $estados,
			'accion_guardar' => site_url('equipored/guardar'),
			'accion_modificar' => site_url('equipored/modificar'),
			'accion_ubicacion' => site_url('buscar_ubicacion'),
			'accion_usuario' => site_url('buscar_usuario')
		);

		if($id_equipored){
			$data['equipored'] = $this->equipored_model->get_todos_equipos($id_equipored);
			$data['id_equipored'] = $id_equipored;
		}

		$this->load->view('template', $data);
	}

	/*
	* Procesa los datos y los envia al modelo que guarda en la base de datos
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
                     'field' => 'ubicacion',
                     'label' => 'Ubicacion',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'usuario',
                     'label' => 'Usuario',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'estado',
                     'label' => 'Estado',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'serie',
                     'label' => 'Serie',
                     'rules' => 'required'
                  )
        );

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('equipored/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],				
				'id_dominio' => $datos_recibidos['dominio'],
				'id_red' => $datos_recibidos['red'],				
				'ip' => $datos_recibidos['ip'],				
				'mac' => $datos_recibidos['mac'],				
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$equipored = $this->equipored_model->save($datos);

			if($equipored){
				$link = anchor('equipored/nuevo/'.$equipored, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('equipored/nuevo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('equipored/nuevo', 'refresh');
			}
		}
	}

	/*
	* Procesa los datos y los envia al modelo para que actualice la informacion
	*/
	public function modificar()
	{
		$this->acceso_restringido();

		$config = array(
               array(
                     'field' => 'nombre',
                     'label' => 'Nombre',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'ubicacion',
                     'label' => 'Ubicacion',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'usuario',
                     'label' => 'Usuario',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'estado',
                     'label' => 'Estado',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'serie',
                     'label' => 'Serie',
                     'rules' => 'required'
                  )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE)
		{
		    $this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
			
			redirect('equipored', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],				
				'id_dominio' => $datos_recibidos['dominio'],
				'id_red' => $datos_recibidos['red'],				
				'ip' => $datos_recibidos['ip'],				
				'mac' => $datos_recibidos['mac'],				
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$eqiposred = $this->equipored_model->update($datos_recibidos['id_equipored'], $datos);

			if($eqiposred){
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('equipored', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('equipored', 'refresh');
			}

		}
		
	}

	public function eliminar($id)
	{
		$this->acceso_restringido();
		$equipored = $this->equipored_model->delete($id);
		if(!$equipored){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_equipored'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('equipored', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}