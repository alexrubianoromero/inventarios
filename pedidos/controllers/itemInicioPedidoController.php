<?php
$raiz = dirname(dirname(dirname(__file__)));
// require_once($raiz.'/pedidos/views/pedidosView.php'); 
require_once($raiz.'/pedidos/models/ItemInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/views/itemInicioPedidoView.php'); 
// die('control33'.$raiz);

class itemInicioPedidoController
{
    protected $itemInicioview; 
    protected $model ; 
    public function __construct()
    {
        // die('desde controlador') ;
        $this->itemInicioview = new itemInicioPedidoView();
        $this->model = new ItemInicioPedidoModel();

        if($_REQUEST['opcion']=='agregarItemInicialPedido')
        {
            $this->agregarItemInicialPedido($_REQUEST);
        }

        if($_REQUEST['opcion']=='eliminarItemInicialPedido')
        {
            $this->eliminarItemInicialPedido($_REQUEST);
        }
    }

    
    public function agregarItemInicialPedido($request)
    {
         $this->model->agregarItemInicialPedido($request);   
         $this->itemInicioview->mostrarItemsInicioPedido($request['idPedido']); 
    }

    public function eliminarItemInicialPedido($request)
    {
        $infoItem = $this->model->traerItemInicioPedidoId($request['id']);
        // echo '<pre>'; 
        // print_r($infoItem); 
        // echo '</pre>';
        // die();  
        $this->model->eliminarItemInicialPedido($request['id']);  
         $this->itemInicioview->mostrarItemsInicioPedido($infoItem['idPedido']); 
    }

    
}    