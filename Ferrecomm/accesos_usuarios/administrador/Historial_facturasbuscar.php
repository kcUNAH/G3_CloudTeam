<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../accesos/CSS/tablahistorial.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <?php include "Header.php"; ?>
</head>

<body>

    <section class="home-section">

    </br>
        <h1> HISTORIAL DE FACTURAS <i class='bx bx-shopping-bag'></i> </h1>
        <?php include 'conex.php'; ?>

        <section id="container">

        <?php
       
       $busqueda = strtolower($_REQUEST['busqueda']);
       if(empty($busqueda))
       {
    echo '<script>
        window.location.href= "Historial_facturas.php";
        </script>
        ';
       }
      
      ?>

            <form action="Historial_facturasbuscar.php" method="get" style="background-color:#DCFFFE ;">
                <input type="text" name="busqueda" style="text-transform:uppercase; margin-left: 40px" id="busqueda" placeholder="No. Factura" value="<?php echo $busqueda; ?>">
                <button type="submit" class="boton-buscar">Buscar</button>
                <a href="Facturacion.php" class="btn_newproducto" style="margin-left: 50px"> Nueva venta<i id="icon_nuevo" class='bx bxs-cart-add'></i></a>
                <a href="../../fpdf/Reportehistorialfacturabuscar.php?buscar=<?php echo $busqueda ?>" target="_blank" class="btn_pdf"> PDF <i class='bx bxs-file-pdf'></i></a>
            </form>
          <!-- <div>
                <h5>Buscar por fecha </h5>
                <form action="buscarVenta.php" method="get" class="form_search_date">
                    <label for="">De: </label>
                    <input type="date" name="fecha_de" id="fecha_de" required>
                    <label for=""> A </label>
                    <input type="date" name="fecha_a" id="fecha_a" required>
                    <button type="submit" class="btn_view">Buscar</button>
                </form>
            </div>-->


            &nbsp;&nbsp;&nbsp;

            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Fecha/hora</th>
                        <th>cliente</th>
                        <th>Vendedor</th>
                        <th>Estado</th>
                        <th>Total factura</th>
                        <th>Acciones</th>

                    </tr>
                </thead>

                <?php
                /* include 'php/conexion.php';*/
                include 'conex.php';
                //Paginador
                $sql_register = mysqli_query($conex, "SELECT COUNT(*) as total_registro FROM tbl_venta");
                $result_register = mysqli_fetch_array($sql_register);
                $total_registro = $result_register['total_registro'];

                $por_pagina = 10;

                if (empty($_GET['pagina'])) {
                    $pagina = 1;
                } else {
                    $pagina = $_GET['pagina'];
                }

                $desde = ($pagina - 1) * $por_pagina;
                $total_paginas = ceil($total_registro / $por_pagina);

                $query = mysqli_query($conex, " SELECT f.id_venta, f.fecha_venta, f.total, f.id_cliente, 
                ev.descripcion as estatus,
                u.nombre_usuario as vendedor,
                 cl.nombre_cliente as cliente
                FROM tbl_venta f
                INNER JOIN tbl_ms_usuario u
                ON f.id_usuario = u.id_usuario
                INNER JOIN tbl_clientes cl
                ON f.id_cliente = cl.id_cliente
                INNER JOIN tbl_estado_venta ev
                ON f.id_estado_venta  = ev.id_estado_venta 
                WHERE ( f.id_venta LIKE '%$busqueda%' OR
                        f.fecha_venta LIKE '%$busqueda%' OR
                        f.total LIKE '%$busqueda%' OR
                        f.id_cliente LIKE '%$busqueda%' OR
                        ev.descripcion LIKE '%$busqueda%' OR
                        u.nombre_usuario LIKE '%$busqueda%' OR 
                        cl.nombre_cliente LIKE '%$busqueda%' OR
                        f.id_estado_venta LIKE '%$busqueda%')
                ORDER BY f. fecha_venta DESC LIMIT $desde, $por_pagina");



                $result = mysqli_num_rows($query);
                if ($result > 0) {

                    while ($data = mysqli_fetch_array($query)) {
                        if ($data["estatus"] == "PROCESADA") {
                            $ESTADO = '<samp class="pagada">' . $data["estatus"] . '</samp>';
                        } else {
                            $ESTADO = '<samp class="anulada">' . $data["estatus"] . '</samp>';
                        }

                ?>

                        <tr id="row_<?php echo $data["id_venta"]; ?>">
                            <td><?php echo $data["id_venta"] ?></td>
                            <td><?php echo $data["fecha_venta"] ?></td>
                            <td><?php echo $data["cliente"] ?></td>
                            <td><?php echo $data["vendedor"] ?></td>
                            <td> <?php echo $ESTADO ?></td>
                            <td>L. <?php echo $data["total"] ?></td>
                            <td>
                                <div class="div_acciones">
                                    <div>
                                        <button class="btn_view view_factura" type="button" cl="<?php echo $data["id_cliente"] ?>" f="<?php echo $data["id_venta"] ?>">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>


                                    <?php
                                    if ($data["estatus"] == 'PROCESADA') {
                                    ?>
                                        <div class="div_factura">
                                            <button class="btn_anular anular_factura" fac="<?php echo $data["id_venta"]; ?>"> <i class="fas fa-ban"></i> </button>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="div_factura">
                                            <button class="btn_anular inactive"> <i class="fas fa-ban"></i> </button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>






                                <!--  <a class="link_edit" href="./productos/editarproducto.php?id=// echo $data["id_producto"]; ?>"><i class='bx bx-edit'></i></a>
                                <a class="link_delete" href="./productos/eliminarproducto.php?id=<?php //echo $data["id_producto"]; 
                                                                                                    ?>"><i class='bx bxs-trash'></i></a>
                                 -->
                            </td>
                        </tr>
                <?php
                    }
                }

                ?>

            </table>
            &nbsp;&nbsp;&nbsp;

            <div class="paginador">
                <ul>
                    <?php
                    if ($pagina != 1) {
                    ?>
                        <li><a href="?pagina=<?php echo 1; ?>">|<< /a>
                        </li>
                        <li><a href="?pagina=<?php echo $pagina - 1; ?>">
                                <<< /a>
                        </li>
                    <?php
                    }
                    for ($i = 1; $i <= $total_paginas; $i++) {
                        if ($i == $pagina) {
                            echo '<li class="pageSelected">' . $i . '</li>';
                        } else {
                            echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($pagina != $total_paginas) {
                    ?>
                        <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
                        <li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
                    <?php } ?>
                </ul>
            </div>


            </style>


        </section>
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
        <!--diseño buscar-->
        <style type="text/css">
            form {
                display: flex;
                align-items: center;
            }

            input[type="text"] {
                padding: 8px;
                border: none;
                border-radius: 10px;
                margin-right: 10px;
                font-size: 16px;
            }

            button[type="submit"] {
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                padding: 8px 16px;
                font-size: 16px;
            }
        </style>



        <script src="../../accesos/JS/jquery-3.6.4.min.js"> </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="../../accesos/JS/Funciones_Facturacion.js"> </script>

</body>
<!--diseño siguiente-->
<style type="text/css">
    .navigation {
        display: flex;
        justify-content: left;
        align-items: left;

    }

    .navigation button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 5px 20px;
        text-align: left;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 1px 2px;
        cursor: pointer;
    }

    .navigation button:hover {
        opacity: 0.8;
    }

    .navigation .page-number {
        margin: 0 0px;
        font-size: 10px;
    }
</style>
<!--Codigo java ventana flotante-->



</html>