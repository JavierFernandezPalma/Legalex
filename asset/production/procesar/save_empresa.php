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
$id_empresa = $_POST['id_empresa'];
$empresa = $_POST['empresa'];
$nit = $_POST['nit'];
$c_operativo = $_POST['c_operativo'];
$telefono = $_POST['telefono'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$s_economico = $_POST['s_economico'];
$a_economica = $_POST['a_economica'];
$contrasena = $_POST['contrasena'];
$password = md5($contrasena);

//actualizamos el registro

if($contrasena == '') {
$actualiza_empresa = "UPDATE Empresas SET Empresa='$empresa',Nit='$nit',Contacto_operativo='$c_operativo',Direccion='$direccion',Telefono='$telefono',Movil='$movil',Correo='$correo',Sector_eco='$s_economico',Actividad_eco='$a_economica' WHERE Id_empresa = '$id_empresa'";
} else {
$actualiza_empresa = "UPDATE Empresas SET Empresa='$empresa',Nit='$nit',Password='$password',Contacto_operativo='$c_operativo',Direccion='$direccion',Telefono='$telefono',Movil='$movil',Correo='$correo',Sector_eco='$s_economico',Actividad_eco='$a_economica' WHERE Id_empresa = '$id_empresa'";
}

mysqli_query($actualiza_empresa);

if (!$actualiza_empresa) {
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