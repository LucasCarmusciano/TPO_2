<?php
require_once './libs/Router.php';
require_once './app/controllers/Monstruo-api.controller.php';
require_once './app/controllers/Admin-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('monster', 'GET', 'MonsterApiController', 'getMonsters');
$router->addRoute('monster/:ID', 'GET', 'MonsterApiController', 'getMonster');
$router->addRoute('monster/:ID', 'DELETE', 'MonsterApiController', 'deleteMonster');
$router->addRoute('monster', 'POST', 'MonsterApiController', 'insertMonster'); 
$router->addRoute('monster/:ID', 'PUT', 'MonsterApiController', 'updateMonster'); 
$router->addRoute('admin/token', 'GET', 'AdminApiController', 'getToken'); 



// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
?>