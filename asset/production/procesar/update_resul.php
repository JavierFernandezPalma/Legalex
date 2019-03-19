<?php 
   include("../seguridad/seguridad.php"); 
   include("../seguridad/connection_db.php");

// aquí se actualizan los datos de la tabla de empresas
if($_POST['type_form'] == "update_empresa") {

$cod_empresa = $_POST['cod_empresa'];
$consulta_empresa = "SELECT  Nombre_empresa FROM EMPRESAS WHERE Id_empresa = '$cod_empresa'";
$resul_empresa = mysql_query($consulta_empresa,$conexion);
$fila = mysql_fetch_assoc($resul_empresa);
echo $empresa = $fila['Nombre_empresa'];

}

if($_POST['type_form'] == "update_nit") {
$cod_empresa = $_POST['cod_empresa'];
$consulta_nit = "SELECT  Nit FROM EMPRESAS WHERE Id_empresa = '$cod_empresa'";
$resul_empresa = mysql_query($consulta_nit,$conexion);
$fila = mysql_fetch_assoc($resul_empresa);
echo $nit = $fila['Nit'];

}

// aquí se actualizan los datos de la tabla de estudiantes
if($_POST['type_form'] == "update_nom_estu") {
$cod_estu = $_POST['cod_estu'];
$consulta_nombre = "SELECT Nombres FROM USUARIOS WHERE Identificacion = '$cod_estu'";
$resul_nombre = mysql_query($consulta_nombre,$conexion);
$fila = mysql_fetch_assoc($resul_nombre);
echo $nombre = $fila['Nombres'];
}

if($_POST['type_form'] == "update_apell_estu") {
$cod_estu = $_POST['cod_estu'];
$consulta_nombre = "SELECT Apellidos FROM USUARIOS WHERE Identificacion = '$cod_estu'";
$resul_nombre = mysql_query($consulta_nombre,$conexion);
$fila = mysql_fetch_assoc($resul_nombre);
echo $apellido = $fila['Apellidos'];
}

if($_POST['type_form'] == "update_cc_estu") {
$cod_estu = $_POST['cod_estu'];
$consulta_cc = "SELECT Identificacion FROM USUARIOS WHERE Identificacion = '$cod_estu'";
$resul_cc = mysql_query($consulta_cc,$conexion);
$fila = mysql_fetch_assoc($resul_cc);
echo $cc = $fila['Identificacion'];
}

if($_POST['type_form'] == "update_correo_estu") {
$cod_estu = $_POST['cod_estu'];
$consulta_correo = "SELECT Mail FROM MAILS WHERE Identificacion = '$cod_estu'";
$resul_correo = mysql_query($consulta_correo,$conexion);
$fila = mysql_fetch_assoc($resul_correo);
echo $correo = $fila['Mail'];
}


// aquí se actualizan los datos de la tabla de docentes
if($_POST['type_form'] == "update_nombre_docen") {
$cod_docen = $_POST['cod_docen'];
$consulta_nom = "SELECT Nombres FROM USUARIOS WHERE Identificacion = '$cod_docen'";
$resul_nom = mysql_query($consulta_nom,$conexion);
$fila = mysql_fetch_assoc($resul_nom);
echo $nombre = $fila['Nombres'];
}

if($_POST['type_form'] == "update_apellido_docen") {
$cod_docen = $_POST['cod_docen'];
$consulta_nom = "SELECT Apellidos FROM USUARIOS WHERE Identificacion = '$cod_docen'";
$resul_nom = mysql_query($consulta_nom,$conexion);
$fila = mysql_fetch_assoc($resul_nom);
echo $nombre = $fila['Apellidos'];
}

if($_POST['type_form'] == "update_cc_docen") {
$cod_docen = $_POST['cod_docen'];
$consulta_cc = "SELECT Identificacion FROM USUARIOS WHERE Identificacion = '$cod_docen'";
$resul_cc = mysql_query($consulta_cc,$conexion);
$fila = mysql_fetch_assoc($resul_cc);
echo $cc = $fila['Identificacion'];
}

if($_POST['type_form'] == "update_programa_docen") {
$cod_docen = $_POST['cod_docen'];
$programa_docen = $_POST['programa_docen'];

$consulta_nom_programa="SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$programa_docen'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   echo $nom_programa=$resul_nom_programa['Desc_programa'];

}

// Se actualizan los datos de masivo proveedores

if($_POST['type_form'] != "update_tel_proveedor") {
$cod_docen = $_POST['cod_estu'];
echo $telefono=2323669;
}

?>