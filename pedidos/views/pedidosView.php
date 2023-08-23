<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/prioridades/models/PrioridadModel.php'); 
require_once($raiz.'/login/models/UsuarioModel.php'); 
// require_once($raiz.'/partes/models/PartesModel.php'); 
// require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 
// require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 

class pedidosView
{
    protected $prioridadModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->prioridadModel = new PrioridadModel();
        $this->usuarioModel = new UsuarioModel();
    }
    

    public function pedidosMenu($pedidos)
    {
        ?>
        <div style="padding:10px;">

            <div id="botones" class="">
                <!-- Button trigger modal -->
                 <button type="button" 
                data-bs-toggle="modal" 
                data-bs-target="#modalPedido"
                class="btn btn-primary  float-right" 
                onclick="pedirInfoNuevoPedido();"
                >
                NUEVO PEDIDO
            </button> 
            </div>
            <div id="divResultadosPedidos">
                <table class="table table-striped hover-hover">
                    <thead>
                        <th>IdPedido.</th>
                        <th>Fecha.</th>
                        <th>Cliente</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                    </thead>
                <tbody>
                    <?php
                      foreach($pedidos as $pedido)
                      {
              
                           echo '<tr>'; 
                          echo '<td>'.$pedido['idPedido'].'</td>';
                          echo '<td>'.$pedido['fecha'].'</td>';
                          echo '<td>'.$pedido['idCliente'].'</td>';
                           echo '<td>'.$pedido['observaciones'].'</td>';
                           echo '<td>'.$pedido['idestadoPedido'].'</td>';
                        //    echo '<td><button 
                        //              data-bs-toggle="modal" 
                        //              data-bs-target="#modalVerMovimientos"
                        //              class="btn btn-primary btn-sm " 
                        //              onclick="verMovimientosParte('.$parte['id'].');"
                        //              >Mov</button></td>';
                           echo '</tr>';  
                        }
                        ?>
                    </tbody>
                </table> 
                
                
            </div>
                
                <?php  
            $this->modalPedido();  
        
            ?>
            
            
        </div>
        <?php
    }


    public function modalPedido()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyPedido">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="realizarCargaArchivo();" >Crear Pedido</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }

    public function pedirInfoNuevoPedido($request)
    {
        $prioridades = $this->prioridadModel->traerPrioridades();
        $tecnicos =  $this->usuarioModel->traerTecnicos(); 
        //  echo '123<pre>';
        // print_r($tecnicos); 
        // echo '</pre>';
        // die();
        ?>
         <div>
            <div class="row">
                <div class="col-lg-3">
                    CLIENTE:
                </div>
                <div class="col-lg-9">
                    <select class="form-control" name="" id="idEmpresaCliente" onchange="buscarSucursal();">
                        <option values =''>Seleccione..</option>
                        <option values ='1'>Empresa 1</option>
                        <option values ='2'>Empresa 2</option>
                        <option values ='3'>Empresa 3</option>
                        <option values ='4'>Empresa 4</option>
                        <option values ='5'>Empresa 5</option>

                    </select>
                </div>

            </div>
            <div id="divInfoNuevoPedido" class="row mt-3">
                <div class="col-lg-6">
                    Urgencia:
                    <select  id="idPrioridad">
                            <option value="">Seleccione...</option>
                            <?php
                                 foreach($prioridades as $prioridad)       
                                 {
                                    echo '<option value ="'.$prioridad['id'].'">'.$prioridad['descripcion'].'</option>';
                                 }
                            ?>
                    </select>
                </div>
                <div class="col-lg-6">
                    Tecnico:
                    <select  id="idTecnico">
                            <option value="">Seleccione...</option>
                            <?php
                                 foreach($tecnicos as $tecnico)       
                                 {
                                    echo '<option value ="'.$tecnico['id_usuario'].'">'.$tecnico['nombre'].'</option>';
                                 }
                            ?>
                    </select>
                </div>
           </div>
          <div class="row">
              <div class="col-lg-8 offset-2">
                  <input type="checkbox" >WO              
                  <input type="checkbox" >R              
                  <input type="checkbox" >I              
              </div>                   
          </div>
          <div class="row">
            <div>Comentarios:</div>
            <textarea class ="form-control">

            </textarea>
          </div>

         </div>   


        <?php
    }

}