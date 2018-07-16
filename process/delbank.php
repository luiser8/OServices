<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$codeCateg=consultasSQL::clean_string($_POST['categ-code']);
$cons=ejecutarSQL::consultar("SELECT * FROM cuentabanco WHERE id='$codeCateg'");
if(mysqli_num_rows($cons)>0){
    if(consultasSQL::DeleteSQL('cuentabanco', "id='".$codeCateg."'")){
        echo '<script>
		    swal({
		      title: "Registro eliminado",
		      text: "La petición se ha procesado exitosamente",
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
    echo '<script>swal("ERROR", "Lo sentimos no podemos eliminar la cuenta bancaria ya que existen registros asociados a la misma", "error");</script>';
}
mysqli_free_result($cons);