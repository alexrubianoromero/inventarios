<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class ClienteModel extends Conexion
{
    public function traerClientes()
    {
        $sql = "select * from cliente0 ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $clientes = $this->get_table_assoc($consulta);
        return $clientes;
    }
    public function grabarCliente($request)
    {
        $sql = "insert into cliente0  (nombre,identi,telefono,email,direccion,ciudad,idTipoContribuyente,sede)    
            values ('".$request['nombre']."','".$request['nit']."','".$request['telefono']."'
            ,'".$request['email']."'
            ,'".$request['direccion']."'
            ,'".$request['ciudad']."'
            ,'".$request['idTipoContribuyente']."'
            ,'".$request['sede']."'
            ) ";
        $consulta = mysql_query($sql,$this->connectMysql());
        // $clientes = $this->get_table_assoc($consulta);
        // return $clientes;
    }


}