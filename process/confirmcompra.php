<?php
session_start(); 
include '../library/configServer.php';
include '../library/consulSQL.php';
$NumDepo=consultasSQL::clean_string($_POST['NumDepo']);
$tipoenvio=consultasSQL::clean_string($_POST['tipo-envio']);
if($tipoenvio!='Recoger Por Tienda')
{
  $nombreenvio=consultasSQL::clean_string($_POST['nombre-envio']);
  $direnvio=consultasSQL::clean_string($_POST['dir-envio']);
  $tlfenvio=consultasSQL::clean_string($_POST['tlf-envio']);
}
else
{
  $nombreenvio=NULL;
  $direnvio=NULL;
  $tlfenvio=NULL;
}
$Cedclien=$_SESSION['UserNIT'];
$cuentabanco=consultasSQL::clean_string($_POST['cuentabancaria']);
$comprobanteTMP=$_FILES['comprobante']['tmp_name'];
$comprobanteName=$_FILES['comprobante']['name'];
//$comprobanteType=$_FILES['comprobante']['type'];
$comprobanteMaxSize=5120;
$comprobanteDir="../assets/comprobantes/";

$consulta=ejecutarSQL::consultar("SELECT numpedido + 1 AS proxVenta FROM venta
                                  ORDER BY numpedido DESC LIMIT 1");
$verData=mysqli_fetch_array($consulta, MYSQLI_ASSOC);
$proximaVenta=$verData['proxVenta'];             

if($_SESSION['carro']) { 
  if(!empty($comprobanteType)){
    if($comprobanteType=="image/jpeg" || $comprobanteType=="image/png"){
      if(($comprobanteSize/1024)<=$comprobanteMaxSize){
        chmod($comprobanteDir, 0777);
        switch ($comprobanteType) {
          case 'image/jpeg':
            $extPicture=".jpg";
          break;
          case 'image/png':
            $extPicture=".png";
          break;
        }
          
        $comprobanteF="comprobante_".($proximaVenta).$extPicture;
        
        if(!move_uploaded_file($_FILES['comprobante']['tmp_name'], $comprobanteDir.$comprobanteF)){
          echo '<script>swal("ERROR", "No se pudo subir el archivo adjunto", "error");</script>';
          exit();
        }
        }else{
          echo '<script>swal("ERROR", "El tamaño del adjunto es muy grande", "error");</script>';
          exit();
        }
    }else{
      echo '<script>swal("ERROR", "El formato del adjunto es invalido, por favor verifica e intenta nuevamente", "error");</script>';
      exit();
    }
  }else{
    $comprobanteF="Sin archivo adjunto";
  }
  

    $StatusV="Pendiente";

    $total_carrito=ejecutarSQL::consultar("SELECT sum(cantidad*precio) subtotal, round(sum(cantidad*precio)*0.12,2) iva, 
                                                                   round(sum(cantidad*precio)*1.12,2) total
                                                                   FROM carrito WHERE cliente='{$_SESSION['UserNIT']}'
                                                                   GROUP BY cliente");
    $suma = mysqli_fetch_array($total_carrito, MYSQLI_ASSOC);

    /*Insertando venta*/
    if(consultasSQL::InsertSQL("venta", "Fecha, RIF, TotalPagar, Estado, NumeroDeposito, TipoEnvio, NombreEnvio, DirEnvio, TlfEnvio, Adjunto,NumeroCuenta",
    "curdate(),'$Cedclien','{$suma['subtotal']}','$StatusV','$NumDepo','$tipoenvio','$nombreenvio','$direnvio','$tlfenvio','$comprobanteF','$cuentabanco'")){

     /*Insertando datos en detalles de la venta*/
            
      ejecutarSQL::consultar("INSERT INTO detalle (Numpedido,CodigoProd,cantidadproductos,PrecioProd) 
      (SELECT '{$proximaVenta}',CodigoProd, Cantidad, Precio FROM carrito WHERE cliente='{$Cedclien}')");   

      /*Vaciando el carrito*/
      unset($_SESSION['carro']);
      consultasSQL::DeleteSQL('carrito', "Cliente='".$Cedclien."'");
      echo '<script>
      swal({
        title: "Pedido realizado",
        text: "El pedido se ha realizado con éxito",
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
      echo '<script>swal("ERROR", "Ha ocurrido un error inesperado", "error");</script>';
    }
  }else{
    echo '<script>swal("ERROR", "No has seleccionado ningún producto, revisa el carrito de compras", "error");</script>';
  }
