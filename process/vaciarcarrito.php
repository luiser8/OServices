<?php
require_once "../library/configServer.php";
require_once "../library/consulSQL.php";
session_start();
unset($_SESSION['carro']);
consultasSQL::DeleteSQL('carrito', "Cliente='".$_SESSION['UserNIT']."'");
?>
<script>
    window.location = "../carrito.php";
</script>
