<!-- <p class="lead">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, culpa quasi tempore assumenda, perferendis sunt. Quo consequatur saepe commodi maxime, sit atque veniam blanditiis molestias obcaecati rerum, consectetur odit accusamus.
</p> -->
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
            <div class="container-form-admin">
                <h3 class="text-primary text-center">Actualizar datos del Proveedor</h3>
                <?php
                    $code=$_GET['code'];
                    $cliente=ejecutarSQL::consultar("SELECT * FROM proveedor WHERE RIFProveedor='{$code}'");
                    $cli=mysqli_fetch_array($cliente, MYSQLI_ASSOC);
                ?>
                <form action="process/updateProveedor.php" method="POST" class="FormCatElec" data-form="update">
                    <input type="hidden" name="rif-prove-old" value="<?php echo $cli['RIFProveedor']; ?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">RIF/CEDULA</label>
                                    <input class="form-control" value="<?php echo $cli['RIFProveedor']; ?>" type="text" name="prove-rif" maxlength="20" required="" readonly>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre</label>
                                    <input class="form-control" type="text" value="<?php echo $cli['NombreCompleto']; ?>" name="prove-name" maxlength="30" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dirección</label>
                                    <input class="form-control" type="text" value="<?php echo $cli['Direccion']; ?>" name="prove-dir" required="">
                                </div> 
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Teléfono</label>
                                    <input class="form-control" value="<?php echo $cli['Telefono']; ?>" type="tel" name="prove-tel" pattern="[0-9]{1,20}" maxlength="20" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Email (tucorreo@mail.com)</label>
                                    <input class="form-control" value="<?php echo $cli['Email']; ?>" type="email" name="prove-email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary btn-raised">Actualizar Proveedor</button></p>
                </form>
            </div>
        </div>
    </div>
</div>