<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);
require_once($raiz.'/impuestos/models/ImpuestoModel.php'); 

require_once($raiz.'/conexion/Conexion.php');

class PedidoModel extends Conexion
{
    protected $impuestoModel;

        public function __construct()
        {
            $this->impuestoModel = new ImpuestoModel();
        }
        public function traerPedidos()
        {
            $sql = "select * from pedidos ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $pedidos = $this->get_table_assoc($consulta);
            return $pedidos;
        }
        public function traerPedidoId($id)
        {
            $sql = "select * from pedidos where idPedido = '".$id."'   ";
            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());
            $pedido = mysql_fetch_assoc($consulta);
            // echo '<pre>'; 
            // print_r($pedido); 
            // echo '</pre>';
            // die(); 
            return $pedido;
        }

        
        
        public function grabarEncabezadoPedido($request)
        {
            $impuestos = $this->impuestoModel->traerImpuestos();

            $sql = "insert into pedidos (idCliente,fecha,porcenretefuente,porcenreteica)   
                values ('".$request['idEmpresaCliente']."',now(),'".$impuestos['porcenretefuente']."','".$impuestos['porcenreteica']."')";
                $consulta = mysql_query($sql,$this->connectMysql());
                //  die($sql); 
            $ultimoId =  $this->obtenerUltimoIdPedidos();   
            return $ultimoId;
        }
        
        public function obtenerUltimoIdPedidos()
        {
            $sql = "select max(idPedido) as maximo from pedidos ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $arr = mysql_fetch_assoc($consulta);
            $ultimo = $arr['maximo']; 
            // die($ultimo); 
            return $ultimo;
            
        }
        
        public function actualizarWoPedido($request)
        {
            $sql = "update pedidos set wo = '".$request['valor']."'   where idPedido = '".$request['idPedido']."'    "; 
            $consulta = mysql_query($sql,$this->connectMysql());
        }
        
        public function actualizarRPedido($request)
        {
            $sql = "update pedidos set r = '".$request['valor']."'   where idPedido = '".$request['idPedido']."'    "; 
            $consulta = mysql_query($sql,$this->connectMysql());
        }
        public function actulizarIPedido($request)
        {
            $sql = "update pedidos set i = '".$request['valor']."'   where idPedido = '".$request['idPedido']."'    "; 
            $consulta = mysql_query($sql,$this->connectMysql());
        }
        
        public function actualizarPedido($request)
        {
            $sql = "update pedidos set observaciones = '".$request['comentarios']."'   
                    ,porcenretefuente = '".$request['porcenretefuente']."'   
                     ,porcenreteica = '".$request['porcenreteica']."'   
                    where idPedido = '".$request['idPedido']."'    "; 
            // die($sql); 
            $consulta = mysql_query($sql,$this->connectMysql());
        }
        
        public function realizarAsignacionTecnicoAItem($request)
        {
            $sql = "update itemsInicioPedido  
            set idPrioridad = '".$request['idPrioridad']."' , idTecnico = '".$request['idTecnico']."' , asignado = '1'  
            where id= '".$request['idItemPedido']."'  ";
            // die($sql );         
            $consulta = mysql_query($sql,$this->connectMysql());
        }

        
        
}