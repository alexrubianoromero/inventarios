<?php
$raiz = dirname(dirname(dirname(__file__)));
 require_once($raiz.'/vista/vista.php');  

class usersView 
{
    public function usersMenu($users)
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

            <h3 align="right">Usuarios</h3>
            <div id="botones">
                <!-- Button trigger modal -->
                <button type="button" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalUsuario"
                    class="btn btn-primary" 
                    onclick="pedirInfoUsuario();"
                    >
                    Crear Usuario
                </button>
            </div>
            <div id="resultados">
                <table class="table table-striped hover-hover">
                    <thead>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Perfil</th>
                    </thead>
                    <tbody>
                        
                        <?php
                      foreach($users as $user)
                      {
                          echo '<tr>'; 
                          echo '<td>'.$user['nombre'].' '.$user['apellido']. '</td>';
                          echo '<td>'.$user['login'].'</td>';
                          echo '<td>'.$user['nombre_perfil'].'</td>';
                          echo '</tr>';  
                        }
                        ?>
                    </tbody>
                </table> 
            </div>
            
            
            <?php  $this->modalUsuario();  ?>
            
            
        </div>

        </body>
        <script src="../js/users.js"></script>
        </html>
        <?php
    }
    public function modalUsuario()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Creacion de Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyUsuario">
                    ...
                </div>
                <div class="modal-footer">
                    <button onclick="users();" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button onclick ="crearUsuario();" type="button" class="btn btn-primary">Crear Usuario</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    
    public function pedirInfoUsuario()
    {
        ?>
        <div class="row">
                <div class="col-md-6">
                    <label for="">Nombre:</label>
                      <input class ="form-control" type="text" id="nombreUsuario">          
                </div>
                <div class="col-md-6">
                    <label for="">Apellido:</label>
                      <input class ="form-control" type="text" id="apellidoUsuario">          
                </div>
        </div>
        <div class="row">
                <div class="col-md-6">
                    <label for="">Password:</label>
                      <input class ="form-control" type="text" id="password">          
                </div>
                <div class="col-md-6">
                    <label for="">email:</label>
                      <input class ="form-control" type="text" id="email">          
                </div>
        </div>

        <?php
    }

}

?>