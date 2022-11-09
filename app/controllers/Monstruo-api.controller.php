<?php
require_once './app/models/Monstruo.model.php';
require_once './app/views/api.view.php';

class MonsterApiController {
    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct() {
        $this->model = new MonsterModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getMonsters($params = null) {
        $order = $_GET['order'];
        $direction = $_GET['direction'];
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        if(!$order==null){
            // compruebo que el get obtenido sea correcto
            if ((in_array($order,$this->model->getColumns())&&(($direction==null)||($direction=='ASC')||($direction=='DESC')))) {
                $monsters = $this->model->getAllOrderBy($order, $direction);
                $this->paginacion($monsters, $page, $limit);
            }else{
                $this->view->response("Parametros GET incorrectos", 400); //
            }
        }else{
            $monsters = $this->model->getAll();
            $this->paginacion($monsters, $page, $limit);
        }
    }
    private function paginacion($list, $page, $limit){
        if(isset($page)&&isset($limit)){
            // si 'page' y 'limit' son de tipo int, selecciono la pagina indicada
            if ((filter_var($page, FILTER_VALIDATE_INT)!== false)&&(filter_var($limit, FILTER_VALIDATE_INT) !== false)){
              $list = array_slice($list, $page*$limit, $limit);
              $this->view->response($list);
            }else{
                $this->view->response("Pagina o limite incorrectos", 400); //
            }
        }else{
            $this->view->response($list, 200);
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

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

        $monster = $this->model->get($id);
        if ($monster) {
            $this->model->delete($id);
            $this->view->response($monster);
        } else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function insertMonster($params = null) {
        $monster = $this->getData();

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }
        
        if (empty($monster->nombre) || empty($monster->debilidad) || empty($monster->descripcion) || empty($monster->id_Categoria_fk)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($monster->nombre, $monster->debilidad, $monster->descripcion, $monster->id_Categoria_fk, $monster->imagen);
            $monster = $this->model->get($id);
            $this->view->response($monster, 201);
        }
    }

    public function updateMonster($params = null) {
        $monster = $this->getData();
        $id = $params[':ID'];
        $autocompleter = $this->model->get($id);
            if(empty($monster->nombre)){
                $monster->nombre = $autocompleter->nombre;
            }
            if(empty($monster->debilidad)){
                $monster->debilidad = $autocompleter->debilidad;
            }
            if(empty($monster->descripcion)){
                $monster->descripcion = $autocompleter->descripcion;
            }
            if(empty($monster->id_Categoria_fk)){
                $categoria = $autocompleter->categoria;
                $monster->id_Categoria_fk = $this->model->getIdCategoriaFk($categoria)->id_Categoria_fk;
            }
            if(empty($monster->imagen)){
                $monster->imagen = $autocompleter->imagen;
            }
        $this->model->update($monster->nombre, $monster->debilidad, $monster->descripcion, $monster->id_Categoria_fk, $id, $monster->imagen);

        $monster = $this->model->get($id);
        $this->view->response($monster, 201);
    }

}