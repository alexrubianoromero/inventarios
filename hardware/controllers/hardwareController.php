<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hardware/views/hardwareView.php'); 
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/partes/models/PartesModel.php'); 

class hardwareController
{
    protected $view;
    protected $model;
    protected $partesModel;

    public function __construct()
    {
        $this->view = new hardwareView();
        $this->model = new HardwareModel();
        $this->partesModel = new PartesModel();

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
        if($_REQUEST['opcion']=='formuAgregarDisco')
        {
            $this->formuAgregarDisco($_REQUEST);
        }
        if($_REQUEST['opcion']=='agregarDisco')
        {
            $this->agregarDisco($_REQUEST);
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

    public function quitarRam($request)
    {
        // echo 'llego a controller y quitar ram '; 
        //desligar la parte del hardware
        $this->model->desligarRamDeEquipo($request);
        //ahora deberia crear el movimiento 
    }
    public function agregarRam($request)
    {
        // echo 'llego a controller y quitar ram '; 
        //desligar la parte del hardware
        // $this->model->desligarRamDeEquipo($request);
        //ahora deberia crear el movimiento 
        $this->view->formuAgregarRam($request['idHardware']);
    }
    public function quitarDisco($request)
    {
        // echo 'llego a controller y quitar Disco '; 
        //desligar la parte del hardware
        $this->model->desligarDiscoDeEquipo($request);
        $this->partesModel->desligarParteDeHardware($request['idDisco']);
        
        //ahora deberia crear el movimiento 
        echo 'El disco se ha desligado del computador '; 
    }
    
    public function formuAgregarDisco($request)
    {
        $this->view->formuAgregarDisco($request['idHardware']);
    }
    public function agregarDisco($request)
    {
        $this->model->asociarParteEnTablaHardware($request);
        $this->partesModel->asociarHardwareEnTablaPartes($request);
        echo 'Disco Agregado!!';
    }
}