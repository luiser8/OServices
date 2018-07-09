<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

$rifOldProveUp=consultasSQL::clean_string($_POST['rif-prove-old']);
$nameProveUp=consultasSQL::clean_string($_POST['prove-name']);
$dirProveUp=consultasSQL::clean_string($_POST['prove-dir']);
$telProveUp=consultasSQL::clean_string($_POST['prove-tel']);
$emailProveUp=consultasSQL::clean_string($_POST['prove-email']);

if(ejecutarSQL::Consultar("UPDATE proveedor SET NombreCompleto='{$nameProveUp}',Direccion='{$dirProveUp}',Telefono='{$telProveUp}',
                            Email='{$emailProveUp}'
                           WHERE RIFProveedor='{$rifOldProveUp}'")){
    echo '<script>
        swal({
          title: "Proveedor actualizado",
          text: "Los datos del proveedor se actualizaron correctamente",
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