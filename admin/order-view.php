<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=verpedidos">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Relación de Ventas
        </a>
    </li>
    <li>
        <a href="configAdmin.php?view=order"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Pedidos</a>
    </li>
</ul>

<div>
  <div class="row">
        <div class="col-xs-12">
            <br><br>
            <div class="panel panel-info">
                <div class="panel-heading text-center"><h4>Pedidos de la tienda</h4></div>
                <div class="form-group filtro">
                  <input type="text" class="form-control filtro" placeholder="Buscar Pedidos" id="filtro_pedido">
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tabla_pedido">
                        <thead class="">
                            <tr>
                              <th class="text-center">#</th>
                                <th class="text-center">N. Deposito</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Total Bs.</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Envío</th>
                                <th class="text-center">Nombre cliente</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center">Telefono</th>
                                <th class="text-center">Opciones</th>
                                <?php if($_SESSION['Nivel'] == 1){  ?>
                                <th class="text-center">Eliminar</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
                                $regpagina = 30;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                $pedidos=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM ventas LIMIT $inicio, $regpagina");

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                $cr=$inicio+1;
                              while($order=mysqli_fetch_array($pedidos, MYSQLI_ASSOC)){
                            ?>
                                <?php 
                                    $verif= ejecutarSQL::consultar("SELECT NumPedido FROM verificado WHERE NumPedido='".$order['NumPedido']."'");
                                    $pedido=mysqli_fetch_array($verif, MYSQLI_ASSOC);
                                ?>
                            <?php if($verif->num_rows == 1){  ?>
                            <tr style="background: #DCEDC8;">
                            <?php } ?>
                              <td class="text-center"><?php echo $cr; ?></td>
                            <td class="text-center"><?php echo $order['NumeroDeposito']; ?></td>
                            <td class="text-center"><?php echo $order['Fecha']; ?></td>
                            <td>
                                <?php 
                                    $conUs= ejecutarSQL::consultar("SELECT Nombre FROM cliente WHERE RIF='".$order['RIF']."'");
                                    $UsP=mysqli_fetch_array($conUs, MYSQLI_ASSOC);
                                    echo $UsP['Nombre'];
                                ?>
                            </td>
                            <td class="text-center"><?php echo $order['TotalPagar']; ?></td>
                            <td class="text-center"><?php echo $order['Estado']; ?></td>
                            <td class="text-center"><?php echo $order['TipoEnvio']; ?></td>
                            <td class="text-center"><?php echo $order['NombreEnvio']; ?></td>
                            <td class="text-center"><?php echo $order['DirEnvio']; ?></td>
                            <td class="text-center"><?php echo $order['TlfEnvio']; ?></td>
                            <td class="text-center">
                                <a href="#!" class="btn btn-raised btn-xs btn-success btn-block btn-up-order" data-code="<?php echo $order['NumPedido']; ?>">Actualizar</a>
                                <?php 
                                    if(is_file("./assets/comprobantes/".$order['Adjunto'])){
                                      echo '<a href="./assets/comprobantes/'.$order['Adjunto'].'" target="_blank" class="btn btn-raised btn-xs btn-info btn-block">Comprobante</a>';
                                    }
                                ?>
                                <a href="./report/factura.php?id=<?php echo $order['NumPedido'];  ?>" class="btn btn-raised btn-xs btn-primary btn-block" target="_blank">Imprimir</a>
                            </td>
                            <td class="text-center">

                                <?php if($verif->num_rows != 1){  ?>
                                    <a href="#!" class="btn btn-raised btn-xs btn-primary btn-block btn-up-verificar" data-rif="<?php echo $order['RIF']; ?>" data-code="<?php echo $order['NumPedido']; ?>">Verificar</a>
                                <?php } ?>
                                <?php if($_SESSION['Nivel'] == 1){  ?>
                              <form action="process/delPedido.php" method="POST" class="FormCatElec" data-form="delete">
                                <input type="hidden" name="num-pedido" value="<?php echo $order['NumPedido']; ?>">
                                <button type="submit" class="btn btn-raised btn-xs btn-danger">Eliminar</button>  
                              </form>
                                <?php } ?>
                            </td>
                            </tr>

                            <?php
                              $cr++;
                              }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php if($numeropaginas>=1): ?>
                <div class="text-center">
                  <ul class="pagination">
                    <?php if($pagina == 1): ?>
                        <li class="disabled">
                            <a>
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="configAdmin.php?view=order&pag=<?php echo $pagina-1; ?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="configAdmin.php?view=order&pag='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="configAdmin.php?view=order&pag='.$i.'">'.$i.'</a></li>';
                            }
                        }
                    ?>
                    

                    <?php if($pagina == $numeropaginas): ?>
                        <li class="disabled">
                            <a>
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="configAdmin.php?view=order&pag=<?php echo $pagina+1; ?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                  </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-order" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content" style="padding: 15px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="modal-title text-center text-primary" id="myModalLabel">Actualizar estado del pedido</h5>
        </div>
        <form action="./process/updatePedido.php" method="POST" class="FormCatElec" data-form="update">
            <div id="OrderSelect"></div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-raised btn-sm">Actualizar</button>
              <button type="button" class="btn btn-danger btn-raised btn-sm" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-verificar" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content" style="padding: 15px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="modal-title text-center text-primary" id="myModalLabel2">Verificación del pedido.</h5>
        </div>
        <!-- action="./process/verificarPedido.php" method="POST"  -->
        <form action="./process/verificarPedido.php" method="POST">
            <div class="modal-footer">
                <input type="hidden" id="NumPedido" name="NumPedido">
                <input type="hidden" id="rif" name="RIF">
              <button type="submit" class="btn btn-success btn-raised btn-sm">Verificado</button>
              <button type="button" class="btn btn-danger btn-raised btn-sm" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
      </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $('.btn-up-order').on('click', function(e){
            e.preventDefault();
            var code=$(this).attr('data-code');
            var rif=$(this).attr('data-rif');
            $.ajax({
                url:'./process/checkOrder.php',
                type: 'POST',
                data: 'code='+code,
                success:function(data){
                    $('#OrderSelect').html(data);
                    $('#modal-order').modal({
                        show: true,
                        backdrop: "static"
                    });  
                }
            });
            return false;

        });
        $('.btn-up-verificar').on('click', function(e){
            var code=$(this).attr('data-code');
            var rif=$(this).attr('data-rif');
            console.log(code);
            $('#NumPedido').val(code);
            $('#rif').val(rif);

            $('#modal-verificar').modal({
                    show: true,
                    backdrop: "static"
            });
        });
    });
  $("#filtro_pedido").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tabla_pedido tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});
</script>