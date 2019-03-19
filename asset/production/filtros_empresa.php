

<?php 
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$f_solicitud=date("Y-m-d");

//consulta empresas 
$consulta_empresa="SELECT * FROM EMPRESAS left JOIN USUARIOS ON EMPRESAS.Identificacion=USUARIOS.Identificacion WHERE USUARIOS.Id_estado='2'";
$datos_empresa=mysqli_query($conexion, $consulta_empresa) or die("no se ha podido ejecutar la consulta");
//departamento
$consulta_departamento="SELECT * FROM DEPARTAMENTO";
$datos_departamento=mysqli_query($conexion, $consulta_departamento) or die("no se ha podido ejecutar la consulta");

//consulta estado oferta
$consulta_estado_oferta="SELECT * FROM ESTADOS WHERE Id_estado<'4' ORDER BY `ESTADOS`.`Desc_estado` ASC";
$datos_estado_oferta=mysqli_query($conexion, $consulta_estado_oferta) or die("no se ha podido ejecutar la consulta");




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
        <li class="active">Busqueda Empresa</li>
      </ol>
              </div>

             
            </div>
            <div class="clearfix"></div>
          
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Reporte Empresas</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
				  
				  
                  <div class="x_content">
				  
				  <div class="row" id="show">

                    <form class="form-horizontal form-label-left" novalidate  name="consulta_empresa" id="consulta_empresa" method="post">
                         
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa">Empresa<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="empresa"  id="empresa">
                        <option value="">Todos</option>
						<?php
						while ($objeto = mysqli_fetch_array($datos_empresa)) {
						echo '<option value="' . $objeto['Id_empresa'] . '">  ' . $objeto['Nombre_empresa'] . '</option>';
						}
					   mysqli_free_result($datos_empresa); //Libera la memoria del resultado 
					   ?>
					   </select>
                        </div>
                      </div>
                      
					    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Departamento<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="departamento"  id="departamento" onchange="cambiar_l_res();" required="required">
						<option value="">Todos</option>
						<?php
                             while ($objeto = mysqli_fetch_array($datos_departamento)) {
                             if ($objeto['Id_departamento'] == $dpto_res) {
								echo '<option value="' . $objeto['Id_departamento'] . '" selected >  ' . $objeto['Desc_departamento'] . '</option>';
                                     } else {
                                                                echo '<option value="' . $objeto['Id_departamento'] . '" >  ' . $objeto['Desc_departamento'] . '</option>';
                                                            }
                                                        }
                                                        mysqli_free_result($datos_departamento); //Libera la memoria del resultado
                                                        ?> 
					   </select>
                       <div id='solicitar_oferta_departamento_errorloc' class='error_strings'></div> 
                        </div>
                      </div>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Ciudad<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="ciudad"  id="ciudad" required>
						<option value="">Todos</option>
						 <?php
                                                        if($dpto_res!=""){
                                                        $consulta_r2="SELECT * FROM CIUDAD WHERE Id_departamento=".$dpto_res;
                                                        $datos_r2=mysqli_query($conexion, $consulta_r2) or die("no se ha podido ejecutar la consulta");
                                                        while($row =mysqli_fetch_array($datos_r2)) {
                                                        if($row['Id_ciudad']==$ciu_res){echo '<option value="' . $row['Id_ciudad'] . '" selected >  ' . $row['Desc_ciudad'] . '</option>'; }else{
                                                        echo '<option value="' . $row['Id_ciudad'] . '" >  ' . $row['Desc_ciudad'] . '</option>';
                                                        }
                                                        }
                                                        }
                                                        mysqli_free_result($datos_r2); //Libera la memoria del resultado
                                                        ?>
					   </select>
            
                        </div>
                      </div>
                      
                      
                        
					<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa">Estado<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="estado_empresa"  id="estado_empresa">
						<?php
						while ($objeto = mysqli_fetch_array($datos_estado_oferta)) {
						echo '<option value="' . $objeto['Id_estado'] . '">  ' . $objeto['Desc_estado'] . '</option>';
						}
					   mysqli_free_result($datos_estado_oferta); //Libera la memoria del resultado 
					   ?>
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
 


      <!-- Custom Theme Scripts -->
    
	
	 <!-- validator -->
 <!-- <script src="../vendors/validator/validator.js"></script>-->
      <!-- Custom Theme Scripts -->
    