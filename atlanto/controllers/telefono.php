<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Telefono extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(
			array(
					'telefono_model', 
					'estadocomponente_model',
					'tipo_model',
					'red_model'
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
		$this->breadcrumbs->push($this->lang->line('bre_telefono'), '/telefono');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$telefonos = $this->telefono_model->get();

		$data = array(
			'titulo' => $this->lang->line('titulo_telefonos'),
			'content' => 'telefonos/index_view',
			'breadcrumbs' => $breadcrumbs,
			'telefonos' => $telefonos
		);
		$this->load->view('template', $data);
	}

	public function nuevo($id_telefono = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_telefono'), '/telefono');
		$this->breadcrumbs->push($this->lang->line('bre_telefono_nuevo'), '/monitor/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$estado = $this->estadocomponente_model->get_todos();
		$tipo = $this->tipo_model->get_tel_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_telefono'),
			'content' => 'telefonos/save_view',
			'breadcrumbs' => $breadcrumbs,
			'estados' => $estado,
			'tipos' => $tipo,
			'accion_guardar' => site_url('telefono/guardar'),
			'accion_modificar' => site_url('telefono/modificar'),
			'accion_ubicacion' => site_url('buscar_ubicacion'),
			'accion_usuario' => site_url('buscar_usuario')
		);

		if($id_telefono){
			$data['telefono'] = $this->telefono_model->get($id_telefono);
			$data['id_telefono'] = $id_telefono;
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
                     'field' => 'ip',
                     'label' => 'Ip',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'firmware',
                     'label' => 'Firmware',
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
			
			redirect('telefono/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'id_telefono_tipo' => $datos_recibidos['tipo'],
				'ip' => $datos_recibidos['ip'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'firmware' => $datos_recibidos['firmware'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$telefono = $this->telefono_model->save($datos);

			if($telefono){
				$link = anchor('telefono/nuevo/'.$telefono, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('telefono/nuevo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('telefono/nuevo', 'refresh');
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
                     'field' => 'red',
                     'label' => 'Red',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'ip',
                     'label' => 'Ip',
                     'rules' => 'required'
                  ), 
               array(
                     'field' => 'fabricante',
                     'label' => 'Fabricante',
                     'rules' => 'required'
                  ),
               array(
                     'field' => 'firmware',
                     'label' => 'Firmware',
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
			
			redirect('telefono', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'id_telefono_tipo' => $datos_recibidos['tipo'],
				'ip' => $datos_recibidos['ip'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'firmware' => $datos_recibidos['firmware'],
				'id_red' => $datos_recibidos['red'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$telefonos = $this->telefono_model->update($datos_recibidos['id_telefono'], $datos);

			if($telefonos){
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('telefono', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('telefono', 'refresh');
			}
		}		
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}