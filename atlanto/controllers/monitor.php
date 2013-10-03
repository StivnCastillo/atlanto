<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monitor extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(
			array(
					'monitor_model', 
					'estadocomponente_model', 
					'interfaz_model', 
					'tipo_model',
					'computador_model'
				)
		);
	}

	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_monitor'), '/monitor');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$monitores = $this->monitor_model->get();

		$data = array(
			'titulo' => $this->lang->line('titulo_monitores'),
			'content' => 'monitores/index_view',
			'breadcrumbs' => $breadcrumbs,
			'monitores' => $monitores
		);
		$this->load->view('template', $data);
	}

	public function nuevo($id_monitor = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_monitor'), '/monitor');
		$this->breadcrumbs->push($this->lang->line('bre_monitor_nuevo'), '/monitor/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		//$monitor = $this->monitor_model->get();
		$estado = $this->estadocomponente_model->get_todos();
		$tipo = $this->tipo_model->get_mon_todos();
		$interfaz = $this->interfaz_model->get_mon_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_mon'),
			'content' => 'monitores/save_view',
			'breadcrumbs' => $breadcrumbs,
			'estados' => $estado,
			'tipos' => $tipo,
			'interfaz' => $interfaz,
			'accion_guardar' => site_url('monitor/guardar'),
			'accion_modificar' => site_url('monitor/modificar'),
			'accion_ubicacion' => site_url('buscar_ubicacion'),
			'accion_usuario' => site_url('buscar_usuario')
		);

		if($id_monitor){
			$data['monitor'] = $this->monitor_model->get($id_monitor);
			$data['id_monitor'] = $id_monitor;
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
                     'field' => 'tipo',
                     'label' => 'Tipo',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'interfaz',
                     'label' => 'Interfaz',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tamano',
                     'label' => 'Tamaño',
                     'rules' => 'required|number'
                  ), 
               array(
                     'field' => 'modelo',
                     'label' => 'Modelo',
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
			
			redirect('monitor/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'id_tipo_monitor' => $datos_recibidos['tipo'],
				'id_interfaz_monitor' => $datos_recibidos['interfaz'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'tamano' => $datos_recibidos['tamano'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$monitor = $this->monitor_model->save($datos);

			if($monitor){
				$link = anchor('monitor/nuevo/'.$monitor, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('monitor/nuevo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('monitor/nuevo', 'refresh');
			}
		}
	}

	public function guardar_externo($id_computador)
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
                     'field' => 'tipo',
                     'label' => 'Tipo',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'interfaz',
                     'label' => 'Interfaz',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tamano',
                     'label' => 'Tamaño',
                     'rules' => 'required|number'
                  ), 
               array(
                     'field' => 'modelo',
                     'label' => 'Modelo',
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
			
			redirect('monitor/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'id_tipo_monitor' => $datos_recibidos['tipo'],
				'id_interfaz_monitor' => $datos_recibidos['interfaz'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'tamano' => $datos_recibidos['tamano'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$monitor = $this->monitor_model->save($datos);

			if($monitor){
				$link = anchor('computador/nuevo/'.$monitor, $datos_recibidos['nombre']);

				$datos = array(
					'id_monitor' => $monitor,
					'id_computador' => $id_computador
				);

				$conexion = $this->computador_model->save_monitor($datos);
				
				$this->session->set_flashdata('mensaje', 'Monitor creado y conectado a este computador');
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('computador/nuevo/'.$id_computador, 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('computador/nuevo/'.$id_computador, 'refresh');
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
                     'field' => 'tipo',
                     'label' => 'Tipo',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'interfaz',
                     'label' => 'Interfaz',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'tamano',
                     'label' => 'Tamaño',
                     'rules' => 'required|number'
                  ), 
               array(
                     'field' => 'modelo',
                     'label' => 'Modelo',
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
			
			redirect('monitor', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'id_tipo_monitor' => $datos_recibidos['tipo'],
				'id_interfaz_monitor' => $datos_recibidos['interfaz'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'tamano' => $datos_recibidos['tamano'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$monitores = $this->monitor_model->update($datos_recibidos['id_monitor'], $datos);

			if($monitores){
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('monitor', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('monitor', 'refresh');
			}
		}		
	}

	public function eliminar($id_monitor)
	{
		$this->acceso_restringido();
		$monitor = $this->monitor_model->delete($id_monitor);
		if(!$monitor){
			$this->session->set_flashdata('mensaje', 'Monitor eliminado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', 'Ocurrio un error al eliminar monitor');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('monitor', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}

}