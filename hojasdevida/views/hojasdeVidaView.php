<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hojasdevida/models/HojadeVidaModel.php'); 
require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 
require_once($raiz.'/subtipos/models/SubtipoParteModel.php');  
require_once($raiz.'/hardware/models/HardwareModel.php');  
require_once($raiz.'/inventarios/models/EstadoInventarioModel.php');  
require_once($raiz.'/vista/vista.php');  

class hojasdeVidaView extends vista
{

    protected $model ; 
    protected $tipoParteModel ; 
    protected $subTipoParteModel ; 
    protected $HardwareModel ; 
    protected $estadoInventarioModel ; 

    public function __construct()
    {
        session_start();
        $this->model = new HojadeVidaModel();
        $this->tipoParteModel = new TipoParteModel();
        $this->subTipoParteModel = new SubTipoParteModel();
        $this->HardwareModel = new HardwareModel();
        $this->estadoInventarioModel = new EstadoInventarioModel();
       
    }
    public function hojasdeVidaMenu()
    {
      ?>
       <div style="padding:10px;"  id="div_general_hojasdevida">
            <h2>Hojas de Vida Hardware</h2>
             <div class="row" id="div_botonesyfiltros">
               <label class="col-lg-2">SERIAL:</label>
               <div class="col-lg-4">
                   <input 
                        placeholder ="SERIAL"
                        class="form-control" 
                        type="text" 
                        id="inputBuscarHardware" 
                        onkeyup="fitrarHardware();">
               </div>  
            </div>
            <div id="div_movimientos_hardware">
                <?php  $this->traerHardware();  ?>
            </div>
       </div>
      <?php
    }
 

    public function traerHardware()
    {
        $hardwards = $this->HardwareModel->traerHardware(); 
        ?>
        <table class="table table-striped hover-hover">
            <thead>
                <th>Serial</th>
                <th>No Importacion</th>
                <th>Estado</th>
                
                <th>Ver</th>
            </thead>
            <tbody>
                <?php
                    foreach($hardwards as $hardward)
                    {
                        $estado = $this->estadoInventarioModel->traerEstadoId($hardward['idEstadoInventario']);      
                        // $this->printR($estado);
                       echo '<tr>'; 
                       echo '<td>'.$hardward['serial'].'</td>';
                       echo '<td>'.$hardward['idImportacion'].'</td>';
                       echo '<td>'.$estado['descripcion'].'</td>';
                       echo '<td><button 
                                   class="btn btn-primary btn-sm " 
                                   onclick="verMovimientosHardware('.$hardward['id'].');"
                                   >Ver</button></td>';
                       echo '</tr>';  
                      }
                      ?>
                  </tbody>
              </table> 
      <?php
      

    }
 

    public function traerHardwareFiltrado($inputBuscarHardware)
    {
        $hardwards = $this->HardwareModel->traerHardwareFiltro($inputBuscarHardware); 
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
                                   onclick="verMovimientosHardware('.$hardward['id'].');"
                                   >Ver</button></td>';
                         echo '</tr>';  
                      }
                      ?>
                  </tbody>
              </table> 
      <?php
      

    }


}