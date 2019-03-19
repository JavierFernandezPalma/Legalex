<?php  
//select.php 
include("../seguridad/connection_db.php"); 
include("../seguridad/seguridad.php"); 

 // capturamos el id del estudiante
 $id_estudiante = $_POST['estudiante'];

 $consulta_estudiante = "SELECT * FROM USUARIOS 
 Left JOIN DOCENTES ON USUARIOS.Identificacion=DOCENTES.Id_docente
 Left JOIN MAILS ON USUARIOS.Identificacion=MAILS.Identificacion
 WHERE USUARIOS.Identificacion = '$id_estudiante'";
 $resul_estudiante = mysql_query($consulta_estudiante,$conexion);
 
 //consulta Estado
$consulta_estado="SELECT * FROM ESTADOS WHERE Id_estado<'4' ORDER BY `ESTADOS`.`Desc_estado` ASC";
$datos_estado=mysql_query($consulta_estado,$conexion) or die("no se ha podido ejecutar la consulta");
 

//consulta programa 
$consulta_programa="SELECT * FROM PROGRAMA_ACADEMICO ORDER BY `PROGRAMA_ACADEMICO`.`Id_facultad` ASC";
$datos_programa=mysql_query($consulta_programa,$conexion) or die("no se ha podido ejecutar la consulta"); 

//Caja compensación
$consulta_doc="SELECT * FROM TIPO_DOCUMENTOS";
$datos_doc=mysql_query($consulta_doc,$conexion) or die("no se ha podido ejecutar la consulta");
 
 while ($row = mysql_fetch_array($resul_estudiante)) { 
	
	$Nombres = $row['Nombres'];
	$Apellidos = $row['Apellidos'];
	$Cedula = $row['Identificacion'];
	$Usuario = $row['Usuario'];
	$Telefono = $row['Telefono'];//pendiente
	$Movil = $row['Movil'];//pendiente
	$Correo = $row['Mail'];
	$Id_estado = $row['Id_estado'];
	$Id_programa = $row['Id_programa'];
	$t_documento = $row['Id_documento'];
	$fecha_expedicion = $row['F_exp_doc'];
	$fecha_nacimiento = $row['Fecha_nacimiento'];
 }
 
$consulta_telefono = "SELECT Telefono_usuario FROM TELEFONOS WHERE Identificacion = '$Cedula' AND Id_telefono='1'";
$datos_telefono = mysql_query($consulta_telefono,$conexion);
$resul_tel = mysql_fetch_assoc($datos_telefono);
$telefono = $resul_tel['Telefono_usuario'];


$consulta_movil = "SELECT Telefono_usuario FROM TELEFONOS WHERE Identificacion = '$Cedula' AND Id_telefono='2'";
$datos_movil = mysql_query($consulta_movil,$conexion);
$resul_mov = mysql_fetch_assoc($datos_movil);
$movil = $resul_mov['Telefono_usuario'];

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
                <label class="col-sm-3 col-form-label">Nombres<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="estudia_nombre" id="estudia_nombre" value = "<? echo $Nombres; ?>" required="required" autocomplete="off" maxlength="50">
				</div>
                </div>
				
				<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Apellidos<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="estudia_apellido" id="estudia_apellido" value = "<? echo $Apellidos; ?>" required="required" autocomplete="off" maxlength="50">
				</div>
                </div>
				
<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">T. documento:</label>
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
                <label class="col-sm-3 col-form-label">Identificación<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="estudia_cedula" id="estudia_cedula" value = "<? echo $Cedula; ?>"  required="required" autocomplete="off" maxlength="15"  onKeyPress="return soloNumeros(event)" disabled>
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
				<div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" required="required" autocomplete="off" maxlength="15"  onKeyPress="return soloNumeros(event)"></div>
				</div>
                </div>

                 <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Email<span class="required">*:</span></label>
				<div class="col-sm-9">
				<input type="email" class="form-control" name="correo" id="correo" value = "<? echo $Correo; ?>">
				<div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" required="required" autocomplete="off"></div>
				</div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Programa<span class="required">*:</span></label>
				<div class="col-sm-9">
				<select class="form-control" name="programa"  id="programa" required value = "<? echo $Id_programa; ?>" >
                        <?php
                        while ($objeto = mysql_fetch_array($datos_programa)) {
                        if ($objeto['Id_programa'] == $Id_programa) {
                       echo '<option value="' . $objeto['Id_programa'] . '" selected >  ' . $objeto['Desc_programa'] . '</option>';
                        } else {
                        echo '<option value="' . $objeto['Id_programa'] . '" >  ' . $objeto['Desc_programa'] . '</option>';
                        }
                        }
                        mysql_free_result($datos_programa); //Libera la memoria del resultado
                        ?> 
				</select>
				</div>
                </div>
				
                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Usuario:</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" name="usuario" id="usuario" value = "<? echo $Usuario; ?>" disabled>
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
                        <label class="col-sm-3 col-form-label" for="empresa">Estado<span class="required">*:</span>
                        </label>
                        <div  class="col-sm-9">
                        <select class="form-control" name="estado"  id="estado" value = "<? echo $Id_estado; ?>" >
						<?php
						while ($objeto = mysql_fetch_array($datos_estado)) {
						if($objeto['Id_estado']==$Id_estado){echo '<option value="' . $objeto['Id_estado'] . '" selected >  ' . $objeto['Desc_estado'] . '</option>'; }else{
						echo '<option value="' .$objeto['Id_estado']. '">  ' . $objeto['Desc_estado'] . '</option>';
						}
						}
					   mysql_free_result($datos_estado); //Libera la memoria del resultado 
					   ?>
					   </select>
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
			  <input type="hidden" name="id_estudiante" value="<? echo $id_estudiante; ?>"/>
			  <input name="valor" type="hidden" value="actualiza_soli"/>
              <button type="submit" class="btn btn-primary" id="subirF" >Actualizar</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			  <br><br>
        <div id="actualizar_soli" style="display:none" align="center"></div>
		
			  </div>
			</div>
			<input type="hidden" name="valor" value="save_docente">	
		</form>
		
		<script>
		$("#error_vac").hide();
		</script>
		
		</div>
</div>
</div>
<div id="response_soli"></div>

