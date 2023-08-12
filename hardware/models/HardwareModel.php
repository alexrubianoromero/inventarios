<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class HardwareModel extends Conexion
{

    public function traerHardware()
    {
        $sql = "select * from hardware order by id asc";
        $consulta = mysql_query($sql,$this->connectMysql());
        $hardware = $this->get_table_assoc($consulta);
        return $hardware;
    }

    public function verHardware($id)
    {
        $sql = "select * from hardware where id = '".$id."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $hardware = mysql_fetch_assoc($consulta);
        // echo '<pre>';
        // print_r($hardware); 
        // echo '</pre>';
        // die();
        return $hardware;  
    }
    
    public function desligarRamDeEquipo($request)
    {
        $sql = "update hardware set  idRam = 0  where  id= '".$request['idHardware']."'   ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    public function desligarDiscoDeEquipo($request)
    {
        $sql = "update hardware set  idDisco = 0  where  id= '".$request['idHardware']."'   ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    public function asociarParteEnTablaHardware($request)
    {
        $sql = "update hardware set idDisco = '".$request['idDisco']."'      where id =   '".$request['idHardware']."'   "; 
        $consulta = mysql_query($sql,$this->connectMysql());
    }





}