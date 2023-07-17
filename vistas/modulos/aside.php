    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">INVENTARIOS D47G</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
       

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- <li class="nav-item">
                        <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas/dashboard.php','content-wrapper');">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Tablero Principal
                            </p>
                        </a>
                    </li>    
                 -->
    
                    <!-- <li class="nav-item menu-open"> -->
                    <!-- <li class="nav-item ">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Productos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Inventario</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Carga Masiva</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categorias</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="nav-item">
                    <a style="cursor:pointer;" class="nav-link" onclick="sucursales();">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Sucursales
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a style="cursor:pointer;" class="nav-link" onclick="users();">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a style="cursor:pointer;" class="nav-link" onclick="perfiles();">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Perfiles
                            </p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                    <a style="cursor:pointer;" class="nav-link" onclick="CargarContenido('vistas/compras.php','content-wrapper');">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Compras
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Reportes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Configuracion
                            </p>
                        </a>
                    </li> -->
                    <li class="nav-item">
                    <a style="cursor:pointer;" class="nav-link" onclick="salir();">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Salir
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <script>
        $(".nav-link").on('click',function(){
            $(".nav-link").removeClass('active');
            $(this).addClass('active');
        })
    </script>