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

$route['default_controller'] = 'home';
$route['contact'] = 'home/contact';
$route['kebijakan-privasi'] = 'home/privacy_policy';

$route['register'] = 'home/register';
$route['login'] = 'login';
$route['dologin'] = 'login/dologin';
$route['logout'] = 'login/logout';

$route['dashboard'] = 'panel/home';
$route['cari-kiriman'] = 'panel/kirim';
$route['cari-kiriman/(:any)'] = 'panel/kirim/$1';
$route['kirim/getDiscussions'] = 'panel/kirim/getDiscussions';
$route['kirim/getBiddingList'] = 'panel/kirim/getBiddingList';
$route['kirim/getKendaraan'] = 'panel/kirim/getKendaraan';
$route['kirim/kirimPenawaran'] = 'panel/kirim/kirimPenawaran';
$route['kirim/tolakPenawaran'] = 'panel/kirim/tolakPenawaran';
//$route['cari-kiriman/private'] = 'panel/cari_kiriman/privates';
//$route['cari-kiriman/public'] = 'panel/cari_kiriman/publics';
//$route['cari-kiriman/penawaran'] = 'panel/cari_kiriman/penawaran';
$route['alat'] = 'panel/alat';
$route['alat/(:any)'] = 'panel/alat/$1/$2';
$route['kendaraan'] = 'panel/kendaraan';
$route['kendaraan/(:any)'] = 'panel/kendaraan/$1/$2';
$route["kendaraan/getKendaraan"] = "panel/kendaraan/getKendaraan";
$route["kendaraan/tambahKendaraan"] = "panel/kendaraan/tambahKendaraan";
$route["kendaraan/updateKendaraan"] = "panel/kendaraan/updateKendaraan";
$route["kendaraan/toggleKendaraanAktif"] = "panel/kendaraan/toggleKendaraanAktif";
$route["kendaraan/deleteKendaraan"] = "panel/kendaraan/deleteKendaraan";
$route['kirim'] = 'panel/kirim';
//$route['kirim/(:any)'] = 'panel/kirim/$1';
$route['kirim/private'] = 'panel/kirim/privates';
$route['kirim/public'] = 'panel/kirim/publics';
$route['kirim/penawaran'] = 'panel/kirim/penawaran';
$route['kirim/detail/(:any)'] = 'panel/kirim/detail/$1';
$route['kirim/kirimbarang'] = 'panel/kirim/kirimbarang';
$route['kirim/dokirimbarang'] = 'panel/kirim/doKirimBarang';
$route['kirim/updatekirimbarang'] = 'panel/kirim/updatekirimBarang';
$route['kirim/update-items'] = 'panel/kirim/updateItems';
$route['kiriman'] = 'panel/kiriman';
$route['lokasi'] = 'panel/lokasi';
$route['lokasi/(:any)'] = 'panel/lokasi/$1/$2';
$route['rekanan'] = 'panel/rekanan';
$route['rekanan/(:any)'] = 'panel/rekanan/$1/$2';
$route['report'] = 'panel/report';
$route['supir'] = 'panel/supir';
$route['supir/(:any)'] = 'panel/supir/$1/$2';
$route['tagihan'] = 'panel/tagihan';
$route['user'] = 'panel/user';
$route['user'] = 'panel/user';
$route['user/(:any)'] = 'panel/user/$1/$2';
$route['confirm'] = 'confirm';
$route['doconfirm'] = 'confirm/doconfirm';

//$route['expedition/(:any)'] = 'expedition/$1';
//$route['consumer/(:any)'] = 'consumer/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
