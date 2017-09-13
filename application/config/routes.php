<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'paginas/index';
$route['inicio'] = 'paginas/index';

/**
 * Páginas
 */
$route['contactanos'] = 'paginas/contactanos';
$route['confirmacion'] = 'paginas/confirmacion';
$route['p/(:any)'] = 'paginas/pagina/$1';

/**
 * Paquetes
 */
$route['paquetes-tours'] = 'paginas/paquetes';
$route['paquetes-tours/(:any)'] = 'paginas/paquetes/$1';
$route['paquete-tour/(:any)'] = 'paginas/paquete/$1';
$route['pdf-paquete/(:any)'] = 'paginas/pdf_paquete/$1';

/**
 * Tours
 */
$route['tours'] = 'paginas/tours';
$route['tours/(:any)'] = 'paginas/tours/$1'; //Solo provincia
$route['tours/(:any)/(:any)'] = 'paginas/tours/$1/$2';//Provincia y categoría
$route['tours/(:any)/(:any)/(:any)'] = 'paginas/tours/$1/$2/$3';//Provincia, categoría y args 
$route['tour/(:any)'] = 'paginas/tour/$1';
$route['pdf-tour/(:any)'] = 'paginas/pdf_tour/$1';

/**
 * Hoteles
 */
$route['hoteles/(:any)'] = 'paginas/hoteles/$1'; //Con provincia
$route['hotel/(:num)/(:any)'] = 'paginas/hotel/$1/$2'; //Hotel

$route['reservar'] = 'paginas/reservar';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
* Admin routes
*/
$route['autenticar'] = "waadmin/waauth/autenticar";
$route['waadmin'] = "waadmin/waauth";
$route['waadmin/login'] = "waadmin/waauth";
$route['waadmin/salir'] = "waadmin/waauth/logout";
$route['waadmin/perfil/(:any)'] = "waadmin/Waauth/perfil";
$route['waadmin/website/(:any)/(:num)'] = "waadmin/website/editar/$1/$2";