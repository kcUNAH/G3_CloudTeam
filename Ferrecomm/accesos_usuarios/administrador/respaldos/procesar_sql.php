<?php
$conn = mysqli_connect("localhost", "root", "", "ferrecomm_db");
  // verificar la conexión
  if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
  }

  if(isset($_FILES['archivo_sql']) && $_FILES['archivo_sql']['error'] == UPLOAD_ERR_OK) {
    $archivo_tmp = $_FILES['archivo_sql']['tmp_name'];
    $archivo_nombre = $_FILES['archivo_sql']['name'];
    $archivo_tipo = $_FILES['archivo_sql']['type'];

    if(pathinfo($archivo_nombre, PATHINFO_EXTENSION) == 'sql') {
      // abrir el archivo .sql
      $sql = file_get_contents($archivo_tmp);

      // ejecutar el archivo .sql
      if ($conn->multi_query($sql) === TRUE) {
        echo '
    <script>
    alert("El archivo SQL se ha procesado correctamente, porfavor vuelva a iniciar sesión");
    window.location= "../../../php/Cerrar_Seccion.php";
    </script>
    ';
      } else {
        echo "Error al procesar el archivo SQL: " . $conn->error;
      }
    } else {
      echo "El archivo seleccionado no es un archivo SQL válido.";
    }
  }

  // cerrar la conexión
  $conn->close();
?>
