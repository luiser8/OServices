
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=provider">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Nuevo Proveedor
        </a>
    </li>
    <li>
        <a href="configAdmin.php?view=providerlist"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Lista de Proveedores</a>
    </li>
</ul>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
            <br><br>
            <div class="panel panel-info">
                <div class="panel-heading text-center"><h4>Lista de Proveedores</h4></div>
                <div class="form-group filtro">
                  <input type="text" class="form-control filtro" placeholder="Buscar proveeedor" id="filtro_clientes">
                </div>
              	<div class="table-responsive">
                  <table class="table table-striped table-hover" id="tabla_clientes">
                      	<thead>
                          	<tr>
								<th class="text-center">#</th>
                              	<th class="text-center">RIF</th>
                              	<th class="text-center">Nombre</th>
                              	<th class="text-center">Dirección</th>
                              	<th class="text-center">Teléfono</th>
                              	<th class="text-center">Email</th>
                                 <?php if($_SESSION['Nivel'] == 1 ||$_SESSION['Nivel'] == 5){ ?>
                                <th class="text-center">Actualizar</th>
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

								$clientes=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM proveedor LIMIT $inicio, $regpagina");

								$totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
								$totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

								$numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

								$cr=$inicio+1;
                                while($cli=mysqli_fetch_array($clientes, MYSQLI_ASSOC)){
                            ?>
							<tr>
								<td class="text-center"><?php echo $cr; ?></td>
								<td class="text-center"><?php echo $cli['RIFProveedor']; ?></td>
								<td class="text-center"><?php echo $cli['NombreCompleto']; ?></td>
								<td class="text-center"><?php echo $cli['Direccion']; ?></td>
								<td class="text-center"><?php echo $cli['Telefono']; ?></td>
								<td class="text-center"><?php echo $cli['Email']; ?></td>
                            <td class="text-center">
                        	 
                                <?php  
                             //$cr+=1;

                             if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 5){ ?>	
                                <a href="configAdmin.php?view=providerinfo&code=<?php echo $cli['RIFProveedor']; ?>" class="btn btn-raised btn-xs btn-success">Actualizar</a>
                        	    <?php } ?>
                            </td>
                            <?php if($_SESSION['Nivel'] == 1 || $_SESSION['Nivel'] == 5){  ?>
                        	<td class="text-center">
                        		<form action="process/delprove.php" method="POST" class="FormCatElec" data-form="delete">
                        			<input type="hidden" name="rif-prove" value="<?php echo $cli['RIFProveedor']; ?>">
                        			<button type="submit" class="btn btn-raised btn-xs btn-danger">Eliminar</button>	
                        		</form>
                        	</td>
                            <?php } }?>
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
                            <a href="configAdmin.php?view=providerlist&pag=<?php echo $pagina-1; ?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="configAdmin.php?view=providerlist&pag='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="configAdmin.php?view=providerlist&pag='.$i.'">'.$i.'</a></li>';
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
                            <a href="configAdmin.php?view=providerlist&pag=<?php echo $pagina+1; ?>">
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
<script>
  $("#filtro_clientes").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tabla_clientes tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});
</script>