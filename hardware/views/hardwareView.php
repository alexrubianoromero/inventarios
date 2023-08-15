<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/hardware/models/HardwareModel.php'); 
require_once($raiz.'/partes/models/PartesModel.php'); 
require_once($raiz.'/subtipos/models/SubtipoParteModel.php'); 
require_once($raiz.'/marcas/models/MarcaModel.php'); 

class hardwareView
{
    protected $hardwareModel;
    protected $partesModel;
    protected $SubtipoParteModel;
    protected $MarcaModel;

    public function __construct()
    {
        $this->hardwareModel = new HardwareModel();
        $this->partesModel = new PartesModel();
        $this->SubtipoParteModel = new SubtipoParteModel();
        $this->MarcaModel = new MarcaModel();
    }
    public function hardwareMenu($hardware)
    {
        ?>
        <div  style="padding:10px;">

            <div id="botones" class="mt-3">
                <button type="button" 
                data-bs-toggle="modal" 
                data-bs-target="#modalSubirArchivo"
                class="btn btn-primary  float-right" 
                onclick="formularioSubirArchivo()"
                >
                    Subir Archivo
                </button>
            </div>
            <!-- <div id="botones" class="mt-3">
                <button type="button" 
                data-bs-toggle="modal" 
                data-bs-target="#modalInventario"
                class="btn btn-primary  float-right" 
                onclick="pedirInfoProducto();"
                >
                    Crear Computador/Monitor
                </button>
            </div> -->
            <div id="divResultadosHardware">
                <table class="table table-striped hover-hover">
                    <thead>
                        
                        <th>Serial</th>
                        <th>Pulgadas</th>
                        <th>Procesador</th>
                        <th>Generacion</th>
                        <!-- <th>Id Ram</th> -->
                        <th>Ram</th>
                        <!-- <th>Id Disco</th> -->
                        <th>Tipo Disco</th>
                        <th>Cap.Disco</th>
                        <th>Acciones</th>
                        
                    </thead>
                    <tbody>
                        
                        <?php
                      foreach($hardware as $hard)
                      {
                        $ram =  $this->partesModel->traerParte($hard['idRam']);
                        $subTipoRam = $this->SubtipoParteModel->traerSubTipoParte($ram[0]['idSubtipoParte']);
                        // echo '<pre>'; print_r($ram); echo '</pre>'; die();
                        
                        $disco =  $this->partesModel->traerParte($hard['idDisco']);
                        $subTipoDisco = $this->SubtipoParteModel->traerSubTipoParte($disco[0]['idSubtipoParte']);
                          // $infoSucursal = $this->sucursalModel->traerSucursalId($user['idSucursal']); 
                          // $infoPerfil = $this->perfilModel->traerPerfilId($user['id_perfil']); 
                          echo '<tr>'; 
                          echo '<td>'.$hard['serial'].'</td>';
                          echo '<td>'.$hard['pulgadas'].'</td>';
                          echo '<td>'.$hard['procesador'].'</td>';
                          echo '<td>'.$hard['generacion'].'</td>';
                        //   echo '<td>'.$hard['idRam'].'</td>';
                          echo '<td>'.$ram[0]['capacidad'].'GB-'.$subTipoRam[0]['descripcion'].'</td>';
                        //   echo '<td>'.$hard['idDisco'].'</td>';
                          echo '<td>'.$subTipoDisco[0]['descripcion'].'</td>';
                          echo '<td>'.$disco[0]['capacidad'].'</td>';
                          echo '<td>';
                          echo '<button 
                          data-bs-toggle="modal" 
                          data-bs-target="#modalHardwareMostrar"
                          onclick="verHardware('.$hard['id'].');" class="btn btn-primary btn-sm ">
                          Ver
                          </button>' ;
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
            // $this->modalInventario();  
            // $this->modalInventarioMostrar();  
            $this->modalSubirArchivo();  
            $this->modalHardwareMostrar();  
            $this->modalAgregarRam();  
            ?>

            
            
        </div>
        <?php
    }
    public function modalSubirArchivo()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalSubirArchivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Subir Archivo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodySubirArchivo">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="realizarCargaArchivo();" >SubirArchivo++</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalHardwareMostrar()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalHardwareMostrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info y Edicion Hardware</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyHardwareMostrar">
                    ...
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();">Cerrar</button>
                    <!-- <button onclick ="actualizarProducto();" type="button" class="btn btn-primary">Actualizar Producto</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalAgregarRam()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalAgregarRam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar o Quitar Parte</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyAgregarRam">
                    ...
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();">Cerrar</button>
                    <!-- <button onclick ="actualizarProducto();" type="button" class="btn btn-primary">Actualizar Producto</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }

