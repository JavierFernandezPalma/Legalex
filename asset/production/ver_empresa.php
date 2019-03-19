<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$f_solicitud=date("Y-m-d");


//departamento
$consulta_departamento="SELECT * FROM Departamento";
$datos_departamento=mysql_query($consulta_departamento,$conexion) or die("no se ha podido ejecutar la consulta");

$cod_empresa=$_POST['cod_empresa'];
$consulta_empre=$_POST['consulta_empre'];
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
                            $("#solicitar_oferta").submit(function() {  
                                $.ajax({
                                    type: "POST",
                                    url: "procesar/solicitud_oferta.php",
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
        <li class="active">Crear Empresa</li>
      </ol>
              </div>

             
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Formulario De Registro</small></h2>
                    <?echo $consulta_empre; ?>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate name="solicitar_oferta" id="solicitar_oferta" method="post">

                      <p><code>Los campos con (*) son obligatorios para crear la oferta</code>
                      </p>
                         
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="f_solicitud">Fecha de Solicitud:<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="f_soli" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<? echo $f_solicitud;?>" name="f_soli"  type="text" disabled>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_empresa" >Nombre<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nom_empresa" name="nom_empresa" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Nombre De Empresa" autocomplete="off" maxlength="50" >
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa_nit" >Nit<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="empresa_nit" name="empresa_nit" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" placeholder="Ingrese Nit De Empresa" autocomplete="off" maxlength="15" >
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa_contacto" >Contacto<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="empresa_contacto" name="empresa_contacto" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Contacto Operativo" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
                        
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dire_operativo" >Dirección<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="dire_operativo" name="dire_operativo" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Dirección" autocomplete="off" maxlength="20" >
                        </div>
                      </div>
                       
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel_operativo">Telefono <span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="tel_operativo" name="tel_operativo" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" maxlength="13" placeholder="Ingrese Telefono Conctacto" autocomplete="off">
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="movil_operativo">Movil<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="movil_operativo" name="movil_operativo" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" maxlength="13" placeholder="Ingrese Celular Conctacto" autocomplete="off">
                        </div>
                      </div>
                    
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email" >Email <span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Correo" autocomplete="off" maxlength="50" >
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Departamento<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="departamento"  id="departamento" onchange="cambiar_l_res();" required="required">
						<option value="">Seleccione</option>
						<?php
                             while ($objeto = mysql_fetch_array($datos_departamento)) {
                             if ($objeto['Id_departamento'] == $dpto_res) {
								echo '<option value="' . $objeto['Id_departamento'] . '" selected >  ' . $objeto['Descripcion'] . '</option>';
                                     } else {
                                                                echo '<option value="' . $objeto['Id_departamento'] . '" >  ' . $objeto['Descripcion'] . '</option>';
                                                            }
                                                        }
                                                        mysql_free_result($datos_departamento); //Libera la memoria del resultado
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
						<option value="">Seleccione</option>
						 <?php
                                                        if($dpto_res!=""){
                                                        $consulta_r2="SELECT * FROM Municipios WHERE Id_departamento=".$dpto_res;
                                                        $datos_r2=mysql_query($consulta_r2,$conexion) or die("no se ha podido ejecutar la consulta");
                                                        while($row =mysql_fetch_array($datos_r2)) {
                                                        if($row['Id_ciudad']==$ciu_res){echo '<option value="' . $row['Id_ciudad'] . '" selected >  ' . $row['NOMBRE'] . '</option>'; }else{
                                                        echo '<option value="' . $row['Id_ciudad'] . '" >  ' . $row['Descripcion'] . '</option>';
                                                        }
                                                        }
                                                        }
                                                        mysql_free_result($datos_r2); //Libera la memoria del resultado
                                                        ?>
					   </select>
            
                        </div>
                      </div>
                       
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sector_eco" >Sector Económico<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="sector_eco" name="sector_eco" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Sector Económico" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="actividad_eco" >Actividad Económica<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="actividad_eco" name="actividad_eco" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Actividad Económica" autocomplete="off" maxlength="50" >
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="caja_compe" >Caja Compensación<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="caja_compe" name="caja_compe" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Caja Compensación" autocomplete="off" maxlength="50" >
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa_usuario" >Usuario<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="empresa_usuario" name="empresa_usuario" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Usuario" autocomplete="off" maxlength="40">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa_usuario" >Clave<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="empresa_clave" name="empresa_clave" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Clave" autocomplete="off" maxlength="40">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                           <input name="valor" type="hidden" value="crear_empresa"/>
                           <input name="f_soli2" type="hidden" value="<? echo $f_solicitud;?>"/>
                           
                          
                          <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Solicitar</button>
						  <a class="btn btn-primary" href="procesar/consulta_filtros.php?n_empresa=<? echo "consulta_empresas"; ?>" name="volver_empre" style="color: #fff;">Atras</a> 
                        </div>
                      </div>
                      <br><br><br><br>
                    </form>
                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                   <div id="response_n"></div>
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