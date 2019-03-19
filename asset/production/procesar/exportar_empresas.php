<?php 

 include("../seguridad/seguridad.php"); 
 include("../seguridad/connection_db.php");
 require_once ('../seguridad/PHPExcel/Classes/PHPExcel.php');
require_once("../seguridad/PHPExcel/Classes/PHPExcel/Writer/Excel5.php");
include ('../seguridad/PHPExcel/Classes/PHPExcel/IOFactory.php');


$objPHPExcel = new PHPExcel;
// set syles
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
// writer will create the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();
$objSheet->setTitle('INFORME');

$phpColor = new PHPExcel_Style_Color();
$phpColor->setRGB('1C517D');  


 $empresa = $_POST["empresa"];
 $departamento = $_POST["departamento"];
 $ciudad = $_POST["ciudad"];
 $estado_empresa = $_POST["estado_empresa"]; 


//consulta ofertas activas
 $cadena1="SELECT * FROM `EMPRESAS` 
 left JOIN USUARIOS ON EMPRESAS.Identificacion=USUARIOS.Identificacion
 WHERE USUARIOS.Id_estado='$estado_empresa' ";

 if($empresa<>''){ //empresa
   $cadena2="AND EMPRESAS.Id_empresa ='$empresa'";
   }
   
   if($departamento<>''){ //departamento
   $cadena3="AND EMPRESAS.Id_departamento='$departamento'";
   }
   
   if($ciudad<>''){ //ciudad
   $cadena4="AND EMPRESAS.Id_ciudad='$ciudad'";
   }

  @$cadenas=$cadena1.$cadena2.$cadena3.$cadena4;
   $consulta_refe2=$cadenas;
   $datos_refe2=mysql_query($consulta_refe2,$conexion) or die("no se ha podido ejecutar la consulta");
   $conteo_personas=mysql_num_rows($datos_refe2);
   
    $consulta_regi=$cadenas;
    $datos_regi=mysql_query($consulta_regi,$conexion) or die("no se ha podido ejecutar la consulta");

$objSheet->getCell('A1')->setValue('N°');
$objSheet->getCell('B1')->setValue('Empresa');
$objSheet->getCell('C1')->setValue('Nit');
$objSheet->getCell('D1')->setValue('Departamento');
$objSheet->getCell('E1')->setValue('Ciudad');
$objSheet->getCell('F1')->setValue('Fecha creación');
$objSheet->getCell('G1')->setValue('Estado');


$i = 2;
$j=1;
while ($row= mysql_fetch_array($datos_refe2)) {

$objSheet->getCell('A'.$i)->setValue($j);

    $codigo_empresa= $row['Id_empresa'];
   $Empresa= $row['Nombre_empresa'];
   $Nit=$row['Nit'];
   $F_creacion =$row['F_creacion']; 
   $Id_departamento = $row['Id_departamento'];
   $Id_ciudad = $row['Id_ciudad'];
   $Estado = $row['Id_estado'];


     //Consulta nombre departamento 
   $consulta_nom_departamento="SELECT * FROM DEPARTAMENTO WHERE Id_departamento='$Id_departamento'";
   $datos_nom_departamento=mysql_query($consulta_nom_departamento,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_departamento=mysql_fetch_assoc($datos_nom_departamento);
   $nom_departamento=$resul_nom_departamento['Desc_departamento'];
   
   //Consulta nombre ciudad
   
   $consulta_nom_ciudad="SELECT * FROM CIUDAD WHERE Id_ciudad='$Id_ciudad'";
   $datos_nom_ciudad=mysql_query($consulta_nom_ciudad,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_ciudad=mysql_fetch_assoc($datos_nom_ciudad);
   $nom_ciudad=$resul_nom_ciudad['Desc_ciudad'];
   
   //Consulta nombre Estado
   
   $consulta_nom_estado="SELECT * FROM ESTADOS WHERE Id_estado='$Estado'";
   $datos_nom_estado=mysql_query($consulta_nom_estado,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_estado=mysql_fetch_assoc($datos_nom_estado);
   $nom_estado=$resul_nom_estado['Desc_estado'];


 $objSheet->getCell('B'.$i)->setValue($Empresa);  
 $objSheet->getCell('C'.$i)->setValue($Nit);
 $objSheet->getCell('D'.$i)->setValue($nom_departamento);    
 $objSheet->getCell('E'.$i)->setValue($nom_ciudad);  
 $objSheet->getCell('F'.$i)->setValue($F_creacion); 
 $objSheet->getCell('G'.$i)->setValue($nom_estado); 
 



$j=$j+1;
$i=$i+1;
}


$content = ob_get_clean();
//$objWriter->save('pruebaexcel2.xls');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Exportar_empresas.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>