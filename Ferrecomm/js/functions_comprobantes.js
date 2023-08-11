
var tableRoles;
var tableprod;

document.addEventListener('DOMContentLoaded', function () {
	
    tableRoles = $('#tablePedidos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url":  '../../modelos/ComprobantesControlador.php?op=listar',
            "dataSrc": ""
            
        },
        "columns": [
            { "data": "id_comprobante" },
            { "data": "nombre" },
            { "data": "descripcion" },
            { "data": "estado" },
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


}

//Función limpiar
function limpiar()
{
	$("#idRol").val("");
	$("#Descripcion").val("");
	$("#serie_comprobante").val("");
	$("#NombreRol").val("");

	
    $('#fecha_hora').val(today);

    //Marcamos el primer tipo_documento
    $("#EstadoRol").val("Activo");
	$("#EstadoRol").selectpicker('refresh');
}

//Función mostrar formulario
function mostrarform(flag)
{


}

//Función cancelarform
function cancelarform()
{
	window.location.href = '../administrador/Comprobante.php';

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

	//$("#btnGuardar").prop("disabled",true);


	var formrol = document.querySelector('#formulario2');
	formrol.onsubmit = function (e) {
    e.preventDefault();

	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = "../../modelos/ComprobantesControlador.php?op=guardaryeditar";
	var formData = new FormData(formrol);
	request.open("POST", ajaxUrl, true);
	request.send(formData);
	
	request.onreadystatechange = function() {
		if (this.readyState === 4 && this.status === 200) {
			var response = this.responseText;
			// Display the response message in a div or alert box
			
			// Or use an alert box to display the response
			// alert(response);
			window.location.href = "../administrador/Comprobante.php";
			
			if(response == "Comprobante Ya existe"){
				bootbox.alert(response)

			}else{

				bootbox.alert(response)
				limpiar()
			}
		
					
				

			
		}
	};
	

  

}

}
function actualizar() {

	var formrol = document.querySelector('#formularioactualizar');
	formrol.onsubmit = function(e) {
	  e.preventDefault();
  
	  var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	  var ajaxUrl = "../../modelos/ComprobantesControlador.php?op=actualizar";
	  var formData = new FormData(formrol);
	  request.open("POST", ajaxUrl, true);
	  request.send(formData);
  
	  request.onreadystatechange = function() {
		if (this.readyState === 4 && this.status === 200) {
		  var response = this.responseText;
		  $("#myModal").modal("hide");
		  // Muestra el mensaje utilizando bootbox.alert()
		  bootbox.alert(response, function() {
			// Minimiza el modal después de mostrar el mensaje
			tableRoles.api().ajax.reload();	
		
		  });
		}
	  };
	}
  }
  
function mostrar(idingreso)
{
	$.post("../../modelos/ComprobantesControlador.php?op=mostrar",{idingreso : idingreso}, function(data, status)
	{
		//window.location.href = '../administrador/mostrarcompra.php';
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idComprobante").val(data.id_comprobante);
		$("#EstadoComprobante").val(data.estado);
		$("#EstadoComprobante").selectpicker('refresh');
		$("#Descripcion").val(data.descripcion);
		$("#NombreComprobante").val(data.nombre);
	
		//Ocultar y mostrar los botones
		$("#btnCancelar").show();
		
 	});

}

//Función para anular registros
function anular(idingreso)
{
	bootbox.confirm("¿Está Seguro de eliminar este  comprobante?", function(result){
		if(result)
        {
        	$.post("../../modelos/ComprobantesControlador.php?op=anular",{idingreso : idingreso}, function(e){
        		bootbox.alert(e);
	           
				tableRoles.api().ajax.reload();
        	});	
        }
	})
}

//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto=18;
var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto()
  {
  	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
  	if (tipo_comprobante=='Factura')
    {
        $("#impuesto").val(impuesto); 
    }
    else
    {
        $("#impuesto").val("0"); 
    }
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
	  var subtotal = cantidad * precio_venta;
	  var fila = '<tr class="filas" id="fila'+cont+'">'+
		'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
		'<td><input type="hidden" name="idarticulo[]" style="width: 500px;" value="'+idarticulo+'">'+articulo+'</td>'+
		'<td><input type="number" name="cantidad[]" id="cantidad[]" style="width: 50px;" value="'+cantidad+'" onkeyup="modificarSubototales()"></td>'+
		'<td><input type="text" name="precio_venta[]" style="width: 200px;" value="'+precio_venta+'" onkeyup="modificarSubototales()"></td>'+
		'<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
	
		'</tr>';
	  cont++;
	  detalles++;
	  $('#detalles').append(fila);
	  modificarSubototales();
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
		  document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
	  }
	  calcularTotales();
  }
  function calcularTotales(){
  	var sub = document.getElementsByName("subtotal");
  	var total = 0.0;

  	for (var i = 0; i <sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}
	$("#total").html("L. " + total);
    $("#total_compra").val(total);
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
  function generarpdf() {
    let buscador = $('.dataTables_filter input').val();
    let url = '../../fpdf/Reportecomprobante.php?buscador=' + encodeURIComponent(buscador);

    // Abre la URL en una nueva ventana
    window.open(url, '_blank');
}




  window.location.href = url;
init();