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

$route['dashboard'] = 'panel/dashboard';
$route['cari-kiriman'] = 'panel/kirim';
$route['cari-kiriman/(:any)'] = 'panel/kirim/$1';
$route['kirim/getDiscussions'] = 'panel/kirim/getDiscussions';
$route['kirim/getBiddingList'] = 'panel/kirim/getBiddingList';
$route['kirim/getKendaraan'] = 'panel/kirim/getKendaraan';
$route['kirim/kirimPenawaran'] = 'panel/kirim/kirimPenawaran';
$route['kirim/tolakPenawaran'] = 'panel/kirim/tolakPenawaran';
$route['kirim'] = 'panel/kirim';
//$route['kirim/(:any)'] = 'panel/kirim/$1';
$route['kirim/getKiriman'] = 'panel/kirim/getKiriman';
$route['kirim/private'] = 'panel/kirim/privates';
$route['kirim/public'] = 'panel/kirim/publics';
$route['kirim/getKota'] = 'panel/kirim/getKota';
$route['kirim/getRangeHarga'] = 'panel/kirim/getRangeHarga';
$route['kirim/getSavedLocation'] = 'panel/kirim/getSavedLocation';
$route['kirim/kirimPertanyaan'] = 'panel/kirim/kirimPertanyaan';
$route['kirim/jawabPertanyaan'] = 'panel/kirim/jawabPertanyaan';
$route['kirim/penawaran'] = 'panel/kirim/penawaran';
$route['kirim/detail/(:any)'] = 'panel/kirim/detail/$1';
$route['kirim/kirimbarang'] = 'panel/kirim/kirimbarang';
$route['kirim/dokirimbarang'] = 'panel/kirim/doKirimBarang';
$route['kirim/updatekirimbarang'] = 'panel/kirim/updatekirimBarang';
$route['kirim/update-items'] = 'panel/kirim/updateItems';
$route['kirim/setujuPenawaran'] = 'panel/kirim/setujuPenawaran';
$route['kiriman-saya'] = 'panel/kiriman';
$route['kiriman-saya/getKirimanSaya'] = 'panel/kiriman/getKirimanSaya';
$route['kiriman-saya/getOpenKiriman'] = 'panel/kiriman/getOpenKiriman';
$route['kiriman-saya/getPendingKiriman'] = 'panel/kiriman/getPendingKiriman';
$route['kiriman-saya/getPesananKiriman'] = 'panel/kiriman/getPesananKiriman';
$route['kiriman-saya/getDikirimKiriman'] = 'panel/kiriman/getDikirimKiriman';
$route['kiriman-saya/getDiambilKiriman'] = 'panel/kiriman/getDiambilKiriman';
$route['kiriman-saya/getDiterimaKiriman'] = 'panel/kiriman/getDiterimaKiriman';
$route['kiriman-saya/getSelesaiKiriman'] = 'panel/kiriman/getSelesaiKiriman';
$route['kiriman-saya/getCancelKiriman'] = 'panel/kiriman/getCancelKiriman';
$route['kiriman-saya/submitRating'] = 'panel/kiriman/submitRating';
$route['kiriman-saya/cancelShipment'] = 'panel/kiriman/cancelShipment';
$route['kiriman-ekspedisi'] = 'panel/kiriman_ekspedisi';
$route['kiriman-ekspedisi/getKirimanSaya'] = 'panel/kiriman_ekspedisi/getKirimanSaya';
$route['kiriman-ekspedisi/submitDeal'] = 'panel/kiriman_ekspedisi/submitDeal';
$route['kiriman-ekspedisi/getKendaraan'] = 'panel/kiriman_ekspedisi/getKendaraan';
$route['kiriman-ekspedisi/getSupir'] = 'panel/kiriman_ekspedisi/getSupir';
$route['kiriman-ekspedisi/getAlat'] = 'panel/kiriman_ekspedisi/getAlat';
$route['kiriman-ekspedisi/submitPesan'] = 'panel/kiriman_ekspedisi/submitPesan';
$route['kiriman-ekspedisi/submitKirim'] = 'panel/kiriman_ekspedisi/submitKirim';
$route['kiriman-ekspedisi/submitAmbil'] = 'panel/kiriman_ekspedisi/submitAmbil';
$route['kiriman-ekspedisi/submitTerima'] = 'panel/kiriman_ekspedisi/submitTerima';
$route['kiriman-ekspedisi/cancelShipment'] = 'panel/kiriman_ekspedisi/cancelShipment';
$route["kiriman-ekspedisi/getDealKiriman"] = 'panel/kiriman_ekspedisi/getDealKiriman';
$route["kiriman-ekspedisi/getPendingKiriman"] = 'panel/kiriman_ekspedisi/getPendingKiriman';
$route["kiriman-ekspedisi/getPesananKiriman"] = 'panel/kiriman_ekspedisi/getPesananKiriman';
$route["kiriman-ekspedisi/getDikirimKiriman"] = 'panel/kiriman_ekspedisi/getDikirimKiriman';
$route["kiriman-ekspedisi/getDiambilKiriman"] = 'panel/kiriman_ekspedisi/getDiambilKiriman';
$route["kiriman-ekspedisi/getDiterimaKiriman"] = 'panel/kiriman_ekspedisi/getDiterimaKiriman';
$route["kiriman-ekspedisi/getSelesaiKiriman"] = 'panel/kiriman_ekspedisi/getSelesaiKiriman';
$route["kiriman-ekspedisi/getCancelKiriman"] = 'panel/kiriman_ekspedisi/getCancelKiriman';
//$route['cari-kiriman/private'] = 'panel/cari_kiriman/privates';
//$route['cari-kiriman/public'] = 'panel/cari_kiriman/publics';
//$route['cari-kiriman/penawaran'] = 'panel/cari_kiriman/penawaran';
$route['alat'] = 'panel/alat';
$route['alat/(:any)'] = 'panel/alat/$1/$2';
$route["alat/getAlat"] = "panel/alat/getAlat";
$route["alat/tambahAlat"] = "panel/alat/tambahAlat";
$route["alat/updateAlat"] = "panel/alat/updateAlat";
$route["alat/toggleAlatAktif"] = "panel/alat/toggleAlatAktif";
$route["alat/deleteAlat"] = "panel/alat/deleteAlat";
$route['kendaraan'] = 'panel/kendaraan';
$route['kendaraan/(:any)'] = 'panel/kendaraan/$1/$2';
$route["kendaraan/getKendaraan"] = "panel/kendaraan/getKendaraan";
$route["kendaraan/tambahKendaraan"] = "panel/kendaraan/tambahKendaraan";
$route["kendaraan/updateKendaraan"] = "panel/kendaraan/updateKendaraan";
$route["kendaraan/toggleKendaraanAktif"] = "panel/kendaraan/toggleKendaraanAktif";
$route["kendaraan/deleteKendaraan"] = "panel/kendaraan/deleteKendaraan";

