<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['login-administrator'] = 'Backend/AuthController';
$route['logout'] = 'Backend/AuthController/logout';

$route['dashboard'] = 'Backend/DashboardController';
$route['get-data-count-tamu-kehadiran'] = 'Backend/DashboardController/getCountTamuKehadiran';

/** Master */

// mempelai //
$route['mempelai'] = 'Backend/MempelaiController';
$route['mempelai/form'] = 'Backend/MempelaiController/form';
$route['mempelai/save-data'] = 'Backend/MempelaiController/store';
$route['mempelai/destroy'] = 'Backend/MempelaiController/destroy';
// mempelai end //

// acara //
$route['acara'] = 'Backend/AcaraController';
$route['acara/form'] = 'Backend/AcaraController/form';
$route['acara/save-data'] = 'Backend/AcaraController/store';
// acara end //

// tamu undangan //
$route['tamu-undangan'] = 'Backend/TamuUndanganController';
$route['tamu-undangan/form'] = 'Backend/TamuUndanganController/form';
$route['tamu-undangan/save-data'] = 'Backend/TamuUndanganController/store';
$route['tamu-undangan/kirim-pesan'] = 'Backend/TamuUndanganController/sendMessageWhatsapp';
$route['tamu-undangan/getDataTamuUndanganById'] = 'Backend/TamuUndanganController/getDataTamuUndanganById';
$route['tamu-undangan/destroy'] = 'Backend/TamuUndanganController/destroy';
// tamu undangan end //

// galery //
$route['galery'] = 'Backend/GaleryController';
$route['galery/save-data'] = 'Backend/GaleryController/store';
$route['galery/destroy'] = 'Backend/GaleryController/destroy';
// galery end //

// banner //
$route['banner'] = 'Backend/BannerController';
$route['banner/save-data'] = 'Backend/BannerController/store';
// banner end //

// rekening //
$route['rekening'] = 'Backend/RekeningController';
$route['rekening/form'] = 'Backend/RekeningController/form';
$route['rekening/save-data'] = 'Backend/RekeningController/store';
$route['rekening/destroy'] = 'Backend/RekeningController/destroy';
// rekening end //

// rekening hadiah //
$route['rekening-hadiah'] = 'Backend/RekeningHadiahController';
$route['rekening-hadiah/form'] = 'Backend/RekeningHadiahController/form';
$route['rekening-hadiah/save-data'] = 'Backend/RekeningHadiahController/store';
$route['rekening-hadiah/destroy'] = 'Backend/RekeningHadiahController/destroy';
// rekening hadiah end //

/** Master end */

/** Aktivitas */
$route['kehadiran'] = 'Backend/KehadiranController';

$route['ucapan'] = 'Backend/UcapanController';
$route['ucapan/reply-ucapan'] = 'Backend/UcapanController/updateReply';
/** Aktivitas end */

/** Setting */
// audio //
$route['audio'] = 'Backend/AudioController';
$route['audio/save-data'] = 'Backend/AudioController/store';
// audio end //

// maps //
$route['maps'] = 'Backend/MapsController';
$route['maps/save-data'] = 'Backend/MapsController/store';
// maps end //


/** Setting end */

$route['post-ucapan'] = 'Welcome/store';
$route['get-ucapan'] = 'Welcome/getUcapan';

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
