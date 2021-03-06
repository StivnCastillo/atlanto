<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "panel";
$route['404_override'] = 'panel/error';

$route['buscar_ubicacion'] = "ubicacion/ubicaciones_select";
$route['buscar_departamento'] = "departamento/departamento_select";
$route['buscar_cargo'] = "cargo/cargo_select";
$route['buscar_usuario'] = "usuario/usuario_select";
$route['buscar_computador'] = "computador/computador_select";

$route['componente/discoduro'] = "componente/index_discoduro";
$route['componente/procesador'] = "componente/index_procesador";
$route['componente/memoria'] = "componente/index_memoria";
$route['componente/tarjeta_video'] = "componente/index_tvideo";


/* End of file routes.php */
/* Location: ./application/config/routes.php */