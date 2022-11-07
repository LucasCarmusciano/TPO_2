<?php
require_once './app/models/Monstruo.model.php';
require_once './app/views/api.view.php';

class MonsterApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new MonsterModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getMonsters($params = null) {
        $order = $_GET['order'];
        $direction = $_GET['direction'];
        // verifico que exista 'page' y 'limit' para transformarlo en int
        if(isset($_GET['page'])&&isset($_GET['limit'])){
            $page = (int) $_GET['page'];
            $limit = (int) $_GET['limit'];
        }
        if(!$order==null){
            if ((in_array($order,$this->model->getColumns())&&(($direction==null)||($direction=='ASC')||($direction=='DESC')))) { // compruebo que el get obtenido sea correcto
                $monsters = $this->model->getAllOrderBy($order, $direction);
                // si 'page' y 'limit' son de tipo int, selecciono la pagina indicada
                if((is_int($page))&(is_int($limit))){
                    $monsters = array_slice($monsters, $page*$limit, $limit);
                }
                $this->view->response($monsters);
            }else{
                $this->view->response("Parametros GET incorrectos", 400); //
            }
        }else{
            $monsters = $this->model->getAll();
            // si 'page' y 'limit' son de tipo int, selecciono la pagina indicada
            if((is_int($page))&(is_int($limit))){
                $monsters = array_slice($monsters, $page*$limit, $limit);
            }
            $this->view->response($monsters);
        }
    }

    public function getMonster($params = null) {
        $id = $params[':ID'];
        $monster = $this->model->get($id);

        // si no existe devuelvo 404
        if ($monster)
            $this->view->response($monster);
        else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function deleteMonster($params = null) {
        $id = $params[':ID'];

        $monster = $this->model->get($id);
        if ($monster) {
            $this->model->delete($id);
            $this->view->response($monster);
        } else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function insertMonster($params = null) {
        $monster = $this->getData();

        if (empty($monster->nombre) || empty($monster->debilidad) || empty($monster->descripcion) || empty($monster->id_Categoria_fk)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($monster->nombre, $monster->debilidad, $monster->descripcion, $monster->id_Categoria_fk, $monster->imagen);
            $monster = $this->model->get($id);
            $this->view->response($monster, 201);
        }
    }

}