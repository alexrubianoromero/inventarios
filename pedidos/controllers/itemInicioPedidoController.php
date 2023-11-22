<?php
$raiz = dirname(dirname(dirname(__file__)));
// require_once($raiz.'/pedidos/views/pedidosView.php'); 
require_once($raiz.'/pedidos/models/ItemInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/views/itemInicioPedidoView.php'); 
require_once($raiz.'/pedidos/models/AsociadoItemInicioPedidoHardwareOparteModel.php'); 
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/movimientos/models/MovimientoHardwareModel.php'); 
// die('control33'.$raiz);

class itemInicioPedidoController
{
    protected $itemInicioview; 
    protected $itemInicioModel; 
    protected $model ; 
    protected $asociadoModel ; 
    protected $hardwareModel ; 
    protected $MovHardwareModel ; 



    public function __construct()
    {
        // die('desde controlador') ;
        $this->itemInicioview = new itemInicioPedidoView();
        $this->itemInicioModel = new ItemInicioPedidoModel();
        $this->model = new ItemInicioPedidoModel();
        $this->asociadoModel = new AsociadoItemInicioPedidoHardwareOparteModel();
        $this->hardwareModel = new HardwareModel();
        $this->MovHardwareModel = new MovimientoHardwareModel();

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
        if($_REQUEST['opcion']=='mostrarItemsInicioPedidoTecnicoNuevo')
        {
            $this->itemInicioview->mostrarItemsInicioPedidoTecnicoNuevo($_REQUEST['idPedido'],$_REQUEST['idTecnico']);
        }
        if($_REQUEST['opcion']=='modificarItemInicioPedido')
        {
            $this->itemInicioview->modificarItemInicioPedido($_REQUEST['idItem']);
        }

        if($_REQUEST['opcion']=='actulizarEstadoProcesoItem')
        {
            $this->model->actulizarEstadoProcesoItem($_REQUEST);
        }
        if($_REQUEST['opcion']=='eliminarHardwareAsociadoItem')
        {
            $this->eliminarHardwareAsociadoItem($_REQUEST);
        }
    }

    
    public function eliminarHardwareAsociadoItem($request)
    {
        $infoAsociado = $this->asociadoModel->traerAsociadoItemIdAsociado($request['idAsociado']);
        $infoItem = $this->itemInicioModel->traerItemInicioPedidoId($infoAsociado['idItemInicioPedido']);
        // echo '<pre>'; 
        // print_r($infoItem); 
        // echo '</pre>';
        // die();
        $this->asociadoModel->eliminarRegistroAsociadoId($request['idAsociado']);  
        //ahora desligar el hardware cambiar el estado
        $this->hardwareModel->actualizarEstadoHardware($request['idHardware'],'0');
        //actualizar el campo que indica el id de asociado y 
        $this->hardwareModel->reiniciaridAsociacionItemHardwareId($request['idHardware']);
        //y registrar el movimiento de desligar el harware del item 
        $tipoMov = 1 ; //vuelve al  inventario;
        $infoMov = new stdClass();
        $infoMov->idTipoMov = $tipoMov ;  
        $infoMov->idItemInicio = $infoItem['id'] ;  
        $infoMov->observaciones = 'Se desliga Hardware  de Item Pedido '.$infoItem['idPedido'].' id Item '.$infoItem['id'];
        $infoMov->idHardware = $_REQUEST['idHardware'];  
        $idMov = $this->MovHardwareModel->registrarMovimientohardware($infoMov); 
        
        


        /////////////////////

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