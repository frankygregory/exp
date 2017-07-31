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
$route['syarat-dan-ketentuan'] = 'home/terms';
$route['profil/(:any)'] = 'home/profil/$1';
$route['profil/getStatistik'] = 'home/profil/getStatistik';
$route['profil/getProfilRating'] = 'home/profil/getProfilRating';
$route['profil/getProfilFeedback'] = 'home/profil/getProfilFeedback';
$route["verify-email/(:any)"] = "home/verify_email/$1";
$route["verify-device-email/(:any)"] = "home/verify_device_email/$1";
$route["reset-password/(:any)"] = "home/reset_password/$1";
$route['list-kiriman'] = 'home/list_kiriman';
$route['forgot-password'] = 'home/forgot_password';
$route['how/pemilik-kendaraan'] = 'home/how/pemilik-kendaraan';
$route['how/pemilik-barang'] = 'home/how/pemilik-barang';
$route['register'] = 'home/register';
$route["resendVerificationEmail"] = "home/resendVerificationEmail";
$route['login'] = 'login';
$route['dologin'] = 'login/dologin';
$route['logout'] = 'login/logout';

$route['api/device/(:any)'] = 'api/device_get_shipment/$1';
$route['api/device/shipment/(:any)'] = 'api/device_get_shipment_detail/$1';
$route['api/post-coordinate'] = 'api/post_coordinate';
$route['api/submit-terima'] = 'api/submit_terima';
$route['api/submit-ambil'] = 'api/submit_ambil';
$route['api/submit-kirim'] = 'api/submit_kirim';

$route['dashboard'] = 'panel/dashboard';

$route['cari-kiriman-bisnis'] = 'panel/kirim/pro';
$route['cari-kiriman-bisnis/getKirimanPro'] = 'panel/kirim/getKirimanPro';
$route['cari-kiriman-bisnis/getKota'] = 'panel/kirim/getKotaPro';

$route['cari-kiriman'] = 'panel/kirim';
$route['cari-kiriman/(:any)'] = 'panel/kirim/$1';
$route['kirim/getDiscussions'] = 'panel/kirim/getDiscussions';
$route['kirim/getBiddingList'] = 'panel/kirim/getBiddingList';
$route['kirim/getKendaraan'] = 'panel/kirim/getKendaraan';
$route['kirim/kirimPenawaran'] = 'panel/kirim/kirimPenawaran';
$route['kirim/tolakPenawaran'] = 'panel/kirim/tolakPenawaran';
$route['kirim/cancelBidding'] = 'panel/kirim/cancelBidding';
$route['kirim'] = 'panel/kirim';
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

$route['penawaran-bisnis'] = 'panel/penawaran_pro';
$route['penawaran-bisnis/getOpenKiriman'] = 'panel/penawaran_pro/getOpenKiriman';
$route['penawaran-bisnis/getClosedKiriman'] = 'panel/penawaran_pro/getClosedKiriman';
$route['penawaran-bisnis/getKirimanCount'] = 'panel/penawaran_pro/getKirimanCount';

$route['penawaran'] = 'panel/penawaran';
$route['penawaran/getOpenKiriman'] = 'panel/penawaran/getOpenKiriman';
$route['penawaran/getClosedKiriman'] = 'panel/penawaran/getClosedKiriman';
$route['penawaran/getKirimanCount'] = 'panel/penawaran/getKirimanCount';

$route['kiriman-saya-bisnis'] = 'panel/kiriman_pro';
$route['kiriman-saya-bisnis/getKirimanCount'] = 'panel/kiriman_pro/getKirimanCount';
$route['kiriman-saya-bisnis/getInfoEkspedisi'] = 'panel/kiriman_pro/getInfoEkspedisi';
$route['kiriman-saya-bisnis/getOpenKiriman'] = 'panel/kiriman_pro/getOpenKiriman';
$route['kiriman-saya-bisnis/getProgressKiriman'] = 'panel/kiriman_pro/getProgressKiriman';
$route['kiriman-saya-bisnis/getSelesaiKiriman'] = 'panel/kiriman_pro/getSelesaiKiriman';
$route['kiriman-saya-bisnis/getCancelKiriman'] = 'panel/kiriman_pro/getCancelKiriman';
$route['kiriman-saya-bisnis/submitRating'] = 'panel/kiriman_pro/submitRating';
$route['kiriman-saya-bisnis/cancelShipment'] = 'panel/kiriman_pro/cancelShipment';

