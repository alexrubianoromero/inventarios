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
                        <th>Id.</th>
                        <th>Parte</th>
                        <th>Tipo</th>
                        <th>capacidad</th>
                        <th>Movimientos</th>
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
                          echo '<td><button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalVerMovimientos"
                                    class="btn btn-primary btn-sm " 
                                    onclick="verMovimientosParte('.$parte['id'].');"
                                    >Mov</button></td>';
                          echo '</tr>';  
                        }
                        ?>
                    </tbody>
                </table> 
                
                
            </div>
                
                <?php  
            $this->modalVerMovimientos();  
        
            ?>
            
            
        </div>
        <?php
    }

    public function modalVerMovimientos()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalVerMovimientos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Movimientos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyVerMovimientos">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="" >SubirArchivo++</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }

}

?>