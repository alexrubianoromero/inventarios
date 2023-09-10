<?php
$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);
require_once($raiz.'/conexion/Conexion.php');
require_once($raiz.'/subtipos/models/SubtipoParteModel.php');

class PartesModel extends Conexion
{
    protected $subTipoModel; 

    public function __construct()
    {
        $this->subTipoModel = new SubtipoParteModel();
    }
    //esta la cree cuando se suben muchos hardware desde un archivo de excell
    public function grabarParte($idSubTipo,$capacidad)
    {
      
        $sql = "insert into partes (idSubtipoParte,capacidad,comentarios)
                values('".$idSubTipo."','".$capacidad."','Se asocia a conmputador')
        ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }

    //esta es para cuando se crean las partes independientes 
    public function grabarParteIndividual($request)
    {
      
        $sql = "insert into partes (idSubtipoParte,capacidad,comentarios)
                values('".$request['isubtipo']."','".$request['capacidad']."','Creacion desde Modulo')
        ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }
   
    public function traerParte($id)
    {
        $sql = "select * from partes where id = '".$id."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $parte = $this->get_table_assoc($consulta);
        return $parte;
    }
    
    public function traerTodasLasPartes()
    {
        $sql = "select * from partes  order by id desc";
        $consulta = mysql_query($sql,$this->connectMysql());
        $partes = $this->get_table_assoc($consulta);
        return $partes;
    }
    public function traerMemoriasDisponibles()
    {
        $sql = "select id from tipoparte where descripcion = 'Ram' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ArridTipoParte = mysql_fetch_assoc($consulta);
        $idTipoParteRam = $ArridTipoParte['id'];



        $sql = "select p.id,t.descripcion as descriParte, s.descripcion as descriSubParte, p.capacidad  from  partes p
        inner join subtipoParte s on (s.id = p.idSubtipoParte )
        inner join tipoparte t on (t.id = s.idParte)
        where t.descripcion = 'Ram'    
        and p.idHardware = 0
        and p.idEstadoParte = 0
        ";
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        $ram = $this->get_table_assoc($consulta);
        return $ram;  
    }
    public function traerDiscosDisponibles()
    {
        $sql = "select id from tipoparte where descripcion = 'Disco' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $ArridTipoParte = mysql_fetch_assoc($consulta);
        $idTipoParteDisco = $ArridTipoParte['id'];



        $sql = "select p.id,t.descripcion as descriParte, s.descripcion as descriSubParte, p.capacidad  from  partes p
        inner join subtipoParte s on (s.id = p.idSubtipoParte )
        inner join tipoparte t on (t.id = s.idParte)
        where t.descripcion = 'Disco'    
        and p.idHardware = 0
        and p.idEstadoParte = 0
        ";
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        $discos = $this->get_table_assoc($consulta);
        return $discos;  
    }
    
    public function traerParteConIdSubtipoyCapacidad($idSubtipo,$capacidad)
    {
        $sql = "select * from partes 
        where idSubtipoParte = '".$idSubtipo."'    
        and capacidad = '".$capacidad."' 
        order by id asc limit 1  "; 
        die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        $filas = mysql_num_rows($consulta); 
        $arrParte = mysql_fetch_assoc($consulta); 
        $respu['filas'] = $filas;
        $respu['info'] = $arrParte; 
        return $respu ; 
    }

    public function desligarParteDeHardware($idDisco)
    {
        $sql = "update partes set idHardware = 0 where id = '".$idDisco."'  "; 
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    
    public function asociarHardwareEnTablaPartes($request)
    {
        $sql = "update partes set  idHardware = '".$request['idHardware']."'      where id=  '".$request['idDisco']."'  "; 
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    public function asociarRamHardwareEnTablaPartes($request)
    {
        $sql = "update partes set  idHardware = '".$request['idHardware']."'      where id=  '".$request['idRam']."'  "; 
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    public function desligarRamDeHardware($request)
    {
        $sql = "update partes set  idHardware = 0      where id=  '".$request['idRam']."'  "; 
        $consulta = mysql_query($sql,$this->connectMysql());
        
    }
    public function cambiarEstadodePArte($idParte,$estado)
    {
        $sql = "update partes set estado = '".$estado."'  where idParte = '".$idParte."' ";
        $consulta = mysql_query($sql,$this->connectMysql());

    }

}