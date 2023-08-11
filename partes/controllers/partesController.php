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
        $this->view = new partesView();
        $this->model = new PartesModel();

        if($_REQUEST['opcion']=='partesMenu')
        {
            $this->partesMenu();
        }

    }

    public function partesMenu()
    {
        $partes =  $this->model->traerTodasLasPartes();
        $this->view->partesMenu($partes);
    }
}