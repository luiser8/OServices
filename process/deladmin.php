<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$code=consultasSQL::clean_string($_POST['admin-code']);
if(consultasSQL::DeleteSQL('usuarios', "id='{$code}'")){
    echo '<script>
	    swal({
	      title: "Usuario eliminado",
	      text: "El Usuario se eliminó con éxito",
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

