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
            $total = $request['icantidad'] * $request['iprecio'];

            $sql = "insert into itemsInicioPedido(idPedido,cantidad,tipo,subtipo,modelo,pulgadas,
            procesador,generacion,ram,disco,estado,fecha,precio,total,observaciones,tipoItem,capacidadRam,capacidadDisco) 
            values ('".$request['idPedido']."','".$request['icantidad']."','".$request['itipo']."'
            ,'".$request['isubtipo']."'
            ,'".$request['imodelo']."'
            ,'".$request['ipulgadas']."','".$request['iprocesador']."','".$request['igeneracion']."'
            ,'".$request['iram']."','".$request['idisco']."','".$request['idEstadoInicio']."',now()
            ,'".$request['iprecio']."'
            ,'".$total."'
            ,'".$request['iobservaciones']."'
            ,'".$request['tipoItem']."'
            ,'".$request['icapacidadram']."'
            ,'".$request['icapacidaddisco']."'
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
            $sql = "select sum(total) as suma from itemsInicioPedido
            where idPedido = '".$idPedido."' 
            and anulado = 0
            ";
            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrSuma = mysql_fetch_assoc($consulta);
            return $arrSuma['suma'];
        }


        public function traerItemInicioPedidoIdTecnico($id,$idTecnicoAsignado)
        {
            $sql = "select  * from itemsInicioPedido   
                    where id = '".$id."'  
                    and anulado = 0
                    and idasignarA = '".$idTecnicoAsignado."'   "; 
            $consulta = mysql_query($sql,$this->connectMysql());
            $infoItemInicio =  mysql_fetch_assoc($consulta);
            // echo '<pre>'; 
            // print_r($infoItemInicio); 
            // echo '</pre>';
            // die(); 
            return $infoItemInicio;   
        }

        public function traerEstadoItemInicioPedidoIdTecnico($idPedido,$idTecnicoAsignado)
        {
            $sql = "select  idEstadoProcesoItem from itemsInicioPedido   
                    where idPedido = '".$idPedido."'  
                    and anulado = 0
                    and idTecnico = '".$idTecnicoAsignado."'   limit 1 "; 
                    // die($sql); 
            $consulta = mysql_query($sql,$this->connectMysql());
            $infoItemInicio =  mysql_fetch_assoc($consulta);
            // echo '<pre>'; 
            // print_r($infoItemInicio); 
            // echo '</pre>';
            // die(); 
            return $infoItemInicio['idEstadoProcesoItem'];   
        }


        public function traerItemsAsignadosATecnico($idTecnico)
        {
            $sql = "select * from itemsInicioPedido  
            where  idTecnico = '".$idTecnico."'   "; 
            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());
            $itemsInicioPedido = $this->get_table_assoc($consulta);
            return $itemsInicioPedido;
        }
        public function traerItemsAsignadosATecnicoDeUnPedido($idPedido,$idTecnico)
        {
            $sql = "select * from itemsInicioPedido  
            where  idTecnico = '".$idTecnico."'   
            and idPedido = '".$idPedido."'    "; 
            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());
            $itemsInicioPedido = $this->get_table_assoc($consulta);
            return $itemsInicioPedido;
        }
        


        
}



?>