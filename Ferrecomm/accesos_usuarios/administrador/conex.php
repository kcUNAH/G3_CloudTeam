<?php
//el signo $ se utiliza para poder declarar una variable, se debe colocar al inicio 
//seguido del nombre de la variable 
// compocision de la conexion puerto, ususario,contraseña,nombre de la base de datos

$host = "localhost";
$user = "root";
$password = "";
$db = "ferrecomm_db";

$conex = @mysqli_connect($host, $user, $password,$db);



if(!$conex){
    echo "Erro en la conexión";
} 

?>