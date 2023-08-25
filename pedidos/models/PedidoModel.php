<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class PedidoModel extends Conexion
{

        public function traerPedidos()
        {
            $sql = "select * from pedidos ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $pedidos = $this->get_table_assoc($consulta);
            return $pedidos;
        }
        public function traerPedidoId($id)
        {
            $sql = "select * from pedidos where idPedido = '".$id."'   ";
            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());
            $pedido = mysql_fetch_assoc($consulta);
            // echo '<pre>'; 
            // print_r($pedido); 
            // echo '</pre>';
            // die(); 
            return $pedido;
        }


        
        public function grabarEncabezadoPedido($request)
        {
            $sql = "insert into pedidos (idCliente, idUrgencia,fecha)   
                values ('".$request['idEmpresaCliente']."','".$request['idPrioridad']."',now())";
                $consulta = mysql_query($sql,$this->connectMysql());
                //  die($sql); 
            $ultimoId =  $this->obtenerUltimoIdPedidos();   
            return $ultimoId;
        }
        
        public function obtenerUltimoIdPedidos()
        {
            $sql = "select max(idPedido) as maximo from pedidos ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $arr = mysql_fetch_assoc($consulta);
            $ultimo = $arr['maximo']; 
            // die($ultimo); 
            return $ultimo;

        }

        
        
}