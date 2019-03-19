<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$f_solicitud=date("Y-m-d");

$nombre  = $_SESSION['users'];



// en caso que acceda Estudiante,Docente,Administrador
    $query1="SELECT * FROM USUARIOS WHERE Id_estado='2' AND Usuario='$nombre'";
    $resul1a=mysqli_query($conexion, $query1);
    $registro1=mysqli_fetch_assoc($resul1a);
    $conteo_interno = mysqli_num_rows($resul1a);
    $users_valida1=$registro1['Identificacion'];
    $users_cedula=$registro1['Identificacion'];
    $users_nombre=$registro1['Nombres'];
    $users_apellido=$registro1['Apellidos'];


//    mysqli_free_result($resul1a); //Libera la memoria del resultado





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
                            $("#actualizar_datos").submit(function() {  
                                $.ajax({
                                    type: "POST",
                                    url: "procesar/actualizar_info.php",
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
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Actualizar Datos</li>
      </ol>
              </div>

             
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Cambio de clave</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
<?php
if($conteo_interno<>0){

?>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate name="actualizar_datos" id="actualizar_datos" method="post">

                      <p><code>Los campos con (*) son obligatorios para actualizar los datos</code>
                      </p>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula" >Cedula<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cedula" name="cedula" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" autocomplete="off" maxlength="15" value="<?php echo $users_cedula; ?>" disabled>
                        </div>
                      </div>
                         
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_empresa" >Nombre<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nom" name="nom" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Nombre" value="<?php echo $users_nombre; ?>" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
					  
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_apellido" >Apellidos<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nom_apellido" name="nom_apellido" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Apellido" value="<?php echo $users_apellido; ?>" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
                       
                       <!--<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel">Telefono <span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="tel" name="tel" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" maxlength="13" placeholder="Ingrese Telefono Conctacto" autocomplete="off" value="<?php echo $users_telefono; ?>">
                        </div>
                      </div>-->

                      <!-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="movil_operativo">Movil<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="movil" name="movil" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" maxlength="13" placeholder="Ingrese Celular Conctacto" autocomplete="off" value="<?php echo $users_movil; ?>">
                        </div>
                      </div>-->
                    
                       <!--<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email" >Email <span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Correo" autocomplete="off" maxlength="50" value="<?php echo $users_correo; ?>" disabled  >
                        </div>
                      </div>-->

                


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clave" >Clave:
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="clave" name="clave" class="form-control col-md-7 col-xs-12" placeholder="Ingrese nueva clave si desea cambiarla" autocomplete="off" maxlength="40">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                           <input name="valor" type="hidden" value="actuali_datos_interno"/>

                          <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Solicitar</button>
						   <a class="btn btn-primary" href="index.php" id = "boton_atras" style="color: #fff;">Atras</a> 
                        </div>
                      </div>
                      <br><br><br><br>
                    </form>
                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                   <div id="response_n"></div>

   <?php
   }
   ?>                

                  <br><br><br><br><br><br> <br><br><br><br><br><br> <br><br><br><br>
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
  <script src="../vendors/validator/validator.js"></script>
