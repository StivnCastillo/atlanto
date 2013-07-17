<?php $theme = $this->config->item('template'); ?>
<!doctype html>
<html lang="es">
<head>
	<!-- Meta tags -->
	<meta charset="UTF-8" />
	<meta name="description" content="Sistema de control de equipos de computo" />
	<meta name="author" content="Stiven Castillo - Blanco y Negro Masivo S.A." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $titulo; ?></title>

	<link rel="shortcut icon" type="image/x-icon" href="img/icono1.png">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/icono1.png">

	<!-- Estilos CSS -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" media="screen" />
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-switch.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/datatable-bootstrap.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5.css" rel="stylesheet" />
	
	<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" />
</head>
<body>