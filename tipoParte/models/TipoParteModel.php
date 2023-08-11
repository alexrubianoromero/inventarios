<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class TipoParteModel extends Conexion
{

    public function traerTipoParteConId($id)
    {
        $sql = "select * from tipoparte where id = '".$id."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $tipoparte = $this->get_table_assoc($consulta);
        return $tipoparte;
    }
    
    public function traerTodasLosTipoPartes()
    {
        $sql = "select * from tipoparte  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $tipopartes = $this->get_table_assoc($consulta);
        return $tipopartes;
    }
    


}