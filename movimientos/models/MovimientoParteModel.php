<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class MovimientoParteModel extends Conexion
{
    public function traerMovimientosParte($idParte)
    {
        $sql = "select * from movimientosPartes  where idParte = '".$idParte."' "; 
        $consulta = mysql_query($sql,$this->connectMysql());
        $movParte = $this->get_table_assoc($consulta ); 
        return $movParte; 
    }

    public function grabarMovDesligardeHardware($infoMov)
    {
            $sql = "insert into movimientosPartes  (idParte,tipoMov,observaciones,idHardware,fecha,idUsuario)
                    values('".$infoMov->idParte."','".$infoMov->tipoMov."',
                    'Se desligo de Hardware con id =".$infoMov->idHardware." ',
                    '".$infoMov->idHardware."',now(),'".$_SESSION['idUsuario']."' )"; 
                    $consulta = mysql_query($sql,$this->connectMysql());
                }
                
                public function registrarAgregarParteAHardware($infoMov)
                {
        $sql = "insert into movimientosPartes (idParte,tipoMov,observaciones,idHardware,fecha,idUsuario)   
                values(
                    '".$infoMov->idParte."'
                    ,'".$infoMov->tipoMov."'
                    ,'".$infoMov->observaciones."'
                    ,'".$infoMov->idHardware."'
                    ,now()
                    ,'".$infoMov->idUsuario."'
                    )"; 
                    // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
    }

}