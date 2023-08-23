<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class PrioridadModel extends Conexion
{

    public function traerPrioridades()
    {
        // die('prioridad model123 ');
        $sql = "select * from prioridades ";
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        $prioridades = $this->get_table_assoc($consulta);
        // echo '<pre>';
        // print_r($prioridades); 
        // echo '</pre>';
        // die();
        return $prioridades;
    }

}