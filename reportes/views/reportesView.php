<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/clientes/models/ClienteModel.php'); 
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/pedidos/models/EstadoInicioPedidoModel.php');  
require_once($raiz.'/pedidos/models/ItemInicioPedidoModel.php');  
require_once($raiz.'/pedidos/models/PedidoModel.php');  
require_once($raiz.'/subtipos/models/SubtipoParteModel.php');  
require_once($raiz.'/marcas/models/MarcaModel.php');  
require_once($raiz.'/vista/vista.php'); 

// require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 

class reportesView extends vista
{
    // protected $reporteModel;
    protected $clienteModel;
    protected $HardwareModel;
    protected $estadoInicioPedidoModel ; 
    protected $itemInicioPedidoModel ; 
    protected $subtipoParteModel ; 
    protected $marcaModel ; 
    protected $pedidoModel ; 
 

    public function __construct()
    {
        $this->clienteModel = new clienteModel();
        $this->HardwareModel = new HardwareModel();
        $this->estadoInicioPedidoModel = new EstadoInicioPedidoModel();
        $this->itemInicioPedidoModel = new ItemInicioPedidoModel();
        $this->subtipoParteModel = new SubtipoParteModel();
        $this->marcaModel = new MarcaModel();
        $this->pedidoModel = new pedidoModel();
    }

    public function reportesMenu()
    {
        ?>
        <div style="padding:10px;"  id="div_general_reportes" class="row">
            <div>
                    <!-- REPORTES -->
            </div>
            <div>
                <button class="btn btn-primary" onclick="formuReporteVentas();">Reporte de Ventas</button>
                <button class="btn btn-primary" onclick="reporteEstadoEquipo();">Reporte Estado Equipo</button>
                <button class="btn btn-primary" onclick="verReporteFinanciero();">Reporte de Ventas</button>
            </div>
            <div id="div_resultados_reportes">

            </div>
        </div>
        <?php
    }
    public function formuReporteVentas()
    {
        ?>
        <div style="padding:10px;"  id="div_general_reportes" class="row">
            <div class="col-lg-6">
                <label class="col-lg-6"for="">Fecha Inicial: </label>
                <div class="col-lg-6">
                    <input type="date" id="fechaIn" class="form-control">
                </div>
            </div>
            
            <div class="col-lg-6">
                <label class="col-lg-6"for="">Fecha Final: </label>
                <div class="col-lg-6">
                    <input type="date" id="fechaFin" class="form-control">
                </div>
            </div>
            <button class="btn btn-primary" onclick="generarReporteVentas();">GENERAR REPORTE</button>

        </div>

        <?php
    }
    public function mostrarReporteVentas($itemsVentasPedidosFechas)
    {
        ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Tipo</th>  <!--hardware o parte -->
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $granTotal = 0; 
                       foreach($itemsVentasPedidosFechas as $item)
                       {
                          $infoCliente =  $this->clienteModel->traerClienteId($item['idCliente']); 
                          if($item['tipoItem']==1){$tipo = 'Hardware';} else { $tipo = 'Parte';}
                        //   $this->printR($infoCliente); 
                          echo '<tr>';  
                          echo '<td>'.$item['idPedido'].'</td>'; 
                          echo '<td>'.$item['fecha'].'</td>'; 
                          echo '<td>'.$infoCliente[0]['nombre'].'</td>'; 
                          echo '<td>'.$tipo.'</td>'; 
                          echo '<td align="right">'.number_format($item['total'],0,",",".").'</td>'; 
                          echo '</tr>';  
                          $granTotal = $granTotal + $item['total']; 
                        }  
                        echo '<tr>';  
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td align="right">'.number_format($granTotal,0,",",".").'</td>';
                        echo '</tr>';  

                    ?>
                </tbody>
            </table>

        <?php
    }

    
    public function reporteEstadoEquipo($hardwards)
    {
        $estados = $this->estadoInicioPedidoModel->traerEstadosInicioPedido();
        ?>
        <div class="row mt-3" >
            <div class="col-lg-3" align="right">
                Escojer el estado: 
            </div>
            <div class="col-lg-6">
                <select id="idEstadoFiltrar" class="form-control" onchange="traerEquiposFiltradoEstado()">
                    <option value ="-1">Seleccione...</option>
                    <?php
                        foreach($estados as $estado)
                        {
                            echo '<option value ="'.$estado['id'].'">'.$estado['descripcion'].'</option>';     
                        }
                    ?>
                </select>
            </div>
           
        </div>
        <div id="div_mostrar_equipos_filtrados_estado">
                 <?php  $this->verEquipos($hardwards);   ?>       
           
        </div>
    <?php
    }


    public function verEquipos($hardwards)
    {
        ?>
         <table class="table table-striped hover-hover mt-3">
                <thead>
                    <th>Serial</th>
                    <th>No Importacion</th>
                    <th>Estado</th>
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
                        //    $dadodebaja = 4;
                        //    if($estado == $dadodebaja)
                        //    {
                            
                            //        echo '<td><button 
                            //                    class="btn btn-secondary btn-sm " 
                            //                    onclick="habilitarHardware('.$hardward['id'].');"
                            //                    >Habilitar</button></td>';
                            //    }else{
                                
                                //        echo '<td><button 
                                //                    class="btn btn-primary btn-sm " 
                                //                    onclick="verificarDarDeBaja('.$hardward['id'].');"
                                //                    >Dar Baja</button></td>';
                                //    }
                                
                                //    echo '<td><button 
                                //                class="btn btn-primary btn-sm " 
                                //                onclick="verMovimientosHardware('.$hardward['id'].');"
                                //                >Historial</button></td>';
                                //    echo '</tr>';  
                            }
                            ?>
                  </tbody>
              </table> 

