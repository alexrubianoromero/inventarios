<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/partes/models/PartesModel.php'); 
require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 
require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 

class partesView
{
    protected $hardwareModel;
    protected $partesModel;
    protected $SubtipoParteModel;
    protected $TipoParteModel;

    public function __construct()
    {
        $this->hardwareModel = new HardwareModel();
        $this->partesModel = new PartesModel();
        $this->SubtipoParteModel = new SubtipoParteModel();
        $this->TipoParteModel = new TipoParteModel();
    }


    public function partesMenu($partes)
    {
        ?>
        <div style="padding:10px;">

            <div id="botones" class="">
                <!-- Button trigger modal -->
                <!-- <button type="button" 
                data-bs-toggle="modal" 
                data-bs-target="#modalInventario"
                class="btn btn-primary  float-right" 
                onclick="pedirInfoProducto();"
                >
                Crear Computador/Monitor
            </button> -->
            </div>
            <div id="resultadosPartes">
                <table class="table table-striped hover-hover">
                    <thead>
                        <th>Id</th>
                        <th>Parte</th>
                        <th>Tipo</th>
                        <th>capacidad</th>
                    </thead>
                <tbody>
                    <?php
                      foreach($partes as $parte)
                      {
                        $subTipoParte = $this->SubtipoParteModel->traerSubTipoParte($parte['idSubtipoParte']);
                        $tipoParte =  $this->TipoParteModel->traerTipoParteConId($subTipoParte[0]['idParte']); 
                          // $infoSucursal = $this->sucursalModel->traerSucursalId($user['idSucursal']); 
                          // $infoPerfil = $this->perfilModel->traerPerfilId($user['id_perfil']); 
                        //   $tipoParte = $this->tipoParteModel->traerTipoParteId($inventario['idTipoParte']); 
                          echo '<tr>'; 
                          echo '<td>'.$parte['id'].'</td>';
                          echo '<td>'.$tipoParte[0]['descripcion'].'</td>';
                          echo '<td>'.$subTipoParte[0]['descripcion'].'</td>';
                          echo '<td>'.$parte['capacidad'].'</td>';
                          echo '<td>';
                          //       echo '<button 
                          //       data-bs-toggle="modal" 
                          // data-bs-target="#modalInventarioMostrar321"
                          //       onclick="verProducto('.$inventario['idInventario'].');" class="btn btn-primary btn-sm m-2">
                          //       Ver
                          //       </button>' ;
                          //   echo '<button onclick="verProducto123('.$inventario['idInventario'].');" class="btn btn-primary btn-sm m-2">
                          //   <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                          //   </button>' ;
                          //   echo '<button onclick="verProducto('.$inventario['idInventario'].');" class="btn btn-primary btn-sm m-2">Ver</button>' ;
                          echo '</td>';
                          echo '</tr>';  
                        }
                        ?>
                    </tbody>
                </table> 
                
                
            </div>
                
                <?php  
            $this->modalInventario();  
            $this->modalInventarioMostrar();  
        
            ?>
            
            
        </div>
        <?php
    }


}

?>