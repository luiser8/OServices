 <?php
session_start();

include '../library/configServer.php';
include '../library/consulSQL.php';

?>

 <div class="row">
        <div class="col-xs-12">
            <br><br>
            <div class="panel panel-info">
              <div class="form-group filtro">
                  <input type="text" class="form-control filtro" placeholder="Buscar pedidos" id="filtro_pedido">
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" cellpadding="10" id="tabla_pedido">
                    <caption font size="20" margin-bottom:25px><strong>Reporte Relación de Ventas</strong></caption>
                        <thead class="">
                            <tr>
                              <th class="text-center">N° Pedido</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Rif</th>                                
                                <th class="text-center">Cliente</th>
                                <th class="text-center">N. Deposito</th>
                                <th class="text-center">Cuenta</th>                                                              
                                <th class="text-center">Envío</th>
                                <th class="text-center">Total Bs.</th>                                
                                <?php //} ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $pedidos=ejecutarSQL::consultar("SELECT * FROM ventas ".$_POST['where']);

                                while($order=mysqli_fetch_array($pedidos, MYSQLI_ASSOC)){
                            ?>
                            <tr>
                            <td class="text-center"><?php echo $order['NumPedido']; ?></td>
                            <td class="text-center"><?php echo $order['Fecha']; ?></td>
                            <td class="text-center"><?php echo $order['RIF']; ?></td>
                            <td class="text-center"><?php echo $order['NombreCompleto']; ?></td>
                            <td class="text-center"><?php echo $order['NumeroDeposito']; ?></td>
                            <td class="text-center"><?php echo $order['NumeroCuenta']; ?></td>                            
                            <td class="text-center"><?php echo $order['TipoEnvio']; ?></td>
                            <td align="right"><?php echo number_format($order['TotalPagar'], 2, ',', '.'); ?></td>
                            </tr>
                            <?php } 
                            $total_carrito=ejecutarSQL::consultar("SELECT sum(TotalPagar) subtotal FROM ventas ".$_POST['where']);
                            $suma = mysqli_fetch_array($total_carrito, MYSQLI_ASSOC);?>
                            <tr></tr>
                            <tfoot><td colspan="7" align="right"><strong>Total Ventas  </td></strong><td align="right"><strong><?php echo number_format($suma['subtotal'], 2, ',', '.');?></strong></td></tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
  </div>

