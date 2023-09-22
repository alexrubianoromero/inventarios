<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');
require_once($raiz.'/partes/models/PartesModel.php');

class HardwareModel extends Conexion
{
    protected $parteModel; 
    public function __construct()
    {
        $this->parteModel = new PartesModel();
    }
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

    public function totalizarRamHardwareId($idHardware)
    {
        $infoH = $this->verHardware($idHardware);
        $ram1 = $this->parteModel->traerParte($infoH['idRam1']);
        $ram2 = $this->parteModel->traerParte($infoH['idRam2']);
        $ram3 = $this->parteModel->traerParte($infoH['idRam3']);
        $ram4 = $this->parteModel->traerParte($infoH['idRam4']);
        $totalRam = $ram1[0]['capacidad'] + $ram2[0]['capacidad'] + $ram3[0]['capacidad'] + $ram4[0]['capacidad'] ; 
        return $totalRam;
    }
    public function totalizarDiscoHardwareId($idHardware)
    {
        $infoH = $this->verHardware($idHardware);
        $disco1 = $this->parteModel->traerParte($infoH['idDisco1']);
        $disco2 = $this->parteModel->traerParte($infoH['idDisco2']);
        $totalDisco = $disco1[0]['capacidad'] + $disco2[0]['capacidad'] ; 
        return $totalDisco;
    }

    public function agregarTemporalDividirMemoria($request)
    {
        $sql = "insert into tablaTemporalDividirMemoria (idHardware,idSubtipo,capacidad)     
        values ('".$request['idHardware']."','".$request['idSubTipoRamHardware']."','".$request['capacidadRamHardware']."')"; 
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    
    public function traerRegistrosTemporales($idHardware)
    {
        $sql = "select * from tablaTemporalDividirMemoria   where idHardware =  '".$idHardware."'  order by id asc  " ;    
        $consulta = mysql_query($sql,$this->connectMysql());
        $arrTempo = $this->get_table_assoc($consulta); 
        return $arrTempo; 
    }
    
    public function asignarDivisionHadware($idHardware)
    {
        $temporales = $this->traerRegistrosTemporales($idHardware);
        $memorias = [
            "0" => "idRam1",
           "1" => "idRam2",
           "2" => "idRam3",
           "3" => "idRam4"
        ];
        $conta = 0; 
        foreach($temporales as $temp)
        {
            //busque si ya existe la parte con esa caracteristica 
            //si no existe toca crearla 
            $conRam = $this->parteModel->traerParteConIdSubtipoyCapacidad($temp['idSubtipo'],$temp['capacidad']);
            //     echo '<pre>';
            //  print_r($conRam); 
            //  echo '</pre>';
            //  die();
            if($conRam['filas']>0)
            {
                //el id de la parte 
                $idParteRam = $conRam['info']['id'];     
            }else{
                // die('entro aca '); 
                //se debe crear la parte con estas caracteristicas
                $this->parteModel->grabarParteGeneral($temp['idSubtipo'],$temp['capacidad'],'se crea al dividir memoria');
                $idParteRam = $this->parteModel->traerUltimoIdPartes();
            }  
            //ahora asignarle ese idParte a las 4 ram del hardware     
            $sql = "update hardware set ".$memorias[$conta]." =   '".$idParteRam."'  where id = '".$idHardware."'    ";
            $consulta = mysql_query($sql,$this->connectMysql());
            // die ('<br>'.$sql);  
            $conta++; 
        }
        
    }
    
    public function inactivarBotonDividir($idHardware)
    {
        $sql = "update hardware set  ramdividida = '1' where id = '".$idHardware."'  ";    
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    
    public function limpiarTablaDivisionRam($idHardware)
    {
        $sql ="delete from 	tablaTemporalDividirMemoria	 where idHardware = '".$idHardware."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }










    public function desligarRamDeEquipo($request)
    {
        $slots= ['','idRam1','idRam2','idRam3','idRam4'];
        // $ram = $slots[$request['numeroRam']]; 
        $sql = "update hardware set  ".$slots[$request['numeroRam']]." = 0  where  id= '".$request['idHardware']."'   ";
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
    }


    public function desligarDiscoDeEquipo($request)
    {
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die('');
        $slots= ['','idDisco1','idDisco2'];
        $sql = "update hardware set  ".$slots[$request['numeroDisco']]." = 0  where  id= '".$request['idHardware']."'   ";
        //  die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    public function desligarCargadorDeEquipo($request)
    {
        // echo '<pre>';
        // print_r($request); 
        // echo '</pre>';
        // die('');
        $sql = "update hardware set  idCargador = 0  where  id= '".$request['idHardware']."'   ";
        //  die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
    }


    public function asociarParteEnTablaHardware($request)
    {
        $sql = "update hardware set idDisco = '".$request['idDisco']."'      where id =   '".$request['idHardware']."'   "; 
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    public function asociarParteRamEnTablaHardware($request)
    {
        $sql = "update hardware set idRam = '".$request['idRam']."'      where id =   '".$request['idHardware']."'   "; 
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    
    public function grabarNuevoHardware($request)
    {
        $sql = "insert into hardware(idImportacion,lote,serial,idMarca,idTipoInv,idSubInv,
        chasis,modelo,pulgadas,procesador,generacion,ramdividida)
        values ( '".$request['idImportacion']."'
        ,'".$request['lote']."'
        ,'".$request['serial']."'
        ,'".$request['marca']."'
        ,'".$request['itipo']."'
        ,'".$request['isubtipo']."'
        ,'".$request['chasis']."'
        ,'".$request['modelo']."'
        ,'".$request['pulgadas']."'
        ,'".$request['procesador']."'
        ,'".$request['generacion']."'
        ,'1'
        )";
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        
    }
    
    
    //este funcion trae la informacion de la tabla hardware
    //y se soloca el nombre del campo de la tabla hardware 
    public function traerInfoCampoTablaHardware($campo)
    {
        $sql = "select distinct(".$campo.") as id from hardware group by ".$campo ;
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        $arrIdImport = $this->get_table_assoc($consulta); 
        return $arrIdImport;
    }

    //esta funcion trae el campo tal cual osea graba el valor de la descripcion 
    //esto para evitar despues tener que buscar el id 
    //entonces simplmente se pone el valor y ya 
    public function traerInfoCampoTabla($campo)
    {
        $sql = "select distinct(".$campo.") as id from ".$campo." group by ".$campo ;
        //  die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        $arrIdImport = $this->get_table_assoc($consulta); 
        return $arrIdImport;
    }
    public function traerInfoTablaParaColocarenSelect($campo)
    {
        $sql = "select id , ".$campo."  as descripcion from ".$campo ;
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        $arrIdImport = $this->get_table_assoc($consulta); 
        return $arrIdImport;
    }
    
    public function traerInfoCampoTablaId($id,$tabla)
    {
        $sql = "select ".$tabla." from ".$tabla." where id = '".$id."'    " ;
        //  die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        $arrIdImport = mysql_fetch_assoc($consulta); 
        return $arrIdImport[$tabla];
    }
    public function actualizarCondicionHardware($request)
    {
        $sql = "update hardware set idCondicion = '".$request['idCondicion']."'  where id='".$request['idHardware']."'"; 
        //  die($sql ); 
        $consulta = mysql_query($sql,$this->connectMysql());
    }

}