$route['lokasi'] = 'panel/lokasi';
$route['lokasi/getMyLocation'] = 'panel/lokasi/getMyLocation';
$route['lokasi/addLocation'] = 'panel/lokasi/addLocation';
$route['lokasi/updateLocation'] = 'panel/lokasi/updateLocation';
$route['lokasi/deleteLocation'] = 'panel/lokasi/deleteLocation';
$route['rekanan'] = 'panel/rekanan';
$route['rekanan/(:any)'] = 'panel/rekanan/$1/$2';
$route['report'] = 'panel/report';
$route['supir'] = 'panel/supir';
$route['supir/(:any)'] = 'panel/supir/$1/$2';
$route["supir/tambahSupir"] = "panel/supir/tambahSupir";
$route["supir/updateSupir"] = "panel/supir/updateSupir";
$route["supir/toggleSupirAktif"] = "panel/supir/toggleSupirAktif";
$route["supir/deleteSupir"] = "panel/supir/deleteSupir";
$route['tagihan'] = 'panel/tagihan';
$route['user'] = 'panel/user';
$route['user/(:any)'] = 'panel/user/$1/$2';
$route['user/getUser'] = 'panel/user/getUser';
$route['user/addOtherUser'] = 'panel/user/addOtherUser';
$route['user/getMyGroups'] = 'panel/user/getMyGroups';
$route['user/insertGroup'] = 'panel/user/insertGroup';
$route['user/updateGroup'] = 'panel/user/updateGroup';
$route['ulasan'] = 'panel/ulasan';
$route['ulasan/getMyRating'] = 'panel/ulasan/getMyRating';
$route['ulasan/getMyFeedback'] = 'panel/ulasan/getMyFeedback';
$route['statistik'] = 'panel/statistik';
$route['statistik/getStatistikKiriman'] = 'panel/statistik/getStatistikKiriman';
$route['statistik/getStatistikBidding'] = 'panel/statistik/getStatistikBidding';
$route['confirm'] = 'confirm';
$route['doconfirm'] = 'confirm/doconfirm';
$route['account-settings'] = 'panel/account';
$route['account-settings/updateCertainField'] = 'panel/account/updateCertainField';
//$route['expedition/(:any)'] = 'expedition/$1';
//$route['consumer/(:any)'] = 'consumer/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
