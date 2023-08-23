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
        
}