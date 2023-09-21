<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/partes/views/partesView.php'); 
require_once($raiz.'/partes/models/PartesModel.php'); 
require_once($raiz.'/movimientos/models/MovimientoParteModel.php'); 

class partesController
{
    protected $view;
    protected $model;
    protected $MovParteModel;

    public function __construct()
    {
        $this->view = new partesView();
        $this->model = new PartesModel();
        $this->MovParteModel = new MovimientoParteModel();

        if($_REQUEST['opcion']=='partesMenu')
        {
            $this->partesMenu();
        }
        if($_REQUEST['opcion']=='formuCreacionParte')
        {
            $this->formuCreacionParte();
        }
        if($_REQUEST['opcion']=='grabarNuevaParte')
        {
            $this->grabarNuevaParte($_REQUEST);
        }
        if($_REQUEST['opcion']=='formuAdicionarRestarCantidadParte')
        {
            $this->formuAdicionarRestarCantidadParte($_REQUEST);
        }
        if($_REQUEST['opcion']=='AdicionarRstarExisatenciasParte')
        {
            $this->AdicionarRstarExisatenciasParte($_REQUEST);
        }
        if($_REQUEST['opcion']=='buscarParteOSerial')
        {
            $this->view->buscarParteOSerial($_REQUEST);
        }

    }

    public function partesMenu()
    {
        $partes =  $this->model->traerTodasLasPartes();
        $this->view->partesMenu($partes);
    }
    
    public function formuCreacionParte()
    {
        $this->view->formuCreacionParte();
    }
    
    public function grabarNuevaParte($request)
    {
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die();
        $partes =  $this->model->grabarParteIndividual($request);
        echo 'Parte creada exitosamente';
        // $this->view->partesMenu($partes);
    }
    
    public function formuAdicionarRestarCantidadParte($request)
    {
        $this->view->formuAdicionarRestarCantidadParte($request);
    }

    public function AdicionarRstarExisatenciasParte($request)
    {
        $data = $this->model->sumarDescontarPartes($request['tipoMov'],$request['idParte'],$request['cantidad']);
        $infoMov = new stdClass();

        if($request['tipoMov']=="1"){
            $infoMov->observaciones = 'Se agrega existencias a partes';
        }
        if($request['tipoMov']=="2"){
            $infoMov->observaciones = 'Se reduce existencias a partes';
        }
        $infoMov->idParte = $request['idParte'];
        $infoMov->idHardware = 0;
        $infoMov->tipoMov = $request['tipoMov'];
        $infoMov->loquehabia = $data['loquehabia']; 
        $infoMov->loquequedo = $data['loquequedo']; 
        $infoMov->query = $data['query'];
        $infoMov->cantidadQueseAfecto = $request['cantidad'];
        //         echo '<pre>';
        // print_r($infoMov); 
        // echo '</pre>';
        // die('antes de movimiento ');
        $this->MovParteModel->registrarAgregarParteAHardware($infoMov);

        echo 'Exitoso!!';
    }
    
}