$route['kiriman-saya'] = 'panel/kiriman';
$route['kiriman-saya/getKirimanCount'] = 'panel/kiriman/getKirimanCount';
$route['kiriman-saya/getInfoEkspedisi'] = 'panel/kiriman/getInfoEkspedisi';
$route['kiriman-saya/getOpenKiriman'] = 'panel/kiriman/getOpenKiriman';
$route['kiriman-saya/getProgressKiriman'] = 'panel/kiriman/getProgressKiriman';
$route['kiriman-saya/getSelesaiKiriman'] = 'panel/kiriman/getSelesaiKiriman';
$route['kiriman-saya/getCancelKiriman'] = 'panel/kiriman/getCancelKiriman';
$route['kiriman-saya/submitRating'] = 'panel/kiriman/submitRating';
$route['kiriman-saya/cancelShipment'] = 'panel/kiriman/cancelShipment';

$route['kiriman-darat-ekspedisi'] = 'panel/kiriman_ekspedisi';
$route['kiriman-darat-ekspedisi/getKirimanSaya'] = 'panel/kiriman_ekspedisi/getKirimanSaya';
$route['kiriman-darat-ekspedisi/getDetailPengirim'] = 'panel/kiriman_ekspedisi/getDetailPengirim';
$route['kiriman-darat-ekspedisi/submitDeal'] = 'panel/kiriman_ekspedisi/submitDeal';
$route['kiriman-darat-ekspedisi/getKendaraan'] = 'panel/kiriman_ekspedisi/getKendaraan';
$route['kiriman-darat-ekspedisi/getSupir'] = 'panel/kiriman_ekspedisi/getSupir';
$route['kiriman-darat-ekspedisi/getAlat'] = 'panel/kiriman_ekspedisi/getAlat';
$route['kiriman-darat-ekspedisi/submitPesan'] = 'panel/kiriman_ekspedisi/submitPesan';
$route['kiriman-darat-ekspedisi/submitKirim'] = 'panel/kiriman_ekspedisi/submitKirim';
$route['kiriman-darat-ekspedisi/submitAmbil'] = 'panel/kiriman_ekspedisi/submitAmbil';
$route['kiriman-darat-ekspedisi/submitTerima'] = 'panel/kiriman_ekspedisi/submitTerima';
$route['kiriman-darat-ekspedisi/cancelShipment'] = 'panel/kiriman_ekspedisi/cancelShipment';
$route["kiriman-darat-ekspedisi/getDealKiriman"] = 'panel/kiriman_ekspedisi/getDealKiriman';
$route["kiriman-darat-ekspedisi/getPendingKiriman"] = 'panel/kiriman_ekspedisi/getPendingKiriman';
$route["kiriman-darat-ekspedisi/getPesananKiriman"] = 'panel/kiriman_ekspedisi/getPesananKiriman';
$route["kiriman-darat-ekspedisi/getDikirimKiriman"] = 'panel/kiriman_ekspedisi/getDikirimKiriman';
$route["kiriman-darat-ekspedisi/getDiambilKiriman"] = 'panel/kiriman_ekspedisi/getDiambilKiriman';
$route["kiriman-darat-ekspedisi/getDiterimaKiriman"] = 'panel/kiriman_ekspedisi/getDiterimaKiriman';
$route["kiriman-darat-ekspedisi/getSelesaiKiriman"] = 'panel/kiriman_ekspedisi/getSelesaiKiriman';
$route["kiriman-darat-ekspedisi/getCancelKiriman"] = 'panel/kiriman_ekspedisi/getCancelKiriman';

