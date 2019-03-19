

<?php 
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$f_solicitud=date("Y-m-d");

//consulta empresas 
$consulta_empresa="SELECT * FROM EMPRESAS left JOIN USUARIOS ON EMPRESAS.Identificacion=USUARIOS.Identificacion WHERE USUARIOS.Id_estado='2'";
$datos_empresa=mysql_query($consulta_empresa,$conexion) or die("no se ha podido ejecutar la consulta");
//departamento
$consulta_departamento="SELECT * FROM DEPARTAMENTO";
$datos_departamento=mysql_query($consulta_departamento,$conexion) or die("no se ha podido ejecutar la consulta");

//consulta estado oferta
$consulta_estado_oferta="SELECT * FROM ESTADOS WHERE Id_estado<'4' ORDER BY `ESTADOS`.`Desc_estado` ASC";
$datos_estado_oferta=mysql_query($consulta_estado_oferta,$conexion) or die("no se ha podido ejecutar la consulta");




?>
 <!-- activa cambio de ciudad segun dpto-->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#departamento").change(function(event) {
                                var id = $("#departamento").find(':selected').val();
                                $("#ciudad").load('seguridad/generar_select.php?id=' + id);
                            });
                        });
                    </script>

<!--Validar solo numeros -->
<script type="text/javascript">
// Solo permite ingresar numeros.
function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return (key >= 48 && key <= 57)
}
</script>


<script type="text/javascript">
          
           $(function() {
                            $("#consulta_empresa").submit(function() {  
                                $.ajax({
                                    type: "POST",
                                    url: "procesar/consulta_filtros.php",
                                    dataType: "html",
                                    data: $(this).serialize(),
                                    beforeSend: function() {
                                        $("#loading_n").show();
                                    },
                                    success: function(response) {
                                        $("#response_n").html(response);
                                        $("#loading_n").hide();
                                    }
                                })
                                return false;
                            })
                        })
          
</script>



<body class="nav-md">
 <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
               <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Entregas</li>
      </ol>
              </div>

             
            </div>
            <div class="clearfix"></div>
          
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Programar Entrega</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
          
          
                  <div class="x_content">
          
          <div class="row" id="show">

                    <form class="form-horizontal form-label-left" novalidate  name="consulta_empresa" id="consulta_empresa" method="post">


                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_docente" >Observación<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea type="text" id="observacione_entrega" name="observacione_entrega" class="form-control col-md-7 col-xs-12" autocomplete="off" maxlength="1000"></textarea>
                        </div>
                      </div>
                        
                      
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_docente" >Fecha Entrega<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control has-feedback-left" id="single_cal3" name="fecha_desde" placeholder="Fecha desde" aria-describedby="inputSuccess2Status3">
                             <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                      </div>
					 
					    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa">Entrega<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="empresa"  id="empresa">
                        <option value="">Entrega1</option>
            <!--<?php
            while ($objeto = mysql_fetch_array($datos_empresa)) {
            echo '<option value="' . $objeto['Id_empresa'] . '">  ' . $objeto['Nombre_empresa'] . '</option>';
            }
             mysql_free_result($datos_empresa); //Libera la memoria del resultado 
             ?>-->
             </select>
                        </div>
                      </div>
                        
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                           <input name="valor" type="hidden" value="consulta_empresas"/>  
                          <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Buscar</button>
                          <a class="btn btn-primary" href="index.php" id = "boton_atras" style="color: #fff;">Atras</a> 
                        </div>
                      </div>
                      <br><br><br><br>
                    </form>
                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                  </div>                  
          <div id="response_n"></div>
              
               <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br>
                </div>
         
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php 
    include("footer.php");
    ?>
</div>
  </div>
  </body>
  
   <!-- validator -->
 <!-- <script src="../vendors/validator/validator.js"></script>-->
      <!-- Custom Theme Scripts -->
    <!--<script src="../build/js/custom.min.js"></script>-->