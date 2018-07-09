<?php
    error_reporting(E_PARSE);
    session_start();
	include '../library/configServer.php';
	include '../library/consulSQL.php';
	consultasSQL::DeleteSQL('carrito', "CodCarrito='".$_POST['codcarrito']."'");
    echo '<script> window.location="carrito.php"; </script>';