<!DOCTYPE html>
<html lang="es">
<head>
    <title>MENSAJE</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-registration">
    <?php include './inc/navbar.php'; ?>
    <section id="form-registration">
        <div class="container">
            <div class="page-header">
              <h1><big class="tittles-pages-logo">MENSAJE</big></h1>
            </div>
            <p class="lead text-center">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident assumenda asperiores architecto nostrum blanditiis excepturi voluptatibus, velit ad enim. Aperiam voluptatum est, fugit quisquam libero distinctio nobis porro numquam minus.
            </p>
            <div class="row">
                <div class="col-sm-5 text-center">
                    <figure>
                      <img src="./assets/img/buzon.jpg" alt="store" class="img-responsive">
                    </figure>
                </div>
                <div class="col-sm-7">
                    <div id="container-form">
                       <p class="text-center lead">Envíenos sus dudas y consultas</p>
                       <br><br>
                       <form class="FormCatElec" action="process/regclien.php" role="form" method="POST" data-form="save">
                          <div class="container-fluid">
                            <div class="row">
                              
                              <div class="col-xs-12">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-user"></i>&nbsp; Ingrese su nombre completo</label>
                                  <input class="form-control" type="text" required name="contacto-fullname" title="Ingrese sus nombres (solamente letras)" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-mobile"></i>&nbsp; Ingrese su número telefónico</label>
                                    <input class="form-control" type="tel" required name="contacto-phone" maxlength="15" title="Ingrese su número telefónico. Mínimo 8 digitos máximo 15">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-at" aria-hidden="true"></i>&nbsp; Ingrese su Email</label>
                                    <input class="form-control" type="email" required name="contacto-email" title="Ingrese la dirección de su Email" maxlength="50">
                                </div>
                              </div>
                                    <div class="col-xs-12">
                                    <div class="form-group label-floating">
                                    <label class="control-label" for="exampleTextarea"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp; Ingrese su Mensaje</label>
                                    <textarea class="form-control" id="exampleTextarea" rows="4"></textarea>
                                  </div>
                                  </div>
                            </div>
                          </div>
                          <p><button type="submit" class="btn btn-primary btn-block btn-raised">Enviar</button></p>
                        </form> 
                    </div> 
                </div>
            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>