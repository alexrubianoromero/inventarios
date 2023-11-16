<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hardware/views/hardwareView.php'); 
// die('controol'.$raiz);
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/partes/models/PartesModel.php'); 
require_once($raiz.'/movimientos/models/MovimientoParteModel.php'); 
require_once($raiz.'/movimientos/models/MovimientoHardwareModel.php'); 
require_once($raiz.'/pedidos/models/ItemInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/models/EstadoInicioPedidoModel.php'); 
require_once($raiz.'/hojasdevida/views/hojasdeVidaView.php'); 
require_once($raiz.'/controller/controllerClass.php'); 
require_once($raiz.'/pedidos/models/AsociadoItemInicioPedidoHardwareOparteModel.php'); 

class hardwareController extends controllerClass
{
    protected $view;
    protected $model;
    protected $partesModel;
    protected $MovParteModel;
    protected $itemInicioModel;
    protected $MovHardwareModel;
    protected $hojasdeVidaView;
    protected $estadoInicioPedidoModel;
    protected $asociadoItemInicio; 

    public function __construct()
    {
        session_start();
        $this->view = new hardwareView();
        $this->model = new HardwareModel();
        $this->partesModel = new PartesModel();
        $this->MovParteModel = new MovimientoParteModel();
        $this->itemInicioModel = new ItemInicioPedidoModel();
        $this->MovHardwareModel = new MovimientoHardwareModel();
        $this->hojasdeVidaView = new hojasdeVidaView();
        $this->estadoInicioPedidoModel = new EstadoInicioPedidoModel();
        $this->asociadoItemInicio = new AsociadoItemInicioPedidoHardwareOparteModel();

        if($_REQUEST['opcion']=='hardwareMenu')
        {
            $this->hardwareMenu();
        }
        if($_REQUEST['opcion']=='formularioSubirArchivo')
        {
            $this->formularioSubirArchivo();
        }
        if($_REQUEST['opcion']=='verHardware')
        {
            $this->verHardware($_REQUEST);
        }
        if($_REQUEST['opcion']=='quitarRam')
        {
            $this->quitarRam($_REQUEST);
        }
        if($_REQUEST['opcion']=='agregarRam')
        {
            $this->agregarRam($_REQUEST);
        }
        if($_REQUEST['opcion']=='quitarDisco')
        {
            $this->quitarDisco($_REQUEST);
        }
        if($_REQUEST['opcion']=='quitarCargador')
        {
            $this->quitarCargador($_REQUEST);
        }
        if($_REQUEST['opcion']=='formuAgregarRam')
        {
            $this->formuAgregarRam($_REQUEST);
        }
        if($_REQUEST['opcion']=='agregarMemoriaRam')
        {
            $this->agregarMemoriaRam($_REQUEST);
        }
        if($_REQUEST['opcion']=='formuAgregarDisco')
        {
            $this->formuAgregarDisco($_REQUEST);
        }
        if($_REQUEST['opcion']=='formuAgregarCargador')
        {
            $this->formuAgregarCargador($_REQUEST);
        }
        if($_REQUEST['opcion']=='agregarDisco')
        {
            $this->agregarDisco($_REQUEST);
        }
        if($_REQUEST['opcion']=='agregarCargador')
        {
            $this->agregarCargador($_REQUEST);
        }
        if($_REQUEST['opcion']=='formuNuevoHardware')
        {
            $this->formuNuevoHardware();
        }
        if($_REQUEST['opcion']=='grabarNuevoHardware')
        {
            $this->grabarNuevoHardware($_REQUEST);
        }
        
        if($_REQUEST['opcion']=='formuDividirRam')
        {
            $this->formuDividirRam($_REQUEST);
        }
        if($_REQUEST['opcion']=='crearRamAgregarHardware')
        {
            $this->crearRamAgregarHardware($_REQUEST);
        }
        
        if($_REQUEST['opcion']=='agregarTemporalDividirMemoria')
        {
            $this->agregarTemporalDividirMemoria($_REQUEST);
        }
        if($_REQUEST['opcion']=='registrarRamDividaHardware')
        {
            $this->registrarRamDividaHardware($_REQUEST);
        }
        if($_REQUEST['opcion']=='buscarInventarioHardware')
        {
            $this->view->buscarInventarioHardware($_REQUEST);
        }
        if($_REQUEST['opcion']=='actualizarCondicionHardware')
        {
            $this->model->actualizarCondicionHardware($_REQUEST);
        }

        if($_REQUEST['opcion']=='buscarHardwareAgregarItemPedido')
        {
            $this->view->buscarHardwareAgregarItemPedido($_REQUEST);
        }
        if($_REQUEST['opcion']=='verMovimientosHardware')
        {
            $this->view->verMovimientosHardware($_REQUEST['idHardware']);
        }
        if($_REQUEST['opcion']=='fitrarHardware')
        {
            // $this->view->fitrarHardware($_REQUEST['inputBuscarHardware']);
            $this->hojasdeVidaView->traerHardwareFiltrado($_REQUEST['inputBuscarHardware']);
        }

        if($_REQUEST['opcion']=='filtrarHardwarePorSerial')
        {
            $hardwareSerial  = $this->model->traerHardwareDisponiblesFiltradosSerial($_REQUEST);
            $this->view->traerHardwareDisponibles($hardwareSerial);

        }
        if($_REQUEST['opcion']=='relacionarHardwareAItemPedido')
        {
            //falta relacionar el item en el hardware cambiar el estado a lo que se deba en la tabla de hardware  
            //falta crear el movimiento historico 
            $infoItem = $this->itemInicioModel->traerItemInicioPedidoId($_REQUEST['idItemAgregar']);
            // $this->printR($_SESSION);
            $tipoMov = 2 ; //sale del inventario;
            $infoMov = new stdClass();
            $infoMov->idTipoMov = $tipoMov ;  
            $infoMov->idItemInicio = $_REQUEST['idItemAgregar'] ;  
            $infoMov->observaciones = 'Se agrega Hardware  a Pedido '.$infoItem['idPedido'].' id Item '.$_REQUEST['idItemAgregar'].' ';
            $infoMov->idHardware = $_REQUEST['idHardware'];  
            $idMov = $this->MovHardwareModel->registrarMovimientohardware($infoMov); 
            
            //aqui hay que vambiar el modelo para que realice la asociacion a la tabla asociacion respectiva
            //se comenta el proceso anterior
            // $this->itemInicioModel->relacionarHardwareAItemPedido($_REQUEST);
            //la info que debe venir es el idItem y el idHardware  
            $idAsociadoItem = $this->asociadoItemInicio->insertarAsociacionHardwareConItemRegistro($_REQUEST);

            //actualizar la tabla de hardware con estado si es alquilado o vendido
            //traer el campo estado de la tabla itemInicioPedido osea vendido o rentado 
            //tener en cuenta que si es cambio de bodega pues solo se cambia el idSucursal y no se actualiza estado de hardware
            //bueno deberia quedar en disponible 
            //tambien es importante que quede registrado en el movimiento  de hardware la sucursal que tenia y la final
            $cambioBodega = 3; //este estado 3 significa que es cambio de bodega 
            if($infoItem['estado']==$cambioBodega)
            {
                //queda disponible y adicional se actualiza el idSucursal 
                //realizar el cambio de bodega 
                $infoCambio = $this->model->realizarCambioDeBodega($_REQUEST['idHardware'],$infoItem['idNuevaSucursal']);
                $this->MovHardwareModel->actualizarMovimientoHardware($idMov,$infoCambio); 
                // $this->printR($infoCambio); 

            }else{
                //cambiar el estado 
                $this->model->actualizarEstadoHardware($_REQUEST['idHardware'],$infoItem['estado']); 
                $this->model->actualizarIdAsociacionItemEnHardware($_REQUEST['idHardware'],$idAsociadoItem); 
            }
            
            echo 'Relacionado de forma correcta '; 
            // $this->view->traerHardwareDisponibles($hardwareSerial);
        }

        if($_REQUEST['opcion']=='formuDevolucionHardware')
        {
            $this->view->formuDevolucionHardware($_REQUEST);
        }
        if($_REQUEST['opcion']=='realizarDevolucion')
        {
            $this->realizarDevolucion($_REQUEST);
        }
        if($_REQUEST['opcion']=='verificarDarDeBaja')
        {
            $this->verificarDarDeBaja($_REQUEST);
            
        }
        if($_REQUEST['opcion']=='habilitarHardware')
        {
            $this->habilitarHardware($_REQUEST);
            
        }
        if($_REQUEST['opcion']=='formuFiltrosHardware')
        {
            $this->view->formuFiltrosHardware($_REQUEST);
            
        }
        if($_REQUEST['opcion']=='fitrarHardwareSerialInventario')
        {
            $this->fitrarHardwareSerialInventario($_REQUEST);
        }
        if($_REQUEST['opcion']=='fitrarHardwarePulgadasInventario')
        {
            $this->fitrarHardwarePulgadasInventario($_REQUEST);
        }
        if($_REQUEST['opcion']=='fitrarHardwareProcesadorInventario')
        {
            // $this->printR($_REQUEST);
            $this->fitrarHardwareProcesadorInventario($_REQUEST);
        }
        if($_REQUEST['opcion']=='fitrarHardwareGeneracionInventario')
        {
            // $this->printR($_REQUEST);
            $this->fitrarHardwareGeneracionInventario($_REQUEST);
        }
        if($_REQUEST['opcion']=='fitrarHardwareImportacionInventario')
        {
            // $this->printR($_REQUEST);
            $this->fitrarHardwareImportacionInventario($_REQUEST);
        }
        if($_REQUEST['opcion']=='fitrarHardwareLoteInventario')
        {
            // $this->printR($_REQUEST);
            $this->fitrarHardwareLoteInventario($_REQUEST);
        }
        if($_REQUEST['opcion']=='fitrarHardwareTipoInventario')
        {
            // $this->printR($_REQUEST);
            $this->fitrarHardwareTipoInventario($_REQUEST);
        }
        if($_REQUEST['opcion']=='fitrarHardwareSubTipoInventario')
        {
            // $this->printR($_REQUEST);
            $this->fitrarHardwareSubTipoInventario($_REQUEST);
        }
        if($_REQUEST['opcion']=='actualizarCostos')
        {
            // $this->printR($_REQUEST);
            $this->model->actualizarCostos($_REQUEST);
        }
 


        



    }

