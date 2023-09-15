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
    
    /*
    trae todos los tipos de parte que sean hardware osea hardwareoparte = 1
    */
    public function traerTipoParteHardware($hardwareoparte)
    {
        $sql = "select id,descripcion from tipoparte where hardwareoparte = '".$hardwareoparte."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $tipopartes = $this->get_table_assoc($consulta);
        //      echo '<pre>';
        // print_r($tipopartes); 
        // echo '</pre>';
        // die();
        return $tipopartes;
    }
    
    public function traerTipoParteId($idTipoParte)
    {
        $sql = "select * from tipoparte where id = '".$idTipoParte."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $arrTipo = mysql_fetch_assoc($consulta); 
        return $arrTipo; 
    }



}