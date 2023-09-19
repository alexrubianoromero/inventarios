<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/pedidos/models/ItemInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/models/EstadoInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/models/PedidoModel.php'); 
require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 
require_once($raiz.'/login/models/UsuarioModel.php');  
require_once($raiz.'/prioridades/models/PrioridadModel.php');  
require_once($raiz.'/subtipos/models/SubtipoParteModel.php');  

class iteminicioPedidoView
{
    protected $itemIniciopedidoModel;
    protected $estadoInicioPedidoModel;
    protected $pedidoModel;
    protected $tipoParteModel;
    protected $usuarioModel;
    protected $prioridadModel;
    protected $subtipoParteModel;


    public function __construct()
    {
        $this->itemIniciopedidoModel = new ItemInicioPedidoModel();
        $this->estadoInicioPedidoModel = new EstadoInicioPedidoModel();
        $this->pedidoModel = new PedidoModel();
        $this->tipoParteModel = new TipoParteModel();
        $this->usuarioModel = new UsuarioModel();
        $this->prioridadModel = new PrioridadModel();
        $this->subtipoParteModel = new SubtipoParteModel();
    }

    public function mostrarItemsInicioPedido($idPedido)
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
            
      
        <?php
        $itemsInicioPedido = $this->itemIniciopedidoModel->traerItemInicioPedido($idPedido); 
        $infoPedido = $this->pedidoModel->traerPedidoId($idPedido);  
        $tiposPartes =   $this->tipoParteModel->traerTodasLosTipoPartes();

        // echo 'wrwer<pre>'; 
        // print_r($itemsInicioPedido); 
        // echo '</pre>';
        // die(); 
        echo '<div>';
        echo '<table class="table table-striped">'; 
        echo '<tr>'; 
        echo '<th>Cantidad</th>';
        echo '<th>Tipo</th>';
        echo '<th>Subtipo</th>';
        echo '<th>Modelo</th>';
        echo '<th>Pulgadas</th>';
        echo '<th>Procesador</th>';
        echo '<th>Generacion</th>';
        echo '<th>Ram</th>';
        echo '<th>Disco</th>';
        echo '<th>Estado</th>';
        echo '<th>Total</th>';
        echo '<th>Eliminar</th>';
        echo '<th>Asginado</th>';
        echo '</tr>';
        $subTotal = 0; 
        $valorR = 0;
        $valorI = 0; 
        
        foreach($itemsInicioPedido as $item)
        {
            $infoEstado = $this->estadoInicioPedidoModel->traerEstadosInicioPedidoId($item['estado']); 
            $infoTipo = $this->tipoParteModel->traerTipoParteConId($item['tipo']);
            $infoSubtipo =  $this->subtipoParteModel->traerSubTipoParte($item['subtipo']);
            // echo 'wrwer<pre>'; 
            // print_r($infoEstado); 
            // echo '</pre>';
            // die(); 
            echo '<tr>'; 
            echo '<td>'.$item['cantidad'].'</td>'; 
            // echo '<td>'.$item['tipo'].'</td>'; 
            echo '<td>'.$infoTipo[0]['descripcion'].'</td>'; 
            // echo '<td>'.$item['modelo'].'</td>'; 
            echo '<td>'.$infoSubtipo[0]['descripcion'].'</td>'; 
            if($item['tipoItem'] == 1)
            {
                echo '<td>'.$item['modelo'].'</td>'; 
                echo '<td>'.$item['pulgadas'].'</td>'; 
                echo '<td>'.$item['procesador'].'</td>'; 
                echo '<td>'.$item['generacion'].'</td>'; 
                echo '<td>'.$item['ram'].'</td>'; 
                echo '<td>'.$item['disco'].'</td>'; 
            }
            if($item['tipoItem'] == 2)
            {
                echo '<td colspan ="6">'.$item['observaciones'].'</td>';
            }
           
           
            echo '<td>'.$infoEstado['descripcion'].'</td>'; 
            echo '<td align="right">'.number_format($item['total'],0,",",".").'</td>'; 
            echo '<td><button class="btn btn-primary" onclick="eliminarItemInicialPedido('.$item['id'].');">Eliminar</button></td>'; 
            echo '<td>'; 
            if($item['asignado']== 0)
            {
                echo '<button 
                class="btn btn-success" 
                data-bs-toggle="modal" 
                data-bs-target="#modalPedidoAsignartecnico"
                onclick="formuAsignarItemPedidoATecnico('.$item['id'].');"
                > Asignar Item
                </button>';
            }else{
                $infoTecnico =  $this->usuarioModel->traerInfoId($item['idTecnico']);
                $infoPrioridad = $this->prioridadModel->traerPrioridadId($item['idPrioridad']);
                echo $infoPrioridad['descripcion'];
                echo '<br>';
                echo $infoTecnico['nombre'];
            }
            
            echo '</td>';
            echo '</tr>';
            $subTotal = $subTotal + $item['total'];
        }

       
        
        
        echo '</table>';
        echo '</div>';
        ?>
          </body>
              <?php    $this->modalPedidoAsignartecnico();    ?>
        </html>
        <?php
    }
    public function calculoValorespedido($idPedido)
    {

        $infoPedido = $this->pedidoModel->traerPedidoId($idPedido); 
        $subTotal = $this->itemIniciopedidoModel->sumaItemsInicioPedidoIdPedido($idPedido); 
        echo '<table class="table table-striped">'; 
        echo '<tr>'; 
        echo '<td>Subtotal</td><td align="right">'.number_format($subTotal,0,",",".").'</td>'; 
        echo '</tr>';
        if($infoPedido['r']==1)
        {
            $valorR = ($subTotal * $infoPedido['porcenretefuente'])/100;
        }    
        echo '<tr>'; 
      
        echo '<td>ValorR</td><td align="right">'.number_format($valorR,0,",",".").'</td>'; 
        echo '</tr>';
        
        if($infoPedido['i']==1)
        {
            $valorI = ($subTotal * $infoPedido['porcenreteica'])/1000;
        }
        echo '<tr>'; 
      
        echo '<td>ValorI</td><td align="right">'.number_format($valorI,0,",",".").'</td>'; 
        echo '</tr>';
            $total = $subTotal - $valorR - $valorI;    
            echo '<tr>'; 
          
            echo '<td>Total</td><td align="right">'.number_format($total,0,",",".").'</td>'; 
            echo '</tr>';
        echo '</table>';
    }
        


    public function modalPedidoAsignartecnico()
    {
            ?>
            <!-- Modal -->
            <div class="modal fade" id="modalPedidoAsignartecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Asignar Item Pedido a tecnico</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyPedidoAsignartecnico">
                    
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

}    
    