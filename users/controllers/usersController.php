<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/login/models/UsuarioModel.php'); 
require_once($raiz.'/users/views/usersView.php'); 
// die('usuarios'.$raiz);

// die('pasooo3');
class usersController
{
    protected $view;
    protected $model; 

    public function __construct()
    {
        session_start();
        if(!isset($_SESSION['id_usuario']))
        {
            echo 'la sesion ha caducado';
            echo '<button class="btn btn-primary" onclick="irPantallaLogueo();">Continuar</button>';
            die();
        }

        $this->model = new UsuarioModel();  
        $this->view = new usersView();  

        // echo 'llego a usercontroller';
        if(!isset($_REQUEST['opcion'])){
            $this->usersMenu();
        }    

        if($_REQUEST['opcion']=='pedirInfoUsuario'){
            $this->pedirInfoUsuario();
        }

        if($_REQUEST['opcion']=='crearUsuario'){
            // echo '<pre>'; print_r($_REQUEST) ;echo '</pre>';
            $this->crearUsuario($_REQUEST);
        }
    }

    public function usersMenu()
    {
        $users =  $this->model->getUsers();
        $this->view->usersMenu($users);
    }
    public function pedirInfoUsuario()
    {
        $this->view->pedirInfoUsuario();
    }
    public function crearUsuario($request)
    {
        //    echo '<pre>'; print_r($_REQUEST) ;echo '</pre>'; die();
        //verificar que ese email o usuario no exista en el sistema
        //  die('llego a funcion de controller ');
         $this->model->crearUsuario($request);
         echo 'El usuario se ha creado Satisfactoriamente';
    }
}




?>