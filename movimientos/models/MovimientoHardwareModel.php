<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class MovimientoHardwareModel extends Conexion
{

        public function registrarMovimientohardware($infoMov)
        {
            $obseSinComillas = addslashes ($infoMov->observaciones);
            $sql ="insert into movimientosHardware (fecha,idTipoMov,idHardware,idItemInicio,observaciones )  
            values (now(),$infoMov->idTipoMov,$infoMov->idHardware,$infoMov->idItemInicio,'".$obseSinComillas."') ";
            // die($sql); 
            $consulta = mysql_query($sql,$this->connectMysql()); 
        }
        
        
        public function  traerMovimientosHardwareId($idHardware)
        {
            $sql = "select * from movimientosHardware  where idHardware = '".$idHardware."' ";
            $consulta = mysql_query($sql,$this->connectMysql()); 
            $arrMov = $this->get_table_assoc($consulta);
            return $arrMov; 
        }
        
        public function  traerMovimientoId($idMovimiento)
        {
            $sql = "select * from movimientosHardware  where idMovimiento = '".$idMovimiento."' ";
            $consulta = mysql_query($sql,$this->connectMysql()); 
            $arrMov = mysql_fetch_assoc($consulta);
            return $arrMov; 
        }

}