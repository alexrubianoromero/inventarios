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
}