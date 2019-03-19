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


 $empresa = $_POST["empresa"];
 $programa = $_POST["programa"];
 $especialidad = $_POST["especialidad"];
 $estado_oferta = $_POST["estado_oferta"]; 


 //consulta ofertas activas
 
 //consulta ofertas activas
 $cadena1="SELECT * FROM `VACANTE` WHERE Id_estado='$estado_oferta' ";

 if($empresa<>''){ //empresa
   $cadena2="AND Id_empresa ='$empresa'";
   }
   
   if($especialidad<>''){ //especialidad
   $cadena3="AND Id_especialidad='$especialidad'";
   }

  @$cadenas=$cadena1.$cadena2.$cadena3;
   $consulta_refe2=$cadenas;
   $datos_refe2=mysql_query($consulta_refe2,$conexion) or die("no se ha podido ejecutar la consulta");
   $conteo_personas=mysql_num_rows($datos_refe2);
   
    $consulta_regi=$cadenas;
    $datos_regi=mysql_query($consulta_regi,$conexion) or die("no se ha podido ejecutar la consulta");


$objSheet->getCell('A1')->setValue('N°');
$objSheet->getCell('B1')->setValue('Empresa');
$objSheet->getCell('C1')->setValue('Departamento');
$objSheet->getCell('D1')->setValue('ciudad');
$objSheet->getCell('E1')->setValue('Fecha solicitud');
$objSheet->getCell('F1')->setValue('Programa');
$objSheet->getCell('G1')->setValue('Especialidad');
$objSheet->getCell('H1')->setValue('Cantidad aprendices');


$i = 2;
$j=1;
while ($row= mysql_fetch_array($datos_refe2)) {

$objSheet->getCell('A'.$i)->setValue($j);

    $Id_oferta_empresa= $row['Id_vacante'];
   $Id_empresa= $row['Id_empresa'];
   $F_solicitud =$row['F_publica'];
   //$Q_solicitud =$row['Q_solicitud'];
   $Cantidad_aprendices =$row['Vacantes'];
   //$Id_programa = $row['Id_programa'];
   $Id_especialidad = $row['Id_especialidad'];
   $Remuneracion_vacante = $row['Remuneracion_vacante'];
   


    //trae datos de empresa
   //consulta empresas 
   $consulta_nom_empresa="SELECT * FROM EMPRESAS WHERE Id_empresa='$Id_empresa'";
   $datos_nom_empresa=mysql_query($consulta_nom_empresa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_empresa=mysql_fetch_assoc($datos_nom_empresa);
   $nom_empresa=$resul_nom_empresa['Nombre_empresa'];
   $Id_departamento=$resul_nom_empresa['Id_departamento'];
   $Id_ciudad=$resul_nom_empresa['Id_ciudad'];
  
   
   //Consulta nombre especialidad
   
   $consulta_nom_especiali="SELECT * FROM ESPECIALIDAD WHERE Id_especialidad='$Id_especialidad'";
   $datos_nom_especiali=mysql_query($consulta_nom_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_especiali=mysql_fetch_assoc($datos_nom_especiali);
   $nom_especiali=$resul_nom_especiali['Desc_especialidad'];
   $id_pro=$resul_nom_especiali['Id_programa'];
   
   //Consulta nombre programa
   
   $consulta_nom_programa="SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$id_pro'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Desc_programa'];

   
   $consulta_nom_ciudad="SELECT * FROM CIUDAD WHERE Id_ciudad='$Id_ciudad'";
   $datos_nom_ciudad=mysql_query($consulta_nom_ciudad,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_ciudad=mysql_fetch_assoc($datos_nom_ciudad);
   $nom_ciudad=$resul_nom_ciudad['Desc_ciudad'];
    $Id_departamento=$resul_nom_ciudad['Id_departamento'];


   $consulta_nom_departamento="SELECT * FROM DEPARTAMENTO WHERE Id_departamento='$Id_departamento'";
   $datos_nom_departamento=mysql_query($consulta_nom_departamento,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_departamento=mysql_fetch_assoc($datos_nom_departamento);
   $nom_departamento=$resul_nom_departamento['Desc_departamento'];



   


 $objSheet->getCell('B'.$i)->setValue($nom_empresa);  
 $objSheet->getCell('C'.$i)->setValue($nom_departamento);
 $objSheet->getCell('D'.$i)->setValue($nom_ciudad);    
 $objSheet->getCell('E'.$i)->setValue($F_solicitud);  
 $objSheet->getCell('F'.$i)->setValue($nom_programa); 
 $objSheet->getCell('G'.$i)->setValue($nom_especiali); 
 $objSheet->getCell('H'.$i)->setValue($Cantidad_aprendices);  



$j=$j+1;
$i=$i+1;
}


$content = ob_get_clean();
//$objWriter->save('pruebaexcel2.xls');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Exportar_ofertas.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>