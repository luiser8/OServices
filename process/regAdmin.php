<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$nameAdmin=consultasSQL::clean_string($_POST['admin-name']);
$adminnivel=consultasSQL::clean_string($_POST['admin-nivel']);
$passAdmin1=consultasSQL::clean_string($_POST['admin-pass1']);
$passAdmin2=consultasSQL::clean_string($_POST['admin-pass2']);

if($passAdmin1!=$passAdmin2){
    echo '<script>swal("ERROR", "Las contraseñas que acaba de ingresar no coinciden", "error");</script>';
    exit();
}

$passAdminFinal=md5($passAdmin1);

$verificar=ejecutarSQL::consultar("SELECT * FROM usuarios WHERE Nombre='".$nameAdmin."'");
if(mysqli_num_rows($verificar)<=0){
    if(consultasSQL::InsertSQL("usuarios", "Nombre, Clave, CodNivel", "'$nameAdmin','$passAdminFinal', '$adminnivel'")){
        echo '<script>
            swal({
              title: "Administrador registrado",
              text: "El administrador se registró con éxito",
              type: "success",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Aceptar",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
              },
                    function(isConfirm) {
      if (isConfirm) {
        window.location.href = "configAdmin.php?view=adminlist";
      } else {
        location.reload();
      }
    });
        </script>';
    }else{
       echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
    }
}else{
    echo '<script>swal("ERROR", "El nombre de usuario que acaba de ingresar ya se encuentra registrado, por favor elija otro", "error");</script>';
}