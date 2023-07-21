<?php

class inventariosView
{

    public function inventariosMenu($inventarios)
    {

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            
      
        <div class="row" style="padding:10px;" id="div_principal_usuarios321">

            <h3 align="right">Inventarios</h3>
            <div id="botones">
                <!-- Button trigger modal -->
                <button type="button" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalInventario"
                    class="btn btn-primary" 
                    onclick="pedirInfoProducto();"
                    >
                    Crear producto 
                </button>
            </div>
            <div id="resultados">
                <table class="table table-striped hover-hover">
                    <thead>
                      
                        <th>Serial</th>
                        <th>Procesador</th>
                        <th>Generacion</th>
                        <th>Ram</th>
                        <th>Tipo Disco</th>
                        <th>Acciones</th>

                    </thead>
                    <tbody>
                        
                        <?php
                      foreach($inventarios as $inventario)
                      {
                        // $infoSucursal = $this->sucursalModel->traerSucursalId($user['idSucursal']); 
                        // $infoPerfil = $this->perfilModel->traerPerfilId($user['id_perfil']); 
                          echo '<tr>'; 
                          echo '<td>'.$inventario['serial'].'</td>';
                          echo '<td>'.$inventario['procesador'].'</td>';
                          echo '<td>'.$inventario['generacion'].'</td>';
                          echo '<td>'.$inventario['ram'].'</td>';
                          echo '<td>'.$inventario['discoTipo'].'</td>';
                          echo '<td>';
                          echo '<button 
                          data-bs-toggle="modal" 
                    data-bs-target="#modalInventarioMostrar"
                          onclick="verProducto('.$inventario['idInventario'].');" class="btn btn-primary btn-sm m-2">
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
            $this->modalInventario();  
            $this->modalInventarioMostrar();  
            ?>
            
            
        </div>

        </body>
        <script src="../js/inventarios.js"></script>
        </html>
        <?php
    }

    public function modalInventario()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalInventario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Creacion de Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyInventario">
                    ...
                </div>
                <div class="modal-footer">
                    <button onclick="inventarios();" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button onclick ="crearProducto();" type="button" class="btn btn-primary">Crear Producto</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalInventarioMostrar()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalInventarioMostrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info y Edicion Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyInventarioMostrar">
                    ...
                </div>
                <div class="modal-footer">
                    <button onclick="inventarios();" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- <button onclick ="actualizarProducto();" type="button" class="btn btn-primary">Actualizar Producto</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }


    public function pedirInfoProducto()
    {
        ?>
        <div class="row">
                <div class="col-md-3">
                    <label for="">Id Import:</label>
                      <input class ="form-control" type="text" id="idImportacion">          
                </div>
                <div class="col-md-3">
                    <label for="">Lote:</label>
                      <input class ="form-control" type="text" id="lote">          
                </div>
                <div class="col-md-3">
                    <label for="">Serial:</label>
                      <input class ="form-control" type="text" id="serial">          
                </div>
                <div class="col-md-3">
                    <label for="">Marca:</label>
                      <input class ="form-control" type="text" id="marca">          
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Tipo_Prod:</label>
                      <input class ="form-control" type="text" id="tipoProd">          
                </div>
                <div class="col-md-3">
                    <label for="">Chasis:</label>
                      <input class ="form-control" type="text" id="chasis">          
                </div>
                <div class="col-md-3">
                    <label for="">Modelo:</label>
                      <input class ="form-control" type="text" id="modelo">          
                </div>
                <div class="col-md-3">
                    <label for="">pulgadas:</label>
                      <input class ="form-control" type="text" id="pulgadas">          
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Procesador:</label>
                      <input class ="form-control" type="text" id="procesador">          
                </div>
                <div class="col-md-3">
                    <label for="">Generacion:</label>
                      <input class ="form-control" type="text" id="generacion">          
                </div>
                <div class="col-md-3">
                    <label for="">Ram_Tipo:</label>
                      <input class ="form-control" type="text" id="ramTipo">          
                </div>
                <div class="col-md-3">
                    <label for="">Ram:</label>
                      <input class ="form-control" type="text" id="ram">          
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Disco_TIpo:</label>
                      <input class ="form-control" type="text" id="discoTipo">          
                </div>
                <div class="col-md-3">
                    <label for="">CapaDisco:</label>
                      <input class ="form-control" type="text" id="capacidadDisco">          
                </div>
                
               
        </div>
        <br>
        <div class="row">
                <div class="col-md-12 mt-03">
                    
                      <textarea class="form-control" id="comentarios" rows="4" placeholder="Comentarios"></textarea>     
                </div>
             
               
        </div>
       
        


        <?php
    }

    public function verProducto($producto)
    {
        ?>
        <div class="row">
                <div class="col-md-3">
                    <label for="">Id Import:</label>
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
                      <input class ="form-control" type="text" id="marca" value ="<?php  echo $producto['marca'] ?>">          
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Tipo_Prod:</label>
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
                    <label for="">pulgadas:</label>
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
                    <label for="">Ram_Tipo:</label>
                      <input class ="form-control" type="text" id="ramTipo" value ="<?php  echo $producto['ramTipo'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">Ram:</label>
                      <input class ="form-control" type="text" id="ram" value ="<?php  echo $producto['ram'] ?>">          
                </div>
        </div>
        <div class="row mt-3">
                <div class="col-md-3">
                    <label for="">Disco_TIpo:</label>
                      <input class ="form-control" type="text" id="discoTipo" value ="<?php  echo $producto['discoTipo'] ?>">          
                </div>
                <div class="col-md-3">
                    <label for="">CapaDisco:</label>
                      <input class ="form-control" type="text" id="capacidadDisco" value ="<?php  echo $producto['capacidadDisco'] ?>">          
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


}