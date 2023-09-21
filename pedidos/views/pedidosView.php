<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/prioridades/models/PrioridadModel.php'); 
require_once($raiz.'/login/models/UsuarioModel.php'); 
require_once($raiz.'/clientes/models/ClienteModel.php'); 
require_once($raiz.'/pedidos/models/EstadoInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/models/PedidoModel.php'); 
require_once($raiz.'/pedidos/views/itemInicioPedidoView.php'); 
require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 
require_once($raiz.'/prioridades/models/PrioridadModel.php'); 
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/impuestos/models/ImpuestoModel.php'); 
require_once($raiz.'/vista/vista.php'); 

// require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 

class pedidosView extends vista
{
    protected $pedidoModel;
    protected $prioridadModel;
    protected $usuarioModel;
    protected $clienteModel;
    protected $estIniPedModel;
    protected $itemInicioPedidoView;
    protected $tipoParteModel;
    protected $hardwareModel;
    protected $impuestoModel;

    public function __construct()
    {
        $this->pedidoModel = new PedidoModel();
        $this->prioridadModel = new PrioridadModel();
        $this->usuarioModel = new UsuarioModel();
        $this->clienteModel = new ClienteModel();
        $this->estIniPedModel = new EstadoInicioPedidoModel();
        $this->itemInicioPedidoView = new iteminicioPedidoView();
        $this->tipoParteModel = new TipoParteModel();
        $this->hardwareModel = new HardwareModel();
        $this->impuestoModel = new ImpuestoModel();
    }
    

    public function pedidosMenu($pedidos)
    {
        ?>
        <div style="padding:10px;"  id="div_general_pedidos" class="row">

            <div id="botones">
                <!-- Button trigger modal -->


                 <button type="button" 
                 class="btn btn-primary  float-left" 
                 onclick="pedidosPorCompletar();"
                 >
                 <!-- data-bs-toggle="modal" 
                 data-bs-target="#modalPedido" -->
                PEDIDOS POR COMPLETAR
                </button> 
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
            <div id="divResultadosPedidos" class="row mt-3">
                <table class="table table-striped hover-hover">
                    <thead>
                        <th>IdPedido.</th>
                        <th>Fecha.</th>
                        <th>Cliente</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                        <th>Ver</th>
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
                           echo '<td><button 
                                     class="btn btn-primary btn-sm " 
                                     onclick="siguientePantallaPedido('.$pedido['idPedido'].');"
                                     >Ver</button></td>';
                           echo '</tr>';  
                        }
                        ?>
                    </tbody>
                </table> 
                
                
            </div>
                
                <?php  
            $this->modalPedido();  
            $this->modalPedidoAsignartecnico();  
            $this->modalPedidoActualizar();  
            $this->modalPedidoVerItemTecnico();  
        
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
    public function modalPedidoVerItemTecnico()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalPedidoVerItemTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ver Item Asignado </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyPedidoVerItemTecnico">
                    
                </div>
                <div class="modal-footer">
                    <!-- <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="realizarCargaArchivo();" >Crear Pedido</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalPedidoActualizar()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalPedidoActualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyPedidoActualizar">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="pedidos();" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="realizarCargaArchivo();" >Crear Pedido</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalPedidoAsignartecnico()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalPedidoAsignartecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyPedidoAsignartecnico">
                    
                </div>
                <div class="modal-footer">
                    <!-- <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="realizarCargaArchivo();" >Crear Pedido</button> -->
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


