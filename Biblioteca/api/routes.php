<?php
$router->post('/auth/login',   'AuthController@login');
$router->post('/auth/logout',  'AuthController@logout');
$router->get('/auth/me',       'AuthController@me');
$router->get('/admin/resumen', 'AdminController@resumen');