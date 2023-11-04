<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class EstadoInventarioModel extends Conexion
{
    public function traerEstadoId($id)
    {
        $sql = "select * from estadosInventario where id = '".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $arrEstado = mysql_fetch_assoc($consulta);
        return $arrEstado;
    } 
    
}