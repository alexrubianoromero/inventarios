<?php
$raiz = dirname(dirname(dirname(__file__)));
// die('vista');
// require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/pedidos/models/PedidoModel.php'); 
require_once($raiz.'/login/models/UsuarioModel.php'); 
// require_once($raiz.'/partes/models/PartesModel.php'); 
// require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 
// require_once($raiz.'/marcas/models/MarcaModel.php'); 
// require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 
require_once($raiz.'/vista/vista.php'); 

class tableroTecnicosView extends vista
{
    protected $pedidoModel;
    protected $usuarioModel;
    // protected $hardwareModel;
    // protected $partesModel;
    // protected $SubtipoParteModel;
    // protected $MarcaModel;
    // protected $tipoParteModel;

    public function __construct()
    {
        // echo 'llego a vista '; 
        $this->pedidoModel = new PedidoModel();
        $this->usuarioModel = new UsuarioModel();
    }



    public function tablerotecnicosMenu()
    {
      ?>
       <div style="padding:10px;"  id="div_general_tablero_tecnicos">
        <div id="div_botonesyfiltros">
              
            </div>
            <div id="div_resultados_tableros_tecnicos">
                <?php  $this->mostrarTableroTecnico();  ?>

            </div>
       </div>
      <?php
    }

    public function mostrarTableroTecnico()
    {
        // echo 'pasooo 1 '; 
         $tecnicosAsginados = $this->pedidoModel->traerLosTecnicosConAsginacion(); 
        //  $this->printR($tecnicosAsginados); 
        
        
        // $this->printR($tecnicosAsginados);
        //traer los items de pedidos  que esten asignados a un tecnico  
        //la idea seria traerlos agrupados por tecnico 
        // $hardwards = $this->HardwareModel->traerHardware(); 
        ?>
          <table class="table table-striped hover-hover">
              <thead>
                  <th>Id</th>
                  <th>Nombre </th>
                  <th>Ver</th>
                </thead>
                <tbody>
                    <?php
                      foreach($tecnicosAsginados as $tecnico)
                      {
                        //    $this->printR($tecnico); 

                          $infoTecnico = $this->usuarioModel->traerInfoId($tecnico['idTecnico']);   
                          echo '<tr>'; 
                          echo '<td>'.$infoTecnico['id_usuario'].'</td>';
                          echo '<td>'.$infoTecnico['nombre'].' '.$infoTecnico['apellido'].'</td>';
                      
                           echo '<td><button 
                                     class="btn btn-primary btn-sm " 
                                     onclick="verItemsAsignadosTecnico('.$infoTecnico['id_usuario'].');"
                                     >Ver</button></td>';
                           echo '</tr>';  
                        }
                        ?>
                    </tbody>
                </table> 
        <?php
    }


}