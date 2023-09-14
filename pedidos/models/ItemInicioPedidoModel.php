<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class ItemInicioPedidoModel extends Conexion
{

        public function traerItemInicioPedido($idPedido)
        {
            $sql = "select * from itemsInicioPedido  where idPedido = '".$idPedido."' and anulado = 0 order by id asc ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $itemsInicioPedido = $this->get_table_assoc($consulta);
            return $itemsInicioPedido;
        }
        
        public function agregarItemInicialPedido($request)
        {
            // echo '<pre>'; 
            // print_r($request); 
            // echo '</pre>';
            // die(); 
            $sql = "insert into itemsInicioPedido(idPedido,cantidad,tipo,modelo,pulgadas,
            procesador,generacion,ram,disco,estado,fecha,precio) 
            values ('".$request['idPedido']."','".$request['icantidad']."','".$request['itipo']."','".$request['imodelo']."'
            ,'".$request['ipulgadas']."','".$request['iprocesador']."','".$request['igeneracion']."'
            ,'".$request['iram']."','".$request['idisco']."','".$request['idEstadoInicio']."',now()
            ,'".$request['iprecio']."'
            )";   
            // die($sql); 
            $consulta = mysql_query($sql,$this->connectMysql());
        }
        
        public function eliminarItemInicialPedido($id)
        {
            // $sql = "delete  from itemsInicioPedido   where id = '".$id."'"; 
            $sql = "update  itemsInicioPedido set anulado = 1  where id = '".$id."'"; 
            $consulta = mysql_query($sql,$this->connectMysql());
        }
        
        public function traerItemInicioPedidoId($id)
        {
            $sql = "select  * from itemsInicioPedido   where id = '".$id."'  and anulado = 0"; 
            $consulta = mysql_query($sql,$this->connectMysql());
            $infoItemInicio =  mysql_fetch_assoc($consulta);
            // echo '<pre>'; 
            // print_r($infoItemInicio); 
            // echo '</pre>';
            // die(); 
            return $infoItemInicio;   
        }
        
        public function sumaItemsInicioPedidoIdPedido($idPedido)
        {
            $sql = "select sum(precio) as suma from itemsInicioPedido
            where idPedido = '".$idPedido."' 
            and anulado = 0
            ";
            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrSuma = mysql_fetch_assoc($consulta);
            return $arrSuma['suma'];
        }


        
}



?>