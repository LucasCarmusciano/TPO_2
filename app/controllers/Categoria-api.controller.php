<?php
require_once './app/models/Categoria.model.php';
require_once './app/views/api.view.php';

class CategorieApiController {
    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct() {
        $this->model = new CategorieModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getCategories($params = null) {
        $order = $_GET['order'];
        $direction = $_GET['direction'];
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        if(!$order==null){
            // compruebo que el get obtenido sea correcto
            if ((in_array($order,$this->model->getColumns())&&(($direction==null)||($direction=='ASC')||($direction=='DESC')))) {
                $categories = $this->model->getAllOrderBy($order, $direction);
                $this->paginacion($categories, $page, $limit);
            }else{
                $this->view->response("Parametros GET incorrectos", 400); //
            }
        }else{
            $categories = $this->model->getAll();
            $this->paginacion($categories, $page, $limit);
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
    
    public function getCategorie($params = null) {
        $id = $params[':ID'];
        $categorie = $this->model->get($id);

        // si no existe devuelvo 404
        if ($categorie)
            $this->view->response($categorie);
        else 
            $this->view->response("La categoria con el id=$id no existe", 404);
    }

    public function deleteCategorie($params = null) {
        $id = $params[':ID'];

        // if(!$this->authHelper->isLoggedIn()){
        //     $this->view->response("No estas logeado", 401);
        //     return;
        // }

        $categorie = $this->model->get($id);
        if ($categorie) {
            $this->model->delete($id);
            $this->view->response($categorie);
        } else 
            $this->view->response("La categoria con el id=$id no existe", 404);
    }

    public function insertCategorie($params = null) {
        $categorie = $this->getData();

        // if(!$this->authHelper->isLoggedIn()){
        //     $this->view->response("No estas logeado", 401);
        //     return;
        // }
        
        if (empty($categorie->nombre) || empty($categorie->descripcion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($categorie->nombre, $categorie->descripcion);
            $categorie = $this->model->get($id);
            $this->view->response($categorie, 201);
        }
    }

    public function updateCategorie($params = null) {
        $categorie = $this->getData();

        // if(!$this->authHelper->isLoggedIn()){
        //     $this->view->response("No estas logeado", 401);
        //     return;
        // }

        $id = $params[':ID'];
        $autocompleter = $this->model->get($id);
            if(empty($categorie->nombre)){
                $categorie->nombre = $autocompleter->nombre;
            }
            if(empty($categorie->descripcion)){
                $categorie->descripcion = $autocompleter->descripcion;
            }
        $this->model->update($categorie->nombre, $categorie->descripcion, $id);

        $categorie = $this->model->get($id);
        $this->view->response($categorie, 201);
    }

}