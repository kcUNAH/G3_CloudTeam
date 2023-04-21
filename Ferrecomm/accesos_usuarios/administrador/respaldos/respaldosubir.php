<!DOCTYPE html>
<html>
  <head>
    <title>Seleccionar archivo SQL</title>
  </head>
  <body>
    <form action="procesar_sql.php" method="post" enctype="multipart/form-data">
      <label for="archivo_sql">Selecciona un archivo SQL:</label>
      <input type="file" name="archivo_sql" id="archivo_sql">
      <br>
      <input type="submit" value="Enviar">
    </form>
  </body>
</html>
