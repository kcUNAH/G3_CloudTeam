<?php
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "ferrecomm_db";

	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn -> set_charset("utf8");
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }
	  $servername = "localhost";
$username = "root";
$password = "";
$dbname = "ferrecomm_db";
try {
    $db= new PDO( "mysql:host=localhost;dbname=ferrecomm_db",
                  "root",
                  "", 
                  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));           
} catch (PDOException $e) {
    echo "ERROR DE CONEXION DE: ".$e->getMessage();
}


?>