    public function habilitarHardware ($request) 
    {
        // $this->printR($_SESSION); 
        // echo 'proceso dar habilitar';
            //se deba cambiar el estado 
            $disponible = 0; 
            $this->model->actualizarEstadoHardware($_REQUEST['idHardware'],$disponible); 
            //dejar registro del movimiento de dar de baja y ya 

            // $infoItem = $this->itemInicioModel->traerItemInicioPedidoId($_REQUEST['idItemAgregar']);
            // $this->printR($infoItem);
            $tipoMov = 0 ; //habilitar;
            $infoMov = new stdClass();
            $infoMov->idTipoMov = $tipoMov ;  
            $infoMov->idItemInicio = 0;  
            $infoMov->observaciones = 'Se habilita Este hardware ';
            $infoMov->idHardware = $_REQUEST['idHardware'];  
            $this->MovHardwareModel->registrarMovimientohardware($infoMov); 
            echo 'Se ha realizado el proceso de habilitar el hardware'; 

    }
    public function verificarDarDeBaja ($request) 
    {
        // $this->printR($_SESSION); 
        // echo 'proceso dar de baja ';
            //se deba cambiar el estado 
            $darDeBaja = 4; 
            $this->model->actualizarEstadoHardware($_REQUEST['idHardware'],$darDeBaja); 
            //dejar registro del movimiento de dar de baja y ya 

            // $infoItem = $this->itemInicioModel->traerItemInicioPedidoId($_REQUEST['idItemAgregar']);
            // $this->printR($infoItem);
            $tipoMov = 4 ; //dado de baja;
            $infoMov = new stdClass();
            $infoMov->idTipoMov = $tipoMov ;  
            $infoMov->idItemInicio = 0;  
            $infoMov->observaciones = 'Se da de baja Este hardware ';
            $infoMov->idHardware = $_REQUEST['idHardware'];  
            $this->MovHardwareModel->registrarMovimientohardware($infoMov); 
            echo 'Se ha realizado el proceso de dar de baja '; 

    }

