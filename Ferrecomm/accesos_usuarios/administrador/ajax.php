<?php

use LDAP\Result;

include "../../php/conexion.php";
session_start();

if (!empty($_POST)) {

    //buscar cliente 
    if ($_POST['action'] == 'searchCliente') {
        if (!empty($_POST["cliente"])) {
            $dni = $_POST["cliente"];
            $query = mysqli_query($conexion, "SELECT * FROM tbl_clientes WHERE dni_cliente LIKE '$dni'");
            mysqli_close($conexion);
            $result = mysqli_num_rows($query);
            $data = '';
            if ($result > 0) {
                $data = mysqli_fetch_assoc($query);
            } else {
                $data = 0;
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        exit;
    }

    //administrar clientes
    if ($_POST['action'] == 'addCliente') {

        $dni = $_POST['nit_cliente'];
        $nombre = $_POST['nom_cliente'];
        $telefono = $_POST['tel_cliente'];
        $direccion = $_POST['dir_cliente'];

        $query_insert = mysqli_query($conexion, "INSERT INTO tbl_clientes(dni_cliente, nombre_cliente, telefono_cliente, direccion_cliente)
                                 VALUES('$dni', '$nombre', '$telefono', '$direccion')");

        mysqli_close($conexion);
        if ($query_insert) {
            $msg = 1;
        } else {
            $msg = 0;
        }

        echo $msg;
    }

    //buscar producto 
    if ($_POST['action'] == 'searchProducto') {
        if (!empty($_POST["producto"])) {
            $producto = $_POST["producto"];
            $query_producto = mysqli_query($conexion, "SELECT id_producto, nombre_producto, precio_producto FROM tbl_producto WHERE id_producto LIKE '$producto' ");

            $result = mysqli_num_rows($query_producto);
            $data = '';

            if ($result > 0) {
                $data = mysqli_fetch_assoc($query_producto);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
            } else {
                echo 'error';
            }
            mysqli_close($conexion);
            exit;
        }
        echo 'error';
    }


    // busacar existencia de producto 
    if ($_POST['action'] == 'searchExistencia') {
        if (!empty($_POST["producto"])) {
            $producto = $_POST["producto"];
            $query_producto = mysqli_query($conexion, "SELECT cantidad FROM tbl_inventario WHERE id_producto LIKE '$producto' ");

            $result = mysqli_num_rows($query_producto);
            $data;
            if ($result > 0) {
                $data = mysqli_fetch_assoc($query_producto);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
            } else {
                echo 'error';
            }
            mysqli_close($conexion);
            exit;
        }
        echo 'error';
    }

    //agregar producto al detalle temporal 
    if ($_POST['action'] == 'addProductoDetalle') {

        if (empty($_POST['producto']) || empty($_POST['cantidad'])) {
            echo 'error';
        } else {
            $codproducto = $_POST['producto'];
            $cantidad    = $_POST['cantidad'];
            $token       = md5($_SESSION['id_usuario']);

            $query_isv = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'IMPUESTO' ");
            $fila_isv = mysqli_fetch_array($query_isv);
            $resul_isv = $fila_isv['valor'];

            $query_detalle_temp = mysqli_query($conexion, "CALL add_detalle_temp($codproducto, $cantidad, '$token')");
            $result = mysqli_num_rows($query_detalle_temp);

            $detalleTabla = '';
            $sub_total = 0;
            $isv = 0;
            $total = 0;
            $arrayData = array();

            if ($result > 0) {
                if ($resul_isv > 0) {
                    $isv = $resul_isv;
                }

                while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
                    $precioTotal =  round($data['cantidad'] * $data['precio_venta'], 2);
                    $sub_total = round($sub_total + $precioTotal, 2);
                    $total = round($total + $precioTotal, 2);
                    $detalleTabla .= '<tr>
                                        <td>'.$data['id_producto'].'</td>
                                        <td colspan="2">'.$data['nombre_producto'].'</td>
                                        <td class="txtcenter">'.$data['cantidad'].'</td>
                                        <td class="textright">'.$data['precio_venta'].'</td>
                                        <td class="textright">'.$precioTotal.'</td>
                                        <td class=""><a class="link_delete" href="#" onclick="event.preventDefault();
                                         del_product_detalle('.$data['id_venta_detalle'].');"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>';
                }

                $impuesto = round($sub_total * ($isv / 100 ), 2);
                $tl_sisv = round($sub_total - $impuesto, 2);
                $total = round($tl_sisv + $impuesto); 

                $detalleTotales = '<tr>
                                        <td colspan="5" class="textright">Subtotal</td>
                                        <td class="textright">'.$tl_sisv.'</td>
                                   </tr>
                                    <tr>
                                        <td colspan="5" class="textright">ISV ('.$isv.'%)</td>
                                        <td class="textright">'.$impuesto.'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="textright">Total </td>
                                        <td class="textright">'.$total.'</td>
                                        </tr>';

                $arrayData['detalle'] = $detalleTabla;
                $arrayData['totales'] = $detalleTotales;

                echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
            }else{
                echo 'error';
            }
            mysqli_close($conexion);

        }

        exit;
    }


    //Extraer datos del detalle_temp
    if ($_POST['action'] == 'searchfordetalle') {

        if (empty($_POST['user'])){
            echo 'error';
        } else {

            $token       = md5($_SESSION['id_usuario']);

            $query = mysqli_query($conexion, "SELECT tmp.id_venta_detalle,
                                              tmp.token_usuario, 
                                              tmp.cantidad, 
                                              tmp.precio_venta, 
                                              p.id_producto,
                                              p.nombre_producto
                                              FROM tbl_venta_detalle_temp tmp
                                              INNER JOIN tbl_producto P
                                              ON tmp.id_producto = p.id_producto
                                              WHERE token_usuario = '$token' ");

            $result = mysqli_num_rows($query);


            $query_isv = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'IMPUESTO' ");
            $fila_isv = mysqli_fetch_array($query_isv);
            $resul_isv = $fila_isv['valor'];

           

            $detalleTabla = '';
            $sub_total = 0;
            $isv = 0;
            $total = 0;
            $arrayData = array();

            if ($result > 0) {
                if ($resul_isv > 0) {
                    $isv = $resul_isv;
                }

                while ($data = mysqli_fetch_assoc($query)) {
                    $precioTotal =  round($data['cantidad'] * $data['precio_venta'], 2);
                    $sub_total = round($sub_total + $precioTotal, 2);
                    $total = round($total + $precioTotal, 2);
                    $detalleTabla .= '<tr>
                                        <td>'.$data['id_producto'].'</td>
                                        <td colspan="2">'.$data['nombre_producto'].'</td>
                                        <td class="txtcenter">'.$data['cantidad'].'</td>
                                        <td class="textright">'.$data['precio_venta'].'</td>
                                        <td class="textright">'.$precioTotal.'</td>
                                        <td class=""><a class="link_delete" href="#" onclick="event.preventDefault();
                                         del_product_detalle('.$data['id_venta_detalle'].');"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>';
                }

                $impuesto = round($sub_total * ($isv / 100 ), 2);
                $tl_sisv = round($sub_total - $impuesto, 2);
                $total = round($tl_sisv + $impuesto); 

                $detalleTotales = '<tr>
                                        <td colspan="5" class="textright">Subtotal</td>
                                        <td class="textright">'.$tl_sisv.'</td>
                                   </tr>
                                    <tr>
                                        <td colspan="5" class="textright">ISV ('.$isv.'%)</td>
                                        <td class="textright">'.$impuesto.'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="textright">Total </td>
                                        <td class="textright">'.$total.'</td>
                                        </tr>';

                $arrayData['detalle'] = $detalleTabla;
                $arrayData['totales'] = $detalleTotales;

                echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
            }else{
                echo 'error';
            }
            mysqli_close($conexion);

        }

        exit;
    }


    //Eliminar del detalle temp
    if ($_POST['action'] == 'delProducDetalle') {
       
        if (empty($_POST['id_detalle'])){
            echo 'error';
        } else {

            $id_detalle  = $_POST['id_detalle'];
            $token       = md5($_SESSION['id_usuario']);

            $query_isv = mysqli_query($conexion, "SELECT valor FROM tbl_ms_parametros WHERE parametro = 'IMPUESTO' ");
            $fila_isv = mysqli_fetch_array($query_isv);
            $resul_isv = $fila_isv['valor'];

            $query_detalle_temp = mysqli_query($conexion, "CALL del_detalle_temp($id_detalle, '$token')");
            $result = mysqli_num_rows($query_detalle_temp);


            $detalleTabla = '';
            $sub_total = 0;
            $isv = 0;
            $total = 0;
            $arrayData = array();

            if ($result > 0) {
                if ($resul_isv > 0) {
                    $isv = $resul_isv;
                }

                while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
                    $precioTotal =  round($data['cantidad'] * $data['precio_venta'], 2);
                    $sub_total = round($sub_total + $precioTotal, 2);
                    $total = round($total + $precioTotal, 2);
                    $detalleTabla .= '<tr>
                                        <td>'.$data['id_producto'].'</td>
                                        <td colspan="2">'.$data['nombre_producto'].'</td>
                                        <td class="txtcenter">'.$data['cantidad'].'</td>
                                        <td class="textright">'.$data['precio_venta'].'</td>
                                        <td class="textright">'.$precioTotal.'</td>
                                        <td class=""><a class="link_delete" href="#" onclick="event.preventDefault();
                                         del_product_detalle('.$data['id_venta_detalle'].');"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>';
                }

                $impuesto = round($sub_total * ($isv / 100 ), 2);
                $tl_sisv = round($sub_total - $impuesto, 2);
                $total = round($tl_sisv + $impuesto); 

                $detalleTotales = '<tr>
                                        <td colspan="5" class="textright">Subtotal</td>
                                        <td class="textright">'.$tl_sisv.'</td>
                                   </tr>
                                    <tr>
                                        <td colspan="5" class="textright">ISV ('.$isv.'%)</td>
                                        <td class="textright">'.$impuesto.'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="textright">Total </td>
                                        <td class="textright">'.$total.'</td>
                                        </tr>';

                $arrayData['detalle'] = $detalleTabla;
                $arrayData['totales'] = $detalleTotales;

                echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
            }else{
                echo 'error';
            }
            mysqli_close($conexion);

        }

        exit;



    }


    //anularVenta
    if ($_POST['action'] == 'anularVenta'){
        $token       = md5($_SESSION['id_usuario']);
        $query_eliminar = mysqli_query($conexion,"DELETE FROM tbl_venta_detalle_temp WHERE token_usuario = '$token' ");
        mysqli_close($conexion);

        if($query_eliminar){
            echo 'ok';
        }else{
            echo 'error';
        }

        exit; 

    }





}
exit;
