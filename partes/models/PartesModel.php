<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class PartesModel extends Conexion
{

    public function traerParte($id)
    {
        $sql = "select * from partes where id = '".$id."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $parte = $this->get_table_assoc($consulta);
        return $parte;
    }
    
    public function traerTodasLasPartes()
    {
        $sql = "select * from partes  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $partes = $this->get_table_assoc($consulta);
        return $partes;
    }
    


}