    public function formularioSubirArchivo()
    {
        // echo 'subir archivo '; 
        ?>
        <div id="div_cargue_archivo">
                <input name="imagen" id="imagen" type="file">
                <br><br><br><br>
                <!-- <button onclick="procesarformu();" >Procesar</button> -->
                <br><br>
                <!-- <button id="btnEnviar">Enviar!!</button> -->
                <!-- </form> -->
                <div id="div_muestre_resultado"></div>
                <span id="demo"></span>
        </div>
        
        <?php

    }

    
    public function verHardware($producto)
    {
        $marca = $this->MarcaModel->traerMarcaId($producto['id']);
        $disco = $this->partesModel->traerParte($producto['idDisco']);
        $subTipoDisco = $this->SubtipoParteModel->traerSubTipoParte($disco[0]['idSubtipoParte']);
        $ram = $this->partesModel->traerParte($producto['idRam']);
        $subTipoRam = $this->SubtipoParteModel->traerSubTipoParte($ram[0]['idSubtipoParte']);
        // die('llego a la vista 123');
        ?>
        <div class="row">
                <div class="col-md-3">
                    <label for="">Importacion #:</label>
                      <input class ="form-control" type="text" id="idImportacion" value ="<?php  echo $producto['idImportacion'] ?>" >          
                </div>
                <div class="col-md-3">
                    <label for="">Lote:</label>
                      <input class ="form-control" type="text" id="lote" value ="<?php  echo $producto['lote'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Serial:</label>
                      <input class ="form-control" type="text" id="serial" value ="<?php  echo $producto['serial'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Marca:</label>
                      <input class ="form-control" type="hidden" id="marca" value ="<?php  echo $producto['marca'] ?>">   
                      <input class ="form-control" type="text" id="nombremarca" onfocus="blur();" value ="<?php  echo $marca[0]['marca'] ?>">   
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Producto:</label>
                      <input class ="form-control" type="text" id="tipoProd" value ="<?php  echo $producto['idTipoProducto'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Chasis:</label>
                      <input class ="form-control" type="text" id="chasis" value ="<?php  echo $producto['chasis'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Modelo:</label>
                      <input class ="form-control" type="text" id="modelo" value ="<?php  echo $producto['modelo'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Pulgadas:</label>
                      <input class ="form-control" type="text" id="pulgadas" value ="<?php  echo $producto['pulgadas'] ?>">          
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Procesador:</label>
                      <input class ="form-control" type="text" id="procesador" value ="<?php  echo $producto['procesador'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Generacion:</label>
                      <input class ="form-control" type="text" id="generacion" value ="<?php  echo $producto['generacion'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Ram Tipo:</label>
                      <input class ="form-control" type="text" onfocus="blur();" value ="<?php  echo $subTipoRam[0]['descripcion']  ?>">   
                </div>
                <div class="col-md-3">
                    <label for="">Ram (GB):</label>
                    <input class ="form-control" type="text" onfocus="blur();" value ="<?php  echo $ram[0]['capacidad']    ?>">   
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Disco TIpo:</label>
                    <input class ="form-control" type="text" onfocus="blur();" value ="<?php  echo $subTipoDisco[0]['descripcion']   ?>">  
                    
                </div>
                <div class="col-md-3">
                    <label for="">Disco (GB):</label>
                      <input class ="form-control" type="text"  onfocus="blur();"value ="<?php  echo $disco[0]['capacidad'] ?>">          
                </div>
                
               
        </div>

        <!--  botones de quitar ram y disco   -->
        <div class="row mt-3">
            <div class="col-md-6">
                <?php 
                if($producto['idRam']==0)
                {
                    echo '<button 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalAgregarRam"
                        class ="btn btn-success" 
                        onclick="formuAgregarRam('.$producto['id'].');"
                        >AGREGAR RAM</button>';

                }else{
                    echo '<button 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalAgregarRam"
                        class ="btn btn-primary" 
                        onclick="quitarRam('.$producto['id'].','.$producto['idRam'].');"
                        >QUITAR RAM</button>';

                }
                ?>
            </div>    
            <div class="col-md-6">
            <?php 
            if($producto['idDisco']==0)
                {
                    echo '<button 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalAgregarRam"
                            class ="btn btn-success" 
                            onclick="formuAgregarDisco('.$producto['id'].');"
                            >AGREGAR DISCO</button>';

                }else{
                    echo '<button 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalAgregarRam"
                            class ="btn btn-primary" 
                            onclick="quitarDisco('.$producto['id'].','.$producto['idDisco'].');"
                            >QUITAR DISCO</button>';
                }
             ?>       
            </div>    
        </div>
        <br>
        <div class="row">
                <div class="col-md-12 mt-03">
                    
                      <textarea class="form-control" id="comentarios" rows="4" placeholder="Comentarios"><?php  echo $producto['comentarios']  ?></textarea>     
                </div>
             
               
        </div>
       
        


        <?php
    }


