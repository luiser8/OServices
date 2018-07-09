
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
	    <section id="form-registration">
        <div class="container">
            <div class="page-header">
              <h1><big class="tittles-pages-logo">Nuevo Proveedor</big></h1>
            </div>
            <div class="row">
                <!--<div class="col-sm-5 text-center">
                    <figure>
                      <img src="./assets/img/registro.jpg" alt="store" class="img-responsive">
                    </figure>
                </div>-->
                <div class="col-xs-12">
                    <div id="container-form">
                       <p class="text-center lead">Registro de Proveedores</p>
                       <br><br>
                       <form class="FormCatElec" action="process/regprove.php" role="form" method="POST" data-form="save">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-xs-12">
                                <legend><i class="fa fa-user"></i> &nbsp; Datos personales</legend>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp; C.I./R.I.F.:</label>
                                  <input class="form-control" type="text" required name="prove-rif" title="Ingresar C.I. o R.I.F." maxlength="15" >
                                </div>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-user"></i>&nbsp; Nombre Completo</label>
                                  <input class="form-control" type="text" required name="prove-name" title="Ingrese Nombre Completo (solamente letras)" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-mobile"></i>&nbsp; Número telefónico</label>
                                    <input class="form-control" type="tel" required name="prove-tel" maxlength="15" title="Ingresar número telefónico. Mínimo 8 digitos máximo 15">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp; Email</label>
                                    <input class="form-control" type="email" required name="prove-email" title="Ingresr dirección de Email" maxlength="50">
                                </div>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-home"></i>&nbsp; Dirección</label>
                                  <input class="form-control" type="text" required name="prove-dir" title="Ingresar la direción del cliente" maxlength="100">
                                </div>
                              </div>
                            </div>
                          </div>
                          <p><button type="submit" class="btn btn-primary btn-block btn-raised">Registrar</button></p>
                        </form> 
                    </div> 
                </div>
            </div>
        </div>
    </section>
</div>