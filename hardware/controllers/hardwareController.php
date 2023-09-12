<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hardware/views/hardwareView.php'); 
// die('controol'.$raiz);
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/partes/models/PartesModel.php'); 
require_once($raiz.'/movimientos/models/MovimientoParteModel.php'); 

class hardwareController
{
    protected $view;
    protected $model;
    protected $partesModel;
    protected $MovParteModel;

    public function __construct()
    {
        $this->view = new hardwareView();
        $this->model = new HardwareModel();
        $this->partesModel = new PartesModel();
        $this->MovParteModel = new MovimientoParteModel();

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
        if($_REQUEST['opcion']=='agregarDisco')
        {
            $this->agregarDisco($_REQUEST);
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
        

    }

    public function hardwareMenu()
    {
        $hardware =  $this->model->traerHardware();
        $this->view->hardwareMenu($hardware);
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