    public function realizarDevolucion($request)
    {

          $regresaAInventario = 0;
          $this->model->actualizarEstadoHardware($request['idHardware'],$regresaAInventario);
          //generar movimiento de devolucion 
           //falta relacionar el item en el hardware cambiar el estado a lo que se deba en la tabla de hardware  
            //falta crear el movimiento historico 
            // $infoItem = $this->itemInicioModel->traerItemInicioPedidoId($_REQUEST['idItemAgregar']);

           $infoMovimiento =  $this->MovHardwareModel->traerMovimientoId($request['idMovimiento']);
           $infoItem = $this->itemInicioModel->traerItemInicioPedidoId($infoMovimiento['idItemInicio'] );

            $tipoMov = 1 ; //entra al inventario;
            $infoMov = new stdClass();
            $infoMov->idTipoMov = $tipoMov ;  
            $infoMov->idItemInicio = $infoMovimiento['idItemInicio'] ;  
            $infoMov->observaciones = 'Se realiza devolucion Hardware  de Pedido '.$infoItem['idPedido'].' id Item '.$infoMovimiento['idItemInicio'] .' ';
            $infoMov->idHardware = $request['idHardware'];  
            $this->MovHardwareModel->registrarMovimientohardware($infoMov); 

    }

    public function hardwareMenu()
    {
        $hardware =  $this->model->traerHardware();
        $this->view->hardwareMenu($hardware);
    }

