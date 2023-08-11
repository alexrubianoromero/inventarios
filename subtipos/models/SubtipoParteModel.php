<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class SubtipoParteModel extends Conexion
{

    public function traerSubTipoParte($id)
    {
        $sql = "select * from subtipoParte where id = '".$id."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $subTipoParte = $this->get_table_assoc($consulta);
        return $subTipoParte;
    }


}