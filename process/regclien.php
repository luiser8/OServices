<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

$rifCliente=consultasSQL::clean_string($_POST['clien-rif']);
$nameCliente=consultasSQL::clean_string($_POST['clien-name']);
$fullnameCliente=consultasSQL::clean_string($_POST['clien-fullname']);
$passCliente=consultasSQL::clean_string(md5($_POST['clien-pass']));
$passCliente2=consultasSQL::clean_string(md5($_POST['clien-pass2']));
$dirCliente=consultasSQL::clean_string($_POST['clien-dir']);
$phoneCliente=consultasSQL::clean_string($_POST['clien-phone']);
$emailCliente=consultasSQL::clean_string($_POST['clien-email']);

if(!$rifCliente=="" && !$nameCliente=="" && !$dirCliente=="" && !$phoneCliente=="" && !$emailCliente=="" && !$fullnameCliente==""){
    if($passCliente==$passCliente2){
        $verificar= ejecutarSQL::consultar("SELECT * FROM cliente WHERE RIF='".$rifCliente."'");
        $verificaltotal = mysqli_num_rows($verificar);
        if($verificaltotal<=0){
            if(consultasSQL::InsertSQL("cliente", "RIF, Nombre, NombreCompleto, Direccion, Clave, Telefono, Email", "'$rifCliente','$nameCliente','$fullnameCliente','$dirCliente', '$passCliente','$phoneCliente','$emailCliente'"))
            {
                consultasSQL::InsertSQL("usuarios","nombre,clave,codnivel,rif","'$nameCliente','$passCliente','2','$rifCliente'");
                echo '<script>
                    swal({
                      title: "Registro completado",
                      text: "El registro se completó con éxito, ya puedes iniciar sesión en el sistema",
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
                        location.reload();
                      } else {
                        location.reload();
                      }
                    });
                  </script>';
            }else{
               echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
            }
        }else{
            echo '<script>swal("ERROR", "CI/RIF ingresado ya está registrado en el sistema, por favor ingrese otro número de identificación", "error");</script>';
        }
        mysqli_free_result($verificar);
    }else{
        echo '<script>swal("ERROR", "Las contraseñas no coinciden, por favor verifique e intente nuevamente", "error");</script>';
    }
}else {
    echo '<script>swal("ERROR", "Los campos no pueden estar vacíos", "error");</script>';
}