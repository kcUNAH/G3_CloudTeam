

$(document).ready(function () {


    //ACTIVAR CAMPOS 
    $('.btn_new_cliente').click(function (e) {
        e.preventDefault();
        $('#nom_cliente').removeAttr('disabled');
        $('#tel_cliente').removeAttr('disabled');
        $('#dir_cliente').removeAttr('disabled');

        $('#div_registro_cliente').slideDown(); //slideDown sirve para dejar invalido el display none 
    })

    // Buscar cliente en la base de datos 
    $('#nit_cliente').keyup(function (e) {
        e.preventDefault();
        var cl = $(this).val();
        var action = 'searchCliente';

        $.ajax({
            url: '../../accesos_usuarios/administrador/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, cliente: cl },

            success: function (response) {
                console.log(response);

                if (response == 0) {
                    $('#idcliente').val('');
                    $('#nom_cliente').val('');
                    $('#tel_cliente').val('');
                    $('#dir_cliente').val('');
                    //mostrar boton agregar 
                    $('.btn_new_cliente').slideDown();

                } else {

                    var data = $.parseJSON(response);
                    $('#idcliente').val(data.id_cliente);
                    $('#nom_cliente').val(data.nombre_cliente);
                    $('#tel_cliente').val(data.telefono_cliente);
                    $('#dir_cliente').val(data.direccion_cliente);
                    //ocultar boton agregar
                    $('.btn_new_cliente').slideUp();

                    //bloque campos 
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#tel_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');

                    // ocultar boton agregar 
                    $('#div_registro_cliente').slideUp();

                }

            },
            error: function (error) {

            }
        });
    })


    //crear cliente - ventas 

    $('#form_new_cliente_venta').submit(function (e) {
        e.preventDefault();


        $.ajax({
            url: '../../accesos_usuarios/administrador/ajax.php',
            type: "POST",
            async: true,
            data: $('#form_new_cliente_venta').serialize(),

            success: function (response) {
                console.log(response);
                if (response == 1) {
                    //bloque campos 
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#tel_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');
                    //ocultar boton agregar
                    $('.btn_new_cliente').slideUp();
                    //ocultar boton uardar 
                    $('#div_registro_cliente').slideUp();

                    Swal.fire({
                        position: 'top-end',
                        background: '#ffa031',
                        icon: 'success',
                        title: 'CLIENTE AGREGADO CON EXITO!!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
                if (response == 0) {
                    console.log('cliente no agregado')
                }

            },
            error: function (error) {

            }
        });

    });


    //Buscar producto 
    $('#txt_cod_producto').keyup(function (e) {
        e.preventDefault();


        var producto = $(this).val();
        var action = 'searchProducto';

        $.ajax({
            url: '../../accesos_usuarios/administrador/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, producto: producto },

            success: function (response) {
                if (response == 'error') {
                    //asignar valores a la tabla 
                    $('#txt_descripcion').html('--');
                    $('#txt_cant_producto').val('0');
                    $('#txt_Precio').html('0.00');
                    $('#txt_Precio_total').html('0.00');

                    //habilitar cantidad 
                    $('#txt_cant_producto').attr('disabled', 'disabled');

                    //ocultar boton agregar 
                    $('#add_product_venta').slideUp();

                } else {
                    var inforProducto = JSON.parse(response);
                    //asignar valores a la tabla 
                    $('#txt_descripcion').html(inforProducto.nombre_producto);
                    $('#txt_cant_producto').val('1');
                    $('#txt_Precio').html(inforProducto.precio_producto);
                    $('#txt_Precio_total').html(inforProducto.precio_producto);
                    //habilitar cantidad 
                    $('#txt_cant_producto').removeAttr('disabled');
                    //mostrar bonton agregar 
                    $('#add_product_venta').slideDown();



                }

            },
            error: function (error) {

            }
        });

        var action = 'searchExistencia';

        //existencia en inventario
        $.ajax({
            url: '../../accesos_usuarios/administrador/ajax.php',
            type: "POST",
            async: true,
            data: { action: action, producto: producto },

            success: function (response) {
                if (response != 'error') {

                    var infoexistencia = JSON.parse(response);
                    $('#txt_existencia').html(infoexistencia.cantidad);
                } else {
                    $('#txt_existencia').html('--');
                }


            },
            error: function (error) {

            }
        });

    });


    // validar cantidad del producto  
    $('#txt_cant_producto').keyup(function (e) {
        e.preventDefault();
        var cantidad = $(this).val();
        var precio = $('#txt_Precio').html();
        var existencia = parseInt($('#txt_existencia').html());
        var precio_total = cantidad * precio;

        $('#txt_Precio_total').html(precio_total);

        //ocultar boton de agregar si la cantidad es menor que 1 O si la cantidad ingresada es mayor que la existente 
        if (($(this).val() < 1 || isNaN($(this).val())) || $(this).val() > existencia) {
            $('#add_product_venta').slideUp();
        } else {
            $('#add_product_venta').slideDown();
        }

    });


    //Agregar producto al detalle temporal
    $('#add_product_venta').click(function (e) {
        e.preventDefault();

        if ($('#txt_cant_producto').val() > 0) {
            var codproducto = $('#txt_cod_producto').val();
            var cantidad = $('#txt_cant_producto').val();
            var action = 'addProductoDetalle';

            $.ajax({
                url: '../../accesos_usuarios/administrador/ajax.php',
                type: "POST",
                async: true,
                data: { action: action, producto: codproducto, cantidad: cantidad },

                success: function (response) {
                    if (response != 'error') {
                        var info = JSON.parse(response);
                        $('#detalle_venta').html(info.detalle);
                        $('#detalle_totales').html(info.totales);

                        // vaciar campos 
                        $('#txt_cod_producto').val('');
                        $('#txt_descripcion').html('--');
                        $('#txt_cant_producto').val('0');
                        $('#txt_Precio').html('0.00');
                        $('#txt_Precio_total').html('0.00');
                        $('#txt_existencia').html('--');

                        // bloquear impunt 
                        $('#txt_cant_producto').attr('disabled', 'disabled');

                        //ocultar boton agregar 
                        $('#add_product_venta').slideUp();
                    } else {
                        console.log('Sin Datos')
                    }
                    viewProcesar();

                },
                error: function (error) {

                }
            });



        }


    })


    //anular venta 
    $('#btn_anular_venta').click(function (e){
        e.preventDefault();

        var rows = $('#detalle_venta tr').length;
        if(rows > 0)
        {
            var action = 'anularVenta';

            $.ajax({
                url: '../../accesos_usuarios/administrador/ajax.php',
                type: "POST",
                async: true,
                data: { action: action},
    
                success: function (response) {
                    if (response != 'error') {
                        location.reload(); 
                    }
                     
                },
                error: function (error) {
    
                }
            });


        }


    }) 




    //fin del ready 
});



//funcion eliminar producto
function del_product_detalle(id_venta_detalle){
    var action = 'delProducDetalle'; 
    var id_detalle = id_venta_detalle; 


    $.ajax({
        url: '../../accesos_usuarios/administrador/ajax.php',
        type: "POST",
        async: true,
        data: { action: action, id_detalle : id_detalle},

        success: function (response) {
            if (response != 'error') {
            var info = JSON.parse(response);
            $('#detalle_venta').html(info.detalle);
            $('#detalle_totales').html(info.totales);
             // vaciar campos 
             $('#txt_cod_producto').val('');
             $('#txt_descripcion').html('--');
             $('#txt_cant_producto').val('0');
             $('#txt_Precio').html('0.00');
             $('#txt_Precio_total').html('0.00');
             $('#txt_existencia').html('--');

             // bloquear impunt 
             $('#txt_cant_producto').attr('disabled', 'disabled');

             //ocultar boton agregar 
             $('#add_product_venta').slideUp();

            }else{
            $('#detalle_venta').html('');
            $('#detalle_totales').html('');

            }

            viewProcesar();
 
            
        },
        error: function (error) {

        }
    });




}


//mostrar/ ocultar boton procesar 
function viewProcesar(){
    if($('#detalle_venta tr').length > 0){
        $('#btn_facturar_venta').show();
    }else{
        $('#btn_facturar_venta').hide();
    }
}


// funcion donde mostrara los detalles de la factura 
function searchfordetalle(id){
    var action = 'searchfordetalle';
    var user = id; 


    $.ajax({
        url: '../../accesos_usuarios/administrador/ajax.php',
        type: "POST",
        async: true,
        data: { action: action, user : user},

        success: function (response) {
            if (response != 'error') {
                var info = JSON.parse(response);
                $('#detalle_venta').html(info.detalle);
                $('#detalle_totales').html(info.totales);
            } else {
                console.log('Sin Datos')
            }
            viewProcesar();
        },
        error: function (error) {

        }
    });


}



