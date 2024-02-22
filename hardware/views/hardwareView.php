<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/partes/models/PartesModel.php'); 
require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 
require_once($raiz.'/marcas/models/MarcaModel.php'); 
require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 
require_once($raiz.'/movimientos/models/MovimientoHardwareModel.php'); 
require_once($raiz.'/pedidos/models/ItemInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/models/EstadoInicioPedidoModel.php'); 
require_once($raiz.'/hardware/models/ProcesadorModel.php'); 
require_once($raiz.'/hardware/models/GeneracionModel.php'); 
require_once($raiz.'/pedidos/models/PedidoModel.php'); 
require_once($raiz.'/clientes/models/ClienteModel.php'); 
require_once($raiz.'/pedidos/models/AsociadoItemInicioPedidoHardwareOparteModel.php'); 
require_once($raiz.'/vista/vista.php'); 

class hardwareView extends vista
{
    protected $hardwareModel;
    protected $partesModel;
    protected $SubtipoParteModel;
    protected $MarcaModel;
    protected $tipoParteModel;
    protected $movimientoHardwareModel;
    protected $itemInicioPedidoModel;
    protected $procesadorModel;
    protected $generacionModel;
    protected $pedidoModel;
    protected $clienteModel;
    protected $estadoInicioPedidoModel;
    protected $asociadoItemPedido;

    public function __construct()
    {
        $this->hardwareModel = new HardwareModel();
        $this->partesModel = new PartesModel();
        $this->SubtipoParteModel = new SubtipoParteModel();
        $this->MarcaModel = new MarcaModel();
        $this->tipoParteModel = new TipoParteModel();
        $this->movimientoHardwareModel = new MovimientoHardwareModel();
        $this->itemInicioPedidoModel = new ItemInicioPedidoModel();
        $this->procesadorModel = new ProcesadorModel();
        $this->generacionModel = new GeneracionModel();
        $this->pedidoModel = new PedidoModel();
        $this->clienteModel = new ClienteModel();
        $this->estadoInicioPedidoModel = new EstadoInicioPedidoModel();
        $this->asociadoItemPedido = new AsociadoItemInicioPedidoHardwareOparteModel();
    }
    public function hardwareMenu($hardware)
    {
        ?>
        <div  style="padding:5px;">
            <!-- <div class="col-lg-2"></div>
            <div class="col-lg-2"></div>
            <div class="col-lg-2"></div>
            <div class="col-lg-2"></div> -->
            <div  class="row" id="botones" class="mt-3 " >
                <!-- <div class="col-lg-2">
                    <button type="button" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalNuevoHardware"
                    class="btn btn-primary " 
                    onclick="formuNuevoHardware()"
                    >
                    Nuevo Hardware
                    </button>
                </div> -->
                <div class="col-lg-2">
                    <button type="button" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalSubirArchivo"
                    class="btn btn-primary  float-right" 
                    onclick="formularioSubirArchivo()"
                    >
                        Subir Archivo
                    </button>
                </div>
                <div class="col-lg-2">
                    <button type="button" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalFiltros"
                    class="btn btn-primary  float-right" 
                    onclick="formuFiltrosHardware()"
                    >
                        Filtros
                    </button>
                </div>

            </div>
            <!-- <div id="botones" class="mt-3">
                <button type="button" 
                data-bs-toggle="modal" 
                data-bs-target="#modalInventario"
                class="btn btn-primary  float-right" 
                onclick="pedirInfoProducto();"
                >
                    Crear Computador/Monitor
                </button>
            </div> -->
            <div id="divResultadosHardware" class="mt-3">
                <?php  
                        $this->traerHardwareMostrarmenu($hardware)  ?>
                </div>
                
                
                
                <?php  
            // $this->modalInventario();  
            // $this->modalInventarioMostrar();  
            $this->modalSubirArchivo();  
            $this->modalHardwareMostrar();  
            $this->modalAgregarRam();  
            $this->modalNuevoHardware();  
            $this->modalDividirRam();  
            $this->modalFiltros();  
            ?>

            
            
        </div>
        <?php
    }
    public function traerHardwareMostrarmenu($hardware)
    {
        ?>
             <table class="table table-striped hover-hover">
                    <thead>
                        
                        <th>H/P</th>
                        <th>Ubicacion</th>
                        <th>Serial</th>
                        <th>Pulg/Cond</th>
                        <th>Procesador</th>
                        <!-- <th>Generacion</th>
                        <th>TotalRam</th>
                        <th>Tipo Disco</th>
                        <th>Cap.Disco</th> -->
                        <th>Acciones</th>
                        
                    </thead>
                    <tbody>
                        
                        <?php
                      foreach($hardware as $hard)
                      {
                        if($hard['hardwareoparte']==1)
                        {
                            $nombreTipoInven = 'Hardware';
                        }
                        if($hard['hardwareoparte']==2)
                        {
                            $nombreTipoInven = 'Parte'; 
                        }
                        $totalRam = $this->hardwareModel->totalizarRamHardwareId($hard['id']);
                        $ram =  $this->partesModel->traerParte($hard['idRam']);
                        $subTipoRam = $this->SubtipoParteModel->traerSubTipoParte($ram[0]['idSubtipoParte']);
                        // echo '<pre>'; print_r($ram); echo '</pre>'; die();
                        
                        $disco =  $this->partesModel->traerParte($hard['idDisco']);
                        $subTipoDisco = $this->SubtipoParteModel->traerSubTipoParte($disco[0]['idSubtipoParte']);
                          // $infoSucursal = $this->sucursalModel->traerSucursalId($user['idSucursal']); 
                          // $infoPerfil = $this->perfilModel->traerPerfilId($user['id_perfil']); 

                          echo '<tr>'; 
                          echo '<td>'.$nombreTipoInven.'</td>';
                          echo '<td>'.$hard['ubicacion'].'</td>';
                          echo '<td>'.$hard['serial'].'</td>';
                          echo '<td>'.$hard['pulgadas'].'</td>';
                          echo '<td>'.$hard['procesador'].'</td>';
                          //   echo '<td>'.$hard['idRam'].'</td>';
                          //aqui depende de la info lo que se muestra
                          //si idRam = 0 entonces muestra info de los campos del cargue para ram 

                        //   echo '<td>'.$hard['generacion'].'</td>';
                        //   echo '<td>'. $totalRam.'</td>';
                          
                        // if($hard['idRam1'] == '0' && $hard['idRam2']=='0' && $hard['idRam3']=='0' && $hard['idRam4']=='0')
                        // {
                        //     // die('entro al condicional');
                        //     $subTipoRamCargue = $this->SubtipoParteModel->traerSubTipoParte($hard['tipoRamCargue']);

                        //     echo '<td>'.$hard['capacidadRamCargue'].'GB-'.$subTipoRamCargue[0]['descripcion'].'</td>';
                        // }
                        // else{
                        //     $totalRam = $this->hardwareModel->totalizarRamHardwareId($hard['id']);
                        //     echo '<td>'.$totalRam.'GB</td>';
                            
                        // }
                        //ahora los discos 
                        if($hard['idDisco1'] == '0' && $hard['idDisco2']=='0')
                        {
                            $subTipoDisco = $this->SubtipoParteModel->traerSubTipoParte($hard['tipoDiscoCargue']);
                            
                            // echo '<td>'.$subTipoDisco[0]['descripcion'].'</td>';
                            // echo '<td>'.$hard['capacidadDiscoCargue'].'GB'.'</td>';
                        }
                        else{
                            
                            $infD1 = $this->partesModel->traerParte($hard['idDisco1']); 
                            $subTipoDisco1 = $this->SubtipoParteModel->traerSubTipoParte($infD1[0]['idSubtipoParte']);
                            //    echo '<pre>';
                            //     print_r($subTipoDisco1); 
                            //     echo '</pre>';
                            //     die();
                            $infD2 = $this->partesModel->traerParte($hard['idDisco2']); 
                            $subTipoDisco2 = $this->SubtipoParteModel->traerSubTipoParte($infD2[0]['idSubtipoParte']);

                            // $infoDisco2 = $this->partesModel->traerParte($hard['idDisco2']); 
                            
                            $totalDisco = $this->hardwareModel->totalizarDiscoHardwareId($hard['id']);
                            //si son varios tipos de discos?
                            // echo '<td>'.$subTipoDisco1[0]['descripcion'].'/'.$subTipoDisco2[0]['descripcion'].'</td>';
                            // echo '<td>'.$totalDisco.'GB</td>';
                        }

                        //   echo '<td>'.$subTipoDisco[0]['descripcion'].'</td>';
                        //   echo '<td>'.$disco[0]['capacidad'].'</td>';
                          echo '<td>';
                          echo '<button 
                          data-bs-toggle="modal" 
                          data-bs-target="#modalHardwareMostrar"
                          onclick="verHardware('.$hard['id'].');" class="btn btn-primary btn-sm ">
                          Ver
                          </button>' ;
                          //   echo '<button onclick="verProducto123('.$inventario['idInventario'].');" class="btn btn-primary btn-sm m-2">
                          //   <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                          //   </button>' ;
                          //   echo '<button onclick="verProducto('.$inventario['idInventario'].');" class="btn btn-primary btn-sm m-2">Ver</button>' ;
                          echo '</td>';
                          echo '</tr>';  
                        }
                        ?>
                    </tbody>
                </table> 

        <?php
    }

