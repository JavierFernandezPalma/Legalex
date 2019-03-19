<?php
include("connection_db.php"); 

$consulta6 = "SELECT * from CIUDAD where Id_departamento = ".$_GET['id']." ORDER BY Desc_ciudad ASC";
$datos6=mysql_query($consulta6,$conexion) or die("no se ha podido ejecutar la consulta");
while($row =mysql_fetch_array($datos6)) {
echo '<option value="' . $row['Id_ciudad'] . '">' . $row['Desc_ciudad'] . '</option>'; 
};

mysql_close($conexion);  // cierra la conexion

?>

