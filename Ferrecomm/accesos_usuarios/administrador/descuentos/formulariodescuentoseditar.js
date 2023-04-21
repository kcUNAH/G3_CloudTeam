const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
    nombre_descuento: /^[a-zA-ZÀ-ÿ0-9\s]{2,40}$/,// Letras, numeros, guion y guion_bajo
    porcentaje_descontar: /[0-9\.\d\d?]{1,100}$/,
}

const campos = {
    nombre_descuento: true,
    porcentaje_descontar: true,
}

const validarFormulario = (e) => {
	switch (e.target.name) {
        case "nombre_descuento":
			validarCampo(expresiones.nombre_descuento, e.target, 'nombre_descuento');
		break;
        case "porcentaje_descontar":
            validarCampo(expresiones.porcentaje_descontar, e.target, 'porcentaje_descontar')
			validarPorcentaje();
		break;
	}
}

function validarPorcentaje(){
	var inputPrecio = Number(document.getElementById('porcentaje_descontar').value);

	if ( inputPrecio <= 0 || inputPrecio > 100 || isNaN(inputPrecio)) {
		document.getElementById(`grupo__porcentaje_descontar`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__porcentaje_descontar`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__porcentaje_descontar .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos['porcentaje_descontar'] = false;
	} else {
		document.getElementById(`grupo__porcentaje_descontar`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__porcentaje_descontar`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__porcentaje_descontar .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos['porcentaje_descontar'] = true;

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

	if ((campos.nombre_descuento && campos.porcentaje_descontar ) ) {
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