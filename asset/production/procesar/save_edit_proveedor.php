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
if($_POST['valor'] == 'save_proveedor') {

//traemos los datos
$fila = $_POST['fila'];
$tip_documento = $_POST['tipo_documento'];
$documento = $_POST['documento'];
$proveedor_nombre = $_POST['proveedor_nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];
$nom_empresa = $_POST['nom_empresa']; 
$nit_empresa = $_POST['nit']; 


 if($tip_documento == "" || $documento == "" || $proveedor_nombre == "" || $apellidos == "" || $telefono == "" || $celular == "" || $correo == "" || $nom_empresa == "" || $nit_empresa == "" )  {

?>

  <div class="row" id= "response">
     <div class="alert alert-danger alert-dismissible fade in" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
     </button>
     <h4><i class="icon fa fa-check"></i><b>Por favor ingrese todos los campos marcados con (*)</b></h4>
      </div>
      </div>

<?php 
} else {
//actualizamos el registro

require_once '../seguridad/PHPExcel/Classes/PHPExcel.php'; //Agregamos la librería

$ruta = "../uploads/"; //ruta carpeta

//Variable con el nombre del archivo
$archivo = $ruta . 'solicitud' . '.xlsx';
$objPHPExcel = PHPExcel_IOFactory::load($archivo);
$objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $fila, $tip_documento);
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $fila, $documento);
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $fila, $proveedor_nombre);
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $fila, $apellidos);
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $fila, $telefono );
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $fila, $celular );
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $fila, $correo );
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $fila, $nom_empresa );
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $fila, $nit_empresa );

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($archivo);
        
if (!$archivo) {
		die("Fallo la actualización del registro." . mysql_error());
		} else {
?>

            <div class="row" id= "response">
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" value="subir_masivos"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>Se actualizó satisfactoriamente el registro!</b></h4>
                </div>
            </div>

<?php
		}
  }
} else if($_POST['valor'] == 'save_docente') {
//traemos los datos
$id_estudiante = $_POST['id_estudiante'];
$estudia_nombre = $_POST['estudia_nombre'];
$estudia_apellido = $_POST['estudia_apellido'];
$estudia_cedula = $_POST['estudia_cedula'];
$telefono = $_POST['telefono'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$programa = $_POST['programa'];
$estado = $_POST['estado'];
$contrasena = $_POST['contrasena'];
$password = md5($contrasena);
$tipo_documento = $_POST['t_documento'];

//actualizamos el registro

if($estudia_nombre == "" || $estudia_apellido == "" || $telefono == "" || $movil == "" || $correo == "")  {

?>

  <div class="row" id= "response">
     <div class="alert alert-danger alert-dismissible fade in" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
     </button>
     <h4><i class="icon fa fa-check"></i><b>Por favor ingrese todos los campos marcados con (*)</b></h4>
      </div>
      </div>

<?php
} else {

if($contrasena == '') {
$actualiza_docente = "UPDATE USUARIOS SET Nombres='$estudia_nombre',Apellidos='$estudia_apellido',Id_estado='$estado',Id_documento='$tipo_documento' WHERE Identificacion = '$id_estudiante'";
} 

else {
$actualiza_docente = "UPDATE USUARIOS SET Nombres='$estudia_nombre',Apellidos='$estudia_apellido',Password='$password',Id_estado='$estado',Id_documento='$tipo_documento' WHERE Identificacion = '$id_estudiante'";
}

$actualiza_email = "UPDATE MAILS SET Mail='$correo' WHERE Identificacion = '$id_estudiante'";
$actualiza_programa = "UPDATE DOCENTES SET Id_programa='$programa' WHERE Id_docente = '$id_estudiante'";

$actualiza_telefono = "UPDATE TELEFONOS SET Telefono_usuario = '$telefono' WHERE Identificacion = '$id_estudiante' AND Id_telefono = '1'";


$actualiza_movil = "UPDATE TELEFONOS SET Telefono_usuario = '$movil' WHERE Identificacion = '$id_estudiante' AND Id_telefono = '2'";


mysql_query($actualiza_movil);
mysql_query($actualiza_telefono);
mysql_query($actualiza_docente);
mysql_query($actualiza_email);
mysql_query($actualiza_programa);

if (!$actualiza_docente) {
    die("Fallo la actualización del registro." . mysql_error());
    } else {
?>

  <div class="row" id= "response">
     <div class="alert alert-info alert-dismissible fade in" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
     </button>
     <h4><i class="icon fa fa-check"></i><b>Se actualizó satisfactoriamente el registro!</b></h4>
      </div>
      </div>

<?php
    }
}
} else if($_POST['valor'] == 'save_empresa') {

$id_empresa = $_POST['id_empresa'];
$empresa = $_POST['empresa'];
$nit = $_POST['nit'];
$nombres = $_POST['nombres'];
$apellidos =  $_POST['apellidos'];
$identificacion = $_POST['cedula'];
$tipo_documento = $_POST['t_documento'];
$telefono = $_POST['telefono'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$sector_economico = $_POST['sector_eco'];
$actividad_economica = $_POST['acti_eco'];
$caja_compe = $_POST['caja_compe'];
$contrasena = $_POST['contrasena'];
$otra_caja = $_POST['cual_caja'];
$password = md5($contrasena);
$dir1 = $_POST['dir1'];
$dir2 = $_POST['dir2'];
$dir3 = $_POST['dir3'];
$dir4 = $_POST['dir4'];
$direccion = $dir2."#".$dir3."-".$dir4;

//actualizamos el registro

if($empresa == "" || $nit == "" || $telefono == "" || $movil == "" || $correo == "" || $direccion == "")  {

?>

  <div class="row" id= "response">
     <div class="alert alert-danger alert-dismissible fade in" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
     </button>
     <h4><i class="icon fa fa-check"></i><b>Por favor ingrese todos los campos marcados con (*)</b></h4>
      </div>
      </div>

<?php

} else {


$actualiza_empresa = "UPDATE EMPRESAS SET Nit='$nit',Nombre_empresa='$empresa',Nom_direccion='$dir1',Direccion_empresa='$direccion',Id_sectoreconomico='$sector_economico',Id_actividad_economica='$actividad_economica',Caja_compensacion = '$caja_compe' WHERE Id_empresa ='$id_empresa'";
mysql_query($actualiza_empresa);

$actualiza_usuario = "UPDATE USUARIOS SET Nombres = '$nombres', Apellidos = '$apellidos', Id_documento = '$tipo_documento', Password = '$password' WHERE Identificacion = '$identificacion'";
mysql_query($actualiza_usuario);

$actualiza_telefono = "UPDATE TELEFONOS SET Telefono_usuario = '$telefono' WHERE Identificacion = '$identificacion' AND Id_telefono = '1'";
mysql_query($actualiza_telefono);

$actualiza_movil = "UPDATE TELEFONOS SET Telefono_usuario = '$movil' WHERE Identificacion = '$identificacion' AND Id_telefono = '2'";
mysql_query($actualiza_movil);

$actualiza_mail = "UPDATE MAILS SET Mail = '$correo' WHERE Identificacion = '$identificacion'";
mysql_query($actualiza_mail);

if (!$actualiza_empresa || !$actualiza_usuario || !$actualiza_telefono || !$actualiza_movil || !$actualiza_mail)  {
    die("Fallo la actualización del registro." . mysql_error());
    } else {
?>

  <div class="row" id= "response">
     <div class="alert alert-info alert-dismissible fade in" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
     </button>
     <h4><i class="icon fa fa-check"></i><b>Se actualizó satisfactoriamente el registro!</b></h4>
      </div>
      </div>

<?php
    }
}

}
?>