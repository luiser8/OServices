<style>
  .form-group {
    padding-bottom: 0px;
    margin: 0px 0 0 0;
    margin-left: 10px;
}

/*Estilo para reducir espacio del input*/
</style>

<!-- <p class="lead">
	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum voluptates, corporis nisi dolores cumque obcaecati perferendis, quisquam, ipsa commodi labore molestias dolor itaque nam cupiditate totam, ea dicta? Sit, asperiores?
</p> -->
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=order"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Pedidos</a>
    </li>
    <li id="newPrint">
       <a id="print" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> &nbsp;Imprimir</i></a>
       <!-- <a href="./report/relacion.php" id="imprimir" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> &nbsp;Imprimir</i></a>-->
    </li>
</ul>

<div ng-app="Oservices">
	<div class="row">
        <div class="col-xs-12">
            <div class="container-form-admin">
                <h3 class="text-primary text-center">Relación de Ventas</h3>
                <form>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                        </div>
                            <div class="col-xs-12">
                                <legend>Datos de la Consulta</legend>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group">
                              <label class="label-control">Por Cliente</label>
                                <select class="form-control" name="porcliente" id="porcliente">
                                <option value="">Seleccione un Cliente</option>
                                    <?php
                                        $clientec= ejecutarSQL::consultar("SELECT * FROM cliente");
                                        while($cliec=mysqli_fetch_array($clientec, MYSQLI_ASSOC)){
                                            echo '<option value="'.$cliec['RIF'].'">'.$cliec['RIF'].' '.$cliec['NombreCompleto'].'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group">
                                <label class="label-control">Fecha Desde</label>
                                <input type="Date" class="form-control" maxlength="30" id="fecha-desde" name="fecha-desde">
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="form-group">
                                <label class="label-control">Fecha Hasta</label>
                                <input type="Date" class="form-control" maxlength="30" id="fecha-hasta" name="fecha-hasta">
                              </div>
                            </div>
                            <p><button class="btn btn-primary btn-block btn-raised" id="consultar" name="consultar" >Consultar</button></p>
                    </div>
                </form>
            </div>
        </div>
     </div>
 </div>       
<div id="tablaPedidos" name="tablaPedidos">
</div>

<script>
   $("#filtro_pedido").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tabla_pedido tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});
   
   
$("#consultar").on("click",function(){
    
    var where="WHERE estado='Verificado'";
    var fechadesde=0;
    var fechahasta=0;
    if($('#fecha-desde').val()&&$('#fecha-hasta').val())
    {
    fechadesde = moment($('#fecha-desde').val()).format('YYYY-MM-DD');
    fechahasta = moment($('#fecha-hasta').val()).format('YYYY-MM-DD');       
    }
    rif = $('#porcliente').val();
 
    if(fechadesde && fechahasta)
    {    
        where=where+" and FechaO between '"+fechadesde+"' and '"+fechahasta+"'";
        if(rif)
        {
            where=where+" and RIF='"+rif+"'";
        }
    }
    else
    {
        if(rif)
        {
            where=where+" and RIF='"+rif+"'";
        }
    }
   
   //console.log(where); 

       $.ajax({
              type: "POST",
              url: 'process/verpedidos.php',
              data: {'where':where, 'Rif':rif},
              success: function(respuestaHTML ){
                       $("#tablaPedidos").html( respuestaHTML);
                       //$('#newPrint').append('<a id="print" target="_blank" href="./report/relacion.php?rif='+rif+'&before='+fechadesde+'&after='+fechahasta+'">Imprimir</a>');
                       $('#print').attr('href', './report/relacion.php?rif='+rif+'&before='+fechadesde+'&after='+fechahasta+'');
               }
       });
});

$('#imprimirr').click(function(){
	rif = $('#porcliente').val();
    fechadesde = moment($('#fecha-desde').val()).format('YYYY-MM-DD');
    fechahasta = moment($('#fecha-hasta').val()).format('YYYY-MM-DD'); 
    
	console.log(rif);
    $.ajax({
        type: "POST",
        url: './report/relacion.php',
        data: {'before':fechadesde, 'after':fechahasta,'Rif':rif},
        success: function(respuestaHTML ){
                 //$("#tablaPedidos").html( respuestaHTML);
                 console.log(respuestaHTML);
                 
                 //window.location = "./report/relacion.php";
                 $('#imprimir').attr('target', '_blank');
         }
 	});
});

function printData()
{
    var divToPrint=document.getElementById("tabla_pedido");
    newWin= window.open("","_self");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
   
}


$('#imprimir').on('click',function(){

if($('#tablaPedidos').html()) 
 {
    printData();
  }   
})

</script>