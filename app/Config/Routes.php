<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Pages::index');
 $routes->get('/orang', 'Orang::index');
 $routes->post('/orang', 'Orang::index');
 $routes->get('/about', 'Pages::about');
 $routes->get('/contact', 'Pages::contact');
 $routes->get('/komik', 'Komik::index');
 $routes->get('/komik/create', 'Komik::create');
 $routes->get('/komik/(:any)', 'Komik::detail/$1');
 $routes->get('/edit/(:num)', 'Komik::edit/$1');
 $routes->put('/edit/(:num)', 'Komik::update/$1');
 $routes->post('/komik/create', 'Komik::save');
 $routes->delete('/komik/(:num)', 'Komik::delete/$1');

// urutan berpengaruh yang benar /komik -> /komik/create -> /komik/:denagn parameter 

// $routes->get('/test','Coba::index');
// $routes->get('/test/about','Coba::about');
// $routes->get('/test/test2',function(){
//   echo 'test cuy';
// });

// untuk parameter di URL
// $routes->get('/test/(:any)', 'Coba::about/$1');

// // memanipulasi route
// $routes->get('/test2/(:any)/(:any)', 'Coba::test/$1/$2');
// $routes->get('users','admin\Users::index');



