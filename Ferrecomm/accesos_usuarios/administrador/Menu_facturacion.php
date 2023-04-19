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
            <div class="divt">
            <div class="title_page">
                <h1> </br> Facturacion <i class='fas fa-cube'></i></h1> <h1>   </h1>
            </div>
            </div>
        </center>

        <center>
            <div class="divx">
            <div class="main" >
                <div class="up">
                    <a href="Facturacion.php">
                    <button class="card1">
                        <h4>ventas</h4>
                    <h1>  <i class='fa-solid fa-cart-shopping'></i> </h1>
                    
                    </button>
                    </a>
                    <button class="card2">
                    <h4>clientes</h4>
                    <h1> <i class="fa-solid fa-users"></i> </h1>
                    </button>
                </div>
                <div class="down">
                    <button class="card3">
                    <h4>descuentos</h4>
                    <h1> <i class="fa-solid fa-percent"></i></h1>
                    </button>

                    <a href="Historial_Facturas.php">
                    <button class="card4" >
                    <h4>Historial</h4>
                    <h1> <i class="fa-solid fa-clipboard"></i></h1>
                    </button>
                    </a>

                </div>
            </div>
            </div>
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

    <style>
        .main {
            display: flex;
            flex-direction: column;
            gap: 0.5em;
        }

        .up {
            display: flex;
            flex-direction: row;
            gap: 0.5em;
        }

        .down {
            display: flex;
            flex-direction: row;
            gap: 0.5em;
        }

        .card1 {
            width: 120px;
            height: 120px;
            outline: none;
            border: none;
            background: white;
            border-radius: 120px 30px 30px 30px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
            transition: .2s ease-in-out;
        }

        .instagram {
            margin-top: 1.5em;
            margin-left: 1.2em;
            fill: #cc39a4;
        }

        .card2 {
            width: 120px;
            height: 120px;
            outline: none;
            border: none;
            background: white;
            border-radius: 30px 120px 30px 30px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
            transition: .2s ease-in-out;
        }

        .twitter {
            margin-top: 1.5em;
            margin-left: -.9em;
            fill: #03A9F4;
        }

        .card3 {
            width: 120px;
            height: 120px;
            outline: none;
            border: none;
            background: white;
            border-radius: 30px 30px 30px 120px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(50, 0, 0, 0.3) 0px 1px 3px -1px;
            transition: .2s ease-in-out;
        }

        .github {
            margin-top: -.3em;
            margin-left: 0.2em;
        }

        .card4 {
            width: 120px;
            height: 120px;
            outline: none;
            border: none;
            background: white;
            border-radius: 30px 30px 120px 30px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
            transition: .2s ease-in-out;
        }

        .discord {
            margin-top: -.9em;
            margin-left: -1.2em;
            fill: #8c9eff;
        }

        .card1:hover {
            cursor: pointer;
            scale: 1.1;
            background-color: #f19c4d;
        }

        .card1:hover .instagram {
            fill: white;
        }

        .card2:hover {
            cursor: pointer;
            scale: 1.1;
            background-color: #f19c4d;
        }

        .card2:hover .twitter {
            fill: white;
        }

        .card3:hover {
            cursor: pointer;
            scale: 1.1;
            background-color: #f19c4d;
        }

        .card3:hover .github {
            fill: red;
        }

        .divx {
            width: 400px;
            height: 400px;
            margin: 0 auto;
        }
        
        .divt {
            width: 800px;
            margin: 0 auto;
        }

        .card4:hover {
            cursor: pointer;
            scale: 1.1;
            background-color: #f19c4d;
        }

        .card4:hover .discord {
            fill: white;
        }
    </style>
</body>

</html>