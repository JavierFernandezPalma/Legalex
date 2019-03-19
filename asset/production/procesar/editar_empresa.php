<?php  
//select.php 
include("../seguridad/connection_db.php"); 
include("../seguridad/seguridad.php"); 

 // capturamos el id de la empresa
 $id_empresa = $_POST['empresa'];

 $consulta_empresa = "SELECT * FROM EMPRESAS WHERE Id_empresa = '$id_empresa'";
 $resul_empresa = mysql_query($consulta_empresa,$conexion);
 
 //Sector economico
$consulta_sector="SELECT * FROM SECTOR_ECONOMICO";
$datos_sector=mysql_query($consulta_sector,$conexion) or die("no se ha podido ejecutar la consulta");

//Caja compensación
$consulta_acti="SELECT * FROM ACTIVIDAD_ECONOMICA";
$datos_acti=mysql_query($consulta_acti,$conexion) or die("no se ha podido ejecutar la consulta");

//Caja compensación
$consulta_doc="SELECT * FROM TIPO_DOCUMENTOS";
$datos_doc=mysql_query($consulta_doc,$conexion) or die("no se ha podido ejecutar la consulta");

 while ($row = mysql_fetch_array($resul_empresa)) { 
	
	$Empresa = $row['Nombre_empresa'];
	$Nit = $row['Nit'];
	$Departamento = $row['Id_departamento'];
	$Ciudad = $row['Id_ciudad'];
	$direccion = $row['Direccion_empresa'];
	$a_economica = $row['Id_actividad_economica'];
	$s_economico = $row['Id_sectoreconomico'];
	$nom_direccion = $row['Nom_direccion'];
	$caja_compe = $row['Caja_compensacion'];
    $identificacion = $row['Identificacion'];

	$trozo1 = explode("#",$direccion);
	$dir1 = $trozo1[0];
	$dir2 = $trozo1[1];
	
	$trozo2 = explode("-",$dir2);

	$dir3 = $trozo2[0];
	$dir4 = $trozo2[1];


 }
 
$consulta_telefono = "SELECT Telefono_usuario FROM TELEFONOS WHERE Identificacion = '$identificacion' AND Id_telefono='1'";
$datos_telefono = mysql_query($consulta_telefono,$conexion);
$resul_tel = mysql_fetch_assoc($datos_telefono);
$telefono = $resul_tel['Telefono_usuario'];


$consulta_movil = "SELECT Telefono_usuario FROM TELEFONOS WHERE Identificacion = '$identificacion' AND Id_telefono='2'";
$datos_movil = mysql_query($consulta_movil,$conexion);
$resul_mov = mysql_fetch_assoc($datos_movil);
$movil = $resul_mov['Telefono_usuario'];

$consulta_mail = "SELECT Mail FROM MAILS WHERE Identificacion = '$identificacion'";
$datos_mail = mysql_query($consulta_mail,$conexion);
$resul_mail = mysql_fetch_assoc($datos_mail);
$correo = $resul_mail['Mail'];


$consulta_c_opera = "SELECT * FROM USUARIOS WHERE Identificacion = '$identificacion'";
$datos_c_opera = mysql_query($consulta_c_opera,$conexion);
$resul_c_opera = mysql_fetch_assoc($datos_c_opera);
$nombres = $resul_c_opera['Nombres'];
$apellidos = $resul_c_opera['Apellidos'];
$usuario = $resul_c_opera['Usuario'];
$fecha_expedicion = $resul_c_opera['F_exp_doc'];
$fecha_nacimiento = $resul_c_opera['Fecha_nacimiento'];
$t_documento = $resul_c_opera['Id_documento'];

 ?>  
 
 <script type="text/javascript">
                                        $(function() {
                                            $("#actualizar_solicitud").submit(function(){
                                                $.ajax({
                                                    type: "POST",
                                                    url: "procesar/save_edit.php",
                                                    dataType: "html",
                                                    data: $(this).serialize(),
                                                    beforeSend: function() {
                                                        $("#actualizar_soli").show();
                                                    },
                                                    success: function(response) {
                                                        $("#response_soli").html(response);
                                                        $("#actualizar_soli").hide();
                                                    }
                                                })
                                                return false;
                                            })
                                        })
            </script>
			
			<script type="text/javascript">