    public function modalSubirArchivo()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalSubirArchivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Subir Archivo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodySubirArchivo">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="realizarCargaArchivo();" >SubirArchivo</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }

    public function modalFiltros()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalFiltros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filtros</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyModalFiltros">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="realizarCargaArchivo();" >SubirArchivo++</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalHardwareMostrar()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalHardwareMostrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info y Edicion Hardware</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyHardwareMostrar">
                    ...
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();">Cerrar</button>
                    <!-- <button onclick ="actualizarProducto();" type="button" class="btn btn-primary">Actualizar Producto</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalNuevoHardware()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevoHardware" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hardware</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevoHardware">
                    ...
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();">Cerrar</button>
                    <!-- <button onclick ="actualizarProducto();" type="button" class="btn btn-primary">Actualizar Producto</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalDividirRam()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalDividirRam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Dividir Ram</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyDividirRam">
                
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();">Cerrar</button>
                    <!-- <button onclick ="actualizarProducto();" type="button" class="btn btn-primary">Actualizar Producto</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalAgregarRam()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalAgregarRam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar o Quitar Parte</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyAgregarRam">
                    ...
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();">Cerrar</button>
                    <!-- <button onclick ="actualizarProducto();" type="button" class="btn btn-primary">Actualizar Producto</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }

    public function formularioSubirArchivo()
    {
        // echo 'subir archivo '; 
        ?>
        <div id="div_cargue_archivo">
                <input name="imagen" id="imagen" type="file">
                <br><br><br><br>
                <!-- <button onclick="procesarformu();" >Procesar</button> -->
                <br><br>
                <!-- <button id="btnEnviar">Enviar!!</button> -->
                <!-- </form> -->
                <div id="div_muestre_resultado"></div>
                <span id="demo"></span>
        </div>
        
        <?php

    }
    public function verCostos($idHardware)
    {
        $infoHardware = $this->hardwareModel->traerHardwareId($idHardware);
        // $this->printR($idHardware);
        ?>
        <input type="hidden" id ="idHardwareCosto" value="<?php  echo $idHardware  ?>">
        <div class="row">
            <div class="form-group" class="col-lg-6">
                <label class="col-lg-4" for="">Costo Item:</label>
                <div class="col-lg-4">
                    <input class="form-control" type="text" id="costoItem"  value ="<?php echo $infoHardware['costoItem'];   ?>" >
                </div>

            </div>
            <div class="form-group" class="col-lg-6">
                <label class="col-lg-4" for="">Costo Importacion:</label>
                <div class="col-lg-4">
                    <input class="form-control" type="text" id="costoImportacion"  value ="<?php echo $infoHardware['costoImportacion'];   ?>" >
                </div>

            </div>
            <div class="form-group" class="col-lg-6">
                <label class="col-lg-4" for="">Costo Producto:</label>
                <div class="col-lg-4">
                    <input class="form-control" type="text" id="costoProducto"  value ="<?php echo $infoHardware['costoProducto'];   ?>" >
                </div>

            </div>
            <div class="form-group" class="col-lg-6">
                <label class="col-lg-4" for="">Precio Minimo Venta:</label>
                <div class="col-lg-4">
                    <input class="form-control" type="text" id="precioMinimoVenta"  value ="<?php echo $infoHardware['precioMinimoVenta'];   ?>" >
                </div>

            </div>
            <button class="btn btn-primary" onclick="actualizarCostos(); ">Actualizar Costos</button>    
        </div>

        <?php
    }
    //aqui llega el id del hardware
    public function verHardware($producto)
    {
        $marca = $this->MarcaModel->traerMarcaId($producto['idMarca']);
        $disco1 = $this->partesModel->traerParte($producto['idDisco1']);
        $subTipoDisco1 = $this->SubtipoParteModel->traerSubTipoParte($disco1[0]['idSubtipoParte']);
        $disco2 = $this->partesModel->traerParte($producto['idDisco2']);
        $subTipoDisco2 = $this->SubtipoParteModel->traerSubTipoParte($disco2[0]['idSubtipoParte']);
        $ram1 = $this->partesModel->traerParte($producto['idRam1']);
        $subTipoRam1 = $this->SubtipoParteModel->traerSubTipoParte($ram1[0]['idSubtipoParte']);
        // $this->printR($subTipoRam1); 
        $ram2 = $this->partesModel->traerParte($producto['idRam2']);
        $subTipoRam2 = $this->SubtipoParteModel->traerSubTipoParte($ram2[0]['idSubtipoParte']);
        $ram3 = $this->partesModel->traerParte($producto['idRam3']);
        $subTipoRam3 = $this->SubtipoParteModel->traerSubTipoParte($ram3[0]['idSubtipoParte']);
        $ram4 = $this->partesModel->traerParte($producto['idRam4']);
        $subTipoRam4 = $this->SubtipoParteModel->traerSubTipoParte($ram4[0]['idSubtipoParte']);
        $cargador = $this->partesModel->traerParte($producto['idCargador']);
        $subTipoCargador = $this->SubtipoParteModel->traerSubTipoParte($cargador[0]['idSubtipoParte']);





        $tipoParte  = $this->tipoParteModel->traerTipoParteId($producto['idTipoInv']);  
        ?>
        <div class="row" >
            <?php
                 if($producto['idRam1']==0 && $producto['idRam2']==0 && $producto['idRam3']==0 &&$producto['idRam4']==0)
                 {
                    $this->mostrarInfoCargueArchivoRam($producto);
                 }
                 if($producto['idDisco1']==0 && $producto['idDisco2']==0 )
                 {
                    $this->mostrarInfoCargueArchivoDisco($producto);
                 }
            ?>
        </div>
        <div class="row">
                <div class="col-md-3">
                    <label for="">Ubicacion</label>
                    <select class ="form-control" id="ubicacion" onchange="actualizarOnchengeUbicacion(<?php echo $producto['id']; ?>);">
                        <?php
                            $ubicaciones = $this->hardwareModel->traerUbicaciones();
                            foreach($ubicaciones as $ubicacion)
                            {
                                if($ubicacion['ubicacion']== $producto['ubicacion'])
                                {
                                    echo '<option selected value="'.$ubicacion['ubicacion'].'">'.$ubicacion['ubicacion'].'</option>';      

                                }else{

                                    echo '<option value="'.$ubicacion['ubicacion'].'">'.$ubicacion['ubicacion'].'</option>';      
                                }
                            }
                        ?>
                    </select>
                    <!-- <input class ="form-control" type="text" id="ubicacion" value ="<?php  //echo $producto['ubicacion'] ?>" >           -->
                </div>
                <div class="col-md-3">
                    <label for="">Importacion/Proveedor</label>
                      <input readonly class ="form-control" type="text" id="idImportacion" value ="<?php  echo $producto['idImportacion'] ?>" >          
                </div>
                <div class="col-md-3">
                    <label for="">Lote/Factura:</label>
                      <input readonly  class ="form-control" type="text" id="lote" value ="<?php  echo $producto['lote'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">SKU:</label>
                      <input  
                        readonly 
                        class ="form-control" 
                        type="text" id="sku" 
                        value ="<?php  echo $producto['sku'].'-'.$producto['comodin'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Serial:</label>
                      <input readonly class ="form-control" type="text" id="serial" value ="<?php  echo $producto['serial'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Marca:</label>
                      <input readonly class ="form-control" type="hidden" id="marca" value ="<?php  echo $producto['idMarca'] ?>">   
                      <input  readonly class ="form-control" type="text" id="nombremarca" onfocus="blur();" value ="<?php  echo $marca[0]['marca'] ?>">   
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Producto:</label>
                      <input readonly class ="form-control" type="text" id="tipoProd" value ="<?php  echo $tipoParte['descripcion'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Chasis/Tipo:</label>
                      <input  readonly class ="form-control" type="text" id="chasis" value ="<?php  echo $producto['chasis'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Modelo:</label>
                      <input  readonly class ="form-control" type="text" id="modelo" value ="<?php  echo $producto['modelo'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Pulgadas/Condicion:</label>
                      <input  readonly class ="form-control" type="text" id="pulgadas" value ="<?php  echo $producto['pulgadas'] ?>">          
                </div>
        </div>
        <div class="row mt-3">
            <?php
              if($producto['hardwareoparte']==1)
              {
            ?>
                <div class="col-md-3">
                    <label for="">Procesador:</label>
                    <?php    
                    if($_SESSION['nivel']>6 || $_SESSION['nivel']==5)
                    {  
                    ?>
                    <select class ="form-control" id="procesador" onchange="actualizarOnchangeProcesador(<?php echo $producto['id']; ?>);">
                        <?php
                            $procesadores = $this->procesadorModel->traerProcesadores();
                            foreach($procesadores as $procesador)
                            {
                                if($procesador['procesador']== $producto['procesador'])
                                {
                                    echo '<option selected value="'.$procesador['procesador'].'">'.$procesador['procesador'].'</option>';      

                                }else{

                                    echo '<option value="'.$procesador['procesador'].'">'.$procesador['procesador'].'</option>';      
                                }
                            }
                        ?>
                    </select>
                    <?php    
                    }else{
                        echo '<input readonly  class ="form-control" type="text" id="procesador" value ="'.$producto['procesador'].'"> ';
                    }
                    ?>

                </div>

            <?php 
            
              }
            ?>
            <!-- <div class="col-md-3">
                <label for="">Generacion:</label>
                <input class ="form-control" type="text" id="generacion" value ="<?php  echo $producto['generacion'] ?>">          
            </div> -->
        </div>
        <div class="mt-3">
            <?php
               if($producto['ramdividida']==0)
               {
                //    echo '<button 
                //             class ="btn btn-success" 
                //             data-bs-toggle="modal" 
                //             data-bs-target="#modalDividirRam"
                //             onclick= "formuDividirRam('.$producto['id'].'); "
                //         >DividirRam</button>';
               }
            ?>
        </div>
        <?php  
         if($producto['hardwareoparte']==1)
         {
         ?>        
        <div class="row mt-3">
                <div class="col-md-4">
                    <?php 
                         $infosubParte =   $this->SubtipoParteModel->traerSubTipoParte($producto['idRam1']);   
                    ?>
                    <label for="">Ram 1:</label>
                    <input class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $infosubParte[0]['descripcion']; ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <br>
                    <?php
                       if($_SESSION['nivel']>6 || $_SESSION['nivel']==5)
                       {
                            if($producto['idRam1']==0)
                            {
                                echo '<button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAgregarRam"
                                    class ="btn btn-success" 
                                    onclick="formuAgregarRam('.$producto['id'].',1);"
                                    >+1</button>';
            
                            }else{
                                echo '<button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAgregarRam"
                                    class ="btn btn-primary" 
                                    onclick="quitarRam('.$producto['id'].','.$producto['idRam1'].',1);"
                                    >-</button>';
                            }
                       }
                    ?>
                </div>
                <div class="col-md-4">
                   <?php 
                         $infosubParte =   $this->SubtipoParteModel->traerSubTipoParte($producto['idRam2']);   
                    ?>
                    <label for="">Ram 2:</label>
                    <input class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $infosubParte[0]['descripcion']; ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <br>
                    <?php
                       if($_SESSION['nivel']>6 || $_SESSION['nivel']==5)
                       {
                            if($producto['idRam2']==0)
                            {
                                echo '<button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAgregarRam"
                                    class ="btn btn-success" 
                                    onclick="formuAgregarRam('.$producto['id'].',2);"
                                    >+</button>';
            
                            }else{
                                echo '<button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAgregarRam"
                                    class ="btn btn-primary" 
                                    onclick="quitarRam('.$producto['id'].','.$producto['idRam2'].',2);"
                                    >-</button>';
            
                            }
                       }
                    ?>
                </div>
        </div>
       
   
        <div class="row mt-3">
                <div class="col-md-4">
                    <?php 
                         $infosubParte =   $this->SubtipoParteModel->traerSubTipoParte($producto['idRam3']);   
                    ?>
                    <label for="">Ram 3:</label>
                    <input class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $infosubParte[0]['descripcion']; ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <br>
                    <?php
                        if($_SESSION['nivel']>6 || $_SESSION['nivel']==5)
                        {

                            if($producto['idRam3']==0)
                            {
                                echo '<button 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalAgregarRam"
                                class ="btn btn-success" 
                                onclick="formuAgregarRam('.$producto['id'].',3);"
                                >+</button>';
                                
                            }else{
                                echo '<button 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalAgregarRam"
                                class ="btn btn-primary" 
                                    onclick="quitarRam('.$producto['id'].','.$producto['idRam3'].',3);"
                                    >-</button>';
                                    
                            }
                        }
                        ?>
                </div>
                <div class="col-md-4">
                    <?php 
                         $infosubParte =   $this->SubtipoParteModel->traerSubTipoParte($producto['idRam4']);   
                    ?>
                    <label for="">Ram 4:</label>
                    <input class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $infosubParte[0]['descripcion']; ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <br>
                    <?php
                      if($_SESSION['nivel']>6 || $_SESSION['nivel']==5 )
                      {
                            if($producto['idRam4']==0)
                            {
                                echo '<button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAgregarRam"
                                    class ="btn btn-success" 
                                    onclick="formuAgregarRam('.$producto['id'].',4);"
                                    >+</button>';
            
                            }else{
                                echo '<button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAgregarRam"
                                    class ="btn btn-primary" 
                                    onclick="quitarRam('.$producto['id'].','.$producto['idRam4'].',4);"
                                    >-</button>';
            
                            }
                        }    
                    ?>
                </div>
               
             
        </div>
        <div class="row mt-3">
                <div class="col-md-4">
                <?php 
                         $infosubParte =   $this->SubtipoParteModel->traerSubTipoParte($producto['idDisco1']);   
                    ?>
                    <label for="">Disco1 :</label>
                    <input class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $infosubParte[0]['descripcion']; ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <br>
                    <?php
                       if($_SESSION['nivel']>6)
                       {
                            if($producto['idDisco1']==0)
                            {
                                echo '<button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAgregarRam"
                                    class ="btn btn-success" 
                                    onclick="formuAgregarDisco('.$producto['id'].',1);"
                                    >+</button>';
            
                            }else{
                                echo '<button 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalAgregarRam"
                                class ="btn btn-primary" 
                                onclick="quitarDisco('.$producto['id'].','.$producto['idDisco1'].',1);"
                                >-</button>';
                                
                            }
                       }
                    ?>
                </div>
                <div class="col-md-4">
                <?php 
                         $infosubParte =   $this->SubtipoParteModel->traerSubTipoParte($producto['idDisco2']);   
                    ?>
                    <label for="">Disco2 :</label>
                    <input class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $infosubParte[0]['descripcion']; ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <br>
                    <?php
                       if($_SESSION['nivel']>6)
                       {
                            if($producto['idDisco2']==0)
                            {
                                echo '<button 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalAgregarRam"
                                class ="btn btn-success" 
                                onclick="formuAgregarDisco('.$producto['id'].',2);"
                                >+</button>';
                                
                                }else{
                                    echo '<button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAgregarRam"
                                    class ="btn btn-primary" 
                                    onclick="quitarDisco('.$producto['id'].','.$producto['idDisco2'].',2);"
                                    >-</button>';
                                    
                                }
                        }
                        ?>
                </div>

        </div>
        
        <div class="row mt-3">

                <div class="col-md-10">
                    <label for="">Cargador :</label>
                    <input class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $cargador[0]['capacidad'].''.$subTipoCargador[0]['descripcion']  ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <br>
                    <?php
                     if($_SESSION['nivel']>6)
                     {
                            if($producto['idCargador']==0)
                            {
                                echo '<button 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalAgregarRam"
                                class ="btn btn-success" 
                                onclick="formuAgregarCargador('.$producto['id'].');"
                                >+</button>';
                                
                                }else{
                                    echo '<button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAgregarRam"
                                    class ="btn btn-primary" 
                                    onclick="quitarCargador('.$producto['id'].','.$producto['idCargador'].');"
                                    >-</button>';
                                    
                                }
                      }
                    ?>
                </div>
               
        </div>
        <?php
        }
        ?>
        

        <!--  botones de quitar ram y disco   -->
            <div class="col-md-6">
            <?php 
            // if($producto['idDisco']==0)
            //     {
            //         echo '<button 
            //                 data-bs-toggle="modal" 
            //                 data-bs-target="#modalAgregarRam"
            //                 class ="btn btn-success" 
            //                 onclick="formuAgregarDisco('.$producto['id'].');"
            //                 >AGREGAR DISCO</button>';

            //     }else{
            //         echo '<button 
            //                 data-bs-toggle="modal" 
            //                 data-bs-target="#modalAgregarRam"
            //                 class ="btn btn-primary" 
            //                 onclick="quitarDisco('.$producto['id'].','.$producto['idDisco'].');"
            //                 >QUITAR DISCO</button>';
            //     }
             ?>       
            </div>    
        </div>
        <br>
        <div class="row">
                <label>Comentarios:</label>
                <div class="col-md-12 mt-03">
                    
                      <textarea class="form-control" id="comentarios" rows="4" placeholder="Comentarios"><?php  echo $producto['comentarios']  ?></textarea>     
                </div>
        </div>
        <div class="row mt-3">
            <label>Condicion/Especificaciones: </label>
             <?php
                $condiciones =  $this->hardwareModel->traerInfoTablaParaColocarenSelect('condicion');
                            //  echo '<pre>';
                            //     print_r($condiciones); 
                            //     echo '</pre>';
                            //     die();
                 if($_SESSION['nivel']>6)
                 {
                     echo '<select class ="form-control"  id="idCondicion" onchange = "actualizarCondicionHardware('.$producto['id'].');">';
                      $this->colocarSelectCampoConOpcionSeleccionadaPorNombre($condiciones,$producto['idCondicion']); 
                    echo '</select>';
                 }else{
                        echo '  <input readonly type="text"  id = "idCondicion"  value="'.$producto['idCondicion'].'"  >';
                 }
                    
             ?>
           
        </div>
        <div class="row mt-3">
            <label>Condicion 2 </label>
             <?php
                 $condiciones =  $this->hardwareModel->traerInfoTablaParaColocarenSelect('condicion');
                 if($_SESSION['nivel']>6)
                 { 
                 echo '<select class ="form-control"  id="idCondicion2" onchange = "actualizarCondicion2Hardware('.$producto['id'].');">';
                 $this->colocarSelectCampoConOpcionSeleccionadaPorNombre($condiciones,$producto['idCondicion2']); 
                 echo '</select>';
                 }else{
                    echo '   <input readonly  type="text"  id = "idCondicion2"  value="'.$producto['idCondicion2'].'"  >';
                 }
                    //  $condiciones =  $this->hardwareModel->traerInfoTablaParaColocarenSelect('condicion');
                    //  echo '<select class ="form-control"  id="idCondicion" onchange = "actualizarCondicionHardware('.$producto['id'].');">';
                    //   $this->colocarSelectCampoConOpcionSeleccionada($condiciones,$producto['idCondicion']); 
                    // echo '</select>';
                    
             ?>
          
        </div>

        <br>
        <?php
        if($_SESSION['nivel']>6)
        {
            $this->verCostos($producto['id']);
        }
        ?>
        <div class="row mt-3">
            <!-- <button ></button> -->
        </div>
       
        


        <?php
    }
    public function verHardwareHojasDeVida($producto)
    {
        $marca = $this->MarcaModel->traerMarcaId($producto['idMarca']);
        $disco1 = $this->partesModel->traerParte($producto['idDisco1']);
        $subTipoDisco1 = $this->SubtipoParteModel->traerSubTipoParte($disco1[0]['idSubtipoParte']);
        $disco2 = $this->partesModel->traerParte($producto['idDisco2']);
        $subTipoDisco2 = $this->SubtipoParteModel->traerSubTipoParte($disco2[0]['idSubtipoParte']);
        $ram1 = $this->partesModel->traerParte($producto['idRam1']);
        $subTipoRam1 = $this->SubtipoParteModel->traerSubTipoParte($ram1[0]['idSubtipoParte']);
        $ram2 = $this->partesModel->traerParte($producto['idRam2']);
        $subTipoRam2 = $this->SubtipoParteModel->traerSubTipoParte($ram2[0]['idSubtipoParte']);
        $ram3 = $this->partesModel->traerParte($producto['idRam3']);
        $subTipoRam3 = $this->SubtipoParteModel->traerSubTipoParte($ram3[0]['idSubtipoParte']);
        $ram4 = $this->partesModel->traerParte($producto['idRam4']);
        $subTipoRam4 = $this->SubtipoParteModel->traerSubTipoParte($ram4[0]['idSubtipoParte']);
        $cargador = $this->partesModel->traerParte($producto['idCargador']);
        $subTipoCargador = $this->SubtipoParteModel->traerSubTipoParte($cargador[0]['idSubtipoParte']);





        $tipoParte  = $this->tipoParteModel->traerTipoParteId($producto['idTipoInv']);  
        ?>
        <div class="row" >
            <?php
                 if($producto['idRam1']==0 && $producto['idRam2']==0 && $producto['idRam3']==0 &&$producto['idRam4']==0)
                 {
                    $this->mostrarInfoCargueArchivoRam($producto);
                 }
                 if($producto['idDisco1']==0 && $producto['idDisco2']==0 )
                 {
                    $this->mostrarInfoCargueArchivoDisco($producto);
                 }
            ?>
        </div>
        <div class="row">
                <div class="col-md-3">
                    <label for="">Ubicacion</label>
                    <input readonly class ="form-control" type="text" id="idImportacion" value ="<?php  echo $producto['ubicacion'] ?>" > 
                  
                    <!-- <input class ="form-control" type="text" id="ubicacion" value ="<?php  //echo $producto['ubicacion'] ?>" >           -->
                </div>
                <div class="col-md-3">
                    <label for="">Importacion/Proveedor</label>
                      <input readonly class ="form-control" type="text" id="idImportacion" value ="<?php  echo $producto['idImportacion'] ?>" >          
                </div>
                <div class="col-md-3">
                    <label for="">Lote/Factura:</label>
                      <input readonly  class ="form-control" type="text" id="lote" value ="<?php  echo $producto['lote'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">SKU:</label>
                      <input  
                        readonly 
                        class ="form-control" 
                        type="text" id="sku" 
                        value ="<?php  echo $producto['sku'].'-'.$producto['comodin'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Serial:</label>
                      <input readonly class ="form-control" type="text" id="serial" value ="<?php  echo $producto['serial'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Marca:</label>
                      <input readonly class ="form-control" type="hidden" id="marca" value ="<?php  echo $producto['idMarca'] ?>">   
                      <input  readonly class ="form-control" type="text" id="nombremarca" onfocus="blur();" value ="<?php  echo $marca[0]['marca'] ?>">   
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Producto:</label>
                      <input readonly class ="form-control" type="text" id="tipoProd" value ="<?php  echo $tipoParte['descripcion'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Chasis/Tipo:</label>
                      <input  readonly class ="form-control" type="text" id="chasis" value ="<?php  echo $producto['chasis'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Modelo:</label>
                      <input  readonly class ="form-control" type="text" id="modelo" value ="<?php  echo $producto['modelo'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Pulgadas/Condicion:</label>
                      <input  readonly class ="form-control" type="text" id="pulgadas" value ="<?php  echo $producto['pulgadas'] ?>">          
                </div>
        </div>
        <div class="row mt-3">
            <?php
              if($producto['hardwareoparte']==1)
              {
            ?>
                <div class="col-md-3">
                    <label for="">Procesador:</label>
                 

                    <input readonly class ="form-control" type="text" id="procesador" value ="<?php  echo $producto['procesador'] ?>">          
                </div>

            <?php 
            
              }
            ?>
            <!-- <div class="col-md-3">
                <label for="">Generacion:</label>
                <input class ="form-control" type="text" id="generacion" value ="<?php  echo $producto['generacion'] ?>">          
            </div> -->
        </div>
        <div class="mt-3">
            <?php
               if($producto['ramdividida']==0)
               {
                //    echo '<button 
                //             class ="btn btn-success" 
                //             data-bs-toggle="modal" 
                //             data-bs-target="#modalDividirRam"
                //             onclick= "formuDividirRam('.$producto['id'].'); "
                //         >DividirRam</button>';
               }
            ?>
        </div>
        <?php  
         if($producto['hardwareoparte']==1)
         {
         ?>        
        <div class="row mt-3">
                <div class="col-md-4">
                    <label for="">Ram 1:</label>
                    <input   readonly  class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $ram1[0]['capacidad'].'GB-'.$subTipoRam1[0]['descripcion']  ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <?php
                    //    if($producto['idRam1']==0)
                    //    {
                    //        echo '<button 
                    //            data-bs-toggle="modal" 
                    //            data-bs-target="#modalAgregarRam"
                    //            class ="btn btn-success" 
                    //            onclick="formuAgregarRam('.$producto['id'].',1);"
                    //            >+1</button>';
       
                    //    }else{
                    //        echo '<button 
                    //            data-bs-toggle="modal" 
                    //            data-bs-target="#modalAgregarRam"
                    //            class ="btn btn-primary" 
                    //            onclick="quitarRam('.$producto['id'].','.$producto['idRam1'].',1);"
                    //            >-</button>';
                    //    }
                    ?>
                </div>
                <div class="col-md-4">
                    <label for="">Ram 2:</label>
                    <input readonly class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $ram2[0]['capacidad'].'GB-'.$subTipoRam2[0]['descripcion']  ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <?php
                    //    if($producto['idRam2']==0)
                    //    {
                    //        echo '<button 
                    //            data-bs-toggle="modal" 
                    //            data-bs-target="#modalAgregarRam"
                    //            class ="btn btn-success" 
                    //            onclick="formuAgregarRam('.$producto['id'].',2);"
                    //            >+</button>';
       
                    //    }else{
                    //        echo '<button 
                    //            data-bs-toggle="modal" 
                    //            data-bs-target="#modalAgregarRam"
                    //            class ="btn btn-primary" 
                    //            onclick="quitarRam('.$producto['id'].','.$producto['idRam2'].',2);"
                    //            >-</button>';
       
                    //    }
                    ?>
                </div>
        </div>
       
   
        <div class="row mt-3">
                <div class="col-md-4">
                    <label for="">Ram 3:</label>
                    <input readonly  class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $ram3[0]['capacidad'].'GB-'.$subTipoRam3[0]['descripcion']  ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <?php
                    //    if($producto['idRam3']==0)
                    //    {
                    //        echo '<button 
                    //            data-bs-toggle="modal" 
                    //            data-bs-target="#modalAgregarRam"
                    //            class ="btn btn-success" 
                    //            onclick="formuAgregarRam('.$producto['id'].',3);"
                    //            >+</button>';
       
                    //    }else{
                    //        echo '<button 
                    //            data-bs-toggle="modal" 
                    //            data-bs-target="#modalAgregarRam"
                    //            class ="btn btn-primary" 
                    //            onclick="quitarRam('.$producto['id'].','.$producto['idRam3'].',3);"
                    //            >-</button>';
       
                    //    }
                    ?>
                </div>
                <div class="col-md-4">
                    <label for="">Ram 4:</label>
                    <input  readonly class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $ram4[0]['capacidad'].'GB-'.$subTipoRam4[0]['descripcion']  ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <?php
                    //    if($producto['idRam4']==0)
                    //    {
                    //        echo '<button 
                    //            data-bs-toggle="modal" 
                    //            data-bs-target="#modalAgregarRam"
                    //            class ="btn btn-success" 
                    //            onclick="formuAgregarRam('.$producto['id'].',4);"
                    //            >+</button>';
       
                    //    }else{
                    //        echo '<button 
                    //            data-bs-toggle="modal" 
                    //            data-bs-target="#modalAgregarRam"
                    //            class ="btn btn-primary" 
                    //            onclick="quitarRam('.$producto['id'].','.$producto['idRam4'].',4);"
                    //            >-</button>';
       
                    //    }
                    ?>
                </div>
               
             
        </div>
        <div class="row mt-3">
                <div class="col-md-4">
                    <label for="">Disco1 :</label>
                    <input readonly class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $disco1[0]['capacidad'].'GB-'.$subTipoDisco1[0]['descripcion']  ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <?php
                    //    if($producto['idDisco1']==0)
                    //    {
                    //        echo '<button 
                    //            data-bs-toggle="modal" 
                    //            data-bs-target="#modalAgregarRam"
                    //            class ="btn btn-success" 
                    //            onclick="formuAgregarDisco('.$producto['id'].',1);"
                    //            >+</button>';
       
                    //    }else{
                    //        echo '<button 
                    //        data-bs-toggle="modal" 
                    //        data-bs-target="#modalAgregarRam"
                    //        class ="btn btn-primary" 
                    //        onclick="quitarDisco('.$producto['id'].','.$producto['idDisco1'].',1);"
                    //        >-</button>';
                           
                    //    }
                    ?>
                </div>
                <div class="col-md-4">
                    <label for="">Disco2 :</label>
                    <input readonly class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $disco2[0]['capacidad'].'GB-'.$subTipoDisco2[0]['descripcion']  ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <?php
                    //    if($producto['idDisco2']==0)
                    //    {
                    //        echo '<button 
                    //        data-bs-toggle="modal" 
                    //        data-bs-target="#modalAgregarRam"
                    //        class ="btn btn-success" 
                    //        onclick="formuAgregarDisco('.$producto['id'].',2);"
                    //        >+</button>';
                           
                    //     }else{
                    //         echo '<button 
                    //         data-bs-toggle="modal" 
                    //         data-bs-target="#modalAgregarRam"
                    //         class ="btn btn-primary" 
                    //         onclick="quitarDisco('.$producto['id'].','.$producto['idDisco2'].',2);"
                    //         >-</button>';
                            
                    //     }
                        ?>
                </div>

        </div>
        
        <div class="row mt-3">

                <div class="col-md-10">
                    <label for="">Cargador :</label>
                    <input readonly class ="form-control" type="text" onfocus="blur();" 
                    value ="<?php  echo $cargador[0]['capacidad'].''.$subTipoCargador[0]['descripcion']  ?>"
                    >   
                </div>
                <div class="col-md-2">
                    <label>Accion </label>
                    <?php
                    //    if($producto['idCargador']==0)
                    //    {
                    //        echo '<button 
                    //        data-bs-toggle="modal" 
                    //        data-bs-target="#modalAgregarRam"
                    //        class ="btn btn-success" 
                    //        onclick="formuAgregarCargador('.$producto['id'].');"
                    //        >+</button>';
                           
                    //     }else{
                    //         echo '<button 
                    //         data-bs-toggle="modal" 
                    //         data-bs-target="#modalAgregarRam"
                    //         class ="btn btn-primary" 
                    //         onclick="quitarCargador('.$producto['id'].','.$producto['idCargador'].');"
                    //         >-</button>';
                            
                    //     }
                        ?>
                </div>
               
        </div>
        <?php
        }
        ?>
        

        <!--  botones de quitar ram y disco   -->
            <div class="col-md-6">
            <?php 
            // if($producto['idDisco']==0)
            //     {
            //         echo '<button 
            //                 data-bs-toggle="modal" 
            //                 data-bs-target="#modalAgregarRam"
            //                 class ="btn btn-success" 
            //                 onclick="formuAgregarDisco('.$producto['id'].');"
            //                 >AGREGAR DISCO</button>';

            //     }else{
            //         echo '<button 
            //                 data-bs-toggle="modal" 
            //                 data-bs-target="#modalAgregarRam"
            //                 class ="btn btn-primary" 
            //                 onclick="quitarDisco('.$producto['id'].','.$producto['idDisco'].');"
            //                 >QUITAR DISCO</button>';
            //     }
             ?>       
            </div>    
        </div>
        <br>
        <div class="row">
                <label>Comentarios:</label>
                <div class="col-md-12 mt-03">
                    
                      <textarea readonly class="form-control" id="comentarios" rows="4" placeholder="Comentarios"><?php  echo $producto['comentarios']  ?></textarea>     
                </div>
        </div>
        <div class="row mt-3">
            <label>Condicion/Especificaciones: </label>
             <?php
                    //  $condiciones =  $this->hardwareModel->traerInfoTablaParaColocarenSelect('condicion');
                    //         //  echo '<pre>';
                    //         //     print_r($condiciones); 
                    //         //     echo '</pre>';
                    //         //     die();
                    //  echo '<select class ="form-control"  id="idCondicion" onchange = "actualizarCondicionHardware('.$producto['id'].');">';
                    //   $this->colocarSelectCampoConOpcionSeleccionadaPorNombre($condiciones,$producto['idCondicion']); 
                    // echo '</select>';
                    
             ?>
             <input readonly type="text"  id = "idCondicion"  value="<?php   echo $producto['idCondicion']   ?>"  >
        </div>
        <div class="row mt-3">
            <label>Condicion 2 </label>
             <?php
                //  $condiciones =  $this->hardwareModel->traerInfoTablaParaColocarenSelect('condicion');
                //  echo '<select class ="form-control"  id="idCondicion2" onchange = "actualizarCondicion2Hardware('.$producto['id'].');">';
                //  $this->colocarSelectCampoConOpcionSeleccionadaPorNombre($condiciones,$producto['idCondicion2']); 
                //  echo '</select>';
                    //  $condiciones =  $this->hardwareModel->traerInfoTablaParaColocarenSelect('condicion');
                    //  echo '<select class ="form-control"  id="idCondicion" onchange = "actualizarCondicionHardware('.$producto['id'].');">';
                    //   $this->colocarSelectCampoConOpcionSeleccionada($condiciones,$producto['idCondicion']); 
                    // echo '</select>';
                    
             ?>
             <input readonly type="text"  id = "idCondicion2"  value="<?php   echo $producto['idCondicion2']   ?>"  >
        </div>

        <br>
        <?php
        // if($_SESSION['nivel']==3)
        // {
        //     $this->verCostos($producto['id']);
        // }
        ?>
        <div class="row mt-3">
            <!-- <button ></button> -->
        </div>
       
        


        <?php
    }

    public function mostrarInfoCargueArchivoRam($producto)
    {
        $tipoParte =    $this->SubtipoParteModel->traerSubTipoParte($producto['tipoRamCargue']);
        echo 'Ram : '.$producto['capacidadRamCargue'].'GB-'.$tipoParte[0]['descripcion'];                            
    }
    public function mostrarInfoCargueArchivoDisco($producto)
    {
        $tipoParte =    $this->SubtipoParteModel->traerSubTipoParte($producto['tipoDiscoCargue']);
        echo ' Disco: '.$producto['capacidadDiscoCargue'].'-'.$tipoParte[0]['descripcion'];                            
    }

    public function formuAgregarRam($request)
    {
        //listado de la tabla partes con las partes existentes para agregarlas 
        $memorias = $this->partesModel->traerMemoriasDisponibles();
        // echo '<pre>';
        // print_r($memorias); 
        // echo '</pre>';
        // die();
        //mostrar las ram disponibles


       
       ?>
       <div>
          <h3>Escoja la ram a agregar</h3>
          <table class="table">
            <thead>

                <tr>
                    <td>Id</td>
                    <td>Parte</td>
                    <td>Subtipo</td>
                    <td>Capacidad</td>
                    <td>Cantidad</td>
                    <td>Acciones</td>


                </tr>

            </thead>
            <tbody>
                <?php
                    foreach($memorias as $memoria)
                    {
                        echo '<tr>'; 
                        echo '<td>'.$memoria['id'].'</td>';
                        echo '<td>'.$memoria['descriParte'].'</td>';
                        echo '<td>'.$memoria['descriSubParte'].'</td>';
                        echo '<td>'.$memoria['capacidad'].'</td>';
                        echo '<td>'.$memoria['cantidad'].'</td>';
                        echo '<td><button class ="btn btn-primary" onclick ="agregarMemoriaRam('.$request['idHardware'].','.$memoria['id'].','.$request['numeroRam'].');">Agregar</button></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
          </table>
            
       </div>
       <?php
    }


    public function formuAgregarDisco($request)
    {
        $discos = $this->partesModel->traerDiscosDisponibles();
        // echo '<pre>';
        // print_r($discos); 
        // echo '</pre>';
        // die();

       
       ?>
       <div>
          <h3>Escoja el Disco a agregar</h3>
          <table class="table">
            <thead>

                <tr>
                    <td>Id</td>
                    <td>Parte</td>
                    <td>Subtipo</td>
                    <td>Capacidad</td>
                    <td>Cantidad</td>
                    <td>Acciones</td>


                </tr>

            </thead>
            <tbody>
                <?php
                    foreach($discos as $disco)
                    {
                        echo '<tr>'; 
                        echo '<td>'.$disco['id'].'</td>';
                        echo '<td>'.$disco['descriParte'].'</td>';
                        echo '<td>'.$disco['descriSubParte'].'</td>';
                        echo '<td>'.$disco['capacidad'].'</td>';
                        echo '<td>'.$disco['cantidad'].'</td>';
                        echo '<td><button class ="btn btn-primary" onclick ="agregarDisco('.$request['idHardware'].','.$disco['id'].','.$request['numeroDisco'].' );">Agregar</button></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
          </table>
            
       </div>
       <?php
    }

    public function formuAgregarCargador($request)
    {
        $cargadores = $this->partesModel->traerCargadoresDisponibles();
        // echo '<pre>';
        // print_r($discos); 
        // echo '</pre>';
        // die();

       
       ?>
       <div>
          <h3>Escoja el cargador </h3>
          <table class="table">
            <thead>

                <tr>
                    <td>Id</td>
                    <td>Parte</td>
                    <td>Subtipo</td>
                    <td>Capacidad</td>
                    <td>Cantidad</td>
                    <td>Acciones</td>


                </tr>

            </thead>
            <tbody>
                <?php
                    foreach($cargadores as $cargador)
                    {
                        echo '<tr>'; 
                        echo '<td>'.$cargador['id'].'</td>';
                        echo '<td>'.$cargador['descriParte'].'</td>';
                        echo '<td>'.$cargador['descriSubParte'].'</td>';
                        echo '<td>'.$cargador['capacidad'].'</td>';
                        echo '<td>'.$cargador['cantidad'].'</td>';
                        echo '<td><button class ="btn btn-primary" onclick ="agregarCargador('.$request['idHardware'].','.$cargador['id'].');">Agregar</button></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
          </table>
            
       </div>
       <?php
    }

    
    
    public function formuNuevoHardware()
    {
        $tipopartes = $this->tipoParteModel->traerTipoParteHardware('1');

        // $marca = $this->MarcaModel->traerMarcaId($producto['id']);
        // $disco = $this->partesModel->traerParte($producto['idDisco']);
        $subTiposDisco = $this->SubtipoParteModel->traerSubtiposPartesConDescriptParte('Disco');
        // $ram = $this->partesModel->traerParte($producto['idRam']);
        $subTiposRam = $this->SubtipoParteModel->traerSubtiposPartesConDescriptParte('ram');
        $marcas = $this->MarcaModel->traerTodasLasMarcas();
        $idImportaciones =  $this->hardwareModel->traerInfoCampoTablaHardware('idImportacion');
        $lotes =  $this->hardwareModel->traerInfoCampoTablaHardware('lote');
        $chasis =  $this->hardwareModel->traerInfoCampoTablaHardware('chasis');
        $pulgadas =  $this->hardwareModel->traerInfoCampoTabla('pulgadas');
        $procesadores =  $this->hardwareModel->traerInfoCampoTabla('procesador');
        $generaciones =  $this->hardwareModel->traerInfoCampoTabla('generacion');
        // die('llego a la vista 123');
        ?>
        <div class="row">
                <div class="col-md-3">
                    <!-- computador monitor impresora -->
                    <label for="">Tipo Hardware</label>
                    <select class ="form-control"  id="itipo" onchange="buscarSuptiposParaSelect();">
                            <?php  $this->colocarSelect($tipopartes);  ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Subtipo:</label>
                    <select class ="form-control"  id="isubtipo">
                    </select>
                </div>
         
        </div>
        <div class="row">
                <div class="col-md-3">
                    <label for="">Importacion #:</label>
                    <select class ="form-control"  id="idImportacion" >
                        <?php  $this->colocarSelectCampo($idImportaciones);  ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Lote:</label>
                    <select class ="form-control"  id="lote" >
                        <?php  $this->colocarSelectCampo($lotes);  ?>
                    </select>         
                </div>
                <div class="col-md-3">
                    <label for="">Serial:</label>
                      <input class ="form-control" type="text" id="serial" value ="<?php  echo $producto['serial'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Marca:</label>
                    <select class ="form-control"  id="marca" >
                            <?php  $this->colocarSelect($marcas);  ?>
                    </select>
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Chasis:</label>
                    <select class ="form-control"  id="chasis" >
                        <?php  $this->colocarSelectCampo($chasis);  ?>
                    </select>               
                </div>
                <div class="col-md-3">
                    <label for="">Modelo:</label>
                      <input class ="form-control" type="text" id="modelo" value ="<?php  echo $producto['modelo'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Pulgadas:</label>
                    <select class ="form-control"  id="pulgadas" >
                        <?php  $this->colocarSelectCampo($pulgadas);  ?>
                    </select>  
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Procesador:</label>
                    <select class ="form-control"  id="procesador" >
                        <?php  $this->colocarSelectCampo($procesadores);  ?>
                    </select>  
                </div>
                <div class="col-md-3">
                    <label for="">Generacion:</label>
                    <select class ="form-control"  id="generacion" >
                        <?php  $this->colocarSelectCampo($generaciones);  ?>
                    </select>  
                </div>
            
        </div>
  
       <div class="row">
                <button type="button" 
                class="btn btn-primary  float-right mt-3" 
                onclick="grabarNuevoHardware()"
                >
                Grabar Hardware
            </button>
       </div>
        


        <?php
    }

    public function formuDividirRam($idHardware)
    {

        $tiposRam =  $this->SubtipoParteModel->traerSubtiposPartesConDescriptParte('ram');
        ?>
        <div class="row">
            <div class="col-lg-4">
             
                <select class="form-control" id="idSubTipoRamHardware">
                    <?php
                    $this->colocarSelect($tiposRam); 
                    ?>
                </select>
            </div>
            <div class="col-lg-4">
              
                <input class="form-control" type="text" id="capacidadRamHardware" placeholder= "capacidad">
            </div>
            <div class="col-lg-4">
               <button onclick = "agregarTemporalDividirMemoria(<?php echo  $idHardware; ?>); " class="btn btn-primary btn-block ">Agregar </button>
            </div>
        </div>
        <div class="row" id="div_resultados_dividir_ram">
                <?php  
                    $temporales =  $this->hardwareModel->traerRegistrosTemporales($idHardware);                     
                    $this->mostrarTemporales($temporales)  
                ?>
        </div>
        <div class="mt-3">
            <button class="btn btn-success  btn-block" onclick ="registrarRamDividaHardware(<?php echo  $idHardware;  ?>); ">Aplicar Cambios</button>
        </div>
        <?php
    }

    public function mostrarTemporales($temporales)
    {
            //    echo '<pre>';
            // print_r($temporales); 
            // echo '</pre>';
            // die();
        echo '<div class="mt-3">';    
        echo '<table class="table table-striped">'; 
        echo '<tr>';
        echo '<td>Tipo</td>'; 
        echo '<td>Capacidad</td>'; 
        echo '</tr>';
        foreach($temporales as $temporal)
        {
            $infoSubtipo = $this->SubtipoParteModel->traerSubTipoParte($temporal['idSubtipo']);
            echo '<tr>';
            echo '<td>'.$infoSubtipo[0]['descripcion'].'</td>';
            echo '<td>'.$temporal['capacidad'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>'; 
    }

    public function buscarInventarioHardware($request)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <div >
                <div id="div_arrriva"></div>
                <div id="div_resultados_inventario_hardware">
                       <?php  $this->traerHardwareDisponibles();  ?> 
                </div>

            </div>
        </body>
        </html>
        <?php
    }

    // public function traerHardwareDisponibles()
    // {
            
    // }

    public function buscarHardwareAgregarItemPedido($request)
    {
        $hardwarsDisponibles = $this->hardwareModel->traerHardwareDisponibles();
        // $this->printR($hardwarsDisponibles);
        ?>
        <div id="div_buscar_hardwareOparte">
            <div class="row">
                <input type="hidden" id="idItemAgregar"  value = "<?php  echo $request['idItem']?>"  >
                <label class="col-lg-3">Buscar Serial.</label>
                <div class="col-lg-9">
                    <input id="serialABuscar" class="form-control" onkeyup="filtrarHardwarePorSerial();">
                </div>
            </div>
            <div class="row" id="resultadosBuscarSeriales">
                <?php  $this->traerHardwareDisponibles($hardwarsDisponibles);     ?>
            </div>
        </div>

        <?php
    }

    public function traerHardwareDisponibles($hardwarsDisponibles)
    {
        echo '<table class="table">'; 
        echo '<tr>';
        echo '<td>Serial</td>';  
        echo '<td>Importacion</td>';  
        echo '<td>Lote</td>';  
        echo '<td>Relacionar</td></td>';  
        echo '</tr>';    
        foreach($hardwarsDisponibles as $hardware)
        {
            echo '<tr>';
            echo '<td>'.$hardware['serial'].'</td>';  
            echo '<td>'.$hardware['idImportacion'].'</td>';  
            echo '<td>'.$hardware['lote'].'</td>';  
            echo '<td>'; 
            echo ' <button 
            class="btn btn-primary  btn-sm " 
            onclick="relacionarHardwareAItemPedido('.$hardware['id'].')"
            >
            +
            </button>';
            echo '</td>';  
            echo '</tr>';    
        }
        echo '</table>';
    } 

    public function verMovimientosHardware($idHardware)
    {
        $infoHardware =   $this->hardwareModel->traerHardwareId($idHardware); 
        $movimientos =  $this->movimientoHardwareModel->traerMovimientosHardwareId($idHardware); 
        // $this->printR($movimientos);
        $maxIdMovimientosHardware = $this->movimientoHardwareModel->traerMaxIdMovimientoHardwareId($idHardware);
        // die('max'.$maxIdMovimientosHardware); 
        ?>
          <table class="table table-striped hover-hover">
                  <thead>
                      <th>Serial</th>
                      <th>Fecha</th>
                      <th>Cliente</th>
                      <th># OC</th>
                      <th>Estado</th>
                      <!-- <th>TipoMov</th> -->
                      <th>Observaciones</th>
                      <!-- <th>Devolucion</th> -->
                  </thead>
              <tbody>
                  <?php
                    foreach($movimientos as $movimiento)
                    {
                        $infoItemInicio =  $this->itemInicioPedidoModel->traerItemInicioPedidoId($movimiento['idItemInicio']); 
                        $infoEstado =  $this->estadoInicioPedidoModel->traerEstadosInicioPedidoId($infoItemInicio['estado']);
                        // die($infoItemInicio); 
                        // $this->printR($infoItemInicio); 
                        $infoPedido =  $this->pedidoModel->traerPedidoId($infoItemInicio['idPedido']); 
                        $infoCliente =   $this->clienteModel->traerClienteId($infoPedido['idCliente']); 
                        echo '<tr>'; 
                        echo '<td>'.$infoHardware['serial'].'</td>';
                        echo '<td>'.$movimiento['fecha'].'</td>';
                        echo '<td>'.$infoCliente[0]['nombre'].'</td>';
                        echo '<td>'.$infoItemInicio['idPedido'].'</td>';

                        echo '<td>'.$infoEstado['descripcion'].'</td>';

                        // echo '<td>'.$movimiento['idTipoMov'].'</td>';
                        echo '<td>'.$movimiento['observaciones'].'</td>';

                        // if($movimiento['idMovimiento'] == $maxIdMovimientosHardware)    
                        // {

                        //     echo '<td><button 
                        //     class="btn btn-primary btn-sm " 
                        //     onclick="formuDevolucionHardware('.$movimiento['idMovimiento'].');"
                        //     >Devolucion</button></td>';
                        // }else {
                        //     echo '<td></td>';
                        // }


                         echo '</tr>';  
                      }
                      ?>
                  </tbody>
              </table> 
        

        <?php
    }
    public function fitrarHardware()
    {
        
    }

    public function formuDevolucionHardware($request)
    {
        //traer info de movimiento 
        $infoMovimiento = $this->movimientoHardwareModel->traerMovimientoId($request['idMovimiento']);
        $infoItemInicio =  $this->itemInicioPedidoModel->traerItemInicioPedidoId($infoMovimiento['idItemInicio']);
        // $this->printR($infoItemInicio);        

         ?>
         <div>
            <span>Devolucion de Hardware</span>
            <div class="row">
                Pedido: <?php echo  $infoItemInicio['idPedido'] ?>

            </div>
            <button class ="btn btn-primary"onclick="realizarDevolucion(<?php  echo  $infoItemInicio['idHardwareOParte']  ?>,<?php  echo  $request['idMovimiento'] ?>)">Realizar Devolucion</button>
         </div>
         <?php
    }

    public function formuFiltrosHardware()
    {
        $tipopartes = $this->tipoParteModel->traerTipoParteHardware('1');
        $subtipos = $this->SubtipoParteModel->traerSubtiposHardware();
        $procesadores = $this->procesadorModel->traerProcesadores();
        $ubicaciones =  $this->hardwareModel->traerUbicaciones();
        $idImportaciones =  $this->hardwareModel->traerInfoCampoTablaHardware('idImportacion');
        $idproveedores =  $this->hardwareModel->traerInfoCampoPartesConserialHardware('idImportacion');
        $lotes =  $this->hardwareModel->traerInfoCampoTablaHardware('lote');
        $facturas =  $this->hardwareModel->traerInfoCampoPartesConserialHardware('lote');
        $skus =  $this->hardwareModel->traerSkus();
        $chasises =  $this->hardwareModel->traerChasises();
        $pulgadas =  $this->hardwareModel->traerPulgadas();
        // $this->printR($skus);
        ?>
        <P>FILTROS</P>
        <div class="row" >
            <span class="col-lg-4">Serial:</span>
            <div class="col-lg-8" align="right">
                <input class="form-control"type="text" id="inputBuscarHardware" onkeyup="fitrarHardwareSerialInventario();">
            </div>
        </div>
        <!-- <div class="row"  >
            <span class="col-lg-4">Pulgadas:</span>
            <div class="col-lg-8" align="right">
                <input class="form-control"type="text" id="inputBuscarPulgadas" onkeyup="fitrarHardwarePulgadasInventario();">
            </div>
        </div> -->
        <div class="row"  >
            <span class="col-lg-4">Procesador:</span>
            <div class="col-lg-8" align="right">
                <select class ="form-control"  id="inputBuscarProcesador" onchange="fitrarHardwareProcesadorInventario();" >
                        <?php  $this->colocarSelecProcesadores($procesadores);  ?>
                    </select>  
            </div>
        </div>
        <div class="row"  >
            <span class="col-lg-4">Ubicacion:</span>
            <div class="col-lg-8" align="right">
                <select class ="form-control"  id="inputBuscarUbicacion" onchange="filtrarUbicacionInventario();" >
                <?php
                            // $ubicaciones = $this->hardwareModel->traerUbicaciones();
                            echo '<option value="-1">Seleccione...</option>';  
                            foreach($ubicaciones as $ubicacion)
                            {
                                if($ubicacion['ubicacion']== $producto['ubicacion'])
                                {
                                    echo '<option selected value="'.$ubicacion['ubicacion'].'">'.$ubicacion['ubicacion'].'</option>';      

                                }else{

                                    echo '<option value="'.$ubicacion['ubicacion'].'">'.$ubicacion['ubicacion'].'</option>';      
                                }
                            }
                        ?>
                    </select>  
            </div>
        </div>
        <div class="row"  >
            <span class="col-lg-4">Importacion:</span>
            <div class="col-lg-8" align="right">
            <select class ="form-control"  id="inputBuscarImportacion" onchange="fitrarHardwareImportacionInventario();" >
                        <?php  $this->colocarSelectCampo($idImportaciones);  ?>
                    </select>
            </div>
        </div>
        <div class="row"  >
            <span class="col-lg-4">Proveedor:</span>
            <div class="col-lg-8" align="right">
            <select class ="form-control"  id="inputBuscarProveedor" onchange="fitrarHardwareProveedorInventario();" >
                        <?php  $this->colocarSelectCampo($idproveedores);  ?>
                    </select>
            </div>
        </div>
        <div class="row"  >
            <span class="col-lg-4">lote:</span>
            <div class="col-lg-8" align="right">
            <select class ="form-control"  id="inputBuscarLote" onchange="fitrarHardwareLoteInventario();" >
                        <?php  $this->colocarSelectCampo($lotes);  ?>
            </select>
            </div>
        </div>
        <div class="row"  >
            <span class="col-lg-4">Factura:</span>
            <div class="col-lg-8" align="right">
            <select class ="form-control"  id="inputBuscarFactura" onchange="fitrarHardwareFacturaInventario();" >
                        <?php  $this->colocarSelectCampo($facturas);  ?>
            </select>
            </div>
        </div>
        <div class="row"  >
            <span class="col-lg-4">Sku:</span>
            <div class="col-lg-8" align="right">
                <select class ="form-control"  id="inputBuscarSku" onchange="filtrarSkuInventario();" >
                <?php
                            // $ubicaciones = $this->hardwareModel->traerUbicaciones();
                            echo '<option value="-1">Sel...</option>';  
                            foreach($skus as $sku)
                            {
                                    echo '<option value="'.$sku['comodin'].'">'.$sku['comodin'].'</option>';      
                            }
                ?>
                </select>  
            </div>
        </div>
        <div class="row"  >
            <span class="col-lg-4">Chasis:</span>
            <div class="col-lg-8" align="right">
                <select class ="form-control"  id="inputBuscarChasis" onchange="filtrarChasisInventario();" >
                <?php
                            // $ubicaciones = $this->hardwareModel->traerUbicaciones();
                            echo '<option value="-1">Sel...</option>';  
                            foreach($chasises as $chasis)
                            {
                                    echo '<option value="'.$chasis['chasis'].'">'.$chasis['chasis'].'</option>';      
                            }
                ?>
                </select>  
            </div>
        </div>
        <div class="row"  >
            <span class="col-lg-4">Pulgadas:</span>
            <div class="col-lg-8" align="right">
                <select class ="form-control"  id="inputBuscarPulgadas" onchange="filtrarPulgadasInventario();" >
                <?php
                            // $ubicaciones = $this->hardwareModel->traerUbicaciones();
                            echo '<option value="-1">Sel...</option>';  
                            foreach($pulgadas as $pulgada)
                            {
                                    echo '<option value="'.$pulgada['pulgadas'].'">'.$pulgada['pulgadas'].'</option>';      
                            }
                ?>
                </select>  
            </div>
        </div>

        <!-- <div class="row"  >
            <span class="col-lg-4">Tipo:</span>
            <div class="col-lg-8" align="right">
            <select class ="form-control"  id="inputBuscarTipo" onchange="fitrarHardwareTipoInventario();">
                            <?php  $this->colocarSelect($tipopartes);  ?>
                    </select>
            </div>
        </div>
        <div class="row"  >
            <span class="col-lg-4">SubTipo:</span>
            <div class="col-lg-8" align="right">
            <select class ="form-control"  id="inputBuscarSubTipo" onchange="fitrarHardwareSubTipoInventario();">
                            <?php  $this->colocarSelect($subtipos);  ?>
                    </select>
            </div>
        </div> -->
        <?php
    }

    function formuRealizarDevolucionABodega($idHardware)
    {
        //traer el registro del ultimo item donde fue incluido este idHArdware 
        $infoHardware = $this->hardwareModel->traerHardwareId($idHardware); 
        $ultimoAsocItemInicio = $this->asociadoItemPedido->traerUltimoItemInicioAsociadoIdHArdware($idHardware);
        $infoAsociado = $this->asociadoItemPedido->traerAsociadoItemIdAsociado($ultimoAsocItemInicio);
        $infoItemInicio = $this->itemInicioPedidoModel->traerItemInicioPedidoId($infoAsociado['idItemInicioPedido']);
        $infoEstado = $this->estadoInicioPedidoModel->traerEstadosInicioPedidoId($infoHardware);
        // $this->printR($infoItemInicio);
    ?>
        <div class="row" >

            <input type="hidden" id="idPedidoDev" value="<?php  echo $infoItemInicio['idPedido']; ?>" >
            <input type="hidden" id="idItemDev" value="<?php  echo $infoAsociado['idItemInicioPedido']; ?>" >

            <label class="col-lg-5">Serial: </label>
            <label class="col-lg-7"><?php echo $infoHardware['serial'];    ?></label>

            <label class="col-lg-5">Ultimo Pedido Asociado: </label>
            <label class="col-lg-7"><?php echo $infoItemInicio['idPedido'];    ?></label>

            <label class="col-lg-5">Item: </label>
            <label class="col-lg-7"><?php echo $infoAsociado['idItemInicioPedido'];    ?></label>
            <label>Observaciones Devolucion:</label>
            <textarea id="obseDevolucion" class="form-control" ></textarea>
            <button 
                onclick ="realizarDevolucionABodega(<?php echo $idHardware    ?>);"
                class="btn btn-primary mt-3 btn-block"
            >Realizar Devolucion</button>
        </div>

    <?php
    }
}
?>