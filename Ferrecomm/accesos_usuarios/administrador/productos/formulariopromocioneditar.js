const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
    nombre_promocion: /^[a-zA-ZÀ-ÿ0-9\s]{2,40}$/,
    fecha_inicio: /[0-9\.\d\d?]{1,100}$/,
    fecha_final: /[0-9\.\d\d?]{1,100}$/,
    precio_venta:/[0-9\.\d\d?]{1,100}$/,
}

const campos = {
	nombre_promocion: true,
    fecha_inicio: true ,
    fecha_final: true,
    precio_venta: true,
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "nombre_promocion":
			validarCampo(expresiones.nombre_promocion, e.target, 'nombre_promocion');
		break;
        case "fecha_inicio":
            validarInicio();
            validarFinal();
		break;
        case "fecha_final":
            validarInicio();
            validarFinal();
		break;
        case "precio_venta":
			validarCampo(expresiones.precio_venta, e.target, 'precio_venta');
            validarPrecio();
		break;

	}
}

function validarPrecio(){
	var inputPrecio = Number(document.getElementById('precio_venta').value);

	if ( inputPrecio == 0  ) {
		document.getElementById(`grupo__precio_venta`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__precio_venta`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__precio_venta .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['precio_venta'] = false;
	} else {
		document.getElementById(`grupo__precio_venta`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__precio_venta`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__precio_venta .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['precio_venta'] = true;

	}

}

function validarInicio() {
    const inputInicio = document.getElementById('fecha_inicio');
    const inputFinal = document.getElementById('fecha_final');
    const fechaInicioRegex = /^\d{4}-\d{2}-\d{2}$/; // Expresión regular para validar el formato AAAA-MM-DD
    const fechaActual = new Date();
 
    
    const fechaInicio = new Date(inputInicio.value);
    const fechaFinal = new Date(inputFinal.value);
    
    if (fechaInicio > fechaFinal || fechaInicio == 0   ) {
      // Si la fecha de inicio es mayor que la fecha final, o si es una fecha inválida o está en el futuro, se marca como incorrecto
      document.getElementById('grupo__fecha_inicio').classList.add('formulario__grupo-incorrecto');
      document.getElementById('grupo__fecha_inicio').classList.remove('formulario__grupo-correcto');
      document.querySelector('#grupo__fecha_inicio .formulario__input-error').classList.add('formulario__input-error-activo');
      campos['fecha_inicio'] = false;
    } else {
      // Si la fecha de inicio es válida, se marca como correcto
      document.getElementById('grupo__fecha_inicio').classList.remove('formulario__grupo-incorrecto');
      document.getElementById('grupo__fecha_inicio').classList.add('formulario__grupo-correcto');
      document.querySelector('#grupo__fecha_inicio .formulario__input-error').classList.remove('formulario__input-error-activo');
      campos['fecha_inicio'] = true;
    }
  }

  function validarFinal() {
    const inputInicio = document.getElementById('fecha_inicio');
    const inputFinal = document.getElementById('fecha_final');
    const fechaInicioRegex = /^\d{4}-\d{2}-\d{2}$/; // Expresión regular para validar el formato AAAA-MM-DD
    const fechaActual = new Date();
    
    if (!fechaInicioRegex.test(inputFinal.value)) {
      // Si el formato de la fecha es incorrecto, se marca como incorrecto y se retorna
      document.getElementById('grupo__fecha_final').classList.add('formulario__grupo-incorrecto');
      document.getElementById('grupo__fecha_final').classList.remove('formulario__grupo-correcto');
      document.querySelector('#grupo__fecha_final .formulario__input-error').classList.add('formulario__input-error-activo');
      campos['fecha_final'] = false;
      return;
    }
    
    const fechaInicio = new Date(inputInicio.value);
    const fechaFinal = new Date(inputFinal.value);
    
    if (fechaFinal < fechaInicio   || fechaFinal == 0 ) {
      // Si la fecha de inicio es mayor que la fecha final, o si es una fecha inválida o está en el futuro, se marca como incorrecto
      document.getElementById('grupo__fecha_final').classList.add('formulario__grupo-incorrecto');
      document.getElementById('grupo__fecha_final').classList.remove('formulario__grupo-correcto');
      document.querySelector('#grupo__fecha_final .formulario__input-error').classList.add('formulario__input-error-activo');
      campos['fecha_final'] = false;
    } else {
      // Si la fecha de inicio es válida, se marca como correcto
      document.getElementById('grupo__fecha_final').classList.remove('formulario__grupo-incorrecto');
      document.getElementById('grupo__fecha_final').classList.add('formulario__grupo-correcto');
      document.querySelector('#grupo__fecha_final .formulario__input-error').classList.remove('formulario__input-error-activo');
      campos['fecha_final'] = true;
    }
  }

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}


inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
	e.preventDefault();

	if ((campos.nombre_promocion && campos.fecha_inicio && campos.fecha_final && campos.precio_venta) ) {
		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		});

		formulario.submit();

	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}


})