    public function fitrarHardwareSerialInventario($request)
    {
        $hardware =  $this->model->traerHardwareFiltro($request['inputBuscarHardware']);
        $this->view->traerHardwareMostrarmenu($hardware) ;
    }
    public function fitrarHardwarePulgadasInventario($request)
    {
        $hardware =  $this->model->traerHardwarePulgadasFiltro($request['inputBuscarPulgadas']);
        $this->view->traerHardwareMostrarmenu($hardware) ;
    }
    public function fitrarHardwareProcesadorInventario($request)
    {
        $hardware =  $this->model->traerHardwareProcesadorFiltro($request['inputBuscarProcesador']);
        $this->view->traerHardwareMostrarmenu($hardware) ;
    }
    public function fitrarHardwareGeneracionInventario($request)
    {
        $hardware =  $this->model->traerHardwaregeneracionFiltro($request['inputBuscarGeneracion']);

        $this->view->traerHardwareMostrarmenu($hardware) ;
    }
    public function fitrarHardwareImportacionInventario($request)
    {
        $hardware =  $this->model->traerHardwareImportacionFiltro($request['inputBuscarImportacion']);

        $this->view->traerHardwareMostrarmenu($hardware) ;
    }
    public function fitrarHardwareLoteInventario($request)
    {
        $hardware =  $this->model->traerHardwareLoteFiltro($request['inputBuscarLote']);

        $this->view->traerHardwareMostrarmenu($hardware) ;
    }
    public function fitrarHardwareTipoInventario($request)
    {
        $hardware =  $this->model->traerHardwareTipoFiltro($request['inputBuscarTipo']);

        $this->view->traerHardwareMostrarmenu($hardware) ;
    }
    public function fitrarHardwareSubTipoInventario($request)
    {
        $hardware =  $this->model->traerHardwareSubTipoFiltro($request['inputBuscarSubTipo']);

        $this->view->traerHardwareMostrarmenu($hardware) ;
    }
   

