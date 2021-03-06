<?php
    include './library/configServer.php';
    include './library/consulSQL.php';
    include './process/securityPanel.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-configAdmin">
    <?php include './inc/navbar.php'; ?>
    <section id="prove-product-cat-config">
        <div class="container">
          <div class="page-header">
            <h1><big class="tittles-pages-logo">Panel de Administración</big></h1>
          </div>
          <!--====  Nav Tabs  ====-->
          <ul class="nav nav-tabs nav-justified" style="margin-bottom: 15px;">
            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 4 || $_SESSION['Nivel'] == 5){ ?>
            <li>
              <a href="configAdmin.php?view=productlist">
                <i class="fa fa-cubes" aria-hidden="true"></i> &nbsp; Productos
              </a>
            </li>
          <?php } ?>
          <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 5){ ?>
            <li>
              <a href="configAdmin.php?view=providerlist">
                <i class="fa fa-truck" aria-hidden="true"></i> &nbsp; Proveedores
              </a>
            </li>
            <?php } ?>
            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 5){ ?>
            <li>
              <a href="configAdmin.php?view=categorylist">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i> &nbsp; Categorías
              </a>
            </li>
            <?php } ?>
            <?php if($_SESSION['Nivel'] == 1){ ?>
            <li>
              <a href="configAdmin.php?view=adminlist">
                <i class="fa fa-users" aria-hidden="true"></i> &nbsp; Usuarios
              </a>
            </li>
            <?php } ?>
            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 3 || $_SESSION['Nivel'] == 5){ ?>
            <li>
              <a href="configAdmin.php?view=order">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp; Pedidos
              </a>
            </li>
            <?php } ?>
            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 3 || $_SESSION['Nivel'] == 5){ ?>
            <li>
              <a href="configAdmin.php?view=banklist">
                <i class="fa fa-university" aria-hidden="true"></i> &nbsp; Cuentas Bancarias
              </a>
            </li>
            <?php } ?>
            <li>
              <a href="configAdmin.php?view=account">
                <i class="fa fa-address-card" aria-hidden="true"></i> &nbsp; Mi cuenta
              </a>
            </li>
          </ul>
          <?php
            $content=$_GET['view'];
            $WhiteList=["product","productlist","productinfo","provider","providerlist","providerinfo","category","categorylist","categoryinfo","admin","adminlist","order","bank","account","banklist","bankinfo","verpedidos"];
            if(isset($content)){
              if(in_array($content, $WhiteList) && is_file("./admin/".$content."-view.php")){
                include "./admin/".$content."-view.php";
              }else{
                echo '<h2 class="text-center">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h2>';
              }
            }else{
              echo '<h2 class="text-center">Para empezar, por favor escoja una opción del menú de administración</h2>';
            }
          ?>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>