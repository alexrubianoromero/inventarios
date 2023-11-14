<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/reportes/views/reportesView.php'); 
require_once($raiz.'/pedidos/models/PedidoModel.php'); 
require_once($raiz.'/pedidos/models/ItemInicioPedidoModel.php'); 
// require_once($raiz.'/pagos/models/PagoModel.php'); 
// require_once($raiz.'/pedidos/models/AsignacionTecnicoPedidoModel.php'); 
// die('controller'.$raiz);
// die('control123'.$raiz);

class reportesController
{
    protected $view; 
    protected $pedidoModel;
    protected $itemInicioModel;
    // protected $model ; 
    // protected $pagoModel ; 

    public function __construct()
    {
        // die('desde controlador') ;
        session_start();
        $this->view = new reportesView();
        $this->pedidoModel = new PedidoModel();
        $this->itemInicioModel = new ItemInicioPedidoModel();

        if($_REQUEST['opcion']=='reportesMenu')
        {
            $this->view->reportesMenu();
        }
        if($_REQUEST['opcion']=='formuReporteVentas')
        {
            $this->view->formuReporteVentas();
        }
        if($_REQUEST['opcion']=='generarReporteVentas')
        {
            // echo '<pre>'; print_r($_REQUEST);  echo '</pre>';
            // die('llego aca '); 
            $this->generarReporteVentas($_REQUEST);
        }
    }

    public function generarReporteVentas($request)
    {
        //  $traerPedidosFechas = $this->pedidoModel->traerPedidosFechas($request);     
         $itemsVentasPedidosFechas = $this->pedidoModel->traerItemsPedidoFechas($request);   
        //  echo '<pre>'; print_r($_REQUEST);  echo '</pre>';  
        //  $traerVentasdePedidos =  $this->itemInicioModel->traerItemsVentas(); 
        $this->view->mostrarReporteVentas($itemsVentasPedidosFechas);
    }
    

}   