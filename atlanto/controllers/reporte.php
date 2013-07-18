<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		$this->load->library(array('pdf', 'table'));
		$this->load->model(array('tarea_model', 'config_model', 'usuario_model'));
	}

	public function index()
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_reporte'), '/reporte');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => $this->lang->line('titulo_departamentos'),
			'content' => 'reportes/index_view',
			'validador' => TRUE,
			'breadcrumbs' => $breadcrumbs
		);
		$this->load->view('template', $data);
	}
	/* Vista */
	public function tareas_lista()
	{
		$this->acceso_restringido();

		$data = array(
			'titulo' => $this->lang->line('titulo_departamentos'),
			'content' => 'reportes/tareas/lista_view',
			'validador' => TRUE,
			'accion' => site_url('reporte/gen_tareas_lista'),
			'config' => config_general()
		);
		$this->load->view('template', $data);
	}
	/* Accion */
	public function gen_tareas_lista()
	{
		//traigo configuraciones generales
		$config = $this->config_model->get(array('id' => 1));
		//COLOCAR TODO DESDE LAS CONFIGURACIONES DE LOS REPORTES
		//crear instancia de la clase y propiedades del archivo
		$pdf = new Pdf('P', 'mm', $config->repo_formato, true, 'UTF-8', false);
		$pdf->SetCreator($this->input->post('creador'));
        $pdf->SetAuthor($this->input->post('autor'));
        $pdf->SetTitle($this->input->post('titulo'));
        $pdf->SetSubject($this->input->post('titulo'));

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->lang->line('rep_tareas_lista').' '.date("Y-m-d"), $config->repo->leyenda, array(0, 0, 0), array(0, 0, 0));
        $pdf->setFooterData($tc = array(0, 0, 0), $lc = array(0, 0, 0));

        //fuente de los titulos de la tabla y el cuerpo
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 10));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 8));
 
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
  
		// Añadir una página
		// Este método tiene varias opciones, consulta la documentación para más información.

        $pdf->AddPage($config->repo_horientacion);

        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "table{width: 100%;boder: solid 1px; font-size: 8px;}";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222;font-size: 10px;}";
        $html .= "</style>";
         "<h2>".$this->input->post('titulo')."</h2>";

        $tareas = $this->tarea_model->get_todos(FALSE);
        if ($tareas) {
        	$this->table->set_heading($this->lang->line('tab_estado'), $this->lang->line('tab_titulo'), $this->lang->line('tab_usuario_asignado'), $this->lang->line('tab_fecha_inicio'), $this->lang->line('tab_fecha_fin'), $this->lang->line('tab_duracion'));		
			foreach ($tareas as $row) {
				($row->estado == 1) ? $estado = 'Si' : $estado = 'No';
				//Calcular duracion
				if ($row->duracion != '') {
					$duracion = explode(',', $row->duracion);
					$duracion_total = '';
					$duracion_total .= ($duracion[0] != 0) ? $duracion[0].' Meses ' : '';
					$duracion_total .= ($duracion[1] != 0) ? $duracion[1].' Dias ' : '';
					$duracion_total .= ($duracion[2] != 0) ? $duracion[2].' Hrs ' : '';
					$duracion_total .= ($duracion[3] != 0) ? $duracion[3].' Mins ' : '';
				}else{
					$duracion_total = 'Sin terminar';
				}
					

				//$duracion_total = $duracion[0].' Meses'.$duracion[1].' Dias'.$duracion[2].' Hrs'.$duracion[3].' Min';
				$this->table->add_row($estado, $row->titulo, $row->nombre." ".$row->apellido, $row->fecha_inicio, $row->fecha_fin, $duracion_total);
			}
        }else{
        	$this->table->set_heading('No se encontraron Resultados');
			$this->table->add_row('0 filas');
        }

        $html .= $this->table->generate();
 
		// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
		// Cerrar el documento PDF y preparamos la salida
        $nombre_archivo = utf8_decode($this->lang->line('rep_tareas_lista')."_".date('Y-m-d').".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

    /* Vista */
	public function tareas_personalizada()
	{
		$this->acceso_restringido();

		//Traer los usuarios administradores
		$usuarios = $this->usuario_model->get_administradores();
		$data = array(
			'titulo' => $this->lang->line('titulo_departamentos'),
			'content' => 'reportes/tareas/personalizar_view',
			'validador' => TRUE,
			'accion' => site_url('reporte/gen_tareas_personalizada'),
			'config' => config_general(),
			'usuarios' => $usuarios
		);
		$this->load->view('template', $data);
	}
	/* Accion */
	public function gen_tareas_personalizada()
	{
		//tab_usuario_asignado configuraciones generales
		$config = $this->config_model->get(array('id' => 1));

		//obtengo las variables enviadas por post
		$datos_recibidos = $this->input->post(NULL, TRUE);

		//crear instancia de la clase y propiedades del archivo
		$pdf = new Pdf('P', 'mm', $datos_recibidos['formato'], true, 'UTF-8', false);
		$pdf->SetCreator($datos_recibidos['creador']);
        $pdf->SetAuthor($datos_recibidos['autor']);
        $pdf->SetTitle($datos_recibidos['titulo']);
        $pdf->SetSubject($datos_recibidos['titulo']);

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $datos_recibidos['titulo'].' '.date("Y-m-d"), $datos_recibidos['leyenda'], array(0, 0, 0), array(0, 0, 0));
        $pdf->setFooterData($tc = array(0, 0, 0), $lc = array(0, 0, 0));

        //fuente de los titulos de la tabla y el cuerpo
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 10));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 8));
 
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
  
		// Añadir una página
		// Este método tiene varias opciones, consulta la documentación para más información.

        $pdf->AddPage($datos_recibidos['horientacion']);

        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "table{width: 100%;boder: solid 1px; font-size: 8px;}";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222;font-size: 10px;}";
        $html .= "</style>";
		"<h2>".$datos_recibidos['titulo']."</h2>";

		//personalizar sql
		$datos = array(
			'fecha_inicio' => $datos_recibidos['fecha_inicio'],
			'fecha_fin' => $datos_recibidos['fecha_fin'],
			'id_usuario' => $datos_recibidos['id_usuario'],
			'estado' => $datos_recibidos['estado']
		);

        $tareas = $this->tarea_model->get_tareas($datos);

        if ($tareas) {
        	$this->table->set_heading($this->lang->line('tab_estado'), $this->lang->line('tab_titulo'), $this->lang->line('tab_usuario_asignado'), $this->lang->line('tab_fecha_inicio'), $this->lang->line('tab_fecha_fin'), $this->lang->line('tab_duracion'));		
			foreach ($tareas as $row) {
				($row->estado == 1) ? $estado = 'Si' : $estado = 'No';
				//Calcular duracion
				if ($row->duracion != '') {
					$duracion = explode(',', $row->duracion);
					$duracion_total = '';
					$duracion_total .= ($duracion[0] != 0) ? $duracion[0].' Meses ' : '';
					$duracion_total .= ($duracion[1] != 0) ? $duracion[1].' Dias ' : '';
					$duracion_total .= ($duracion[2] != 0) ? $duracion[2].' Hrs ' : '';
					$duracion_total .= ($duracion[3] != 0) ? $duracion[3].' Mins ' : '';
				}else{
					$duracion_total = 'Sin terminar';
				}

				//$duracion_total = $duracion[0].' Meses'.$duracion[1].' Dias'.$duracion[2].' Hrs'.$duracion[3].' Min';
				$this->table->add_row($estado, $row->titulo, $row->nombre." ".$row->apellido, $row->fecha_inicio, $row->fecha_fin, $duracion_total);
			}
        }else{
        	$this->table->set_heading('No se encontraron Resultados');
			$this->table->add_row('0 filas');
        }

        $html .= $this->table->generate();
 
		// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
		// Cerrar el documento PDF y preparamos la salida
        $nombre_archivo = utf8_decode($datos_recibidos['nombre_archivo']."_".date('Y-m-d').".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

	public function acceso_restringido(){
		if (!$this->session->userdata('ingresado')) {
			redirect('panel', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */