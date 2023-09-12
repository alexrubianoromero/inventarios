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

        $this->model->desligarRamDeEquipo($request);
        $this->partesModel->desligarRamDeHardware($request);
        // $infoMov = new stdClass();
        // $infoMov->idParte = $request['idRam'];
        // $infoMov->idHardware = $request['idHardware'];
        // $infoMov->tipoMov = '1';
        // $this->MovParteModel->grabarMovDesligardeHardware($infoMov);
        $this->llamarRegistroMovimientoQuitarHardware($request['idHardware'],$request['idRam'],'1');

        echo 'La Ram fue desasociada del hardware';
    }

    public function quitarDisco($request)
    {
        // echo 'llego a controller y quitar Disco '; 
        //desligar la parte del hardware
        $this->model->desligarDiscoDeEquipo($request);
        $this->partesModel->desligarParteDeHardware($request['idDisco']);
        $this->llamarRegistroMovimientoQuitarHardware($request['idHardware'],$request['idDisco'],'1');
       

        
        //ahora deberia crear el movimiento 
        echo 'El disco ya no esta asociado a este hardware '; 
    }
    
    public function formuAgregarRam($request)
    {
        echo '<pre>';
        print_r($request); 
        echo '</pre>';
        die('valoresRam');
        $this->view->formuAgregarRam($request['idHardware'],$request['ram']);

        $this->llamarRegistroMovimientoQuitarHardware($request['idHardware'],$request['idRam'],'1');
    }

    public function formuAgregarDisco($request)
    {
        $this->view->formuAgregarDisco($request['idHardware']);
    }

    public function agregarMemoriaRam($request)
    {
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die();
        $this->model->asociarParteRamEnTablaHardware($request);
        $this->partesModel->asociarRamHardwareEnTablaPartes($request);
        
        //registrar el movimiento agregar parte al hardware
        $this->llamarRegistroMovimientoPonerHardware($request['idHardware'],$request['idRam'],'2',$request['opcion']);
        // $this->partesModel->cambiarEstadodePArte($request['idRam'],);//pendiente


        echo 'Memoria Agregado!!';
    }
    public function agregarDisco($request)
    {
        $this->model->asociarParteEnTablaHardware($request);
        $this->partesModel->asociarHardwareEnTablaPartes($request);
        $this->llamarRegistroMovimientoPonerHardware($request['idHardware'],$request['idDisco'],'2',$request['opcion']);
        echo 'Disco Agregado!!';
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