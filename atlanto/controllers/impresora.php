<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Impresora extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		/* Cargar modelos */
		$this->load->model(
			array(
					'impresora_model', 
					'dominio_model', 
					'estadocomponente_model', 
					'tipo_model',
					'red_model'
				)
		);
	}

	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_impresora'), '/impresora');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$impresoras = $this->impresora_model->get();

		$data = array(
			'titulo' => $this->lang->line('titulo_impresora'),
			'content' => 'impresoras/index_view',
			'breadcrumbs' => $breadcrumbs,
			'impresoras' => $impresoras
		);
		$this->load->view('template', $data);
	}

	public function nuevo($id_impresora = FALSE)
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_impresora'), '/impresora');
		$this->breadcrumbs->push($this->lang->line('bre_impresora_nueva'), '/impresora/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		//$monitor = $this->monitor_model->get();
		$estado = $this->estadocomponente_model->get_todos();
		$tipo = $this->tipo_model->get_imp_todos();
		$dominios = $this->dominio_model->get_todos();
		$redes = $this->red_model->get_todos();

		$data = array(
			'titulo' => $this->lang->line('titulo_nuevo_mon'),
			'content' => 'impresoras/save_view',
			'breadcrumbs' => $breadcrumbs,
			'estados' => $estado,
			'tipos' => $tipo,
			'dominios' => $dominios,
			'redes' => $redes,
			'accion_guardar' => site_url('impresora/guardar'),
			'accion_modificar' => site_url('impresora/modificar'),
			'accion_ubicacion' => site_url('buscar_ubicacion'),
			'accion_usuario' => site_url('buscar_usuario')
		);

		if($id_impresora){
			$data['impresora'] = $this->impresora_model->get($id_impresora);
			$data['id_impresora'] = $id_impresora;
		}

		$this->load->view('template', $data);
	}

	/*
	* Procesa los datos y los envia al modelo que guarda en la base de datos
	*/
	public function guardar()
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
                     'field' => 'red',
                     'label' => 'Red',
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
                     'field' => 'dominio',
                     'label' => 'Dominio',
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
			
			redirect('impresora/nuevo', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'id_tipo_impresora' => $datos_recibidos['tipo'],
				'id_dominio' => $datos_recibidos['dominio'],
				'id_red' => $datos_recibidos['red'],
				'ip' => $datos_recibidos['ip'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$impresora = $this->impresora_model->save($datos);

			if($impresora){
				$link = anchor('impresora/nuevo/'.$impresora, $datos_recibidos['nombre']);
				
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$link." ".$this->lang->line('msj_ext_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('impresora/nuevo', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_guardar'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('impresora/nuevo', 'refresh');
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
                     'field' => 'red',
                     'label' => 'Red',
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
                     'field' => 'dominio',
                     'label' => 'Dominio',
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
			
			redirect('impresora', 'refresh');
		}else{
			$datos_recibidos = $this->input->post(NULL, TRUE);

			$datos = array(
				'nombre' => $datos_recibidos['nombre'],
				'id_usuario' => $datos_recibidos['usuario'],
				'id_ubicacion' => $datos_recibidos['ubicacion'],
				'id_estado' => $datos_recibidos['estado'],
				'id_tipo_impresora' => $datos_recibidos['tipo'],
				'id_dominio' => $datos_recibidos['dominio'],
				'id_red' => $datos_recibidos['red'],
				'ip' => $datos_recibidos['ip'],
				'fabricante' => $datos_recibidos['fabricante'],
				'modelo' => $datos_recibidos['modelo'],
				'n_serie' => $datos_recibidos['serie'],
				'n_activo' => $datos_recibidos['activo'],
				'comentarios' => $datos_recibidos['comentario'],
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$impresoras = $this->impresora_model->update($datos_recibidos['id_impresora'], $datos);

			if($impresoras){
				$this->session->set_flashdata('mensaje', $this->lang->line('msj_exito')." ".$this->lang->line('msj_ext_config'));
				$this->session->set_flashdata('tipo_mensaje', 'exito');
				
				redirect('impresora', 'refresh');
			}else{

				$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_modificar_usu'));
				$this->session->set_flashdata('tipo_mensaje', 'error');
				
				redirect('impresora', 'refresh');
			}

		}
		
	}

	public function eliminar($id)
	{
		$this->acceso_restringido();
		$equipored = $this->impresora_model->delete($id);
		if(!$equipored){
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_ext_eliminar_imp'));
			$this->session->set_flashdata('tipo_mensaje', 'exito');
		}else{
			$this->session->set_flashdata('mensaje', $this->lang->line('msj_error_eliminar'));
			$this->session->set_flashdata('tipo_mensaje', 'error');
		}

		redirect('impresora', 'refresh');
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}

}