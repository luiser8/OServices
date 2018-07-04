<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$NumPedido=isset($_POST['NumPedido']) ? $_POST['NumPedido'] : '';
$Cliente = isset($_POST['RIF']) ? $_POST['RIF'] : '';

if(consultasSQL::InsertSQL("verificado", "CodVerf, NumPedido, Estado, Fecha", "'NULL','{$NumPedido}', '1','NULL'")){
	consultasSQL::DeleteSQL('carrito', "Cliente='".$Cliente."'");
	consultasSQL::UpdateSQL("venta", "Estado='verificado'", "NumPedido='$NumPedido'");
  header('Location: ../configAdmin.php?view=order');
}else{
  echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
}