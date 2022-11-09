<?php
require_once './libs/Router.php';
require_once './app/controllers/Monstruo-api.controller.php';
require_once './app/controllers/Categoria-api.controller.php';

require_once './app/controllers/Admin-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('monster', 'GET', 'MonsterApiController', 'getMonsters');
$router->addRoute('monster/:ID', 'GET', 'MonsterApiController', 'getMonster');
$router->addRoute('monster/:ID', 'DELETE', 'MonsterApiController', 'deleteMonster');
$router->addRoute('monster', 'POST', 'MonsterApiController', 'insertMonster'); 
$router->addRoute('monster/:ID', 'PUT', 'MonsterApiController', 'updateMonster');

$router->addRoute('categorie', 'GET', 'CategorieApiController', 'getCategories');
$router->addRoute('categorie/:ID', 'GET', 'CategorieApiController', 'getCategorie');
$router->addRoute('categorie/:ID', 'DELETE', 'CategorieApiController', 'deleteCategorie');
$router->addRoute('categorie', 'POST', 'CategorieApiController', 'insertCategorie'); 
$router->addRoute('categorie/:ID', 'PUT', 'CategorieApiController', 'updateCategorie');

$router->addRoute('admin/token', 'GET', 'AdminApiController', 'getToken'); 



// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
?>