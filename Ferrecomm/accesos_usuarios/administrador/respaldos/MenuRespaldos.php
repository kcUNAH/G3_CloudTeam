
<!DOCTYPE html>
<html lang="en" dir="ltr">
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../accesos/CSS/EstiloMenu.css">
    <link rel="stylesheet" href="../../../accesos/CSS/respaldos.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php include "../productos/menu.php"; ?>
   </head>
<body>
  
  <section class="home-section">
  <h1> Respaldos <i class='bx bxs-notepad'></i></h1>


  <section class="home-section">  
    

    <!-- Aqui inicia el formulario-->
  
                    
                      
                     </div>
              
    <label>¿Que acción desea realizar?</label>
    <form action="respaldo.php" method="post" enctype="multipart/form-data" >
    <button type="submit" class="btn btn-dark" name="btnrespaldo" value="ok">Respaldo</button>
    <button type="button" class="btn btn-outline-danger" onclick="location.href='../seguridad.php'" >Cancelar</button>
    </form>


    <form action="procesar_sql.php" method="post" enctype="multipart/form-data">
    <label for="archivo_sql">Selecciona un archivo SQL: </label><br>
    <input type="file" name="archivo_sql" id="archivo_sql">
    <br></br>
    <input type="submit" value="Enviar">
    </form>

    
    
 
    
</div>
 

<!--diseño buscar-->
<style type="text/css">
form {
  display: flex;
  align-items: center;
  margin-bottom:30px;
}



input[type="submit"] {
  background-color: #4CAF50;
  color: black;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  padding: 8px 16px;
  font-size: 15px;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  padding: 8px 16px;
  font-size: 16px;
  margin-top: 30px;
  margin-left: 10px;
}

button[type="button"] {
  background-color: red;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  padding: 8px 16px;
  font-size: 16px;
  margin-top: 30px;
  margin-left: 10px;
}

table{
    border-collapse: collapse;
    font-size: 10pt;
    font-family: Arial;
    margin-left: 40px;
    margin-right: 5px;
    background-color: #fff;
    
}

thead{
  background-color: rgba(255, 102, 0, 0.911);
  border-bottom: solid 5px;
  color: rgb(0, 0, 0);
}


table td:first-child {
    width: 70px;
  }
  table td:nth-child(2){
    width: 180px;
  }
  table td:nth-child(3){
    width: 30px;
  }
  table td:nth-child(4){
    width: 30px;
  }
  table td:nth-child(5){
    width: 150px;
  }
  table td:nth-child(6){
    width: 200px;
  }
  


/*Tamaño de los th de la tabla*/
table th:first-child {
  width: 70px;
}
table th:nth-child(2){
  width: 180px;
}
table th:nth-child(3){
  width: 30px;
}
table th:nth-child(4){
  width: 30px;
}
table th:nth-child(5){
  width: 150px;
}
table th:nth-child(6){
  width: 200px;
}



  table td:last-child {
    width: 10px;
  }

.table .th{
    text-align: left;
    padding: 10px;
    background: #ffffff;
    color: #181212;
    
}


table tr:nth-child(){
    background: #fff;
}
table td {
    padding: 10px;
}


/*-----------Paginador------------*/
.paginador ul{
  padding: 15px;
  list-style: none;
  background: #DCFFFE;
  margin-top: 15px;
  display: -webkit-flex;
  display: -moz-flex;
  display: -ms-flex;
  display: -o-flex;
  display: flex;
  
}

.paginador a, .pageSelected{
  color: #428bca;
  border: 1px solid #ddd;
  padding: 5px;
  display: inline-block;
  font-size: 14px;
  text-align: center;
  width: 35px;
  text-decoration: none;
}


.paginador a:hover{
  background: #ddd;
}

.pageSelected{
  color: #fff;
  background: #428bca;
  border: 1px solid #428bca;
}
.btn_pdf{
    display: inline-block;
    background-color: rgba(255, 102, 0, 0.911);
    color:rgb(255, 255, 255);
    padding: 5px 25px;
    border-radius: 10px;
    margin: 20px;
    text-decoration: none;

} 
.h1{
    color:rgba(255, 102, 0, 0.911);
    margin-left: 20px;
    text-align: center;
    font-size: 30pt;
    
} 
.link_edit{
    color: green;
    font-size: 25px;
}

.link_delete{
    color: red;
    font-size: 25px;
}
</style>



</div>
    
</div>
  
</div>

      
</section>

  </script>

   
    <!-- Aqui termina el formularios-->
  </section>
  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();
  });

  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
   }
  }
  </script>
<!--Funciones js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">





</script>

  </html>
