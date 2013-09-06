<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quejas extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form'));
		//$this->load->helper(array('form'));
		$this->load->model(array('quejas_model'));
	}

	public function index()
	{
		$this->acceso_restringido();

		$this->breadcrumbs->push('Quejas y Reclamos', '/ticket/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$queja = $this->quejas_model->get_todos();

		$data = array(
			'titulo' => 'Quejas y Reclamos',
			'content' => 'quejas/index_view',
			'breadcrumbs' => $breadcrumbs,
			'queja' => $queja
		);

		$this->load->view('template', $data);
	}

	public function nuevo($id = FALSE)
	{
		$this->acceso_restringido();

		$this->breadcrumbs->push('Nuevo Registro', '/quejas/nuevo');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => 'Nuevo Registro',
			'content' => 'quejas/save_view',
			'breadcrumbs' => $breadcrumbs,
			'accion' => site_url('quejas/guardar')
		);

		if($id){
			$data['queja'] = $this->quejas_model->get(array('id' => $id));
			$data['id_queja'] = $id;
		}

		$this->load->view('template', $data);
	}
	/*GUARDA Y ENVIA NOTIFICACION A LAS AREAS ASIGNADAS*/
	public function guardar()
	{
		$datos_recibidos = $this->input->post(NULL, TRUE);

		$datos = array(
			'item' => $datos_recibidos['item'],
			'n_caso' => $datos_recibidos['caso'],
			'ruta' => $datos_recibidos['ruta'],
			'n_bus' => $datos_recibidos['placa'],
			'fecha' => $datos_recibidos['fecha'],
			'fecha_creacion' => date('Y-m-d H:i:s'),
			'estacion' => $datos_recibidos['direccion'],
			'descripcion' => $datos_recibidos['descripcion']
		);

		$correos = array();
		$proceso = '';

		$i=0;
		
		if (isset($datos_recibidos['gh'])) {
			$correo[$i++] = 'cristina.villegas@blancoynegromasivo.com.co';
			$proceso .= 'Gestión Humana,';
		}

		if (isset($datos_recibidos['op'])) {
			$correo[$i++] = 'julian.beltran@blancoynegromasivo.com.co';
			$correo[$i++] = 'wilber.valencia@blancoynegromasivo.com.co';
			$proceso .= 'Operaciones,';
		}

		if (isset($datos_recibidos['mtto'])) {
			$correo[$i++] = 'jorge.soto@blancoynegromasivo.com.co';
			$proceso .= 'Mantenimiento,';
		}

		if (isset($datos_recibidos['gi'])) {
			$correo[$i++] = 'alejandro.ramirez@blancoynegromasivo.com.co';
			$proceso .= 'Gestión Integral,';
		}

		if (isset($datos_recibidos['prev'])) {
			$correo[$i++] = 'gustavo.santa@blancoynegromasivo.com.co';
			$correo[$i++] = 'ferney.gonzalez@blancoynegromasivo.com.co';
			$proceso .= 'Prevencion Vial,';
		}

		$datos['proceso'] = $proceso;				

		if (isset($datos_recibidos['solucionado'])) {
			$datos['solucion'] = $datos_recibidos['solucion'];
			$datos['solucionado'] = 1;
		}

		$queja = $this->quejas_model->save($datos);

		if($queja){
			//Envia correo si no esta solucionado
			if (!isset($datos_recibidos['solucionado'])) {
				$html = '
				<style>
				th{text-align:left;}
				table{border:1px solid;}
				</style>
					<h4>Caso Asignado #'.$datos_recibidos['caso'].'</h4>
					<table boder="1">
						<tr>
							<th>RUTA</th>
							<td>'.$datos_recibidos['ruta'].'</td>
						</tr>
						<tr>
							<th>PLACA/NUMERO INTERNO DEL BUS</th>
							<td>'.$datos_recibidos['placa'].'</td>
						</tr>
						<tr>
							<th>FECHA</th>
							<td>'.$datos_recibidos['fecha'].'</td>
						</tr>
						<tr>
							<th>ESTACION/DIRECCION PUNTO EXTERNO</th>
							<td>'.$datos_recibidos['direccion'].'</td>
						</tr>
						<tr>
							<th>DESCRIPCION GENERAL</th>
							<td>'.$datos_recibidos['descripcion'].'</td>
						</tr>
					</table>
					<br><hr>
					<p>Para resolver este caso por favor ir este link <a href="'.base_url().'quejas/solucionar/'.md5($queja).'/'.$queja.'">Solucionar</a></p>
					<hr>
					<p>Blanco y Negro Masivo S.A.</p>
				';

				/*ENVIO DE CORREO*/
				//Configuracion del email
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'mail.blancoynegromasivo.com.co',
					'smtp_port' => 25,
					'smtp_user' => 'bnmasiv1',
					'smtp_pass' => 'Masivo2013c',
					'mailtype' => 'html',
					'charset' => 'utf-8',
					'wordwrap' => TRUE
				);
				//datos del email
				$this->load->library('email', $config);
				$this->email->from('yanneth.yanquen@blancoynegromasivo.com.co', 'Yanneth Yanquen');
				//$this->email->to($correo);
				$this->email->to(array('stiven.castillo@blancoynegromasivo.com.co', 'informatica@blancoynegromasivo.com.co'));				
				$this->email->subject('Caso Asignado #'.$datos_recibidos['caso']);
				$this->email->set_mailtype("html");
				$this->email->message($html);

				if($this->email->send()){
					//si envia
					$this->session->set_flashdata('mensaje', 'Registro creado con Exito');
					$this->session->set_flashdata('tipo_mensaje', 'exito');			
					redirect('quejas', 'refresh');
				}else{
					//si no envia, elimina el registro.
					$this->quejas_model->delete($queja);
					$this->session->set_flashdata('mensaje', 'Ocurrio un error, Consulte con el Administrador');
					$this->session->set_flashdata('tipo_mensaje', 'error');			
					redirect('quejas', 'refresh');
				}
			}			
		}else{
			$this->session->set_flashdata('mensaje', 'Ocurrio un error, Consulte con el Administrador');
			$this->session->set_flashdata('tipo_mensaje', 'error');			
			redirect('quejas', 'refresh');
		}
	}
	/*MODIFICA LA SOLUCION Y COLOCA EL CASO COMO SOLUCIONADO, Y ENVIA CORREO A YANNETH*/
	public function modificar()
	{
		$datos_recibidos = $this->input->post(NULL, TRUE);

		$datos = array(
			'solucion' => $datos_recibidos['solucion'],
			'solucionado' => 1
		);

		$queja = $this->quejas_model->update($datos_recibidos['id_queja'], $datos);
		$quejas = $this->quejas_model->get(array('id' => $datos_recibidos['id_queja']));
		if($queja){

			$html = '
				<style>
				th{text-align:left;}
				table{border:1px solid;}
				</style>
					<h4>Caso Asignado #'.$quejas->n_caso.'</h4>
					<table boder="1">
						<tr>
							<th>RUTA</th>
							<td>'.$quejas->ruta.'</td>
						</tr>
						<tr>
							<th>PLACA/NUMERO INTERNO DEL BUS</th>
							<td>'.$quejas->n_bus.'</td>
						</tr>
						<tr>
							<th>FECHA</th>
							<td>'.$quejas->fecha.'</td>
						</tr>
						<tr>
							<th>ESTACION/DIRECCION PUNTO EXTERNO</th>
							<td>'.$quejas->estacion.'</td>
						</tr>
						<tr>
							<th>DESCRIPCION GENERAL</th>
							<td>'.$quejas->descripcion.'</td>
						</tr>
						<tr>
							<th>PROCESO</th>
							<td>'.$quejas->proceso.'</td>
						</tr>
						<tr>
							<th>SOLUCION</th>
							<td>'.$quejas->solucion.'</td>
						</tr>
					</table>
					<hr>
					<p>Blanco y Negro Masivo S.A.</p>
				';

			//Configuracion del email
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'mail.blancoynegromasivo.com.co',
				'smtp_port' => 25,
				'smtp_user' => 'bnmasiv1',
				'smtp_pass' => 'Masivo2013c',
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'wordwrap' => TRUE
			);

			//datos del email
			$this->load->library('email', $config);
			$this->email->from('informatica@blancoynegromasivo.com.co', 'Yanneth Yanquen');
			$this->email->to("stiven.castillo@blancoynegromasivo.com.co");
			//$this->email->to($correo);				
			$this->email->subject('Solucion de Caso #'.$quejas->n_caso);
			$this->email->set_mailtype("html");
			$this->email->message($html);

			if($this->email->send()){
				$this->session->set_flashdata('mensaje', 'Caso Solucionado con Éxito');
				$this->session->set_flashdata('tipo_mensaje', 'exito');			
				redirect('quejas', 'refresh');
			}			
		}else{
			$this->session->set_flashdata('mensaje', 'Ocurrio un error, Consulte con el Administrador');
			$this->session->set_flashdata('tipo_mensaje', 'error');			
			redirect('quejas', 'refresh');
		}
	}

	public function solucionar($hash, $id)
	{
		$id1 = md5($id);
		if($hash == $id1){
			$this->breadcrumbs->push('Solución', '/quejas/nuevo');
			$breadcrumbs = $this->breadcrumbs->show();

			$queja = $this->quejas_model->get(array('id' => $id));
			if($queja->solucionado == 0){
				$data = array(
					'titulo' => 'Solución a Caso #'.$queja->n_caso,
					'content' => 'quejas/solucionar_view',
					'breadcrumbs' => $breadcrumbs,
					'accion' => site_url('quejas/modificar'),
					'queja' => $queja
				);

				$this->load->view('template', $data);
			}else{
				echo "Este Caso ya ha sido solucionado.";
			}
		}else{
			echo "Ocurrió un error. El enlace no es válido, Por favor Comuniquese con el administrador.";
		}
	}

	public function buscar()
	{
		$this->acceso_restringido();

		$this->breadcrumbs->push('Quejas y Reclamos', '/ticket/nuevo');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$queja = $this->quejas_model->get_todos();

		$data = array(
			'titulo' => 'Quejas y Reclamos',
			'content' => 'quejas/index_view',
			'breadcrumbs' => $breadcrumbs,
			'queja' => $queja
		);

		$this->load->view('template', $data);
	}

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}