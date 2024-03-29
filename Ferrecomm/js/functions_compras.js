
var tableRoles;
var tableprod;
$("#impuesto").val("15 %");
document.addEventListener('DOMContentLoaded', function () {
	listarArticulos()
    tableRoles = $('#tablePedidos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url":  '../../modelos/ComprasControlador.php?op=listar',
            "dataSrc": ""
            
        },
        "columns": [
            { "data": "id_compra" },
            { "data": "nombre_proveedor" },
            { "data": "fecha_compra" },
            { "data": "total_compra" },
            { "data": "nombre_estad_compra" },
            { "data": "options" }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

});
$('#tablePedidos').dataTable({
    // ... otras configuraciones
    "headerCallback": function(thead, data, start, end, display) {
      $(thead).find('th').css('background-color', 'rgba(255, 102, 0, 0.911)').css('color', '#000');
    }
  });
  var tabla;

//Función que se ejecuta al inicio
function init(){

	//Cargamos los items al select proveedor
	$.post("../../modelos/ComprasControlador.php?op=selectProveedor", function(r){
	            $("#idproveedor").html(r);
	            $('#idproveedor').selectpicker('refresh');
	});
	$.post("../../modelos/ComprasControlador.php?op=selectComprobante", function(r){
		$("#tipo_comprobante").html(r);
		$('#tipo_comprobante').selectpicker('refresh');

		
});
$.post("../../modelos/ComprasControlador.php?op=selectComprobante", function(r){
	$("#tipo_comprobante2").html(r);
	$('#tipo_comprobante2').selectpicker('refresh');

	tipo_comprobante2
});
	$.post("../../modelos/ComprasControlador.php?op=selectEstado", function(r){
		$("#estadoc").html(r);
		$('#estadoc').selectpicker('refresh');
});
	$.post("../../modelos/ComprasControlador.php?op=selectidcompra", function(r){
		

		
		$("#num_comprobante").val(r);
});

	
}

//Función limpiar
function limpiar()
{
	$("#idproveedor").val("");
	$("#proveedor").val("");
	$("#serie_comprobante").val("");
	$("#num_comprobante").val("");
	$("#impuesto").val("15 %");

	$("#total_compra").val("");
	$(".filas").remove();
	$("#total").html("0");
	
	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_hora').val(today);

    //Marcamos el primer tipo_documento
  

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarArt").show();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}

}
//Función generar pdf
function generarpdf() {
    let buscador = $('.dataTables_filter input').val();
    let url = '../../fpdf/Reportecompras.php?buscador=' + encodeURIComponent(buscador);
    
    // Abre la URL en una nueva ventana
    window.open(url, '_blank');
}



  function detalleM(idingreso) {

	let url = '../../fpdf/ReporteDetalleCompra.php?buscador=' + encodeURIComponent(idingreso);
	window.location.href = url;
  }
  
//Función cancelarform
function cancelarform()
{
	window.location.href = '../administrador/compras.php';

	limpiar();
	mostrarform(false);
	
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/ingreso.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Función ListarArticulos
function listarArticulos()
{
	tabla=$('#tblarticulos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            
		        ],
		"ajax":
				{
					url: '../../modelos/ComprasControlador.php?op=listarArticulos',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar


function guardaryeditar(e)
{
	
var form = document.querySelector('#formulario');
form.onsubmit = function (e) {
    e.preventDefault();
	const fechaActual = new Date();
	const fechaInput = new Date(document.getElementById("fecha_hora").value);
	
	if (fechaInput.getTime() > fechaActual.getTime()) {
	  // La fecha ingresada es mayor que la fecha actual
	  alert("La fecha ingresada no puede ser mayor a la fecha actual.");
	 return false;
	}else{

	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../../modelos/ComprasControlador.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

		success: function(datos)
		{                    
			bootbox.alert({
				message: datos,
				callback: function() {
					//location.reload();
					// Abre la página "nuevaPagina.html" en una nueva ventana
					window.location.href = "../administrador/Compras.php";


				}
			});	          
			mostrarform(false);
			listar();
		}
	
	});
	limpiar();
}
}	
}
function actualizar()
{
	var formData = new FormData($("#formulario2")[0]);

	$.ajax({
		url: "../../modelos/ComprasControlador.php?op=actualizar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

		success: function(datos)
		{                    
			bootbox.alert({
				message: datos,
				callback: function() {
					
				}
			});	          
			
		tableRoles.api().ajax.reload();	
		
		}
		

	});

}
function mostrar(idingreso)
{
	$.post("../../modelos/ComprasControlador.php?op=mostrar",{idingreso : idingreso}, function(data, status)
	{
		//window.location.href = '../administrador/mostrarcompra.php';
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idproveedor").val(data.id_proveedor);
		$("#idproveedor").selectpicker('refresh');
		$("#tipo_comprobante2").val(data.id_comprobante);
		$("#tipo_comprobante2").selectpicker('refresh');
		$("#estadoc").val(data.id_estado_compras);
		$("#estadoc").selectpicker('refresh');
		$("#num_comprobante").val(data.id_compra);
		$("#fecha_hora").val(data.fecha);
		$("#impuesto").val(data.impuesto);
		$("#idingreso").val(data.id_compra);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
 	});

 	$.post("../../modelos/ComprasControlador.php?op=listarDetalle&id="+idingreso,function(r){
	        $("#detalles").html(r);
	});
}

//Función para anular registros
function anular(idingreso)
{
	bootbox.confirm({
		message: "¿Está seguro de anular la compra?",
		buttons: {
			confirm: {
				label: 'Aceptar',
				className: 'btn-success'
			},
			cancel: {
				label: 'Cancelar',
				className: 'btn-danger'
			}
		},
		callback: function(result) {
			if (result) {
				$.post("../../modelos/ComprasControlador.php?op=anular", { idingreso: idingreso }, function(e) {
					bootbox.alert(e);
					tableRoles.api().ajax.reload();
				});
			}
		}
	});
	
}

//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto='15 %';
var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();


function marcarImpuesto()
  {
  	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
 
        $("#impuesto").val(impuesto); 
    
    
  }

  function agregarDetalle(idarticulo, articulo) {
	var cantidad = 1;
	var precio_venta = 1;
	var encontrado = false;
	
	// Busca si el artículo ya está en la tabla
	$('#detalles tr').each(function(i, fila) {
	  if ($(fila).find('input[name="idarticulo[]"]').val() == idarticulo) {
		encontrado = true;
		var cantidad_actual = parseInt($(fila).find('input[name="cantidad[]"]').val());
		$(fila).find('input[name="cantidad[]"]').val(cantidad_actual + 1);
		modificarSubototales();
	  }
	});
	
	if (!encontrado) {
	  // Si no se encontró, agrega una nueva fila
	  var subtotal = (cantidad * precio_venta);
	  var fila = '<tr class="filas" id="fila'+cont+'">'+
		'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
		'<td><input type="hidden" name="idarticulo[]" style="width: 500px;" value="'+idarticulo+'">'+articulo+'</td>'+
		'<td><input type="number" name="cantidad[]" id="cantidad[]" style="width: 50px;" value="'+cantidad+'"onkeypress="validarPrecio(event);" onkeyup="modificarSubototales()"></td>'+
		'<td><input type="text" name="precio_venta[]" id="cantidad[]" style="width: 200px;" value="'+precio_venta+'" onkeypress="validarPrecio(event);" onkeyup="modificarSubototales()"></td>'+
		
		'<td><span name="subtotal" id="subtotal'+cont+'">'+ (subtotal * 0.15 ) + subtotal +'</span></td>'+
		'<td><span name="ISV" id="ISV'+cont+'">'+ (subtotal * 0.15) +'</span></td>'
	
		'</tr>';
	  cont++;
	  detalles++;
	  $('#detalles').append(fila);
	  modificarSubototales();
	}
  }
  
  function validarPrecio(event) {
	const input = event.target;
	const regex = /^\d*\.?\d{0,2}$/;
	const char = String.fromCharCode(event.keyCode);
  
	if (!regex.test(input.value + char)) {
	  event.preventDefault();
	}
  }
  
  function modificarSubototales()
  {
	  var cant = document.getElementsByName("cantidad[]");
	  var prec = document.getElementsByName("precio_venta[]");
	  var sub = document.getElementsByName("subtotal");
  
	  for (var i = 0; i <cant.length; i++) {
		  var inpC=cant[i];
		  var inpP=prec[i];
		  var inpS=sub[i];
  
		  inpS.value=inpC.value * inpP.value;
		  document.getElementsByName("subtotal")[i].innerHTML = (inpS.value * 0.15 + inpS.value).toFixed(2) ;
		  document.getElementsByName("ISV")[i].innerHTML = (inpS.value * 0.15).toFixed(2);


		
	  }
	  calcularTotales();
  }
  function calcularTotales(){
  	var sub = document.getElementsByName("subtotal");
  	var total = 0.0;

  	for (var i = 0; i <sub.length; i++) {
		total += (document.getElementsByName("subtotal")[i].value) *  0.15 + (document.getElementsByName("subtotal")[i].value);
		
	}
	
	$("#total").html("L. " + total.toFixed(2));
    $("#total_compra").val(total.toFixed(2));
    evaluar();
  }

  function evaluar(){
  	if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide(); 
      cont=0;
    }
  }

  function eliminarDetalle(indice){
  	$("#fila" + indice).remove();
  	calcularTotales();
  	detalles=detalles-1;
  	evaluar();
  }

init();