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
        if($_REQUEST['opcion']=='continuarAItemsPedido')
        {
            $this->continuarAItemsPedido($_REQUEST);
        }
        if($_REQUEST['opcion']=='siguientePantallaPedido')
        {
            $this->siguientePantallaPedido($_REQUEST);
        }

        if($_REQUEST['opcion']=='actualizarWoPedido')
        {
            $this->actualizarWoPedido($_REQUEST);
        }

        if($_REQUEST['opcion']=='actualizarRPedido')
        {
            $this->actualizarRPedido($_REQUEST);
        }

        if($_REQUEST['opcion']=='actulizarIPedido')
        {
            $this->actulizarIPedido($_REQUEST);
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

    public function continuarAItemsPedido($request)
    {
        $ultimoIdPedido = $this->model->grabarEncabezadoPedido($request);
        // echo '<pre>'; 
        // print_r($ultimoIdPedido); 
        // echo '</pre>';
        // die(); 
        //llamar a la siguiente pantalla de pedidos apra agregar los itemsiniciales
        $this->view->siguientePantallaPedido($ultimoIdPedido);
    }

    public function siguientePantallaPedido($request)
    {
        // $ultimoIdPedido = $this->model->grabarEncabezadoPedido($request);
        $this->view->siguientePantallaPedido($request['idPedido']);
    }

    public function actualizarWoPedido($request)
    {
        $this->model->actualizarWoPedido($request);
    }

    public function actualizarRPedido($request)
    {
        $this->model->actualizarRPedido($request);
    }
    
    public function actulizarIPedido($request)
    {
        $this->model->actulizarIPedido($request);
    }

}