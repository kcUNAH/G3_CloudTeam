const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const input_contra = document.getElementById('contra');
const ojito = document.getElementById('Ojito');

const expresiones = {
	usuario: /^[a-zA-Z\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	contra: /^.{6,12}$/, // 6 a 12 digitos.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}


const campos = {
usuario :  false,
nombre : false,
contra : false,
email : false,
Password2 : false
}


const validarformulario  = (e) => {
switch(e.target.name){
	
	case "usuario":
		validarCampo(expresiones.usuario, e.target, 'usuario');
		break;

	case "nombre":
		validarCampo(expresiones.nombre, e.target, 'nombre');
		break;

	case "contra":
		validarCampo(expresiones.contra, e.target, 'contra');
		validarPassword2();
		break;

	case "password2":
		validarPassword2();
		break;

	case "email":
		validarCampo(expresiones.email, e.target, 'email');
		break;
	
}

}



const validarCampo = (expresion, input, campo) =>{
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;


	}else{
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}


const validarPassword2 = () => {
const inputPassword = document.getElementById('contra');
const inputPassword2 = document.getElementById('password2');

if(inputPassword.value !== inputPassword2.value){
	document.getElementById(`grupo__password2`).classList.add('formulario__grupo-incorrecto');
	document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-correcto');
	document.querySelector(`#grupo__password2 .formulario__input-error`).classList.add('formulario__input-error-activo');
	campos['contra'] = false;
} else {
	document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-incorrecto');
	document.getElementById(`grupo__password2`).classList.add('formulario__grupo-correcto');
	document.querySelector(`#grupo__password2 .formulario__input-error`).classList.remove('formulario__input-error-activo');
	campos['contra'] = true;
	
}

}




inputs.forEach((input) =>{
input.addEventListener('keyup', validarformulario);
input.addEventListener('blur', validarformulario);
})

formulario.addEventListener('submit', (e) => {
	e.preventDefault();


	if(campos.usuario && campos.nombre && campos.email && campos.contra){
		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		});

		formulario.submit(); 

	}else{
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}




})

this.addEventListener('click', (e) => {
	console.log(e.target);

	if(e.target.id === 'Ojito' || e.target.id === 'Ojito2'){
		if(e.target.previousElementSibling.type === 'password') {
			e.target.previousElementSibling.type = 'text'
			e.target.classList.remove('fa-eye')
			e.target.classList.add('fa-eye-slash')
	
		} else {
			e.target.previousElementSibling.type = 'password'
			e.target.classList.add('fa-eye')
			e.target.classList.remove('fa-eye-slash')
		}
	}
	
})