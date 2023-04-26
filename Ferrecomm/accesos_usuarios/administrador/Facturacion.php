<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../accesos/CSS/Facturacion.css">
    <link rel="stylesheet" href="../../accesos/CSS/tablaproducto.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "Header.php"; ?>

    <link rel="stylesheet" type="text/css" href="select2/select2.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="select2/select2.min.js"></script>

</head>

<body>


    <section class="home-section">

        <center>
            <div class="title_page">
                <h1> </br> Ventas <i class='fas fa-cube'></i></h1>
            </div>
        </center>

        <center>
            <div class="Datos_cliente">
                <div class="Clientes_boton">

                    <h4>Datos del Cliente <a href="#" class="btn_new_cliente"> <i class="fas fa-plus"></i> nuevo cliente</a></h4>

                    <br>

                </div>
                <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
                    <input type="hidden" name="action" id="action" value="addCliente">
                    <input type="hidden" id="idcliente" name="idcliente" value="" required>
                    <div class="wd30 inputbox">
                        <input type="number" required="required" name="nit_cliente" id="nit_cliente">
                        <span>DNI</span>
                        <i></i>
                    </div>
                    <div class="wd30">
                        <Label> Nombre </Layel>
                            <input type="text" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" name="nom_cliente" id="nom_cliente" disabled required>
                    </div>
                    <div class="wd30">
                        <label>Teléfono</label>
                        <input type="number" name="tel_cliente" id="tel_cliente" disabled required>
                    </div>
                    <div class="wd100" id="wd100">
                        <label class="textright">Dirección</label>
                        <input type="text" style="text-transform:uppercase;" onblur="cambiarAMayusculas(this);" name="dir_cliente" id="dir_cliente" disabled required>
                    </div>
                    <div id="div_registro_cliente" class="wd100">
                        <br>
                        <button class="boton-buscar" name="boton-buscar" id="boton-buscar"> <i class="far fa-save fa-lg"></i>
                            Guardar</button>
                    </div>
                </form>

            </div>

            <div class="datos_venta">
                <h4>Datos de venta</h4>
                <div class="datos">
                    <div class="w50">
                        <label>Vendedor</label>
                        <p><?php echo $_SESSION['usuario']['nombre'] . " " ?></p>
                    </div>
                    <div class="w50">
                        <label>Tipo de pago <br></label>
                        <?php
                        include 'conex.php';
                        $query_prom = mysqli_query($conex, "SELECT * from tbl_forma_pago");
                        $result_prom = mysqli_num_rows($query_prom)
                        ?>
                        <input type="hidden" name="txt_tipo_pago" id="txt_tipo_pago" value="">
                        <select name="selec_tipo_pago" id="selec_tipo_pago">
                            <?php
                            echo $option;
                            if ($result_prom > 0) {
                                while ($promo = mysqli_fetch_array($query_prom)) {

                            ?>
                                    <option value="<?php echo $promo["id_pago"]; ?>"><?php echo $promo["nombre_forma_pago"] ?> </option>
                            <?php
                                }
                            }

                            ?>
                        </select>

                    </div>


                    <div class="w50">
                        <label>Tipo de venta <br></label>

                        <?php
                        include 'conex.php';
                        $query_prom = mysqli_query($conex, "SELECT * from tbl_tipo_venta");
                        $result_prom = mysqli_num_rows($query_prom)
                        ?>
                        <input type="hidden" name="txt_tipo_venta" id="txt_tipo_venta" value="">

                        <select name="selec_tipo_venta" id="selec_tipo_venta">
                            <?php
                            echo $option;
                            if ($result_prom > 0) {
                                while ($promo = mysqli_fetch_array($query_prom)) {

                            ?>
                                    <option value="<?php echo $promo["id_tip_venta"]; ?>"><?php echo $promo["nombre_tip_venta"] ?></option>
                            <?php
                                }
                            }

                            ?>
                        </select>

                    </div>

                    <div class="w50">
                        <label>Aplicar Descuento <br></label>

                        <?php
                        include 'conex.php';
                        $query_prom = mysqli_query($conex, "SELECT * from tbl_descuentos");
                        $result_prom = mysqli_num_rows($query_prom)
                        ?>
                        <input type="hidden" name="txt_descuento" id="txt_descuento" value="">


                        <select name="selec_descuento" id="selec_descuento">
                            <?php
                            echo $option;
                            if ($result_prom > 0) {
                                while ($promo = mysqli_fetch_array($query_prom)) {

                            ?>
                                    <option value="<?php echo $promo["id_descuentos"]; ?>"><?php echo $promo["porcentaje_descontar"] ?> % <?php echo $promo["nombre_descuento"] ?></option>
                            <?php
                                }
                            }

                            ?>
                        </select>

                    </div>

                    <div class="w50">
                        <label> Acciones <br><br></label>

                        <div class="acciones_venta">
                            <a href="#" class="btn_anular" id="btn_anular_venta"> <i class="fas fa-ban"></i> Anular</a>
                            <a href="#" class="btn_accion" id="btn_facturar_venta" style="display : none;"> <i class="fas fa-edit"></i> Procesar</a>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" id="id" value=<?php echo $_SESSION['id_usuario']; ?>>
            <table class="tbl_venta">
                <thead>
                    <th colspan="7">BUSCAR PRODUCTOS</th>
                    <tr>
                        <th width="100px">Codigo</th>
                        <th width="100px">Descripcion</th>
                        <th width="100px">Existencia</th>
                        <th width="100px">Cantidad</th>
                        <th class="textright">Precio</th>
                        <th class="textright">Precio Total</th>
                        <th>Accion</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="txt_cod_producto" id="txt_cod_producto" value="">

                            <?php
                            include 'conex.php';
                            $query_prom = mysqli_query($conex, "SELECT * from tbl_producto");
                            $result_prom = mysqli_num_rows($query_prom)
                            ?>

                            <select name="selec_producto" id="selec_producto">
                                <?php
                                echo "<option selected disabled>Selecciona uno</option>";
                                if ($result_prom > 0) {
                                    while ($promo = mysqli_fetch_array($query_prom)) {

                                ?>
                                        <option value="<?php echo $promo["id_producto"]; ?>"><?php echo $promo["nombre_producto"] ?> </option>
                                <?php
                                    }
                                }

                                ?>
                                <script type="text/javascript">
                                    $('#selec_producto').select2({
                                        language: {

                                            noResults: function() {

                                                return "No hay resultado";
                                            },
                                            searching: function() {

                                                return "Buscando..";
                                            }
                                        }
                                    });
                                    $('#selec_producto').change(function(e) {
                                        opcion = $('#selec_producto').val();
                                        buscarproducto(opcion);
                                    })
                                </script>


                            </select>


                        </td>
                        <td id="txt_descripcion">----</td>
                        <td id="txt_existencia">---</td>
                        <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                        <td id="txt_Precio" class="textright">0.00</td>
                        <td id="txt_Precio_total" class="textright">0.00</td>
                        <td><a href="#" class="btn_accion" id="add_product_venta"><i class="fas fa-plus"></i></a></td>
                    </tr>
                    <br><br>
                    <th colspan="7">BUSCAR PROMOCIONES</th>
                    <tr>
                        <th width="100px">Codigo</th>
                        <th colspan="2">Descripcion</th>
                        <th width="100px">Cantidad</th>
                        <th class="textright">Precio</th>
                        <th class="textright">Precio Total</th>
                        <th>Accion</th>
                    </tr>
                    <tr>

                        <td>
                        <input type="hidden" name="txt_cod_promocion" id="txt_cod_promocion" value="">
                            <?php
                            include 'conex.php';
                            $query_prom = mysqli_query($conex, "SELECT * from tbl_promociones");
                            $result_prom = mysqli_num_rows($query_prom)
                            ?>

                            <select name="selec_promocion" id="selec_promocion">
                                <?php
                                echo $option;
                                if ($result_prom > 0) {
                                    while ($promo = mysqli_fetch_array($query_prom)) {

                                ?>
                                        <option value="<?php echo $promo["id_promocion"]; ?>"><?php echo $promo["nombre_promocion"] ?> </option>
                                <?php
                                    }
                                }

                                ?>
                            </select>

                        </td>

                        <td colspan="2" id="txt_descripcion_promocion">----</td>
                        <td><input type="text" name="txt_cant_promocion" id="txt_cant_promocion" value="0" min="1" disabled></td>
                        <td id="txt_Precio_promocion" class="textright">0.00</td>
                        <td id="txt_Precio_total_promocion" class="textright">0.00</td>
                        <td><a href="#" class="btn_accion" id="add_promocion_venta"><i class="fas fa-plus"></i></a></td>

                    </tr>


                    <tr>
                        <th>Codigo</th>
                        <th colspan="2">Descripcion</th>
                        <th>Cantidad</th>
                        <th class="textright">Precio</th>
                        <th class="textright">Precio Total</th>
                        <th>Accion</th>
                    </tr>
                </thead>

                <tbody id="detalle_venta">
                    <!-- Se utilizara contenido Ajax para llenar la tabla -->
                </tbody>

                <th colspan="7">PROMOCIONES</th>
                <input type="hidden" name="total_promocion" id="total_promocion" value="">

                <tbody id="detalle_venta_promociones">
                    
                </tbody>

                <tfoot id="detalle_totales">
                    <!-- Se utilizara contenido Ajax para llenar la tabla -->
                </tfoot>
            </table>

        </center>
    </section>
    <script src="../../accesos/JS/jquery-3.6.4.min.js"> </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../../accesos/JS/Funciones_Facturacion.js"> </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var usuarioid = <?php echo $_SESSION['id_usuario']; ?>;
            searchfordetalle(usuarioid);
        });
    </script>


</body>

</html>