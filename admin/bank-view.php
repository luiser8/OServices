<!-- <p class="lead">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, culpa quasi tempore assumenda, perferendis sunt. Quo consequatur saepe commodi maxime, sit atque veniam blanditiis molestias obcaecati rerum, consectetur odit accusamus.
</p> -->
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=bank">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Nueva Cuenta
        </a>
    </li>
    <li>
        <a href="configAdmin.php?view=banklist"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Cuentas Bancarias</a>
    </li>
</ul>
<div class="container">
	<div class="row">
        <div class="col-xs-12">
            <div class="container-form-admin">
                <h3 class="text-info text-center">Agregar nueva cuenta</h3>
                <form action="process/regbank.php" method="POST" class="FormCatElec" data-form="save">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Número de cuenta</label>
                                    <input class="form-control" type="text" name="bancoCuenta" maxlength="9" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Banco</label>
                                    <input class="form-control" type="text" name="bancoNombre" maxlength="30" required="">
                                </div>  
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Beneficiario</label>
                                    <input class="form-control" type="text" name="bancoBeneficiario" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group label-floating">
                                    <select class="form-control" name="prod-categoria">
                                    <option value="">Tipo de cuenta</option>
                                    <option value="">Corriente</option>
                                    <option value="">Ahorro</option>
                                    </select>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary btn-raised">Agregar cuenta</button></p>
                </form>
            </div>
        </div>
    </div>
</div>