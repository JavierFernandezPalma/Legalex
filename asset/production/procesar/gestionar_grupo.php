<?php  
//select.php 
include("../seguridad/connection_db.php"); 
include("../seguridad/seguridad.php"); 

 // capturamos el id de la empresa
$user = $_SESSION['users'];
$id_grupo = $_POST['grup'];

//consulta estudiantes asignado al grupo
$consulta_grupo_es="SELECT * FROM `ASIGNAR_GRUPO` WHERE Codigo_grupo='$id_grupo'";
$datos_grupo_es=mysql_query($consulta_grupo_es,$conexion) or die("no se ha podido ejecutar la consulta");

 ?>  	

<div class="container">
<div class ="row">
<div class="col-md-10">



<h2 align="center">Estudiantes Asignados</h2>		
<table id="datatable" class="table table-striped table-bordered" align="center">
	<thead>
	<th>N°</th>
	<th>Nombres</th>
	<th>Cedula</th>
	<th>Programa</th>
	<th>Especialidad</th>
	<th>Jornada</th>
    <th>Semestre</th>
	<th>Eliminar</th>
	</thead>

<tbody>
<?php 

$i = 1;

while ($row2 = mysql_fetch_array($datos_grupo_es)) {

$id_estudiante = $row2['Id_estudiante'];

 //Consulta nombres de estudiante
   
   $consulta_nom_estudiante="SELECT Nombres,Apellidos FROM USUARIOS WHERE Identificacion='$id_estudiante'";
   $datos_nom_estudiante=mysql_query($consulta_nom_estudiante,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_estudiante=mysql_fetch_assoc($datos_nom_estudiante);
   $nom_estudiantes=$resul_nom_estudiante['Nombres'];
   $apell_estudiantes=$resul_nom_estudiante['Apellidos'];

 //Consulta tabla estudiantes
   
   $consulta_dat_estudiante="SELECT * FROM ESTUDIANTES WHERE Identificacion='$id_estudiante'";
   $datos_dat_estudiante=mysql_query($consulta_dat_estudiante,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_dat_estudiante=mysql_fetch_assoc($datos_dat_estudiante);
   $id_programa_gr=$resul_dat_estudiante['Id_programa']; 
   $id_especiali_gr=$resul_dat_estudiante['Id_especialidad']; 
   $id_jornada_gr=$resul_dat_estudiante['Id_jornada']; 
   $id_semestre_gr=$resul_dat_estudiante['Id_semestre']; 
   
   //Consulta nombre programa
   
   $consulta_nom_programa="SELECT Desc_programa FROM PROGRAMA_ACADEMICO WHERE Id_programa='$id_programa_gr'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Desc_programa'];
   
   //Consulta nombre especialidad
   
   $consulta_nom_especiali="SELECT Desc_especialidad FROM ESPECIALIDAD WHERE Id_especialidad='$id_especiali_gr'";
   $datos_nom_especiali=mysql_query($consulta_nom_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_especiali=mysql_fetch_assoc($datos_nom_especiali);
   $nom_especiali=$resul_nom_especiali['Desc_especialidad'];
   
   //Consulta jornada
   
   $consulta_jornada="SELECT Desc_jornada FROM JORNADA WHERE Id_jornada='$id_jornada_gr'";
   $datos_jornada=mysql_query($consulta_jornada,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_jornada=mysql_fetch_assoc($datos_jornada);
   $nom_jornada=$resul_jornada['Desc_jornada'];
?>
<tr>

<td><?php echo $i; ?></td>	

<td><?php echo $nom_estudiantes.' '.$apell_estudiantes;  ?></td>
<td><?php echo $id_estudiante;  ?></td>
<td><?php echo $nom_programa;  ?></td>
<td><?php echo $nom_especiali;  ?></td>
<td><?php echo $nom_jornada;  ?></td>
<td><?php echo $id_semestre_gr;  ?></td>
<td><p>Eliminar</p></td>

</tr>
<?php
$i++;
}
?>

</tbody>
</table>
	

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

