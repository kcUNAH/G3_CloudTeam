const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
    nombre_producto: /[a-zA-ZáéíóúÁÉÍÓÚ\S]{3,16}$/,// Letras, numeros, guion y guion_bajo
    descripcion_producto: /^[a-zA-Z0-9áéíóúÁÉÍÓÚ\_\-\s]/,
    precio_producto: /[0-9\.\d\d?]{1,100}$/,
	unidad_medida: /\S[a-zA-Z0-9\.\,]{1,100}$/,
	cantidad_min: /^[0-9]+$/,
	cantidad_max: /^[0-9]+$/,
}

const campos = {
    nombre_producto: false,
    descripcion_producto: false,
    precio_producto: false,
	unidad_medida: false,
	cantidad_min: false,
	cantidad_max: false,
}

const validarFormulario = (e) => {
	switch (e.target.name) {
        case "nombre_producto":
			validarCampo(expresiones.nombre_producto, e.target, 'nombre_producto');
		break;
        case "descripcion_producto":
			validarCampo(expresiones.descripcion_producto, e.target, 'descripcion_producto');
		break;
        case "precio_producto":
			validarCampo(expresiones.precio_producto, e.target, 'precio_producto');
		break;
        case "unidad_medida":
			validarCampo(expresiones.unidad_medida, e.target, 'unidad_medida');
		break;
		case "cantidad_min":
			validarMenor();
			validarMayor();
		break;
		case "cantidad_max":
			validarMenor();
			validarMayor();
		break;
	}
}


function validarMenor(){
	var inputMenor = Number(document.getElementById('cantidad_min').value);
	var inputMayor = Number(document.getElementById('cantidad_max').value);

	if (inputMenor > inputMayor || inputMenor == 0 || inputMenor === inputMayor) {
		document.getElementById(`grupo__cantidad_min`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cantidad_min`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__cantidad_min .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['cantidad_min'] = false;
	} else {
		document.getElementById(`grupo__cantidad_min`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cantidad_min`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__cantidad_min .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['cantidad_min'] = true;

	}

}

function validarMayor(){
	var inputMenor = Number(document.getElementById('cantidad_min').value);
	var inputMayor = Number(document.getElementById('cantidad_max').value);

	if ( inputMayor < inputMenor || inputMenor == 0 || inputMayor === inputMenor ) {
		document.getElementById(`grupo__cantidad_max`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cantidad_max`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__cantidad_max .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['cantidad_max'] = false;
	} else {
		document.getElementById(`grupo__cantidad_max`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cantidad_max`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__cantidad_max .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['cantidad_max'] = true;

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

	if ((campos.nombre_producto && campos.descripcion_producto && campos.precio_producto && campos.unidad_medida 
		&& campos.cantidad_min && campos.cantidad_max) ) {
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