    public function formularioSubirArchivo()
    {
        $this->view->formularioSubirArchivo(); 
    }
    public function verHardware($request)
    {
        $hardware = $this->model->verHardware($request['id']);
        // echo '<pre>';
        // print_r($hardware); 
        // echo '</pre>';
        // die();
        $this->view->verHardware($hardware);

    }
    public function llamarRegistroMovimientoQuitarHardware ($idHardware,$idParte,$tipoMov)
    {
     
        $infoMov = new stdClass();
        $infoMov->idParte = $idParte;
        $infoMov->idHardware = $idHardware;
        $infoMov->tipoMov = $tipoMov;
        $this->MovParteModel->grabarMovDesligardeHardware($infoMov);
    }
    
    public function llamarRegistroMovimientoPonerHardware ($idHardware,$idParte,$tipoMov,$observaciones)
    {
     
        $infoMov = new stdClass();
        $infoMov->idParte = $idParte;
        $infoMov->idHardware = $idHardware;
        $infoMov->tipoMov = $tipoMov;
        $infoMov->observaciones = $observaciones;

        $this->MovParteModel->registrarAgregarParteAHardware($infoMov);
    }
    

    public function quitarRam($request)
    {
        //        echo '<pre>';
        // print_r($_SESSION); 
        // echo '</pre>';
        // die('quitar ram');
        // echo 'llego a controller y quitar ram '; 
        //desligar la parte del hardware

        $tipoMov = 1; //es una entrada al inventario porque vuelve una parte  
        $cantidadParaActualizar = 1; 
        $data = $this->partesModel->sumarDescontarPartes($tipoMov,$request['idRam'],$cantidadParaActualizar);
        $this->model->desligarRamDeEquipo($request);
        $infoMov = new stdClass();
        $infoMov->idParte = $request['idRam'];
        $infoMov->idHardware = $request['idHardware'];
        $infoMov->tipoMov = $tipoMov;
        $infoMov->observaciones = 'Se quita memoria ram de Hardware id No '.$request['idHardware'];
        $infoMov->loquehabia = $data['loquehabia']; 
        $infoMov->loquequedo = $data['loquequedo']; 
        $infoMov->query = $data['query'];
        $infoMov->cantidadQueseAfecto = $data['cantidadQueseAfecto'];

        $this->MovParteModel->grabarMovDesligardeHardware($infoMov);
        echo 'La Ram fue desasociada del hardware';
    }

    public function quitarDisco($request)
    {
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die('');
        $tipoMov = 1; //es una entrada al inventario porque vuelve una parte  
        $cantidadParaActualizar = 1; 
        $data = $this->partesModel->sumarDescontarPartes($tipoMov,$request['idDisco'],$cantidadParaActualizar);
        $this->model->desligarDiscoDeEquipo($request);
        $infoMov = new stdClass();
        $infoMov->idParte = $request['idDisco'];
        $infoMov->idHardware = $request['idHardware'];
        $infoMov->tipoMov = $tipoMov;
        $infoMov->observaciones = 'Se quita disco de Hardware id No '.$request['idHardware'];
        $infoMov->loquehabia = $data['loquehabia']; 
        $infoMov->loquequedo = $data['loquequedo']; 
        $infoMov->query = $data['query'];
        $infoMov->cantidadQueseAfecto = $data['cantidadQueseAfecto'];

        $this->MovParteModel->grabarMovDesligardeHardware($infoMov);

        echo 'Se ha desligado este disco '; 


        // echo 'llego a controller y quitar Disco '; 
        //desligar la parte del hardware
        // $this->model->desligarDiscoDeEquipo($request);
        // $this->partesModel->desligarParteDeHardware($request['idDisco']);
        // $this->llamarRegistroMovimientoQuitarHardware($request['idHardware'],$request['idDisco'],'1');
       

        
        //ahora deberia crear el movimiento 
    }
    
