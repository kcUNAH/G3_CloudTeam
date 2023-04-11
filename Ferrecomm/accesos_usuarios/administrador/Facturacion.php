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
</head>

<body>


    <section class="home-section">

        <center>
            <div class="title_page">
                <h1> </br> Facturacion <i class='fas fa-cube'></i></h1>
            </div>
        </center>

        <center>
            <div class="Datos_cliente">
                <div class="Clientes_boton">

                    <h4>Datos del Cliente  <a href="#" class="btn_new_cliente"> <i class="fas fa-plus"></i> nuevo cliente</a></h4>
                    
                    <br>

                </div>
                <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
                    <input type="hidden" name="action" id= "action" value="addCliente">
                    <input type="hidden" id="idcliente" name="idcliente" value="" required>
                    <div class="wd30 inputbox">
                        <input type="number"  required="required"  name="nit_cliente" id="nit_cliente">
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
                        <p><?php echo $_SESSION['usuario']['nombre']. " "?></p>
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

            <table class="tbl_venta">
                <thead>
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
                        <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                        <td id="txt_descripcion">----</td>
                        <td id="txt_existencia">---</td>
                        <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                        <td id="txt_Precio" class="textright">0.00</td>
                        <td id="txt_Precio_total" class="textright">0.00</td>
                        <td><a href="#" class="btn_accion" id="add_product_venta"><i class="fas fa-plus"></i>AGR</a></td>
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

                <tfoot id = "detalle_totales">
                    <!-- Se utilizara contenido Ajax para llenar la tabla -->
                </tfoot>
            </table>










        </center>
    </section>
    <script src="../../accesos/JS/jquery-3.6.4.min.js"> </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="../../accesos/JS/Funciones_Facturacion.js"> </script>

    <script type= "text/javascript">
        $(document).ready(function () {
            var usuarioid = <?php echo $_SESSION['id_usuario']; ?>;
            searchfordetalle(usuarioid);
        });
    
    </script>
    

</body>

</html>