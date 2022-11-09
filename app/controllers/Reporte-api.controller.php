<?php
require_once './app/models/Reporte.model.php';
require_once './app/views/api.view.php';

class ReportApiController {
    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct() {
        $this->model = new ReportModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getReports($params = null) {
        $order = $_GET['order'];
        $direction = $_GET['direction'];
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        $monster = $_GET['monster'];
        if(isset($monster)){
            $this->getFilterReports($monster, $order, $direction, $page, $limit);
        }else{
            if(!$order==null){
                // compruebo que el get obtenido sea correcto
                if ((in_array($order,$this->model->getColumns())&&(($direction==null)||($direction=='ASC')||($direction=='DESC')))) {
                    $reports = $this->model->getAllOrderBy($order, $direction);
                    $this->paginacion($reports, $page, $limit);
                }else{
                    $this->view->response("Parametros GET incorrectos", 400);
                }
            }else{
                $reports = $this->model->getAll();
                $this->paginacion($reports, $page, $limit);
            }
        }
    }
    
    private function getFilterReports($monster, $order, $direction, $page, $limit){
        if(!$order==null){
            // compruebo que el get obtenido sea correcto
            if ((in_array($order,$this->model->getColumns())&&(($direction==null)||($direction=='ASC')||($direction=='DESC')))) {
                $reports = $this->model->getFilterOrderBy($monster, $order, $direction);
                $this->paginacion($reports, $page, $limit);
            }else{
                $this->view->response("Parametros GET incorrectos", 400);
            }
        }else{
            $reports = $this->model->getFilter($monster);
            $this->paginacion($reports, $page, $limit);
        }
    }

    // Metodo privado para paginar en caso de que existan los parametros correctos.
    private function paginacion($list, $page, $limit){
        if(isset($page)&&isset($limit)){
            // si 'page' y 'limit' son de tipo int, selecciono la pagina indicada
            if ((filter_var($page, FILTER_VALIDATE_INT)!== false)&&(filter_var($limit, FILTER_VALIDATE_INT) !== false)){
              $list = array_slice($list, $page*$limit, $limit);
              $this->view->response($list);
            }else{
                $this->view->response("Pagina o limite incorrectos", 400);
            }
        }else{
            $this->view->response($list, 200);
        }
    }
    
    public function getReport($params = null) {
        $id = $params[':ID'];
        $report = $this->model->get($id);
        
        // si no existe devuelvo 404
        if ($report)
        $this->view->response($report);
        else 
        $this->view->response("El reporte con el id=$id no existe", 404);
    }
    
    public function deleteReport($params = null) {
        $id = $params[':ID'];
        
        // Verifico que tenga el token
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }
            
            $report = $this->model->get($id);
            if ($report) {
                $this->model->delete($id);
                $this->view->response($report);
            } else 
            $this->view->response("El reporte con el id=$id no existe", 404);
        }
        
        public function insertReport($params = null) {
            $report = $this->getData();
            
            // Verifico que tenga el token
            if(!$this->authHelper->isLoggedIn()){
                $this->view->response("No estas logeado", 401);
                return;
            }
                
            if (empty($report->narrador) || empty($report->historia) || empty($report->agresividad) || empty($report->id_Monstruo_fk)) {
                $this->view->response("Complete los datos", 400);
            } else {
                $id = $this->model->insert($report->narrador, $report->historia, $report->agresividad, $report->id_Monstruo_fk);
                $report = $this->model->get($id);
                $this->view->response($report, 201);
            }
        }
            
        public function updateReport($params = null) {
            $report = $this->getData();
            
            // Verifico que tenga el token
            if(!$this->authHelper->isLoggedIn()){
                $this->view->response("No estas logeado", 401);
                return;
            }

            $id = $params[':ID'];
            $autocompleter = $this->model->get($id);
                if(empty($report->narrador)){
                    $report->narrador = $autocompleter->narrador;
                }
                if(empty($report->historia)){
                    $report->historia = $autocompleter->historia;
                }
                if(empty($report->agresividad)){
                    $report->agresividad = $autocompleter->agresividad;
                }
                if(empty($report->id_Monstruo_fk)){
                    $monstruo = $autocompleter->monstruo;
                    $report->id_Monstruo_fk = $this->model->getIdMonstruoFk($monstruo)->id_Monstruo_fk;
                }
            $this->model->update($report->narrador, $report->historia, $report->agresividad, $report->id_Monstruo_fk, $id);

            $monster = $this->model->get($id);
            $this->view->response($report, 201);
    }

}