<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hojasdevida/models/HojadeVidaModel.php'); 
require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 
require_once($raiz.'/subtipos/models/SubtipoParteModel.php');  
require_once($raiz.'/hardware/models/HardwareModel.php');  
require_once($raiz.'/pedidos/models/EstadoInicioPedidoModel.php');  
require_once($raiz.'/vista/vista.php');  

class hojasdeVidaView extends vista
{

    protected $model ; 
    protected $tipoParteModel ; 
    protected $subTipoParteModel ; 
    protected $HardwareModel ; 
    protected $estadoInicioPedidoModel ; 

    public function __construct()
    {
        session_start();
        $this->model = new HojadeVidaModel();
        $this->tipoParteModel = new TipoParteModel();
        $this->subTipoParteModel = new SubTipoParteModel();
        $this->HardwareModel = new HardwareModel();
        $this->estadoInicioPedidoModel = new EstadoInicioPedidoModel();
       
    }
    public function hojasdeVidaMenu()
    {
      ?>
       <div style="padding:10px;"  id="div_general_hojasdevida">
            <h2>Hojas de Vida Hardware</h2>
             <div class="row" id="div_botonesyfiltros">
               <label class="col-lg-2">SERIAL:</label>
               <div class="col-lg-4 ">
                   <input 
                        placeholder ="SERIAL"
                        class="form-control" 
                        type="text" 
                        id="inputBuscarHardware" 
                        onkeyup="fitrarHardware();">
               </div>  
             <br>
            </div>
            <div id="div_movimientos_hardware" class="mt-3">
                <?php  $this->traerHardware();  ?>
            </div>
       </div>
      <?php
    }
 

    public function traerHardware()
    {
        $hardwards = $this->HardwareModel->traerHardwareTodosLosEstados(); 
        ?>
        <table class="table table-striped hover-hover">
            <thead>
                <th>Serial</th>
                <th>No Importacion</th>
                <th>Estado</th>
                <th>Dar Baja</th>
                
                
                <th>Ver</th>
            </thead>
            <tbody>
                <?php
                    foreach($hardwards as $hardward)
                    {
                        $infoEstado = $this->estadoInicioPedidoModel->traerEstadosInicioPedidoId($hardward['idEstadoInventario']);      
                        // $this->printR($estado);
                       $estado =  $hardward['idEstadoInventario'];
                       echo '<tr>'; 
                       echo '<td>'.$hardward['serial'].'</td>';
                       echo '<td>'.$hardward['idImportacion'].'</td>';
                       echo '<td>'.$infoEstado['descripcion'].'</td>';
                       $dadodebaja = 4;
                       if($estado == $dadodebaja)
                       {

                           echo '<td><button 
                                       class="btn btn-secondary btn-sm " 
                                       onclick="habilitarHardware('.$hardward['id'].');"
                                       >Habilitar</button></td>';
                       }else{
                           
                           echo '<td><button 
                                       class="btn btn-primary btn-sm " 
                                       onclick="verificarDarDeBaja('.$hardward['id'].');"
                                       >Dar Baja</button></td>';
                       }

                       echo '<td><button 
                                   class="btn btn-primary btn-sm " 
                                   onclick="verMovimientosHardware('.$hardward['id'].');"
                                   >Historial</button></td>';
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