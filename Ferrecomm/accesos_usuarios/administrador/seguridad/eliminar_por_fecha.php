<?php
include '../conex.php';

if(isset($_POST['delete_by_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $delete_query = "DELETE FROM tbl_bitacora WHERE fecha BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($conex, $delete_query);

    if($result) {
        echo '<script>
            alert("Registros eliminados exitosamente.");
            window.location = "mostrarbitacora.php";
        </script>';
    } else {
        echo '<script>
            alert("Error al eliminar registros: '.mysqli_error($conex).'");
            window.location = "mostrarbitacora.php";
        </script>';
    }
}

mysqli_close($conex);
?>
