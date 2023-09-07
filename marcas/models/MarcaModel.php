<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class MarcaModel extends Conexion
{

    public function traerMarcaId($id)
    {
        $sql = "select * from marcas where id = '".$id."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $hardware = $this->get_table_assoc($consulta);
        return $hardware;
    }
    
    public function traerTodasLasMarcas()
    {
        $sql = "select id, marca as descripcion from marcas  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $marcas = $this->get_table_assoc($consulta);
        return $marcas;
    }
}


?>