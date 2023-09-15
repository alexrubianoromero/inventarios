<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/pedidos/views/pedidosView.php'); 
require_once($raiz.'/pedidos/models/PedidoModel.php'); 
require_once($raiz.'/pedidos/models/AsignacionTecnicoPedidoModel.php'); 
// die('controller'.$raiz);
// die('control123'.$raiz);

class pedidosController
{
    protected $view; 
    protected $model ; 
    // protected $asignacionModel ; 

    public function __construct()
    {
        // die('desde controlador') ;
        $this->view = new pedidosView();
        $this->model = new pedidoModel();
        // $this->asignacionModel = new AsisgnacionTecnicoPedidoModel();

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
        if($_REQUEST['opcion']=='asignarTecnicoAPedido')
        {
            $this->asignarTecnicoAPedido($_REQUEST);
        }
        if($_REQUEST['opcion']=='formuAsignarItemPedidoATecnico')
        {
            $this->formuAsignarItemPedidoATecnico($_REQUEST);
        }
        if($_REQUEST['opcion']=='realizarAsignacionTecnicoAItem')
        {
            $this->realizarAsignacionTecnicoAItem($_REQUEST);
        }
        if($_REQUEST['opcion']=='mostrarTipoItem')
        {
            $this->mostrarTipoItem($_REQUEST);
        }
        if($_REQUEST['opcion']=='actualizarPedido')
        {
            $this->actualizarPedido($_REQUEST);
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
    public function realizarAsignacionTecnicoAItem($request)
    {
        $this->model->realizarAsignacionTecnicoAItem($request);
        echo 'Asignacion Realizada ';
    }
    // public function asignarTecnicoAPedido($request)
    // {
    //     $this->asignacionModel->registrarAsignacionTecnicoAPedido($request);
    //     $this->view->siguientePantallaPedido($request['idPedido']);
    // }
    public function formuAsignarItemPedidoATecnico($request)
    {
        // $this->asignacionModel->registrarAsignacionTecnicoAPedido($request);
        $this->view->formuAsignarItemPedidoATecnico($request);
    }
    public function mostrarTipoItem($request)
    {
        if($request['tipoItem']==1)
        {  $this->view->tipoItemHardware($request['tipoItem']); }
        if($request['tipoItem']==2)
        {  $this->view->tipoItemParte($request['tipoItem']); }
        
    }
    public function actualizarPedido($request)
    {
        $this->model->actualizarPedido($request);
        echo 'Pedido Actualizado';
    }
    
}