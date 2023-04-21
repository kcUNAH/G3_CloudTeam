const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
    
	dni_cliente: /^(?=.*[1-9])[0-9.?\d]{1,13}$/,
    nombre_cliente: /[ /^[a-zA-ZÀ-ÿ\s]{3,25}$/,// Letras, numeros, guion y guion_bajo
	telefono_cliente:/^(?=.*[1-9])[0-9.?\d]{1,8}$/,
	direccion_cliente: /[ /^[a-zA-ZÀ-ÿ\s]{3,25}$/,
}

const campos = {
    dni_cliente: true,
	nombre_cliente: true,
	telefono_cliente: true,
	direccion_cliente: true,

}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		
        case "dni_cliente":
			validarCampo(expresiones.dni_cliente, e.target, 'dni_cliente');
		break;
        case "nombre_cliente":
			validarCampo(expresiones.nombre_cliente, e.target, 'nombre_cliente');
		break;
        case "telefono_cliente":
			validarCampo(expresiones.telefono_cliente, e.target, 'telefono_cliente');
		break;
		case "direccion_cliente":
			validarCampo(expresiones.direccion_cliente, e.target, 'direccion_cliente');
		break;
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

	if ((campos.dni_cliente && campos.nombre_cliente &&  campos.telefono_cliente  && campos.direccion_cliente) ) {
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