<?php
include("connection_db.php"); 

$consulta6 = "SELECT * from DOCENTES 
left JOIN USUARIOS ON DOCENTES.Id_docente=USUARIOS.Identificacion
where DOCENTES.Id_programa = ".$_GET['id']." and USUARIOS.Id_perfil='3' and USUARIOS.Id_estado='2'";
$datos6=mysql_query($consulta6,$conexion) or die("no se ha podido ejecutar la consulta");
while($row =mysql_fetch_array($datos6)) {
echo '<option value="' . $row['Id_docente'] . '">'.$row['Nombres'].'</option>'; 
};

mysql_close($conexion);  // cierra la conexion

?>
