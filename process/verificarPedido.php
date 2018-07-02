<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$NumPedido=isset($_POST['NumPedido']) ? $_POST['NumPedido'] : '';

if(consultasSQL::InsertSQL("verificado", "CodVerf, NumPedido, Estado, Fecha", "'NULL','{$NumPedido}', '1','NULL'")){
  header('Location: ../configAdmin.php?view=order');
}else{
  echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
}