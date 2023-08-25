<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/prioridades/models/PrioridadModel.php'); 
require_once($raiz.'/login/models/UsuarioModel.php'); 
require_once($raiz.'/clientes/models/ClienteModel.php'); 
require_once($raiz.'/pedidos/models/EstadoInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/models/PedidoModel.php'); 
// require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 
// require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 

class pedidosView
{
    protected $pedidoModel;
    protected $prioridadModel;
    protected $usuarioModel;
    protected $clienteModel;
    protected $estIniPedModel;

    public function __construct()
    {
        $this->pedidoModel = new PedidoModel();
        $this->prioridadModel = new PrioridadModel();
        $this->usuarioModel = new UsuarioModel();
        $this->clienteModel = new ClienteModel();
        $this->estIniPedModel = new EstadoInicioPedidoModel();
    }
    

    public function pedidosMenu($pedidos)
    {
        ?>
        <div style="padding:10px;"  id="div_general_pedidos">

            <div id="botones" class="">
                <!-- Button trigger modal -->
                 <button type="button" 
                 class="btn btn-primary  float-right" 
                 onclick="pedirInfoNuevoPedido();"
                 >
                 <!-- data-bs-toggle="modal" 
                 data-bs-target="#modalPedido" -->
                NUEVO PEDIDO
            </button> 
            </div>
            <br>
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

    public function pedirInfoNuevoPedidoAnte($request)
    {
        $prioridades = $this->prioridadModel->traerPrioridades();
        $tecnicos =  $this->usuarioModel->traerTecnicos(); 
        $clientes = $this->clienteModel->traerClientes();
        $estIniPedModel = $this->estIniPedModel->traerEstadosInicioPedido();

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
                    <select class="form-control" name="" id="idEmpresaCliente" onchange="buscarSucursal123();">
                        <option values =''>Seleccione..</option>
                        <?php
                              foreach($clientes as $cliente)       
                              {
                                 echo '<option value ="'.$cliente['idcliente'].'">'.$cliente['nombre'].'</option>';
                              }
                        ?>

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
            
           </div>
     
         </div>   


        <?php
    }

    public function pedirInfoNuevoPedido($request)
    {
        $prioridades = $this->prioridadModel->traerPrioridades();
        $tecnicos =  $this->usuarioModel->traerTecnicos(); 
        $clientes = $this->clienteModel->traerClientes();
        $estIniPedModel = $this->estIniPedModel->traerEstadosInicioPedido();

        //  echo '123<pre>';
        // print_r($tecnicos); 
        // echo '</pre>';
        // die();
        ?>
         <div class="row">
            
                <label class="col-lg-2">
                    CLIENTE:
                </label>
                <div class="col-lg-3">
                    <select class="form-control" name="" id="idEmpresaCliente" onchange="buscarSucursal123();">
                        <option values =''>Seleccione..</option>
                        <?php
                              foreach($clientes as $cliente)       
                              {
                                 echo '<option value ="'.$cliente['idcliente'].'">'.$cliente['nombre'].'</option>';
                              }
                        ?>

                    </select>
                </div>

                
                    <label class="col-lg-2">
                        Urgencia:
                    </label>
                    <div class="col-lg-3">
                        <select  id="idPrioridad" class="form-control">
                                <option value="">Seleccione...</option>
                                <?php
                                     foreach($prioridades as $prioridad)       
                                     {
                                        echo '<option value ="'.$prioridad['id'].'">'.$prioridad['descripcion'].'</option>';
                                     }
                                ?>
                        </select>
                    </div>          
                
               
           </div>

           <div >
                    <button class="btn btn-primary" onclick="continuarAItemsPedido();">Continuar</button>
           </div>
      
          

         </div>   


        <?php
    }


   public  function siguientePantallaPedido($idPedido)
   {
        $infoPedido    = $this->pedidoModel->traerPedidoId($idPedido);
        $infoCliente   = $this->clienteModel->traerClienteId($infoPedido['idCliente']);
        $estadosInicio = $this->estIniPedModel->traerEstadosInicioPedido(); 
        //    echo '<pre>'; 
        //     print_r($infoCliente); 
        //     echo '</pre>';
        //     die(); 
        echo '<input type="hidden" id="idPedido" value = "'.$idPedido.'">';
    ?>  
        <div>
            <div class="row" style="padding:5px;">
                <div class="col-lg-4">
                    <label class="col.lg-1"> Fecha:</label>
                    <span class="col-lg-1"><?php  echo $infoPedido['fecha'];  ?></span>
                </div>
                <div class="col-lg-2">
                    <label>OC:</label>
                    <span class="col-lg-2"><?php  echo $infoPedido['idPedido'];  ?></span>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-lg-4">
                    <label class="col.lg-1">Cliente:</label>
                    <span class="col-lg-3"><?php  echo $infoCliente[0]['nombre'];  ?></span>
                </div>
                <div class="col-lg-6">
                    <label class="col-lg-2" align="rigtht">WO <input type="checkbox"  id="wo"></label>
                    
                    <label class="col-lg-2">R <input type="checkbox"  id="wo"></label>
                    
                    <label class="col-lg-2">I <input type="checkbox"  id="wo"></label>
                    
                </div>
            </div>
            
            <div class="row">
                <table class="table">
                    <tr>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                        <th>Modelo</th>
                        <th>Pulgadas</th>
                        <th>Procesador</th>
                        <th>Generacion</th>
                        <th>Ram</th>
                        <th>Disco</th>
                        <th>Estado</th>
                        <th>Precio</th>
                        <th>Accion</th>
                    </tr>
                    <tr>
                        <th><input type="text" id="icantidad" size="1px"></th>
                        <th><input type="text" id="itipo" size="1px"></th>
                        <th><input type="text" id="imodelo" size="1px"></th>
                        <th><input type="text" id="ipulgadas" size="1px"></th>
                        <th><input type="text" id="iprocesador" size="1px"></th>
                        <th><input type="text" id="igeneracion" size="1px"></th>
                        <th><input type="text" id="iram" size="1px"></th>
                        <th><input type="text" id="idisco" size="1px"></th>
                        <th>
                            <select id="idEstadoInicio"  size="1px" >
                                <option value="">Seleccione...</option>
                                <?php
                                    foreach($estadosInicio as $estadoInicio)
                                    {
                                        echo '<option value = "'.$estadoInicio['id'].'">'.$estadoInicio['descripcion'].'</option>';    
                                    }

                                ?>
                            </select> 
                        </th>
                        <th><input type="text" id="iprecio" size="5px"></th>
                        <th><button class="btn btn-primary btn-sm" onclick="agregarItemInicialPedido();">+</button></th>
                    </tr>
                </table>
                    <div id="div_items_solicitados_pedido">
                        </div>
                    </div>
            

        </div>
   <?php
    } 

}