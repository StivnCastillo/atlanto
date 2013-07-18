<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//si no existe la función get_ip_cliente la creamos
if(!function_exists('get_ip_cliente'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function get_ip_cliente()
    { 
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];

		return $_SERVER['REMOTE_ADDR']; 
    }
}

//si no existe la función config_general la creamos
if(!function_exists('config_general'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function config_general()
    { 
    	$ci = &get_instance();
		$ci->load->model('config_model');
		return $ci->config_model->get(array('id' => 1));
    }
}