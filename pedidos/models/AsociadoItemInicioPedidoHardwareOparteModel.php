<?php
//este modelo es el de la tabla que une los hardware o partes al item inicio de un pedido
$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class AsociadoItemInicioPedidoHardwareOparteModel extends Conexion
{
        public function construct()
        {
          session_start();   
        }
        public function insertarAsociacionHardwareConItemRegistro($request)
        {
            $sql = "insert into asociadoItemInicioPedidoHardwareOparte(idHardwareOParte,idItemInicioPedido,fecha,idUsuario) 
            values ('".$request['idHardware']."','".$request['idItemAgregar']."',now(),'".$_SESSION['id_usuario']."')	 ";
            $consulta = mysql_query($sql,$this->connectMysql());
            // $estadosInicio = $this->get_table_assoc($consulta);
            // return $estadosInicio;
        }
        public function insertarAsociacionParteConItemRegistro($request)
        {
            $sql = "insert into asociadoItemInicioPedidoHardwareOparte(idHardwareOParte,idItemInicioPedido,fecha,idUsuario) 
            values ('".$request['idParte']."','".$request['idItemAgregar']."',now(),'".$_SESSION['id_usuario']."')	 ";
            $consulta = mysql_query($sql,$this->connectMysql());
            // $estadosInicio = $this->get_table_assoc($consulta);
            // return $estadosInicio;
        }


        public function traerMaximoId()
        {
            $sql = "select max(id) as maximo from asociadoItemInicioPedidoHardwareOparte ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrMaximo= mysql_fetch_assoc($consulta); 
            return $arrMaximo['macimo'];
        }

        public function traerAsociadoItemIdAsociado($idAsociado)
        {
            $sql = "select * from asociadoItemInicioPedidoHardwareOparte where id= '".$id."'  ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $infoAsociado = mysql_fetch_assoc($consulta); 
            return $infoAsociado;
        }
        
        public function traerAsociadoItemIdItem($idItem)
        {
            $sql = "select * from asociadoItemInicioPedidoHardwareOparte where idItemInicioPedido= '".$idItem."'  ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrAsociados= mysql_fetch_assoc($consulta); 
            return $arrAsociados;
        }

        
}