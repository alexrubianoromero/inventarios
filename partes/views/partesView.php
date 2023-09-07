<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/partes/models/PartesModel.php'); 
require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 
require_once($raiz.'/tipoParte/models/TipoParteModel.php'); 
// require_once($raiz.'/marcas/models/MarcaModel.php'); 
require_once($raiz.'/vista/vista.php'); 

class partesView extends vista
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

            <div id="botones" >
                <button type="button" 
                data-bs-toggle="modal" 
                data-bs-target="#modalCreacionParte"
                class="btn btn-primary  float-right" 
                onclick="formuCreacionParte();"
                >
                Crear Parte
            </button>
            </div>
            <div id="resultadosPartes">
               
                <?php  $this->traerPartes($partes);  ?>
                
            </div>
                
                <?php  
            $this->modalVerMovimientos();  
            $this->modalCreacionParte();  
        
            ?>
            
            
        </div>
        <?php
    }

    public function traerPartes($partes)
    {
    ?>
         <table class="table table-striped hover-hover">
                    <thead>
                        <th>Id.</th>
                        <th>Parte</th>
                        <th>Tipo</th>
                        <th>Capacidad</th>
                        <th>Cantidad</th>
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
                          echo '<td>'.$parte['cantidad'].'</td>';
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

    public function modalCreacionParte()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalCreacionParte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Movimientos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyCreacionParte">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="partesMenu();" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="" >SubirArchivo++</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }

    public function formuCreacionParte()
    {
        $tipopartes = $this->TipoParteModel->traerTipoParteHardware('2');
        ?>
         <div class="row">
                <div class="col-md-3">
                    <!-- computador monitor impresora -->
                    <label for="">Tipo:</label>
                    <select class ="form-control"  id="itipo" onchange="buscarSuptiposParaSelect();">
                            <?php  $this->colocarSelect($tipopartes);  ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Subtipo:</label>
                    <select class ="form-control"  id="isubtipo">
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Capacidad</label>
                      <input class ="form-control" type="text" id="capacidad" value ="<?php  echo $producto['capacidad'] ?>">          
                </div>
            
        </div>
        <div class="row">
                <button type="button" 
                class="btn btn-primary  float-right mt-3" 
                onclick="grabarNuevaParte()"
                >
                Grabar Parte
            </button>
       </div>
        <?php
    }

}

?>