    public function quitarCargador($request)
    {
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die('');
        $tipoMov = 1; //es una entrada al inventario porque vuelve una parte  
        $cantidadParaActualizar = 1; 
        $data = $this->partesModel->sumarDescontarPartes($tipoMov,$request['idCargador'],$cantidadParaActualizar);
        $this->model->desligarCargadorDeEquipo($request);
        $infoMov = new stdClass();
        $infoMov->idParte = $request['idCargador'];
        $infoMov->idHardware = $request['idHardware'];
        $infoMov->tipoMov = $tipoMov;
        $infoMov->observaciones = 'Se quita disco de Hardware id No '.$request['idHardware'];
        $infoMov->loquehabia = $data['loquehabia']; 
        $infoMov->loquequedo = $data['loquequedo']; 
        $infoMov->query = $data['query'];
        $infoMov->cantidadQueseAfecto = $data['cantidadQueseAfecto'];

        $this->MovParteModel->grabarMovDesligardeHardware($infoMov);

        echo 'Se ha desligado esta parte '; 


        // echo 'llego a controller y quitar Disco '; 
        //desligar la parte del hardware
        // $this->model->desligarDiscoDeEquipo($request);
        // $this->partesModel->desligarParteDeHardware($request['idDisco']);
        // $this->llamarRegistroMovimientoQuitarHardware($request['idHardware'],$request['idDisco'],'1');
       

        
        //ahora deberia crear el movimiento 
    }
    
    public function formuAgregarRam($request)
    {
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die('valoresRam');
        // $this->view->formuAgregarRam($request['idHardware'],$request['ram']);
        $this->view->formuAgregarRam($request);

        // $this->llamarRegistroMovimientoQuitarHardware($request['idHardware'],$request['idRam'],'1');
    }

    
    //recibe el requesr con 3 parametros
    //idHArdware
    //idRam
    //numeroRam
    public function agregarMemoriaRam($request)
    {
        //ya no hay que hacer asociaciones solamente se suma o se resta  a la cantidad que tenga la parte 
        // $this->model->asociarParteRamEnTablaHardware($request);
        // $this->partesModel->asociarRamHardwareEnTablaPartes($request);
        //hay que hacer la suma o la resta del inventario 
        //deberia ser una funcion de Partes
        //tipoMov 1 Entrada 2 salida 
        //registrar el movimiento 

        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die('funcion agregar memoria ram ');

        $tipoMov = 2; //es salida porque se saca un parte para agregarla a un hardware
        $cantidadParaActualizar = 1; 
        $data = $this->partesModel->sumarDescontarPartes($tipoMov,$request['idRam'],$cantidadParaActualizar);

        $infoMov = new stdClass();
        $infoMov->idParte = $request['idRam'];
        $infoMov->idHardware = $request['idHardware'];
        $infoMov->tipoMov = $tipoMov;
        $infoMov->observaciones = 'Se agrega parte a Hardware id No '.$request['idHardware'];
        $infoMov->loquehabia = $data['loquehabia']; 
        $infoMov->loquequedo = $data['loquequedo']; 
        $infoMov->query = $data['query'];
        $infoMov->cantidadQueseAfecto = $data['cantidadQueseAfecto'];
        $this->MovParteModel->registrarAgregarParteAHardware($infoMov);
        $ramODisco = 'r'; //porque es una ram 
        $this->partesModel->asociarParteAHardware($request['idHardware'],$request['idRam'],$request['numeroRam'],$ramODisco);

        echo 'Memoria Agregado!!';
    }

    public function formuAgregarDisco($request)
    {
        $this->view->formuAgregarDisco($request);
    }
    public function formuAgregarCargador($request)
    {
        $this->view->formuAgregarCargador($request);
    }

