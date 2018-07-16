<?php
error_reporting(E_PARSE);
include '../library/configServer.php';
include '../library/consulSQL.php';
session_start();
$codigo=consultasSQL::clean_string($_POST['codigo']);
$nombre=consultasSQL::clean_string($_POST['nombre']);
$precio=consultasSQL::clean_string($_POST['precio']);
$descuento=consultasSQL::clean_string($_POST['descuento']);
$cantidad=consultasSQL::clean_string($_POST['cantidad']);
$subtotal=$cantidad*$precio;

//Datos para guardar
if($codigo && $cantidad>0){
        consultasSQL::InsertSQL("carrito", "CodigoProd, Cliente, NombreProd, Precio, Cantidad, Subtotal, descuento",
                "'{$codigo}','{$_SESSION['UserNIT']}','{$nombre}', '{$precio}',
                '{$cantidad}', '{$subtotal}', '{$descuento}'");
echo '<script>
        swal({
        title: "Producto agregado",
        text: "Quieres ver el carrito de compras?",
        type: "info",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        cancelButtonClass: "btn-primary",
        confirmButtonText: "Si, ir al carrito",
        cancelButtonText: "No, seguir comprando",
        closeOnConfirm: false
        },
        function(isConfirm) {
            if (isConfirm) {
                window.location="carrito.php";
            } else {
                window.location="product.php";
            }
        });
        
    </script>';
}
