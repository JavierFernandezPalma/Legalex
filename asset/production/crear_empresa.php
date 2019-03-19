<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$f_solicitud=date("Y-m-d");


//departamento
$consulta_departamento="SELECT * FROM DEPARTAMENTO";
$datos_departamento=mysql_query($consulta_departamento,$conexion) or die("no se ha podido ejecutar la consulta");

//Sector economico
$consulta_sector="SELECT * FROM SECTOR_ECONOMICO";
$datos_sector=mysql_query($consulta_sector,$conexion) or die("no se ha podido ejecutar la consulta");

//Caja Actividad Económica
$consulta_actividad="SELECT * FROM ACTIVIDAD_ECONOMICA";
$datos_actividad=mysql_query($consulta_actividad,$conexion) or die("no se ha podido ejecutar la consulta");

//Tamaño Empresa
$consulta_tamano="SELECT * FROM TAMANO_EMPRESA";
$datos_tamano=mysql_query($consulta_tamano,$conexion) or die("no se ha podido ejecutar la consulta");
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
                    <h2>Formulario De Registro</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate name="solicitar_oferta" id="solicitar_oferta" method="post">

                      <p><code>Los campos con (*) son obligatorios para crear la empresa</code>
                      </p>
                         
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="f_solicitud">Fecha de Solicitud:<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="f_soli" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<? echo $f_solicitud;?>" name="f_soli"  type="text" disabled>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_empresa" >Razón Social<span class="required">*:</span>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dire_operativo" >Dirección<span class="required">*:</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <select class="form-control" id="dir1" name="dir1">
                                    <option value="Calle">Calle</option>
                                    <option value="Carrera">Carrera</option>
                                    <option value="Avenida">Avenida</option>
                                    <option value="Avenida Carrera">Avenida Carrera</option>
                                    <option value="Avenida Calle">Avenida Calle</option>
                                    <!--<option value="Circular">Circular</option>-->
                                    <option value="Circunvalar">Avenida Circunvalar</option>
                                    <option value="Diagonal">Diagonal</option>
                                    <option value="Manzana">Manzana</option>
                                    <option value="Transversal">Transversal</option>
                                    <option value="Vía">Vía</option>
                          </select>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                          <input type="text" id="dir2" name="dir2" required="required" class="form-control col-md-1 col-xs-1" autocomplete="off" maxlength="20" >
                        </div>

                          
                       <label class="control-label col-md-0 col-sm-0 col-xs-0" for="dire_operativo" style="float: left;">#</label>
                        

                        <div class="col-md-1 col-sm-1 col-xs-12">
                        <input type="text" id="dir3" name="dir3" required="required" class="form-control col-md-1 col-xs-1" autocomplete="off" maxlength="20" >
                        </div>

                         <label class="control-label col-md-0 col-sm-0 col-xs-0" for="dire_operativo" style="float: left;">-</label>

                         <div class="col-md-1 col-sm-1 col-xs-12">
                        <input type="text" id="dir4" name="dir4" required="required" class="form-control col-md-1 col-xs-1" autocomplete="off" maxlength="20" >
                        </div>

                      </div>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barrio" >Barrio<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="barrio" name="barrio" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Barrio" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tamano">Tamaño<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="tamano"  id="tamano">
						<?php
						while ($objeto = mysql_fetch_array($datos_tamano)) {
						echo '<option value="' . $objeto['Id_tamano'] . '">  ' . $objeto['Desc_tamano'] . '</option>';
						}
					   mysql_free_result($datos_tamano); //Libera la memoria del resultado 
					   ?>
					   </select>
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
								echo '<option value="' . $objeto['Id_departamento'] . '" selected >  ' . $objeto['Desc_departamento'] . '</option>';
                                     } else {
                                                                echo '<option value="' . $objeto['Id_departamento'] . '" >  ' . $objeto['Desc_departamento'] . '</option>';
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
                                                        $consulta_r2="SELECT * FROM CIUDAD WHERE Id_departamento=".$dpto_res;
                                                        $datos_r2=mysql_query($consulta_r2,$conexion) or die("no se ha podido ejecutar la consulta");
                                                        while($row =mysql_fetch_array($datos_r2)) {
                                                        if($row['Id_ciudad']==$ciu_res){echo '<option value="' . $row['Id_ciudad'] . '" selected >  ' . $row['Desc_ciudad'] . '</option>'; }else{
                                                        echo '<option value="' . $row['Id_ciudad'] . '" >  ' . $row['Desc_ciudad'] . '</option>';
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
                               <select class="form-control" name="sector_eco"  id="sector_eco" required>
             <?php
                                                        while($row1 =mysql_fetch_array($datos_sector)) {
                                                        echo '<option value="' . $row1['Id_sectoreconomico'] . '" >  ' . $row1['Desc_sectoreconomico'] . '</option>';
                                                        }
                                                        mysql_free_result($datos_sector); //Libera la memoria del resultado
                                                        ?>
                                 </select>
                        </div>
                      </div>
					  
					  
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="actividad_eco" >Actividad Económica<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                               <select class="form-control" name="actividad_eco"  id="actividad_eco" required>
             <?php
                                                        while($row1 =mysql_fetch_array($datos_actividad)) {
                                                        echo '<option value="' . $row1['Id_actividad_economica'] . '" >  ' . $row1['Desc_actividad_economica'] . '</option>';
                                                        }
                                                        mysql_free_result($datos_actividad); //Libera la memoria del resultado
                                                        ?>
                                 </select>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_emple" >Numero Empleados<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="num_emple" name="num_emple" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" placeholder="Ingrese Numero Empleados" autocomplete="off" maxlength="5" >
                        </div>
                      </div>
					  
					  

                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa_nombre" >Nombre<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="empresa_nombre" name="empresa_nombre" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Nombre Contacto Operativo" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
					  
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa_apellido" >Apellido<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="empresa_apellido" name="empresa_apellido" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Apellido Contacto Operativo" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula_contacto" >Cedula<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cedula_contacto" name="cedula_contacto" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" placeholder="Ingrese N De Cedula" autocomplete="off" maxlength="15" >
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
						   <a class="btn btn-primary" href="index.php" id = "boton_atras" style="color: #fff;">Atras</a> 
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
