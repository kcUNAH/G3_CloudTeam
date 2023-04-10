const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
	cantidad: /[0-9]{1,100}$/,
}

const campos = {
	cantidad: false,
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "cantidad":
			validarCampo(expresiones.cantidad, e.target, 'cantidad');
			validarMayor();
		break;
	}
}



function validarMayor(){
	var inputMayor = document.getElementById('cantidad').value;

	if ( inputMayor < 0 || inputMayor == '-' ) {
		document.getElementById(`grupo__cantidad`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cantidad`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__cantidad .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['cantidad'] = false;
	} else {
		document.getElementById(`grupo__cantidad`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__cantidad`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__cantidad .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['cantidad'] = true;

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

	if ((campos.cantidad) ) {
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