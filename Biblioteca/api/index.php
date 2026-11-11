<?php
require_once __DIR__ . '/autoload.php';
EnvLoader::cargar(__DIR__ . '/.env');

$router = new Router();
require __DIR__ . '/routes.php';
$router->despachar();