<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("localitation: inicio.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Validación de Formulario con Javascript</title>
	<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="accesos/CSS/Estiloscambio.css">
</head>
<body>
	<main>
         </br></br></br></br>
        <h2>Cambiar contraseña</h2>
		<form action="recuperarcontra.php" method="POST" class="formulario" id="formulario">
			<!-- Usuario -->
			<div class="formulario__grupo" id="grupo__usuario">
				<label for="usuario" class="formulario__label">Usuario</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" onblur="cambiarAMayusculas(this);" name="usuario" id="usuario" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>

		<!-- Contraseña anterior -->
		<div class="formulario__grupo" id="grupo__passwordant">
			<label for="password" class="formulario__label">Contraseña enviada a su correo</label>
			<div class="formulario__grupo-input">
				<input type="password" class="formulario__input" name="passwordant" id="passwordant">
                <i class="formulario__validacion-estado fa-solid fa-eye" id="Ojito1"></i>
				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<p class="formulario__input-error">La contraseña tiene que ser de 6 a 20 dígitos.</p>
		</div>

			<!-- Nueva Contraseña -->
			<div class="formulario__grupo" id="grupo__password">
				<label for="password" class="formulario__label">Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="password" id="password">
                    <i class="formulario__validacion-estado fa-solid fa-eye" id="Ojito2"></i>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La contraseña tiene que ser de 6 a 20 dígitos.</p>
			</div>

			<!-- Confirmar Contraseña -->
			<div class="formulario__grupo" id="grupo__password2">
				<label for="password2" class="formulario__label">Confirmar Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="password2" id="password2">
                            <i class="formulario__validacion-estado fa-solid fa-eye" id="Ojito3"></i>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
			</div>


			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor llene todos los campos correctamente </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="submit" class="formulario__btn">Confirmar</button>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
			</div>
            <div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="reset" onclick="location.href='index.php'" class="formulario__btncancelar">Cancelar</button>
			</div></br>

            <script>
                        function cambiarAMayusculas(elemento) {
                            let texto = elemento.value;
                            elemento.value = texto.toUpperCase();
                        }
                    </script>
		</form>
	</main>

	<script src="accesos/JS/formulariocontra.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>