<!DOCTYPE html>
<html lang="es">
<head>
    <title>Carrito de compras</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <section id="container-pedido">
        <div class="container">
            <div class="page-header">
              <h1><big class="tittles-pages-logo">CARRITO DE COMPRAS</big></h1>
            </div>
            <br><br><br>
            <div class="row">
                <div class="col-xs-12">
                    <?php
                        require_once "library/configServer.php";
                        require_once "library/consulSQL.php";
                                                  
                            $consulta_carrito=ejecutarSQL::consultar("SELECT codcarrito, cliente, codigoprod, nombreprod, cantidad,
                                                                      precio, descuento, cantidad*(precio-descuento) subtotal, estado
                                                                      FROM carrito
                                                                      WHERE cliente = '{$_SESSION['UserNIT']}'  
                                                                      AND Estado=1");                           
                            
                            $total_carrito=ejecutarSQL::consultar("SELECT sum(cantidad*precio) subtotal, round(sum(cantidad*precio)*0.12,2) iva, 
                                                                   round(sum(cantidad*precio)*1.12,2) total
                                                                   FROM carrito WHERE cliente='{$_SESSION['UserNIT']}'
                                                                   GROUP BY cliente");
                            
                            if(mysqli_num_rows($consulta_carrito)>0) //si el usuario tiene cosas en el carrito proseguir
                            {
                            $_SESSION['carro']=1;
                            echo '<table class="table table-bordered table-hover"><thead><tr class="bg-success"><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acciones</th></tr></thead>';                                
                                while($fila = mysqli_fetch_array($consulta_carrito, MYSQLI_ASSOC)) {
                            echo "<tbody>
                                            <tr>
                                                <td>".$fila['nombreprod']."</td>
                                                <td>".$fila['precio']."</td>
                                                <td>".$fila['cantidad']."</td>
                                                <td>".$fila['subtotal']."</td>
                                                <td> 
                                                    <form action='process/quitarproducto.php' method='POST' class='FormCatElec' data-form=''>
                                                        <input type='hidden' value='".$fila['codcarrito']."' name='codcarrito'>
                                                        <input type='hidden' value='".$fila['codigoprod']."' name='codigo'>
                                                        <button class='btn btn-danger btn-raised btn-xs'>Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>";
                                }
  
                              mysqli_free_result($consulta_carrito);
                              
                              $suma = mysqli_fetch_array($total_carrito, MYSQLI_ASSOC);


                              echo '<tr><td colspan="3">Sub-Total</td><td><strong>'.$suma['subtotal'].'</strong></td></tr>';
                              echo '<tr><td colspan="3">I.V.A. 12.00%</td><td><strong>'.$suma['iva'].'</strong></td></tr>';
                              echo '<tr class="bg-danger"><td colspan="3">Total Bs.</td><td><strong>'.$suma['total'].'</strong></td></tr></table><div class="ResForm"></div>';
                                    echo '
                                    <p class="text-center">
                                    <a href="product.php" class="btn btn-primary btn-raised btn-lg">Seguir comprando</a>
                                    <a href="process/vaciarcarrito.php" class="btn btn-success btn-raised btn-lg">Vaciar el carrito</a>
                                    <a href="pedido.php?codeProd='.base64_encode($_SESSION['UserNIT']).'" class="btn btn-danger btn-raised btn-lg">Confirmar el pedido</a>
                                    </p>
                                    ';
                                }
                        else{
                            $_SESSION['carro']=0;                            
                            echo '<p class="text-center text-danger lead">El carrito de compras esta vacío</p><br>
                            <a href="product.php" class="btn btn-primary btn-lg btn-raised">Ir a Productos</a>';
                                                        
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>