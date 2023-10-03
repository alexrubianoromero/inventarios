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
            if($_REQUEST['tipoItem']==1)
            {
                $this->agregarItemInicialPedido($_REQUEST);
            }
            if($_REQUEST['tipoItem']==2)
            {
                $this->agregarItemInicialPedidoParte($_REQUEST);
            }

        }

        if($_REQUEST['opcion']=='eliminarItemInicialPedido')
        {
            $this->eliminarItemInicialPedido($_REQUEST);
        }
        if($_REQUEST['opcion']=='verItemsAsignadosTecnico')
        {
            $this->verItemsAsignadosTecnico($_REQUEST);
        }
        if($_REQUEST['opcion']=='mostrarItemsInicioPedidoTecnico')
        {
            $this->itemInicioview->mostrarItemsInicioPedidoTecnico($_REQUEST['idPedido'],$_REQUEST['idTecnico']);
        }
        if($_REQUEST['opcion']=='actulizarEstadoProcesoItem')
        {
            $this->model->actulizarEstadoProcesoItem($_REQUEST);
        }
    }

    
    public function agregarItemInicialPedido($request)
    {
         $this->model->agregarItemInicialPedido($request);   
         $this->itemInicioview->mostrarItemsInicioPedido($request['idPedido']); 
    }
    public function agregarItemInicialPedidoParte($request)
    {
         $this->model->agregarItemInicialPedidoParte($request);   
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
    
    public function verItemsAsignadosTecnico($request)
    {
        // die('passoooo2');
         $itemsAsignados = $this->model->traerItemsAsignadosATecnico($request['id']);   
         $this->itemInicioview->verItemsAsignadosTecnico($itemsAsignados); 
    }
    
}    