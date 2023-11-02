<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/partes/views/partesView.php'); 
require_once($raiz.'/partes/models/PartesModel.php'); 

class partesController
{
    protected $view;
    protected $model;
    public function __construct()
    {
        session_start();
        
        $this->view = new partesView();
        $this->model = new PartesModel();

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
}