    public function formuAgregarRam($idHardware)
    {
        $memorias = $this->partesModel->traerMemoriasDisponibles();
        // echo '<pre>';
        // print_r($memorias); 
        // echo '</pre>';
        // die();

       
       ?>
       <div>
          <h3>Escoja la ram a agregar</h3>
          <table class="table">
            <thead>

                <tr>
                    <td>Id</td>
                    <td>Parte</td>
                    <td>Subtipo</td>
                    <td>Capacidad</td>
                    <td>Acciones</td>


                </tr>

            </thead>
            <tbody>
                <?php
                    foreach($memorias as $memoria)
                    {
                        echo '<tr>'; 
                        echo '<td>'.$memoria['id'].'</td>';
                        echo '<td>'.$memoria['descriParte'].'</td>';
                        echo '<td>'.$memoria['descriSubParte'].'</td>';
                        echo '<td>'.$memoria['capacidad'].'</td>';
                        echo '<td><button class ="btn btn-primary" onclick ="agregarMemoriaRam('.$idHardware.','.$memoria['id'].');">Agregar</button></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
          </table>
            
       </div>
       <?php
    }


    public function formuAgregarDisco($idHardware)
    {
        $discos = $this->partesModel->traerDiscosDisponibles();
        // echo '<pre>';
        // print_r($discos); 
        // echo '</pre>';
        // die();

       
       ?>
       <div>
          <h3>Escoja el Disco a agregar</h3>
          <table class="table">
            <thead>

                <tr>
                    <td>Id</td>
                    <td>Parte</td>
                    <td>Subtipo</td>
                    <td>Capacidad</td>
                    <td>Acciones</td>


                </tr>

            </thead>
            <tbody>
                <?php
                    foreach($discos as $disco)
                    {
                        echo '<tr>'; 
                        echo '<td>'.$disco['id'].'</td>';
                        echo '<td>'.$disco['descriParte'].'</td>';
                        echo '<td>'.$disco['descriSubParte'].'</td>';
                        echo '<td>'.$disco['capacidad'].'</td>';
                        echo '<td><button class ="btn btn-primary" onclick ="agregarDisco('.$idHardware.','.$disco['id'].');">Agregar</button></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
          </table>
            
       </div>
       <?php
    }




}
?>