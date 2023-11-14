<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/clientes/models/ClienteModel.php'); 
require_once($raiz.'/vista/vista.php'); 

// require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 

class reportesView extends vista
{
    // protected $reporteModel;
    protected $clienteModel;
 

    public function __construct()
    {
        $this->clienteModel = new clienteModel();
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

}    