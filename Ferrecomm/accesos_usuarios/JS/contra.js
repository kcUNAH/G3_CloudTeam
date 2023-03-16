
$('.newPass').keyup(function(){
  
validPass();
});

function validPass(){
    var passNuevo= $('#clave_nueva').val();
 var confirmPassNuevo =$('#confirmar_clave').val();
 if(passNuevo != confirmPassNuevo){
    $('.alertChangePass').html('<p> Las contraseña no son Iguales.</p>');
    $('alertChangePass').slideDown();
    return false;
 }


} 
