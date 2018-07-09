<?php
session_start();
error_reporting(E_PARSE);
if ($_SESSION['nombre']=="") {
    header("Location: index.php");
}