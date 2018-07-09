<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$NumPedido=isset($_POST['NumPedido']) ? $_POST['NumPedido'] : '';
$Cliente = isset($_POST['RIF']) ? $_POST['RIF'] : '';

if(consultasSQL::InsertSQL("verificado", "NumPedido, Estado ", "'{$NumPedido}', '1'")){
	
  //Se actualiza el estatus del pedido
  consultasSQL::UpdateSQL("venta", "Estado='Verificado'", "NumPedido='$NumPedido'");

  /*Actualizar el stock de cada producto en el pedido*/
  $consulta= ejecutarSQL::consultar("SELECT CodigoProd, CantidadProductos FROM detalle WHERE NumPedido='{$NumPedido}'");        
  while($fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
    $codigoProd=$fila['CodigoProd'];
    $cantidad=$fila['CantidadProductos'];
    ejecutarSQL::consultar("UPDATE producto SET Stock=Stock-'{$cantidad}' WHERE CodigoProd='{$codigoProd}'");
  }

  header('Location: ../configAdmin.php?view=order');
}else{
  echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
}