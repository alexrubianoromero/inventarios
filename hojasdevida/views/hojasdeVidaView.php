<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hojasdevida/models/HojadeVidaModel.php'); 
require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 
require_once($raiz.'/subtipos/models/SubtipoParteModel.php');  
require_once($raiz.'/hardware/models/HardwareModel.php');  

class hojasdeVidaView
{

    protected $model ; 
    protected $tipoParteModel ; 
    protected $subTipoParteModel ; 
    protected $HardwareModel ; 

    public function __construct()
    {
        $this->model = new HojadeVidaModel();
        $this->tipoParteModel = new TipoParteModel();
        $this->subTipoParteModel = new SubTipoParteModel();
        $this->HardwareModel = new HardwareModel();
        
       
    }
    public function hojasdeVidaMenu()
    {
      ?>
       <div style="padding:10px;"  id="div_general_hojasdevida">
        <div id="div_botonesyfiltros">
              
            </div>
            <div>
                <?php  $this->mostrarHardware();  ?>
            </div>
       </div>
      <?php
    }
    public function mostrarHardware()
    {
        $hardwards = $this->HardwareModel->traerHardware(); 
        ?>
          <table class="table table-striped hover-hover">
                    <thead>
                        <th>Serial</th>
                        <th>No Importacion</th>
                      
                        <th>Ver</th>
                    </thead>
                <tbody>
                    <?php
                      foreach($hardwards as $hardward)
                      {
              
                           echo '<tr>'; 
                          echo '<td>'.$hardward['serial'].'</td>';
                          echo '<td>'.$hardward['idImportacion'].'</td>';
                           echo '<td><button 
                                     class="btn btn-primary btn-sm " 
                                     onclick="siguientePantallaPedido('.$hardward['id'].');"
                                     >Ver</button></td>';
                           echo '</tr>';  
                        }
                        ?>
                    </tbody>
                </table> 
        <?php
    }

}