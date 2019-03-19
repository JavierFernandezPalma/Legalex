<?php
include("connection_db.php"); 

$consulta6 = "SELECT * from ESPECIALIDAD where Id_programa = ".$_GET['id']." ORDER BY `ESPECIALIDAD`.`Desc_especialidad` ASC";
$datos6=mysql_query($consulta6,$conexion) or die("no se ha podido ejecutar la consulta");
while($row =mysql_fetch_array($datos6)) {
echo '<option value="' . $row['Id_especialidad'] . '">'.$row['Desc_especialidad'].'</option>'; 
};

mysql_close($conexion);  // cierra la conexion

?>