        </div >
            <div>
                    <button class="btn btn-primary" onclick="continuarAItemsPedido();">Continuar</button>
           </div>
        <?php
    }


   public  function siguientePantallaPedido($idPedido)
   {
        $infoPedido    = $this->pedidoModel->traerPedidoId($idPedido);
        $infoCliente   = $this->clienteModel->traerClienteId($infoPedido['idCliente']);
        $estadosInicio = $this->estIniPedModel->traerEstadosInicioPedido(); 
        $tiposPartes   =   $this->tipoParteModel->traerTodasLosTipoPartes();
        $prioridades   =  $this->prioridadModel->traerPrioridades();
        $tecnicos      = $this->usuarioModel->traerTecnicos();
        $impuestos    = $this->impuestoModel->traerImpuestos();

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
                <div class=" row col-lg-4">
                    <div class="col-lg-3">% Retefuen
                        <input id="porcenretefuente" value = "<?php  echo $infoPedido['porcenretefuente']; ?>" size="4" >
                    </div>
                    <div class="col-lg-3">% ReteIca
                        <input id="porcenreteica" value = "<?php  echo $infoPedido['porcenreteica'];  ?>" size="4" >

                    </div>
                  
                </div>
                <div class =" row col-lg-2">
                <?php           
                  echo '<button 
                        class="btn btn-success" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalPedidoActualizar"
                        onclick = "actualizarPedido('.$idPedido.');"
                        >Actualizar Pedido
                        </button>';
                ?>
                </div>
                
            </div>
        
            <div class="row">
                <div class="col-lg-4">
                    <label class="col.lg-1">Cliente:</label>
                    <span class="col-lg-3"><?php  echo $infoCliente[0]['nombre'];  ?></span>
                </div>
                <div class="col-lg-2">
                    <?php
                      if($infoPedido['wo']==1)  
                      {
                          echo '<label class="col-lg-2" align="rigtht">WO <input type="checkbox" checked  id="checkwo"  onclick="actulizarWoPedido('.$idPedido.');"></label>';
                    }
                    else{
                          echo '<label class="col-lg-2" align="rigtht">WO <input type="checkbox"  id="checkwo"  onclick="actulizarWoPedido('.$idPedido.');"></label>';
                      }
                      if($infoPedido['r']==1)  
                      {
                          echo '<label class="col-lg-2" align="rigtht">R<input type="checkbox" checked  id="checkr"  onclick="actulizarRPedido('.$idPedido.');"></label>';
                    }
                    else{
                          echo '<label class="col-lg-2" align="rigtht">R <input type="checkbox"  id="checkr"  onclick="actulizarRPedido('.$idPedido.');"></label>';
                      }
                      if($infoPedido['i']==1)  
                      {
                          echo '<label class="col-lg-2" align="rigtht">I<input type="checkbox" checked  id="checki"  onclick="actulizarIPedido('.$idPedido.');"></label>';
                    }
                    else{
                          echo '<label class="col-lg-2" align="rigtht">I<input type="checkbox"  id="checki"  onclick="actulizarIPedido('.$idPedido.');"></label>';
                      }

                    ?>
                    
                </div>
             
            </div>
           
            <div class="row">
                 <div class="col-lg-3">
                    Tipo de item Agregar:
                </div>   
                <div class="col-lg-3">
                     <select class="form-control" id = "tipoItem" onchange="mostrarTipoItem();">
                         <option value = "-1">Seleccione</option>
                         <option value = "1">Hardware</option>
                         <option value = "2">Parte</option>
                     </select>

                 </div>   
                 <div class="col-lg-3"></div>   
                 <div class="col-lg-3"></div>   
            </div>

            <div class="row" >
                    <div id= "divTipoItemPedido">

                    </div>    
                    <div id="div_items_solicitados_pedido">
                          <?php   $this->itemInicioPedidoView->mostrarItemsInicioPedido($idPedido);  ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- aqui iran los comentarios        -->
                                <textarea 
                                    class="form-control" 
                                    id="comentarios" 
                                    placeholder = "Comentarios" 
                                    rows = "7"
                                    >
                                    <?php   echo $infoPedido['observaciones'] ?>
                                </textarea>
                             </div>            
                                <div class="col-lg-4">
                                    <!-- aqui ira la parte de los calculos totales del pedido  -->
                                    <?php   $this->itemInicioPedidoView->calculoValorespedido($idPedido);  ?>
                                </div>            
                        </div> 
                    </div>
                <div class="row">
                 <?php           
                //   echo '<button 
                //         class="btn btn-primary" 
                //         data-bs-toggle="modal" 
                //         data-bs-target="#modalPedidoActualizar"
                //         onclick = "actualizarPedido('.$idPedido.');"
                //         >Actualizar Pedido
                //         </button>';
                ?>
                </div>

            </div>

            <?php   $this->modalPedidoActualizar();  ?>
          
   <?php
    } 


    public function formuAsignarItemPedidoATecnico($request)
    {
        $prioridades   =  $this->prioridadModel->traerPrioridades();
        $tecnicos      = $this->usuarioModel->traerTecnicos();
      ?>
        <div class="row">
               <div class="col-md-3">
                    <label >Urgencia:</label>
                    <select id="idPrioridad" class="form-control">
                        <option value = ''>Seleccione...</option>
                            <?php
                                    foreach($prioridades as $prioridad)
                                    {
                                        echo '<option value = "'.$prioridad['id'].'">'.$prioridad['descripcion'].'</option>';    
                                    }
                                            
                                ?>
                    </select>         
               </div>

               <div class="col-md-3">
                    <label for="">Tecnico</label>
                      <select id="idTecnico" class="form-control">
                        <option value = ''>Seleccione...</option>
                        <?php
                                foreach($tecnicos as $tecnico)
                                {
                                    echo '<option value = "'.$tecnico['id_usuario'].'">'.$tecnico['nombre'].'</option>';    
                                }
                                        
                            ?>
                      </select>        
               </div>
           
       </div>
       <div class="row">
               <button type="button" 
               class="btn btn-primary  float-right mt-3" 
               onclick="realizarAsignacionTecnicoAItem(<?php echo $request['idItemPedido']  ?>); ";
               >
               Asignar  Tecnico a Item 
           </button>
      </div>
      

      <?php
    }

    
    public function tipoItemHardware($tipoItem)
    {
        $tiposPartes   =   $this->tipoParteModel->traerTipoParteHardware($tipoItem);
        $estadosInicio = $this->estIniPedModel->traerEstadosInicioPedido(); 
        $pulgadas =  $this->hardwareModel->traerInfoCampoTabla('pulgadas');
        $procesadores =  $this->hardwareModel->traerInfoCampoTabla('procesador');
        $generaciones =  $this->hardwareModel->traerInfoCampoTabla('generacion');
        $generaciones =  $this->hardwareModel->traerInfoCampoTabla('generacion');
        $capacidadram =  $this->hardwareModel->traerInfoCampoTabla('capacidadram');
        $capacidaddisco =  $this->hardwareModel->traerInfoCampoTabla('capacidaddisco');
        ?>
        <input type="hidden"  id="iobservaciones" value =".">
        <table class="table">
               <thead >
                   
                   <tr>
                       <th>Cantidad</th>
                       <th>Tipo</th>
                       <th>Subtipo</th>
                       <th>Modelo</th>
                       <th>Pulgadas</th>
                       <th>Procesador</th>
                       <th>Generacion</th>
                       <th>Ram Tipo</th>
                       <th>Disco Tipo</th>
                       <th>Ram GB</th>
                       <th>Disco GB</th>
                       <th>Estado</th>
                       <th>Precio</th>
                       <th>Accion</th>
                    </tr>
                </thead> 
                <tbody>

                    <tr>
                        <th><input type="text" id="icantidad" size="1px"></th>
                        <!-- <th><input type="text" id="itipo" size="1px"></th> -->
                        <th>
                            <select id="itipo"  size="1px" onchange="buscarSuptiposParaSelect();">
                                <option value=''>...</option>
                                <?php
                                foreach($tiposPartes as $tipoParte)
                                {
                                    echo '<option value = "'.$tipoParte['id'].'">'.$tipoParte['descripcion'].'</option>';    
                                }
                                
                                ?>
                            </select>
                        </th>
                        <th><select id="isubtipo">222</select> </th>
                        <!-- <th colspan ="6"><input id="iobservaciones" class="form-control"> </th> -->

                            <th><input type="text" id="imodelo" size="1px"></th>
                            <th>
                                <!-- <input type="text" id="ipulgadas" size="1px"> -->
                                <select class ="form-control"  id="ipulgadas" size="1px">
                                    <?php  $this->colocarSelectCampo($pulgadas);  ?>
                                </select>  
                            </th>
                            <th>
                            <select class ="form-control"  id="iprocesador" size="1px">
                                    <?php  $this->colocarSelectCampo($procesadores);  ?>
                                </select>  
                                <!-- <input type="text" id="iprocesador" size="1px"> -->
                            </th>
                            <th>   <select class ="form-control"  id="igeneracion"  size="1px">
                                        <?php  $this->colocarSelectCampo($generaciones);  ?>
                                    </select>  
                            </th>
                            <th>
                                <select class ="form-control"  id="iram" size="1px" >
                                    <option value ="-1">Sel..</option>
                                    <option value ="DDR2">DDR2</option>
                                    <option value ="DDR3">DDR3</option>
                                    <option value ="DDR4">DDR4</option>
                                </select>  
                            </th>
                            <th>
                                <select class ="form-control"  id="idisco" size="1px" >
                                    <option value ="-1">Sel..</option>
                                    <option value ="Solido">Solido</option>
                                    <option value ="Mecanico">Mecanico</option>
                                </select>  
                                
                            </th>
                            <th>
                                <select class ="form-control"  id="icapacidadram"  size="1px">
                                    <?php  $this->colocarSelectCampo($capacidadram);  ?>
                                </select>  
                            </th>
                            <th>
                            <select class ="form-control"  id="icapacidaddisco"  size="1px">
                                    <?php  $this->colocarSelectCampo($capacidaddisco);  ?>
                                </select>  
                            </th>

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
                    <?php
                    echo '<th><button class="btn btn-primary btn-sm" onclick="agregarItemInicialPedido('.$tipoItem.');">+</button></th>';
                     ?>           
                    </tr>
            </tbody>
            </table>  

    <?php

    }

    
    public function tipoItemParte($tipoItem)
    {
        $tiposPartes   =   $this->tipoParteModel->traerTipoParteHardware($tipoItem);
        $estadosInicio = $this->estIniPedModel->traerEstadosInicioPedido(); 
        echo '<input type="hidden"  id="imodelo" value="." >';
        echo '<input type="hidden"  id="ipulgadas"  value="." >';
        echo '<input type="hidden"  id="iprocesador"  value="." >';
        echo '<input type="hidden"  id="igeneracion"  value="." >';
        echo '<input type="hidden"  id="iram"  value="." >';
        echo '<input type="hidden"  id="idisco"  value="." >';
        ?>
        <table class="table">
               <thead >
                   
                   <tr>
                       <th>Cantidad</th>
                       <th>Tipo</th>
                       <th>Subtipo</th>
                       <th>Observaciones</th>
                       <th>Estado</th>
                       <th>Precio</th>
                       <th>Accion</th>
                    </tr>
                </thead> 
                <tbody>

                    <tr>
                        <th><input type="text" id="icantidad" size="1px"></th>
                        <!-- <th><input type="text" id="itipo" size="1px"></th> -->
                        <th>
                            <select id="itipo"  size="1px" onchange="buscarSuptiposParaSelect();">
                                <option value=''>...</option>
                                <?php
                                foreach($tiposPartes as $tipoParte)
                                {
                                    echo '<option value = "'.$tipoParte['id'].'">'.$tipoParte['descripcion'].'</option>';    
                                }
                                
                                ?>
                            </select>
                        </th>
                        <th><select id="isubtipo"></select> </th>
                        <th><input type="text" id="iobservaciones" ></th>
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
                    echo '<th><button class="btn btn-primary btn-sm" onclick="agregarItemInicialPedido('.$tipoItem.');">+</button></th>';
                </tr>
            </tbody>
            </table>  

    <?php

    }

    public function pedidosPorCompletar($pedidosPorCompletar)
    {
        // $this->printR($pedidosPorCompletar);
        echo '<div class="row">'; 
        foreach($pedidosPorCompletar as $pedido)
        {
            $tecnicos = $this->pedidoModel->traerLosTecnicosConAsginacionIdPedido($pedido['idPedido']);
            // $this->printR($tecnicos); 
            ?>
                <div style="width:150px; height:150px; border:1px solid; display:inline;margin:5px;padding:10px;">
                    <div class="row">
                        OC <?php echo $pedido['idPedido'] ?>
                    </div>
                    <div class="row" style="padding:2px;">
                        <?php 
                            foreach($tecnicos as $tecnico)
                            {
                                $infoTecnico = $this->usuarioModel->traerInfoId($tecnico['idTecnico']);
                                echo '<br>';
                                echo '<button 
                                        onclick="mostrarItemsInicioPedidoTecnico('.$pedido['idPedido'].','.$tecnico['idTecnico'].')"; 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalPedidoVerItemTecnico"
                                        class="btn btn-primary btn-sm" 
                                        style="margin-bottom:3px"
                                        >'.$infoTecnico['nombre'].' ' .$infoTecnico['apellido'].
                                     '</button>';
                            }
                        ?>    
                    </div>
                </div>
            <?php       
        }
        echo '</div>'; 
    }
}