<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/clientes/views/clientesView.php'); 
require_once($raiz.'/clientes/models/ClienteModel.php'); 
// require_once($raiz.'/partes/models/PartesModel.php'); 
// require_once($raiz.'/movimientos/models/MovimientoParteModel.php'); 

class clientesController
{
    protected $view;
    protected $model;
    // protected $partesModel;
    // protected $MovParteModel;

    public function __construct()
    {
        $this->view = new clientesView();
        $this->model = new ClienteModel();
        // $this->partesModel = new PartesModel();
        // $this->MovParteModel = new MovimientoParteModel();

        if($_REQUEST['opcion']=='listarClientes')
        {
            $this->listarClientes();
        }
        if($_REQUEST['opcion']=='clientesMenu')
        {
            $this->clientesMenu();
        }

        if($_REQUEST['opcion']=='formuNuevoCliente')
        {
            // die('llego a nuevo cliente');
            $this->formuNuevoCliente();
        }
        if($_REQUEST['opcion']=='grabarCliente')
        {
            // die('llego a nuevo cliente');
            $this->grabarCliente($_REQUEST);
        }
        

    }
    public function listarClientes()
    {
        // $clientes = $this->model->traerClientes();
        $this->view->mostrarCLientes();   
    }
    public function clientesMenu()
    {
        // $clientes = $this->model->traerClientes();
        $this->view->clientesMenu();   
    }
    public function formuNuevoCliente()
    {
        // $clientes = $this->model->traerClientes();
        $this->view->formuNuevoCliente();   
    }
    public function grabarCliente($request)
    {
        // $clientes = $this->model->traerClientes();
        $this->model->grabarCliente($request);   
        echo 'Cliente grabado!';
    }
    
}    