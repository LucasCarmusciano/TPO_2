<?php
require_once './app/models/Monstruo.model.php';
require_once './app/models/Usuario.model.php';
require_once './app/views/api.view.php';
require_once './app/helper/AuthApiHelper.php';


function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

class AdminApiController {
    private $model;
    private $view;
    private $authHelper;

    function __construct(){
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        $this->model = new UserModel();

        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    function getToken($params = null){
        $basic = $this->authHelper->getAuthHeader();
        if(empty($basic)){
            $this->view->response('No autorizado', 401);
            return;
        }
        $basic = explode(" ",$basic);
        if($basic[0]!="Basic"){
            $this->view->response('La autenticación debe ser Basic', 401);
            return;
        }
        //valida usuario, contraseña
        $adminpass = base64_decode($basic[1]);
        $adminpass = explode(":", $adminpass);
        $email = $adminpass[0];
        $pass = $adminpass[1];

        //obtengo usuario
        $user = $this->model->getUser($email);
        
        if($user && password_verify($pass, $user->contrasenia)){
            //  crear un token
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            $payload = array(
                'id' => $user->id,
                'name' => $user->nombre,
                'exp' => time()+3600
            );
            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            $signature = hash_hmac('SHA256', "$header.$payload", "Clave1234", true);
            $signature = base64url_encode($signature);
            $token = "$header.$payload.$signature";
             $this->view->response($token);
        }else{
            $this->view->response('No autorizado', 401);
        }
    }
}
?>