    public function agregarDisco($request)
    {
        
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die('valores que llegan al controlador');
        $tipoMov = 2; //es salida porque se saca un parte para agregarla a un hardware
        $cantidadParaActualizar = 1; 
        $data = $this->partesModel->sumarDescontarPartes($tipoMov,$request['idDisco'],$cantidadParaActualizar);

        $infoMov = new stdClass();
        $infoMov->idParte = $request['idDisco'];
        $infoMov->idHardware = $request['idHardware'];
        $infoMov->tipoMov = $tipoMov;
        $infoMov->observaciones = 'Se agrega parte a Hardware id No '.$request['idHardware'];
        $infoMov->loquehabia = $data['loquehabia']; 
        $infoMov->loquequedo = $data['loquequedo']; 
        $infoMov->query = $data['query'];
        $infoMov->cantidadQueseAfecto = $data['cantidadQueseAfecto'];
        //         echo '<pre>';
        // print_r($infoMov); 
        // echo '</pre>';
        // die('antes de movimiento ');
        $this->MovParteModel->registrarAgregarParteAHardware($infoMov);
        $ramODisco = 'd'; //porque es una ram 
        $this->partesModel->asociarParteAHardware($request['idHardware'],$request['idDisco'],$request['numeroDisco'],$ramODisco);

        echo 'Disco Agregado!!';
        // $this->model->asociarParteEnTablaHardware($request);
        // $this->partesModel->asociarHardwareEnTablaPartes($request);
        // $this->llamarRegistroMovimientoPonerHardware($request['idHardware'],$request['idDisco'],'2',$request['opcion']);
        // echo 'Disco Agregado!!';
    }

    public function agregarCargador($request)
    {
        
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die('valores que llegan al controlador');
        $tipoMov = 2; //es salida porque se saca un parte para agregarla a un hardware
        $cantidadParaActualizar = 1; 
        $data = $this->partesModel->sumarDescontarPartes($tipoMov,$request['idCargador'],$cantidadParaActualizar);

        $infoMov = new stdClass();
        $infoMov->idParte = $request['idCargador'];
        $infoMov->idHardware = $request['idHardware'];
        $infoMov->tipoMov = $tipoMov;
        $infoMov->observaciones = 'Se agrega parte a Hardware id No '.$request['idHardware'];
        $infoMov->loquehabia = $data['loquehabia']; 
        $infoMov->loquequedo = $data['loquequedo']; 
        $infoMov->query = $data['query'];
        $infoMov->cantidadQueseAfecto = $data['cantidadQueseAfecto'];
        //         echo '<pre>';
        // print_r($infoMov); 
        // echo '</pre>';
        // die('antes de movimiento ');
        $this->MovParteModel->registrarAgregarParteAHardware($infoMov);
        $ramODisco = 'c'; //porque es un cargador
        $this->partesModel->asociarParteAHardware($request['idHardware'],$request['idCargador'],'idCargador',$ramODisco);

        echo ' Agregado!!';
        // $this->model->asociarParteEnTablaHardware($request);
        // $this->partesModel->asociarHardwareEnTablaPartes($request);
        // $this->llamarRegistroMovimientoPonerHardware($request['idHardware'],$request['idDisco'],'2',$request['opcion']);
        // echo 'Disco Agregado!!';
    }
    
    public function formuNuevoHardware()
    {
        $this->view->formuNuevoHardware();
    }
    public function grabarNuevoHardware($request)
    {
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die();
        $this->model->grabarNuevoHardware($request);
        echo 'Grabado Satisfactoriamente'; 
    }

    public function formuDividirRam($request)
    {
        $this->view->formuDividirRam($request['idHardware']);
    }
    
    
    public function agregarTemporalDividirMemoria($request)
    {
        $this->model->agregarTemporalDividirMemoria($request);
        $temporales = $this->model->traerRegistrosTemporales($request['idHardware']);
        //  echo '<pre>';
        // print_r($temporales); 
        // echo '</pre>';
        // die();
        $this->view->mostrarTemporales($temporales);  
    }
    public function registrarRamDividaHardware($request)
    {
        $this->model->asignarDivisionHadware($request['idHardware']);
        //limpiar los temporales 
        $this->model->limpiarTablaDivisionRam($request['idHardware']);
        //inactgivar el boton de dividir
        $this->model->inactivarBotonDividir($request['idHardware']);
        echo 'Division realizada';
    }
    
}