

document.getElementById("btn__iniciar-secion").addEventListener("click", IniciarSecion);
document.getElementById("btn__Registrarse").addEventListener("click", registro);
document.getElementById("btn__Recupera").addEventListener("click", recuperar);
window.addEventListener("resize", AnchoPagina);


// declaracion de variables 
var contenedor__login_registro= document.querySelector(".contenedor__login-registro")
var formulario_login = document.querySelector(".formulario__login")
var formulario_registro = document.querySelector(".formulario__registro")
var formulario_recupera = document.querySelector(".formulario_recupera")
var Caja_trasera_login = document.querySelector(".caja__trasera__login")
var Caja_trasera_registro = document.querySelector(".caja__trasera__Registro")



function AnchoPagina(){
    if(window.innerWidth > 850){
        Caja_trasera_login.style.display = "block"
        Caja_trasera_registro.style.display = "block"
        formulario_recupera.style.display = "none";
    }else{
        Caja_trasera_registro.style.display = "block";
        Caja_trasera_registro.style.opacity = "1";
        Caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        formulario_registro.style.display= "none";
        formulario_recupera.style.display = "none";
        contenedor__login_registro.style.left = "0px";
    }
}

AnchoPagina();

function IniciarSecion(){
    if(window.innerWidth > 850){
    formulario_registro.style.display = "none";
    formulario_recupera.style.display = "none";
    contenedor__login_registro.style.left = "10px"; 
    formulario_login.style.display = "block";
    Caja_trasera_registro.style.opacity = "1";
    Caja_trasera_login.style.opacity = "0";
    }else{
    formulario_registro.style.display = "none";
    contenedor__login_registro.style.left = "0px"; 
    formulario_login.style.display = "block";
    Caja_trasera_registro.style.display = "block";
    Caja_trasera_login.style.display = "none";
    }


    }


function registro(){
    if(window.innerWidth > 850){
formulario_registro.style.display = "block";
contenedor__login_registro.style.left = "410px"; 
formulario_login.style.display = "none";
Caja_trasera_registro.style.opacity = "0";
Caja_trasera_login.style.opacity = "1";
}else{
    formulario_registro.style.display = "block";

    contenedor__login_registro.style.left = "0px"; 
    formulario_login.style.display = "none";
    Caja_trasera_registro.style.display = "none";
    Caja_trasera_login.style.display = "block";
    Caja_trasera_login.style.opacity = "1";
}

}





function recuperar(){
    if(window.innerWidth > 850){
        formulario_recupera.style.display = "block";
        contenedor__login_registro.style.left = "410px"; 
        formulario_login.style.display = "none";
        Caja_trasera_recupera.style.opacity = "0";
        Caja_trasera_login.style.opacity = "1";
        }else{
            formulario_registro.style.display = "block";
        
            contenedor__login_registro.style.left = "0px"; 
            formulario_login.style.display = "none";
            Caja_trasera_recupera.style.display = "none";
            Caja_trasera_login.style.display = "block";
            Caja_trasera_login.style.opacity = "1";
        }

}

 function cambiarAMayusculas(elemento){
        let texto = elemento.value;
        elemento.value = texto.toUpperCase();
    }

 

