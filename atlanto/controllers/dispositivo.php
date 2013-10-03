<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dispositivo extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(
			array(
					'dispositivo_model', 
					'estadocomponente_model',
				)
		);
	}

	/*
	* funcion inicial del controlador, datos tabulados
	*/
	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_dispositivo'), '/dicpositivo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$dispositivos = $this->dispositivo_model->get();

		$data = array(
			'titulo' => $this->lang->line('titulo_dispositivos'),
			'content' => 'dispositivos/index_view',
			'breadcrumbs' => $breadcrumbs,
			'dispositivos' => $dispositivos
		);
		$this->load->view('template', $data);
	}

	public function nuevo($id_dispositivo = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_dispositivo'), '/dispositivo');
		$this->breadcrumbs->push($this->lang->line('bre_dispositivo_nuevo'), '/dispositivo/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$estado = $this->estadocomponente_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_mon'),
			'content' => 'dispositivos/save_view',
			'breadcrumbs' => $breadcrumbs,
			'estados' => $estado,
			'accion_guardar' => site_url('dispositivo/guardar'),
			'accion_modificar' => site_url('dispositivo/modificar'),
			'accion_ubicacion' => site_url('buscar_ubicacion'),
			'accion_usuario' => site_url('buscar_usuario')
		);

		if($id_dispositivo){
			$data['dispositivo'] = $this->dispositivo_model->get($id_dispositivo);
			$data['id_dispositivo'] = $id_dispositivo;
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
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
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
			
			redirect('dispositivo/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			if (isset($datos_recibidos['prestable'])) {
				$prestable = "si";
			}else{
				$prestable = "no";
			}

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'prestable' => $prestable,
				'comentario' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$dispositivo = $this->dispositivo_model->save($datos);

			if($dispositivo){
				$link = anchor('dispositivo/nuevo/'.$dispositivo, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('dispositivo/nuevo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('monitor/nuevo', 'refresh');
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
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
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
			
			redirect('dispositivo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			if (isset($datos_recibidos['prestable'])) {
				$prestable = "si";
			}else{
				$prestable = "no";
			}

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'prestable' => $prestable,
				'comentario' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$dispositivos = $this->dispositivo_model->update($datos_recibidos['id_dispositivo'], $datos);

			if($dispositivos){
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('dispositivo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('dispositivo', 'refresh');
			}
		}		
	}

	public function eliminar($id_dispositivo)
	{
		$this->acceso_restringido();
		$dispositivo = $this->dispositivo_model->delete($id_dispositivo);
		if(!$dispositivo){
			$this->session->set_flashdata('mensaje', 'Dispositivo eliminado');
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', 'Ocurrio un error al eliminar Dispositivo');
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('dispositivo', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}