<?php


date_default_timezone_set('America/Tegucigalpa');



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Compras</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../../public/img/apple-touch-icon.png">


    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../../public/datatables/jquery.dataTables.min.css">
    <link href="../../public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="../../public/datatables/responsive.dataTables.min.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../../../accesos/CSS/tablas.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxs-factory icon'></i>
            <div class="logo_name">FERRECOMM</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="../Menu.php">
                    <i class='bx bxs-home'></i>
                    <span class="links_name">Inicio</span>
                </a>
                <span class="tooltip">Inicio</span>
            </li>
            <li>
                <a href="../Menu_facturacion.php">
                    <i class='bx bx-money'></i>
                    <span class="links_name">Facturación</span>
                </a>
                <span class="tooltip">Facturación</span>
            </li>
            <li>
                <a href="../Compras.php">
                    <i class='bx bxs-cart'></i>
                    <span class="links_name">Compras</span>
                </a>
                <span class="tooltip">Compras</span>
            </li>
            <li>
                <a href="../Productos.php">
                    <i class='bx bx-shopping-bag'></i>
                    <span class="links_name">Productos</span>
                </a>
                <span class="tooltip">Productos</span>
            </li>
            <li>
            <a href="../categoria.php">
            <i class='bx bxs-category'></i>
                <span class="links_name">Categorias</span>
            </a>
            <span class="tooltip">Categorias</span>
        </li>
        <li>
            <a href="../productos/promocion.php">
            <i class='bx bxs-purchase-tag-alt'></i>
                <span class="links_name">Promociones</span>
            </a>
            <span class="tooltip">Promociones</span>
        </li>
            <li>
                <a href=".../Seguridad.php">
                    <i class='bx bx-shield-quarter'></i>
                    <span class="links_name">Seguridad</span>
                </a>
                <span class="tooltip">Seguridad</span>
            </li>
            <li>
                <a href="../Proveedores.php">
                    <i class='bx bxs-user'></i>
                    <span class="links_name">Proveedores</span>
                </a>
                <span class="tooltip">Proveedores</span>
            </li>
            <li>
                <a href="../Inventario.php">
                    <i class='bx bx-package'></i>
                    <span class="links_name">Inventario</span>
                </a>
                <span class="tooltip">Inventario</span>
            </li>
            <a href="../../../index.php">
                <li class="profile">
                    <i class='bx bx-log-out' id="log_out"></i>
                    <div class="Salir">Cerrar Sesión</div>
                </li>
            </a>
        </ul>
    </div> <!-- Main content -->
    <section class="content" style="background-color: #DCFFFE;">
        <h2 style="text-align: center;  color: rgba(255, 102, 0, 0.91);"> Añadir Nuevo Rol <i
                class='bx bxs-cart'></i></h2>
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">

                    </div>
                    <div class="panel-body" style="height: auto;" id="formularioregistros">
                        <form name="formulario2" id="formulario2" method="POST">
                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <label>Nombre de Rol :</label>
                                <input type="text" class="form-control" name="NombreRol" id="NombreRol"
                                    maxlength="20" placeholder="" required="" ></input>
                              
                            </div>
                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <label>Descripcion de Rol :</label>
                                <input type="text" class="form-control" name="Descripcion" id="Descripcion"
                                    maxlength="20" placeholder="" required="" ></input>
                            
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Fecha(*):</label>
                                <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required=""
                                    value="<?php echo date("Y-m-d") ?>">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Estado Rol </label>
                                <input type="hidden" name="idRol" id="idRol">
                                <select name="EstadoRol" id="EstadoRol" class="form-control selectpicker"
                                    required="">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                  
                                </select>
                            </div>
                           
                        
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" onclick="guardaryeditar()" type="submit"
                                    id="btnGuardar2"><i class="fa fa-save"></i>
                                    Guardar</button>

                                <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()"
                                    type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->


    <!-- Fin modal -->
    <div>
        <style>
            .row {
                margin-right: 321px;
                margin-left: 375px;
            }

            .content {
                min-height: 950px;

            }

            .link_edit {
                color: green;
                font-size: 25px;
            }


            .link_delete {
                color: red;
                font-size: 25px;
            }
        </style>

        <div class="form-group col-md-6" id="tbldiv">
            <!--PODER VER LA CLAVE NUEVO USUARIO-->
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">

                    </div>
                </div>
            </div>
        </div>
        </form>
        <script src="../formularioproducto.js"></script>

        <script>
            let sidebar = document.querySelector(".sidebar");
            let closeBtn = document.querySelector("#btn");
            let searchBtn = document.querySelector(".bx-search");

            closeBtn.addEventListener("click", () => {
                sidebar.classList.toggle("open");
                menuBtnChange();
            });
            function menuBtnChange() {
                if (sidebar.classList.contains("open")) {
                    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
                } else {
                    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
                }
            }
        </script>
        <!-- jQuery -->
        <script src="../../public/js/jquery-3.1.1.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="../../public/js/bootstrap.min.js"></script>

        <!-- AdminLTE App -->
        <script src="../../public/js/app.min.js"></script>

        <!-- DATATABLES -->
        <script src="../../public/datatables/jquery.dataTables.min.js"></script>
        <script src="../../public/datatables/dataTables.buttons.min.js"></script>
        <script src="../../public/datatables/buttons.html5.min.js"></script>
        <script src="../../public/datatables/buttons.colVis.min.js"></script>
        <script src="../../public/datatables/jszip.min.js"></script>
        <script src="../../public/datatables/pdfmake.min.js"></script>
        <script src="../../public/datatables/vfs_fonts.js"></script>

        <script src="../../public/js/bootbox.min.js"></script>
        <script src="../../public/js/bootstrap-select.min.js"></script>



        <script src="../../../js/functions_roles.js"></script>
    </div>
    <style>
        .modal-body {
            position: relative;
            padding: 0px;

        }

        .modal-dialog {
            width: 50%;
        }
    </style>
</body>

</html>