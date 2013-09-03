<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->helper(array('form'));
		$this->load->library(array('pdf', 'table'));
		$this->load->model(array(
			'tarea_model', 
			'config_model', 
			'usuario_model', 
			'computador_model'
		));
	}

	public function index($seccion = 'todas')
	{
		$this->acceso_restringido();

		//Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('bre_reporte'), '/reporte');
		$this->breadcrumbs->unshift($this->lang->line('bre_inicio'), '/panel/escritorio');
		$breadcrumbs = $this->breadcrumbs->show();

		$data = array(
			'titulo' => 'Reportes',
			'content' => 'reportes/index_view',
			'breadcrumbs' => $breadcrumbs,
			'seccion' => $seccion
		);
		$this->load->view('template', $data);
	}

	/********* Tareas ***********/
	/* Vista */
	public function tareas_lista()
	{
		$this->acceso_restringido();

		$data = array(
			'titulo' => 'Reportes Tareas',
			'content' => 'reportes/tareas/lista_view',
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
			'titulo' => 'Reportes',
			'content' => 'reportes/tareas/personalizar_view',
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
    /********* Computadores ***********/
	/* Vista */
	public function computador_lista()
	{
		$this->acceso_restringido();

		$data = array(
			'titulo' => 'Reporte Computadores',
			'content' => 'reportes/computadores/lista_view',
			'accion' => site_url('reporte/gen_computador_lista'),
			'config' => config_general()
		);
		$this->load->view('template', $data);
	}

	public function gen_computador_lista()
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

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->lang->line('rep_tareas_lista').' '.date("Y-m-d"), $this->input->post('leyenda'), array(0, 0, 0), array(0, 0, 0));
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

        $computadores = $this->computador_model->get();
        if ($computadores) {
        	$this->table->set_heading(
        		'Nro', 
        		'Nombre', 
        		'Estado', 
        		'Nro Serie', 
        		'Usuario', 
        		'Lugar/Ubicación'
        		);
        	$i = 1;
			foreach ($computadores as $row) {
				//$duracion_total = $duracion[0].' Meses'.$duracion[1].' Dias'.$duracion[2].' Hrs'.$duracion[3].' Min';
				$this->table->add_row(
					$i, 
					$row->nombre_computador, 
					$row->estado, 
					$row->n_serie, 
					$row->nombre_usuario, 
					$row->ubicacion
				);
				$i++;
			}
        }else{
        	$this->table->set_heading('No se encontraron Resultados');
			$this->table->add_row('0 filas');
        }

        $html .= $this->table->generate();
 
		// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
		// Cerrar el documento PDF y preparamos la salida
        $nombre_archivo = utf8_decode('Lista de computadores'."_".date('Y-m-d').".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

    public function computador($id_computador = FALSE)
    {
    	$this->acceso_restringido();

		$data = array(
			'titulo' => 'Reportes Computador',
			'content' => 'reportes/computadores/individual_view',
			'accion' => site_url('reporte/gen_computador'),
			'config' => config_general(),
			'accion_computador' => site_url('buscar_computador')
		);

		if($id_computador){
			$data['id_computador'] = $id_computador;
		}
		$this->load->view('template', $data);
    }

    public function gen_computador()
    {
    	$datos_recibidos = $this->input->post(NULL, TRUE);
    	$computador = $this->computador_model->get($datos_recibidos['id_computador']);

    	/**** Configuracion de titulo de reporte ****/
    	if($datos_recibidos['titulo'] == 1){
    		$titulo = 'Computador '.date('Y-m-d');
    	}elseif ($datos_recibidos['titulo'] == 2) {
    		$titulo = $computador->nombre_computador.' '.date('Y-m-d');
    	}else{
    		$titulo = $computador->nombre_usuario.' '.date('Y-m-d');
    	}

		//traigo configuraciones generales
		$config = config_general();
		//COLOCAR TODO DESDE LAS CONFIGURACIONES DE LOS REPORTES
		//crear instancia de la clase y propiedades del archivo
		$pdf = new Pdf('P', 'mm', $titulo, true, 'UTF-8', false);
		$pdf->SetCreator($datos_recibidos['creador']);
        $pdf->SetAuthor($datos_recibidos['autor']);
        $pdf->SetTitle('Reporte Computador '.$computador->nombre_computador);
        $pdf->SetSubject('Reporte Computador '.$computador->nombre_computador);

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $titulo, $datos_recibidos['leyenda'], array(0, 0, 0), array(0, 0, 0));
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
        $html .= "table{width: 100%;border: solid 1px black; font-size: 8px;}";
        $html .= "th{color: #333; font-weight: bold; background-color: #ccc;font-size: 10px;border: solid 1px black;}";
        $html .= "</style>";
        $html .= "<h5>".'Datos del Equipo'."</h5>";

        $computador = $this->computador_model->get($datos_recibidos['id_computador']);
        //conexiones
        $monitores = $this->computador_model->get_monitor($datos_recibidos['id_computador']);
        $impresoras = $this->computador_model->get_impresora($datos_recibidos['id_computador']);
        $dispositivos = $this->computador_model->get_dispositivo($datos_recibidos['id_computador']);
        $software = $this->computador_model->get_software($datos_recibidos['id_computador']);
        //componentes
        $discosduro = $this->computador_model->get_discoduro($datos_recibidos['id_computador']);
		$memorias = $this->computador_model->get_memoria($datos_recibidos['id_computador']);
		$procesadores = $this->computador_model->get_procesador($datos_recibidos['id_computador']);
		$tvideos = $this->computador_model->get_tvideo($datos_recibidos['id_computador']);

        if ($computador) {
    		$html .= '
        		<table>
        			<tr>
        				<th>Nombre de equipo</th>
        				<td>'.$computador->nombre_computador.'</td>
        				<th>Numero de Serie</th>
        				<td>'.$computador->n_serie.'</td>
        			</tr>
        			<tr>
        				<th>Tipo</th>
        				<td>'.$computador->com_tipo.'</td>
        				<th>Estado</th>
        				<td>'.$computador->estado.'</td>
        			</tr>
        			<tr>
        				<th>Fabricante</th>
        				<td>'.$computador->fabricante.'</td>
        				<th>Modelo</th>
        				<td>'.$computador->modelo.'</td>
        			</tr>
        			<tr>
        				<th>Numero de Activo</th>
        				<td>'.$computador->n_activo.'</td>
        				<th>Usuario</th>
        				<td>'.$computador->nombre_usuario.'</td>
        			</tr>
        			<tr>
        				<th>Dominio</th>
        				<td>'.$computador->dominio.'</td>
        				<th>Red</th>
        				<td>'.$computador->red.'</td>
        			</tr>
        			<tr>
        				<th>Ubicación</th>
        				<td>'.$computador->ubicacion.'</td>
        				<th>Sistema Operativo</th>
        				<td>'.$computador->sistema_operativo." ".$computador->version." ".$computador->tipo_so.'</td>
        			</tr>
        			<tr>
        				<td colspan="4"> </td>        				
        			</tr>
        			<tr>
        				<th colspan="4">Comentarios</th>        				
        			</tr>
        			<tr>
        				<td>'.$computador->comentarios.'</td>
        			</tr>
        		</table>
        	';

        	if (isset($datos_recibidos['componentes'])) {
        		$html .= "<h5>".'Componentes'."</h5>";
	        	$html .= '<table>';        	
	        	$html .= '<tr>
		        				<th>Cantidad</th>	        				
		        				<th>Componente</th>							
		        				<th>Nombre</th>	        				
		        				<th>Fabricante</th>    				
		        			</tr>';

		        if ($discosduro) {	        	
		        	foreach ($discosduro as $row) {        		
			        	$html .= '<tr>
			        				<td>'.$row->cantidad.'</td>
			        				<td>Disco Duro</td>
			        				<td>'.$row->nombre.'</td>
			        				<td>'.$row->fabricante.'</td>
			        			</tr>';
		        	}
		        }

		        if ($memorias) {	        	
		        	foreach ($memorias as $row) {        		
			        	$html .= '<tr>
			        				<td>'.$row->cantidad.'</td>
			        				<td>Memoria RAM</td>
			        				<td>'.$row->nombre.' '.$row->tamano.' GB</td>
			        				<td>'.$row->fabricante.'</td>
			        			</tr>';
		        	}
		        }

		        if ($procesadores) {	        	
		        	foreach ($procesadores as $row) {        		
			        	$html .= '<tr>
			        				<td>'.$row->cantidad.'</td>
			        				<td>Procesadores</td>
			        				<td>'.$row->nombre.'</td>
			        				<td>'.$row->fabricante.'</td>
			        			</tr>';
		        	}
		        }

		        if ($tvideos) {	        	
		        	foreach ($tvideos as $row) {        		
			        	$html .= '<tr>
			        				<td>'.$row->cantidad.'</td>
			        				<td>Tarjeta de Video</td>
			        				<td>'.$row->nombre.'</td>
			        				<td>'.$row->fabricante.'</td>
			        			</tr>';
		        	}
		        }        

	        	$html .='</table>';
        	}

        	if (isset($datos_recibidos['conexiones'])){
        		$html .= "<h5>".'Conexiones'."</h5>";
	        	$html .= '<table>';
	        	$html .= '<tr>
		        				<th>Tipo</th>	        				
		        				<th>Nombre</th>							
		        				<th>Numero de Serie</th>	        				
		        				<th>Fabricante</th>	        				
		        				<th>Modelo</th>	        				
		        			</tr>';

		        if ($monitores) {	        	
		        	foreach ($monitores as $row) {        		
			        	$html .= '<tr>
			        				<td>Monitor</td>
			        				<td>'.$row->nombre.'</td>
			        				<td>'.$row->n_serie.'</td>
			        				<td>'.$row->fabricante.'</td>
			        				<td>'.$row->modelo.'</td>
			        			</tr>';
		        	}
		        }

		        if ($impresoras) {	        	
		        	foreach ($impresoras as $row) {        		
			        	$html .= '<tr>
			        				<td>Impresora</td>
			        				<td>'.$row->nombre.'</td>
			        				<td>'.$row->n_serie.'</td>
			        				<td>'.$row->fabricante.'</td>
			        				<td>'.$row->modelo.'</td>
			        			</tr>';
		        	}
		        }

		        if ($dispositivos) {	        	
		        	foreach ($dispositivos as $row) {        		
			        	$html .= '<tr>
			        				<td>Otro Dispositivo</td>
			        				<td>'.$row->nombre.'</td>
			        				<td>'.$row->n_serie.'</td>
			        				<td>'.$row->fabricante.'</td>
			        				<td>'.$row->modelo.'</td>
			        			</tr>';
		        	}
		        }
	        	$html .='</table>';
        	}

        	if (isset($datos_recibidos['software'])) {
        		if ($software) {
	        		$html .= "<h5>".'Software'."</h5>";
		        	$html .= '<table>';
		        	$html .= '<tr>
		        				<th>Nombre</th>							
		        				<th>Versión</th>	        				
		        				<th>Fabricante</th>   				
		        			</tr>';
		        
		        	foreach ($software as $row) {        		
			        	$html .= '<tr>
			        				<td>'.$row->nombre.'</td>
			        				<td>'.$row->version.'</td>
			        				<td>'.$row->fabricante.'</td>
			        			</tr>';
		        	}
		        	$html .='</table>';
		        }
        	}
        }else{
        	$html .= "<h4>".'No se encontró datos del equipo.'."</h4>";
        }
 
		// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
		// Cerrar el documento PDF y preparamos la salida
        $nombre_archivo = utf8_decode($computador->nombre_computador.'_'.date('Y-m-d').".pdf");
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