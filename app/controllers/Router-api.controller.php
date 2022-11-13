<?php
require_once './app/views/api.view.php';

class defaultRouterMsg{

    private $view;

    public function __construct(){
        $this->view = new ApiView;
    }

    public function message(){
        $this->view->response('Pagina inexistente', 404);
        return;
    }
}