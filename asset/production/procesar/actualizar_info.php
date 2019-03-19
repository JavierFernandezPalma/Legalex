<script>
function tiempo(){
    setTimeout(function(){
        document.getElementById('response_n').innerHTML = '';
    },6000);
}
 tiempo(); 

</script>

<?php

   include("../seguridad/seguridad.php"); 
   include("../seguridad/connection_db.php");

if($_POST['valor'] == "actuali_datos_interno") {


//validad que los campos no esten vacios
if((isset($_POST['nom']) and !empty($_POST['nom'])) AND (isset($_POST['nom_apellido']) and !empty($_POST['nom_apellido']))){

//variables para registrar prueba
   $nombre  = $_SESSION['users'];
   $nom = $_POST['nom'];
   $nom_apellido = $_POST['nom_apellido'];
   $clave = $_POST['clave'];
  
if($clave==''){

 $actualizar_datos="Update USUARIOS Set Nombres='$nom',Apellidos='$nom_apellido' Where Usuario='$nombre'";
        mysqli_query($conexion, $actualizar_datos);
		if (!$actualizar_datos) {
		die("Fallo la actualización del registro (Candidato)." . mysqli_error());
		}

}else{


 $actualizar_datos="Update Usuarios Set Nombres='$nom',Apellidos='$nom_apellido',Password='$clave' Where Usuario='$nombre'";
        mysqli_query($conexion, $actualizar_datos);
		if (!$actualizar_datos) {
		die("Fallo la actualización del registro (Candidato)." . mysqli_error());
		}


}
?>
 <div class="row" id= "response_n">
     <div class="alert alert-info alert-dismissible fade in" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
     </button>
     <h4><i class="icon fa fa-check"></i><b>Se actualizo satisfactoriamente el registro!</b></h4>
      </div>
      </div>
<?php

   
   }
}


?>