$route['kiriman-laut-ekspedisi'] = 'panel/kiriman_ekspedisi_laut';
$route['kiriman-laut-ekspedisi/getKirimanSaya'] = 'panel/kiriman_ekspedisi_laut/getKirimanSaya';
$route['kiriman-laut-ekspedisi/getDetailPengirim'] = 'panel/kiriman_ekspedisi_laut/getDetailPengirim';
$route["kiriman-laut-ekspedisi/getDealKiriman"] = 'panel/kiriman_ekspedisi_laut/getDealKiriman';
$route["kiriman-laut-ekspedisi/getPendingKiriman"] = 'panel/kiriman_ekspedisi_laut/getPendingKiriman';
$route["kiriman-laut-ekspedisi/getDoorAwalKiriman"] = 'panel/kiriman_ekspedisi_laut/getDoorAwalKiriman';
$route["kiriman-laut-ekspedisi/getPortAwalKiriman"] = 'panel/kiriman_ekspedisi_laut/getPortAwalKiriman';
$route["kiriman-laut-ekspedisi/getPortAkhirKiriman"] = 'panel/kiriman_ekspedisi_laut/getPortAkhirKiriman';
$route["kiriman-laut-ekspedisi/getDoorAkhirKiriman"] = 'panel/kiriman_ekspedisi_laut/getDoorAkhirKiriman';
$route["kiriman-laut-ekspedisi/getSelesaiKiriman"] = 'panel/kiriman_ekspedisi_laut/getSelesaiKiriman';
$route["kiriman-laut-ekspedisi/getCancelKiriman"] = 'panel/kiriman_ekspedisi_laut/getCancelKiriman';
$route['kiriman-laut-ekspedisi/submitDeal'] = 'panel/kiriman_ekspedisi_laut/submitDeal';
$route['kiriman-laut-ekspedisi/submitUbah'] = 'panel/kiriman_ekspedisi_laut/submitUbah';
$route['kiriman-laut-ekspedisi/cancelShipment'] = 'panel/kiriman_ekspedisi_laut/cancelShipment';

$route['alat'] = 'panel/alat';
$route['alat/(:any)'] = 'panel/alat/$1/$2';
$route["alat/getAlat"] = "panel/alat/getAlat";
$route['alat/checkUserKembar'] = 'panel/alat/checkUserKembar';
$route['alat/checkEmailKembar'] = 'panel/alat/checkEmailKembar';
$route["alat/tambahAlat"] = "panel/alat/tambahAlat";
$route["alat/updateAlat"] = "panel/alat/updateAlat";
$route['alat/gantiPassword'] = 'panel/alat/gantiPassword';
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

$route['rekanan-ekspedisi'] = 'panel/rekanan_ekspedisi';
$route["rekanan-ekspedisi/getRekanan"] = "panel/rekanan_ekspedisi/getRekanan";
$route["rekanan-ekspedisi/getPendingRekanan"] = "panel/rekanan_ekspedisi/getPendingRekanan";
$route['rekanan'] = 'panel/rekanan_konsumen';
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
$route['user/checkUserKembar'] = 'panel/user/checkUserKembar';
$route['user/checkEmailKembar'] = 'panel/user/checkEmailKembar';
$route['user/addOtherUser'] = 'panel/user/addOtherUser';
$route['user/updateOtherUser'] = 'panel/user/updateOtherUser';
$route['user/updateOtherUserPassword'] = 'panel/user/updateOtherUserPassword';
$route['user/deleteOtherUser'] = 'panel/user/deleteOtherUser';
$route['user/getMyGroups'] = 'panel/user/getMyGroups';
$route['user/insertGroup'] = 'panel/user/insertGroup';
$route['user/updateGroup'] = 'panel/user/updateGroup';
$route['user/deleteGroup'] = 'panel/user/deleteGroup';

$route['ulasan'] = 'panel/ulasan';
$route['ulasan/getMyRating'] = 'panel/ulasan/getMyRating';
$route['ulasan/getMyFeedback'] = 'panel/ulasan/getMyFeedback';

$route['statistik'] = 'panel/statistik';
$route['statistik/getStatistik'] = 'panel/statistik/getStatistik';
$route['confirm'] = 'confirm';
$route['doconfirm'] = 'confirm/doconfirm';
$route['account-settings'] = 'panel/account';
$route['account-settings/updateCertainField'] = 'panel/account/updateCertainField';
//$route['expedition/(:any)'] = 'expedition/$1';
//$route['consumer/(:any)'] = 'consumer/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
