<?php
include("../seguridad/connection_db.php"); 
include("../seguridad/seguridad.php"); 

?>

<script>
function tiempo(){
    setTimeout(function(){
        document.getElementById('response').innerHTML = '';
    },2000);
}
 tiempo(); 

</script>

<?php
//traemos los datos
$id_estudiante = $_POST['id_estudiante'];
$estudia_nombre = $_POST['estudia_nombre'];
$estudia_cedula = $_POST['estudia_cedula'];
$telefono = $_POST['telefono'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$estado = $_POST['estado'];
$contrasena = $_POST['contrasena'];
$password = md5($contrasena);

//actualizamos el registro

if($contrasena == '') {
$actualiza_estudiante = "UPDATE Usuarios SET Nombres='$estudia_nombre',Identificacion='$estudia_cedula',Telefono='$telefono',Movil='$movil',Correo='$correo',Id_estado='$estado' WHERE Id_usuario = '$id_estudiante'";
} else {
$actualiza_estudiante = "UPDATE Usuarios SET Nombres='$estudia_nombre',Identificacion='$estudia_cedula',Password='$password',Telefono='$telefono',Movil='$movil',Correo='$correo',Id_estado='$estado' WHERE Id_usuario = '$id_estudiante'";
}

mysqli_query($actualiza_estudiante);

if (!$actualiza_estudiante) {
		die("Fallo la actualización del registro." . mysql_error());
		} else {
?>

  <div class="row" id= "response">
     <div class="alert alert-info alert-dismissible fade in" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
     </button>
     </button>
     <h4><i class="icon fa fa-check"></i><b>Se actualizó satisfactoriamente el registro!</b></h4>
      </div>
      </div>

<?php
		}

?>