// Solo permite ingresar numeros.
function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return (key >= 48 && key <= 57)
}
</script>
		
<script src="../vendors/validator/validator.js"></script>		

<div class="container">
<div class ="row">
<div class="col-md-10">
<form id="actualizar_solicitud" novalidate method="post" class="form-horizontal form-label-left" >
<div class="box-body">
				
			
                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Empresa<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="empresa" id="empresa2" value = "<? echo $Empresa; ?>" required="required" autocomplete="off" maxlength="50">
				</div>
                </div>
				
				<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Nit<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="nit" id="nit" value = "<? echo $Nit; ?>"  required="required" autocomplete="off" maxlength="15"  onKeyPress="return soloNumeros(event)">
				</div>
                </div>
				

				<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Nombres<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="nombres" id="nombres" required="required"  value = "<? echo $nombres; ?>" autocomplete="off" maxlength="50">
				</div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Apellidos<span class="required">*:</span></label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="apellidos" id="apellidos" required="required"  value = "<? echo $apellidos; ?>" autocomplete="off" maxlength="50">
                </div>
                </div>

                 <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Identificación:</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="identificacion" id="identificacion" value = "<? echo $identificacion; ?>" autocomplete="off" maxlength="50" disabled>
                </div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Tipo documento:</label>
                <div class="col-sm-9">
                
                                     <select class="form-control" name="t_documento"  id="t_documento" required>
             <?php
                                                        while($row1 =mysql_fetch_array($datos_doc)) {
                                                        if($row1['Id_documento'] == $t_documento) { echo '<option value="' . $row1['Id_documento'] . '"  selected>  ' . $row1['Desc_documento'] . '</option>';  } else {  
                                                        echo '<option value="' . $row1['Id_documento'] . '" >  ' . $row1['Desc_documento'] . '</option>';
                                                        }
                                                        }
                                                        mysql_free_result($datos_doc); //Libera la memoria del resultado
                                                        ?>
                                 </select>

                <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left"></div>
                </div>
                </div>

                  <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Fecha expedición:</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="fecha_expedicion" id="fecha_expedicion" required="required"  value = "<? echo $fecha_expedicion; ?>" autocomplete="off" maxlength="50" disabled>
                </div>
                </div>

                 <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Fecha nacimiento:</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required="required"  value = "<? echo $fecha_nacimiento; ?>" autocomplete="off" maxlength="50" disabled>
                </div>
                </div>

				<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Teléfono<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="telefono" id="telefono" value = "<? echo $telefono; ?>">
				<div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" required="required" autocomplete="off" maxlength="15"  onKeyPress="return soloNumeros(event)"></div>
				</div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Movil<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="movil" id="movil" value = "<? echo $movil; ?>">
				</div>
                </div>

                 <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Email<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="email" class="form-control" name="correo" id="correo" value = "<? echo $correo; ?>">
				</div>
                </div>


              <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label" for="dire_operativo" >Dirección<span class="required">*:</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select class="form-control" id="dir1" name="dir1">
                                    <option value="Calle" <?php if($nom_direccion == "Calle") { ?> selected <?php  }?>>Calle</option>
                                    <option value="Carrera" <?php if($nom_direccion == "Carrera") { ?> selected <?php  }?>>Carrera</option>
                                    <option value="Avenida" <?php if($nom_direccion == "Avenida") { ?> selected <?php  }?>>Avenida</option>
                                    <option value="Avenida Carrera" <?php if($nom_direccion == "Avenida Carrera") { ?> selected <?php  }?>>Avenida Carrera</option>
                                    <option value="Avenida Calle" <?php if($nom_direccion == "Avenida Calle") { ?> selected <?php  }?>>Avenida Calle</option>
                                    <option value="Circular" <?php if($nom_direccion == "Circular") { ?> selected <?php  }?>>Circular</option>
                                    <option value="Circunvalar" <?php if($nom_direccion == "Circunvalar") { ?> selected <?php  }?>>Circunvalar</option>
                                    <option value="Diagonal" <?php if($nom_direccion == "Diagonal") { ?> selected <?php  }?>>Diagonal</option>
                                    <option value="Manzana" <?php if($nom_direccion == "Manzana") { ?> selected <?php  }?>>Manzana</option>
                                    <option value="Transversal" <?php if($nom_direccion == "Transversal") { ?> selected <?php  }?>>Transversal</option>
                                    <option value="Vía" <?php if($nom_direccion == "Vía") { ?> selected <?php  }?>>Vía</option>
                          </select>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="text" id="dir2" name="dir2" required="required" class="form-control col-md-1 col-xs-1" autocomplete="off" maxlength="20" value="<?php echo $dir1; ?>">
                        </div>

                          
                       <label class="control-label col-md-0 col-sm-0 col-xs-0" for="dire_operativo" style="float: left;">#</label>
                        

                        <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="dir3" name="dir3" required="required" class="form-control col-md-1 col-xs-1" autocomplete="off" maxlength="20" value="<?php echo $dir3; ?>">
                        </div>

                         <label class="control-label col-md-0 col-sm-0 col-xs-0" for="dire_operativo" style="float: left;">-</label>

                         <div class="col-md-1 col-sm-1 col-xs-12">
                        <input type="text" id="dir4" name="dir4" required="required" class="form-control col-md-1 col-xs-1" autocomplete="off" maxlength="20" style="width: 89px;" value="<?php echo $dir4; ?>">
                        </div>

                      </div>

				<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Sector económico:</label>
				<div class="col-sm-9">
				
				                     <select class="form-control" name="sector_eco"  id="sector_eco" required>
             <?php
                                                        while($row1 =mysql_fetch_array($datos_sector)) {
                                                        if($row1['Id_sectoreconomico'] == $s_economico) { echo '<option value="' . $row1['Id_sectoreconomico'] . '"  selected>  ' . $row1['Desc_sectoreconomico'] . '</option>';  } else {	
                                                        echo '<option value="' . $row1['Id_sectoreconomico'] . '" >  ' . $row1['Desc_sectoreconomico'] . '</option>';
                                                        }
                                                        }
                                                        mysql_free_result($datos_sector); //Libera la memoria del resultado
                                                        ?>
                                 </select>

				<div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left"></div>
				</div>
                </div>
				
                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Actividad económica:</label>
				<div class="col-sm-9">
				                                 <select class="form-control" name="acti_eco"  id="acti_eco" required>
             <?php
                                                        while($row1 =mysql_fetch_array($datos_acti)) {
                                                        if($row1['Id_actividad_economica'] == $a_economica) { echo '<option value="' . $row1['Id_actividad_economica'] . '"  selected>  ' . $row1['Desc_actividad_economica'] . '</option>';  } else {  
                                                        echo '<option value="' . $row1['Id_actividad_economica'] . '" >  ' . $row1['Desc_actividad_economica'] . '</option>';
                                                        }
                                                        }
                                                        mysql_free_result($datos_acti); //Libera la memoria del resultado
                                                        ?>
                                 </select>
				<div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left"></div>
				</div>
                </div>


				<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Caja Compensación:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="caja_compe" id="caja_compe" value = "<? echo $caja_compe; ?>">               
				<div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left"></div>
				</div>
                </div>


                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Usuario:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="usuario" id="usuario" value = "<? echo $usuario; ?>" disabled>
				<div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left"></div>
				</div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Contraseña:</label>
				<div class="col-sm-9">
				<input type="password" class="form-control" name="contrasena" id="contrasena" value ="" placeholder="Ingrese nueva clave si desea cambiarla">
				<div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" ></div>
				</div>
                </div>
								
				
				<div class="form-group" style="margin-top:-8px;">
				 <label class="col-sm-3 col-form-label"></label>
				<div class="col-sm-5">
				</div>
                </div>
										
			  <br>
			  <div class='col-md-2'>
			  </div>
			  <div class="col-md-6 col-md-offset-5">
			  <input type="hidden" name="id_empresa" value="<? echo $id_empresa; ?>"/>
              <input type="hidden" name="cedula" value="<? echo $identificacion; ?>"/>
			  <input name="valor" type="hidden" value="actualiza_soli"/>
              <button type="submit" class="btn btn-primary" id="subirF" >Actualizar</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			  <br><br>
        <div id="actualizar_soli" style="display:none" align="center"></div>
		
			  </div>
			</div>
	<input type="hidden" name="valor" value="save_empresa">		
		</form>
		
		<script>
		$("#error_vac").hide();
		</script>
		
		</div>
</div>
</div>
<div id="response_soli"></div>

