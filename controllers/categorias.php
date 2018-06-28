<?php
require_once '../models/categoria.php';

$categoria = new Categoria();
echo json_encode($categoria->getCategorias());