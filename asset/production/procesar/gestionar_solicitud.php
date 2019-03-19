<?php  
//select.php 
include("../seguridad/connection_db.php"); 
include("../seguridad/seguridad.php"); 

 // capturamos el id de la empresa
$user = $_SESSION['users'];
$id_oferta = $_POST['empresa'];

$consulta_user = "SELECT Id_perfil FROM USUARIOS WHERE Usuario = '$user'";
$resul_usuario = mysql_query($consulta_user,$conexion);
$resul_id = mysql_fetch_array($resul_usuario);

$id_perfil = $resul_id['Id_perfil'];

 $consulta_oferta = "SELECT * FROM VACANTE WHERE Id_vacante = '$id_oferta'";
 $resul_oferta = mysql_query($consulta_oferta,$conexion);
 

 while ($row = mysql_fetch_array($resul_oferta)) { 
	
	$id_empresa = $row['Id_empresa'];
	$id_estado = $row['Id_estado'];
	$id_especialidad = $row['Id_especialidad'];
	$id_modalidad  = $row['Id_modalidad'];
	$vacantes = $row['Vacantes'];
	$fecha_solicitud = $row['F_publica'];
	$descripcion = $row['Desc_vacante'];
	$remuneracion = $row['Remuneracion_vacante'];
	$observaciones = $row['Obser_vacante'];
	
 }

