<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../accesos/CSS/EstiloMenu.css">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Compras</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/css/font-awesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">


  <!-- DATATABLES -->
  <head>
    <!-- Otros elementos en el encabezado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

  <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
  <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
  <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="../../accesos/CSS/tablas.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include "Header.php"; ?>
</head>

<body class="app sidebar-mini">
  <!-- Modal -->
  <div class="modal fade" id="myModal" name="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

      <div class="modal-content" style="background-color: #fff0">

        <div class="modal-body">
          <section class="content" style="background-color: #DCFFFE; min-height: auto; width: 110%;">
            <h2 style="text-align: center;  color: rgba(255, 102, 0, 0.91);"> Detalle de compra <i
                class='bx bxs-cart'></i></h2>
            <div class="row" style="margin-right: 1px;
margin-left: -3px;">
              <div class="col-md-12">
                <div class="box">

                  <!-- /.box-header -->
                  <!-- centro -->
                  <div class="panel-body table-responsive" id="listadoregistros">

                  </div>
                  <div class="panel-body" style="height: auto;" id="formularioregistros2">
                    <form name="formulario2" id="formulario2" method="POST">
                      <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Proveedor(*):</label>
                        <input type="hidden" name="idingreso" id="idingreso">
                        <select id="idproveedor" name="idproveedor" class="form-control selectpicker"
                          data-live-search="true" required disabled>

                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Fecha(*):</label>
                        <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required="" value=""
                          disabled>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Tipo Comprobante(*):</label>
                        <select id="tipo_comprobante2" name="tipo_comprobante2" class="form-control selectpicker"
                          data-live-search="true" required disabled>

                        </select>
                      </div>


                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>Nº Compra:</label>
                        <input type="text" class="form-control" name="num_comprobante" id="num_comprobante"
                          maxlength="10" placeholder="" required="" readonly>
                      </div>
                      <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>Impuesto:</label>
                        <input type="text" class="form-control" name="impuesto1" id="impuesto1" value="15%">
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a data-toggle="modal" href="#myModal">
                          <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span
                              class="fa fa-plus"></span> Agregar Productos</button>
                        </a>
                      </div>

                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                          <thead style="width: 130.083px; background-color', 'rgba(255, 102, 0, 0.911)">

                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th> subtotal</th>
                            <th>isv</th>
                            <th>Total</th>
                          </thead>
                          <tfoot>
                            <th>TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>

                            <th>
                              <h4 id="total">L. 0.00</h4><input type="hidden" name="total_compra" id="total_compra">
                            </th>
                          </tfoot>
                          <tbody>

                          </tbody>
                        </table>
                      </div>

                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                    </form>
                  </div>
                  <!--Fin centro -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
  </div>
  <!-- Fin modal -->

  <section class="home-section">
    </br>
    </header>

    <!-- /////////////////////////////////#DCFFFE/////////////////////////////////////////////////////////////////////-->
    <div id="divModal"></div>
    <h2 style="text-align: center; color: rgba(255, 102, 0, 0.91);"><b>Compras</b> <i class='bx bxs-cart'></i></h2>

    <main class="app-content" style="background-color: #DCFFFE;">
      <div class="center">
        <a href="nueva_compra.php" class="btn_newproducto">Nueva Compra<i id="icon_nuevo"
            class='bx bxs-cart-add'></i></a>
        <a onclick="generarpdf()" target="_blank" class="btn_pdf">Generar PDF<i id="" class=''></i></a>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">

              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablePedidos">


                  <thead>
                    <tr>
                      <th>Id Compra</th>
                      <th>Proveedor</th>
                      <th>Fecha</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


    </main>
    <!-- Essential javascripts for application to work-->


    <style>
      .row {
        margin-right: 321px;
        margin-left: 375px;
      }

      .center {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      h1 {
        display: flex;
        align-items: center;
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

      .btn_pdf {
        display: inline-block;
        background-color: rgba(255, 102, 0, 0.911);
        color: rgb(255, 255, 255);
        padding: 5px 25px;
        border-radius: 10px;
        margin: 20px;
        text-decoration: none;
      }

      .btn_newproducto {
        display: inline-block;
        background: #306fe6;
        color: rgb(255, 255, 255);
        padding: 5px 25px;
        border-radius: 10px;
        margin: 20px;
        margin-left: 20px;
        text-decoration: none;
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
    <script src="formularioproducto.js"></script>

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
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../public/js/bootstrap.min.js"></script>

    <!-- AdminLTE App -->
    <script src="../public/js/app.min.js"></script>
    <script src="formularioproducto.js"></script>
    <!-- DATATABLES -->
    <script src="../public/datatables/jquery.dataTables.min.js"></script>
    <script src="../public/datatables/dataTables.buttons.min.js"></script>
    <script src="../public/datatables/buttons.html5.min.js"></script>
    <script src="../public/datatables/buttons.colVis.min.js"></script>
    <script src="../public/datatables/jszip.min.js"></script>
    <script src="../public/datatables/pdfmake.min.js"></script>
    <script src="../public/datatables/vfs_fonts.js"></script>

    <script src="../public/js/bootbox.min.js"></script>
    <script src="../public/js/bootstrap-select.min.js"></script>



    <script src="../../js/functions_compras.js"></script>
    <script src="../../js/sweetalert.min.js"></script>
    <script >
$(document).ready(function() {
    setTimeout(function() {
        $('.dataTables_filter input').on('input', function(event) {
            var inputValue = $(this).val();
            var sanitizedValue = inputValue.replace(/[^a-zA-Z0-9\s]/g, ''); // Remueve caracteres no permitidos
            if (sanitizedValue !== inputValue) {
                $(this).val(sanitizedValue);
            }
        });
    }, 1000); // Retraso de 1 segundo (ajusta según sea necesario)
});

    </script>
    </div>



</body>

</html>