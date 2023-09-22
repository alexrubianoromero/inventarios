<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');
require_once($raiz.'/partes/models/PartesModel.php');

class CondicionModel extends Conexion
{
    public function traerCondicionId($id)
    {
        $sql = "select * from cliente0 where idcliente = '".$id."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $cliente = $this->get_table_assoc($consulta);
        return $cliente;
    }

}