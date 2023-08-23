<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/pedidos/views/pedidosView.php'); 
require_once($raiz.'/pedidos/models/PedidoModel.php'); 
// die('control123'.$raiz);

class pedidosController
{
    protected $view; 
    protected $model ; 
    public function __construct()
    {
        // die('desde controlador') ;
        $this->view = new pedidosView();
        $this->model = new pedidoModel();

        if($_REQUEST['opcion']=='pedidosMenu')
        {
            // echo 'pedidos controlador '; 
            $this->pedidosMenu();
        }
        if($_REQUEST['opcion']=='pedirInfoNuevoPedido')
        {
            // echo 'pedidos controlador '; 
            $this->pedirInfoNuevoPedido($_REQUEST);
        }

    }   

    public function pedidosMenu()
    {
        $pedidos =  $this->model->traerPedidos(); 
        // echo '<pre>';
        // print_r($pedidos); 
        // echo '</pre>';
        // die();
        $this->view->pedidosMenu($pedidos);
    }

    public function pedirInfoNuevoPedido($request)
    {
        $this->view->pedirInfoNuevoPedido($request);
    }

}