$consulta_empresa = "SELECT Nombre_empresa FROM EMPRESAS WHERE Id_empresa = '$id_empresa'";
$resul_empresa = mysql_query($consulta_empresa,$conexion);
$empresa_nom = mysql_fetch_array($resul_empresa);
$nombre_empresa = $empresa_nom['Nombre_empresa'];
 
   $consulta_nom_especiali="SELECT * FROM ESPECIALIDAD WHERE Id_especialidad='$id_especialidad'";
   $datos_nom_especiali=mysql_query($consulta_nom_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_especiali=mysql_fetch_assoc($datos_nom_especiali);
   $nom_especiali=$resul_nom_especiali['Desc_especialidad'];
   $id_pro=$resul_nom_especiali['Id_programa']; 

    $consulta_nom_programa="SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$id_pro'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Desc_programa'];

  /*$consulta_nom_programa="SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$id_programa'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Nom_programa'];


$consulta_nom_especiali="SELECT * FROM Especialidades WHERE Id_especialidad='$id_especialidad'";
$datos_nom_especiali=mysql_query($consulta_nom_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
$resul_nom_especiali=mysql_fetch_assoc($datos_nom_especiali);
$nom_especiali=$resul_nom_especiali['Nom_especialidad'];*/

/* 
$consulta_departamento = "SELECT Descripcion FROM Departamento WHERE Id_departamento = '$departamento'";
$resul_dpto = mysql_query($consulta_departamento,$conexion);
$dpto_nom = mysql_fetch_array($resul_dpto);
$nombre_dpto = $dpto_nom['Descripcion'];

$consulta_ciudad = "SELECT Descripcion FROM Municipios WHERE Id_departamento = '$departamento' AND Id_ciudad = '$ciudad'";
$resul_ciu = mysql_query($consulta_ciudad,$conexion);
$ciu_nom = mysql_fetch_array($resul_ciu);
$nombre_ciu = $ciu_nom['Descripcion'];
*/

$consulta_estudiantes = "SELECT * FROM OFERTA_ESTUDIANTE WHERE Id_oferta = '$id_oferta'";
$resul_estudiantes = mysql_query($consulta_estudiantes,$conexion);
 ?>  	

<div class="container">
<div class ="row">
<div class="col-md-10">
<form id="actualizar_solicitud" novalidate method="post" class="form-horizontal form-label-left" >
<div class="box-body">
				
			
                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Empresa<span class="required">:</span></label>
				<div class="col-sm-9">
				<?php echo $nombre_empresa; ?>
				</div>
                </div>
				
				<!--<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Departamento<span class="required">:</span></label>
				<div class="col-sm-9">
				<?php echo $nombre_dpto; ?>
				</div>
                </div>
				

				<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Ciudad<span class="required">:</span></label>
				<div class="col-sm-9">
				<?php echo $nombre_ciu; ?>
				
				</div>
                </div>-->

				<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Fecha Solicitud<span class="required">:</span></label>
				<div class="col-sm-9">
				<?php echo $fecha_solicitud; ?>
			
				</div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Programa<span class="required">:</span></label>
				<div class="col-sm-9">
				<?php echo $nom_programa; ?>
				</div>
                </div>

                 <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Especialidad<span class="required">:</span></label>
				<div class="col-sm-9">
				<?php echo $nom_especiali; ?>
				</div>
                </div>


                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">canitdad de aprendices<span class="required">:</span></label>
				<div class="col-sm-9">
				<?php echo $vacantes; ?>
				</div>
                </div>

                   <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Remuneración vacante<span class="required">:</span></label>
				<div class="col-sm-9">
				<?php echo $remuneracion; ?>
				</div>
                </div>

				<!--<div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Contacto operativo:</label>
				<div class="col-sm-9">
				<?php echo $contacto_operativo; ?>
				
				</div>
                </div>-->

                <!-- <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Correo:</label>
				<div class="col-sm-9">
				<?php echo $correo; ?>
				</div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Teléfono:</label>
				<div class="col-sm-9">
				<?php echo $telefono;  ?>
				</div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Movil:</label>
				<div class="col-sm-9">
				<?php echo $movil;  ?>
				</div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Dirección:</label>
				<div class="col-sm-9">
				<?php echo $direccion;  ?>
				</div>
                </div>-->
				
                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Perfil aspirante:</label>
				<div class="col-sm-9">
				<?php echo $descripcion; ?>
				</div>
                </div>

                <div class="form-group" style="margin-top:-8px;">
                <label class="col-sm-3 col-form-label">Observaciones:</label>
				<div class="col-sm-9">
				<?php echo $observaciones; ?>
				</div>
                </div>

              			
				
				<div class="form-group" style="margin-top:-8px;">
				 <label class="col-sm-3 col-form-label"></label>
				<div class="col-sm-5">
				</div>
                </div>
										
			</div>
			
		</form>
<?php  if($id_perfil != '4') { ?>

<h2 align="center">Estudiantes postulados</h2>		
<table id="datatable" class="table table-striped table-bordered" align="center">
	<thead>
	<th>N°</th>
	<th>Nombre</th>
	<th>Documento</th>
	<th>Programa</th>
	<th>Especialidad</th>
	</thead>

<tbody>
<?php 

$i = 1;

while ($row2 = mysql_fetch_array($resul_estudiantes)) {

$id_estudiante = $row2['Id_estudiante'];
$id_titulo_estudiante = $row2['Id_titulo_estudiante'];
$fecha_postu = $row2['F_postulado'];
$id_estado_soli = $row2['Id_estado_solicitud'];

$consulta_postulados = "SELECT * FROM USUARIOS Left JOIN ESTUDIANTES ON USUARIOS.Identificacion=OFERTA_ESTUDIANTE.Est_identificacion  WHERE USUARIOS.Identificacion = '$id_estudiante' AND OFERTA_ESTUDIANTE.Id_oferta = '$id_titulo_estudiante'";
$resul_estu = mysql_query($consulta_postulados,$conexion);
$datos_postu = mysql_fetch_array($resul_estu);



    //Consulta nombre programa
   
   $consulta_nom_programa="SELECT * FROM Programas WHERE Id_programa='$datos_postu[Id_programa]'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Nom_programa'];

      //Consulta nombre especialidad
   
  $consulta_nom_especiali="SELECT * FROM Especialidades WHERE Id_especialidad='$datos_postu[Id_especialidad]'";
   $datos_nom_especiali=mysql_query($consulta_nom_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_especiali=mysql_fetch_assoc($datos_nom_especiali);
   $nom_especiali=$resul_nom_especiali['Nom_especialidad'];

?>
<tr>

<td><?php echo $i; ?></td>	

<td><?php echo $datos_postu['Nombres'];  ?></td>
<td><?php echo $datos_postu['Cedula'];  ?></td>
<td><?php echo $nom_programa;  ?></td>
<td><?php echo $nom_especiali;  ?></td>

</tr>
<?php
$i++;
}
?>

</tbody>
</table>

<?php } ?>		

			  <div class='col-md-2'>
			  </div>
			  <div class="col-md-6 col-md-offset-5">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			  <br><br>
		
			  </div>
		<script>
		$("#error_vac").hide();
		</script>
		
		</div>
</div>
</div>
<div id="response_soli"></div>

