const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
    nombre_proveedor: /[ /^[a-zA-ZÀ-ÿ\s]{3,25}$/,// Letras, numeros, guion y guion_bajo
	rtn_proveedor:/^(?=.*[1-9])[0-9.?\d]{1,14}$/,


	telefono:/^(?=.*[1-9])[0-9.?\d]{1,8}$/,
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	direccion: /[ /^[a-zA-ZÀ-ÿ\s]{3,100}$/,
}

const campos = {
    nombre_proveedor: false,
	rtn_proveedor: false,
	telefono: false,
	email: false,
	direccion: false,

}

const validarFormulario = (e) => {
	switch (e.target.name) {
		
		
        case "nombre_proveedor":
			validarCampo(expresiones.nombre_proveedor, e.target, 'nombre_proveedor');
		break;
        case "rtn_proveedor":
			validarCampo(expresiones.rtn_proveedor, e.target, 'rtn_proveedor');
		break;
        case "telefono":
			validarCampo(expresiones.telefono, e.target, 'telefono');
		break;
		case "email":
			validarCampo(expresiones.email, e.target, 'email');
		break;
		case "direccion":
			validarCampo(expresiones.direccion, e.target, 'direccion');
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

	if (( campos.nombre_proveedor && campos.rtn_proveedor && campos.telefono && campos.email && campos.direccion) ) {
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