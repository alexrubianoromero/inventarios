<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/pedidos/models/ItemInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/models/EstadoInicioPedidoModel.php'); 
require_once($raiz.'/pedidos/models/PedidoModel.php'); 
require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 

class iteminicioPedidoView
{
    protected $itemIniciopedidoModel;
    protected $estadoInicioPedidoModel;
    protected $pedidoModel;
    protected $tipoParteModel;


    public function __construct()
    {
        $this->itemIniciopedidoModel = new ItemInicioPedidoModel();
        $this->estadoInicioPedidoModel = new EstadoInicioPedidoModel();
        $this->pedidoModel = new PedidoModel();
        $this->tipoParteModel = new TipoParteModel();
      
    }

    public function mostrarItemsInicioPedido($idPedido)
    {
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
        echo '<th>Modelo</th>';
        echo '<th>Pulgadas</th>';
        echo '<th>Procesador</th>';
        echo '<th>Generacion</th>';
        echo '<th>Ram</th>';
        echo '<th>Disco</th>';
        echo '<th>Estado</th>';
        echo '<th>Precio</th>';
        echo '<th>Eliminar</th>';
        echo '</tr>';
        $subTotal = 0; 
        $valorR = 0;
        $valorI = 0; 
        
        foreach($itemsInicioPedido as $item)
        {
            $infoEstado = $this->estadoInicioPedidoModel->traerEstadosInicioPedidoId($item['estado']); 
            // echo 'wrwer<pre>'; 
            // print_r($infoEstado); 
            // echo '</pre>';
            // die(); 
            echo '<tr>'; 
            echo '<td>'.$item['cantidad'].'</td>'; 
            echo '<td>'.$item['tipo'].'</td>'; 
            echo '<td>'.$item['modelo'].'</td>'; 
            echo '<td>'.$item['pulgadas'].'</td>'; 
            echo '<td>'.$item['procesador'].'</td>'; 
            echo '<td>'.$item['generacion'].'</td>'; 
            echo '<td>'.$item['ram'].'</td>'; 
            echo '<td>'.$item['disco'].'</td>'; 
            echo '<td>'.$infoEstado['descripcion'].'</td>'; 
            echo '<td align="right">'.number_format($item['precio'],0,",",".").'</td>'; 
            echo '<td><button class="btn btn-primary" onclick="eliminarItemInicialPedido('.$item['id'].');">Eliminar</button></td>'; 
            echo '</tr>';
            $subTotal = $subTotal + $item['precio'];
        }
        echo '<tr>'; 
        echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'; 
        echo '<td>Subtotal</td><td align="right">'.number_format($subTotal,0,",",".").'</td>'; 
        echo '</tr>';
        if($infoPedido['r']==1)
        {
            $valorR = ($subTotal * 2.5)/100;
        }    
            echo '<tr>'; 
            echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'; 
            echo '<td>ValorR</td><td align="right">'.number_format($valorR,0,",",".").'</td>'; 
            echo '</tr>';
        
        if($infoPedido['i']==1)
        {
            $valorI = ($subTotal * 11.04)/1000;
        }
            echo '<tr>'; 
            echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'; 
            echo '<td>ValorI</td><td align="right">'.number_format($valorI,0,",",".").'</td>'; 
            echo '</tr>';
            $total = $subTotal - $valorR - $valorI;    
            echo '<tr>'; 
            echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'; 
            echo '<td>Total</td><td align="right">'.number_format($total,0,",",".").'</td>'; 
            echo '</tr>';
        
        
        echo '</table>';
        echo '</div>';
    }

}    
    