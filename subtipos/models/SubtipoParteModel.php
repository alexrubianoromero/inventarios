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


    //esta trae todas las subpartes del id parte indicado 
    //por ejemplo ram = 4
    //discos = 3
    public function traerSubTipoParteIdParte($idParte)
    {
        $sql = "select * from subtipoParte where idParte = '".$idParte."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $subTiposParte = $this->get_table_assoc($consulta);
        return $subTiposParte;
    }
    //esta trae los subtipos de acuerdo  a la descripcion de la parte 
    public function traerSubtiposPartesConDescriptParte($decriParte)
    {
        $sql = "select s.id as id ,s.descripcion from subtipoParte s
        inner join tipoparte t on (t.id = s.idparte)
        where t.descripcion = '".$decriParte."'
        ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $subTiposParte = $this->get_table_assoc($consulta);
        return $subTiposParte;
    }
    
    public function traerSubtiposHardware()
    {
        $sql = "select s.id,s.descripcion from subtipoParte  s    
        inner join tipoparte t on (t.id = s.idParte)
        where t.hardwareoparte	= 1
        "; 
        $consulta = mysql_query($sql,$this->connectMysql());
        $subTiposParte = $this->get_table_assoc($consulta);
        return $subTiposParte;
    }
    public function traerSubtiposParte()
    {
        $sql = "select s.id,s.descripcion from subtipoParte  s    
        inner join tipoparte t on (t.id = s.idParte)
        where t.hardwareoparte	= 2
        "; 
        $consulta = mysql_query($sql,$this->connectMysql());
        $subTiposParte = $this->get_table_assoc($consulta);
        return $subTiposParte;
    }
    
    


}