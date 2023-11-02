<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');


// Bagian Halaman Admin

$routes->get('admin/data_admin/(:segment)', 'CreateAdmin::create_akun_admin/$1');
$routes->get('admin/edit_akun_admin/(:segment)', 'Admin::create_akun_admin/$1');
$routes->get('admin/detail_akun_admin/(:num)', 'Admin::deleteAkunAdmin/$1');
$routes->get('detailadmin/data_admin/(:any)', 'DetailAdmin::detail_akun_admin/$1');


// Membuat routes baru dengan method get ketika user mengakses (admin/berita_admin) apapun dan ambil serta diarahkan ke controller admin dengan method detail
$routes->get('admin/berita_admin/(:segment)', 'CreateAdmin::create_berita_admin/$1');
$routes->get('detailadmin/edit_berita_admin/(:segment)', 'EditUpdateAdmin::editBerita/$1');
$routes->get('detailadmin/detail_berita_admin/(:num)', 'DeleteAdmin::deleteBerita/$1');
$routes->get('detailadmin/berita_admin/(:any)', 'DetailAdmin::detail_berita_admin/$1');


$routes->get('admin/inovasi_admin/(:segment)', 'CreateAdmin::create_inovasi_admin/$1');
$routes->get('admin/edit_inovasi_admin/(:segment)', 'Admin::editInovasi/$1');
$routes->get('admin/detail_inovasi_admin/(:num)', 'Admin::deleteInovasi/$1');
$routes->get('admin/inovasi_admin/(:any)', 'DetailAdmin::detail_inovasi_admin/$1');




// Bagian Halaman User
$routes->get('pages/index/(:segment)', 'Pages::detail_berita/$1');
$routes->get('pages/index/(:segment)', 'Pages::detail_inovasi/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