        <?php
    }


    public function verEquiposFinanciero($hardwards)
    {
        ?>
         <table class="table table-striped hover-hover mt-3">
                <thead>
                    <th>No Importacion</th>
                    <th>Lote</th>
                    <th>Serial</th>
                    <th>TipoProducto</th>
                    <th>Chasis</th>
                    <th>Modelo</th>
                    <th>Pulgadas</th>
                    <th>Procesador</th>
                    <th>Generacion</th>
                    <th>Marca</th>
                    <th>OC</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Costo Item</th>
                    <th>Costo Importacion</th>
                    <th>Costo Producto</th>
                    <th>Precio Minimo Venta</th>
                    <th>Ganancia Base</th>
                    <th>Ganancia</th>
                    <th>Wo</th>
                    <th>Retefuente</th>
                    <th>ReteIca</th>
                </thead>
                <tbody>
                    <?php
                    foreach($hardwards as $hardward)
                    {
                        $infoEstado = $this->estadoInicioPedidoModel->traerEstadosInicioPedidoId($hardward['idEstadoInventario']);
                        $infoSubtipo =  $this->subtipoParteModel->traerSubTipoParte($hardward['idSubInv']);  
                        $infoMarca = $this->marcaModel->traerMarcaId($hardward['idMarca']); 
                        $numeroPedido =   $this->itemInicioPedidoModel->traerPedidoConIdAsociadoItem($hardward['idItemPedido']);
                        $infoPedido =  $this->pedidoModel->traerPedidoId($numeroPedido); 
                        $nombreCliente =    $this->itemInicioPedidoModel->traerClientePedido($numeroPedido['pedido']);
                        $gananBase = $hardward['precioMinimoVenta'] - $hardward['costoProducto'];
                        $ganancia = '';
                        // $this->printR($hardward);
                        $estado =  $hardward['idEstadoInventario'];
                        echo '<tr>'; 
                        echo '<td>'.$hardward['idImportacion'].'</td>';
                        echo '<td>'.$hardward['lote'].'</td>';
                        echo '<td>'.$hardward['serial'].'</td>';
                        echo '<td>'.$infoSubtipo[0]['descripcion'].'</td>';
                        echo '<td>'.$hardward['chasis'].'</td>';
                        echo '<td>'.$hardward['modelo'].'</td>';
                        echo '<td>'.$hardward['pulgadas'].'</td>';
                        echo '<td>'.$hardward['procesador'].'</td>';
                        echo '<td>'.$hardward['generacion'].'</td>';
                        echo '<td>'.$infoMarca[0]['marca'].'</td>';
                        echo '<td>'.$numeroPedido['pedido'] .'</td>';
                        echo '<td>'.$nombreCliente .'</td>';
                        echo '<td>'.$infoEstado['descripcion'].'</td>';
                        echo '<td>'.$hardward['costoItem'].'</td>';
                        echo '<td>'.$hardward['costoImportacion'].'</td>';
                        echo '<td>'.$hardward['costoProducto'].'</td>';
                        echo '<td>'.$hardward['precioMinimoVenta'].'</td>';
                        echo '<td>'.$gananBase.'</td>';
                        echo '<td></td>';
                        echo '<td>'.$infoPedido['wo'].'</td>';
                        echo '<td>'.$infoPedido['porcenretefuente'].'</td>';
                        echo '<td>'.$infoPedido['porcenreteica'].'</td>';
                        //    $dadodebaja = 4;
                        //    if($estado == $dadodebaja)
                        //    {
                            
                            //        echo '<td><button 
                            //                    class="btn btn-secondary btn-sm " 
                            //                    onclick="habilitarHardware('.$hardward['id'].');"
                            //                    >Habilitar</button></td>';
                            //    }else{
                                
                                //        echo '<td><button 
                                //                    class="btn btn-primary btn-sm " 
                                //                    onclick="verificarDarDeBaja('.$hardward['id'].');"
                                //                    >Dar Baja</button></td>';
                                //    }
                                
                                //    echo '<td><button 
                                //                class="btn btn-primary btn-sm " 
                                //                onclick="verMovimientosHardware('.$hardward['id'].');"
                                //                >Historial</button></td>';
                                //    echo '</tr>';  
                            }
                            ?>
                  </tbody>
              </table> 

        <?php
    }



    public function verReporteFinanciero($hardwards)
    {
        // $estados = $this->estadoInicioPedidoModel->traerEstadosInicioPedido();
        ?>
        <div class="row mt-3" >
            <div class="col-lg-3" align="right">
                Enviar a excel: 
            </div>
            <div class="col-lg-6">
                <select id="idEnviarExcel" class="form-control">
                    <option value ="-1">Seleccione...</option>
                    <option value ="1">SI</option>
                    <option value ="2">NO</option>
                   
                </select>
            </div>
           
        </div>
        <div id="div_mostrar_reporte_financiero">
                 <?php  $this->verEquiposFinanciero($hardwards);   ?>       
           
        </div>
    <?php
    }

}    