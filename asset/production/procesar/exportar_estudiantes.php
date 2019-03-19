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


 $programa = $_POST["programa"];
 $especialidad = $_POST["especialidad"];
 $estado_estudiante = $_POST["estado_estudiante"]; 
 $estado_practica = $_POST["estado_practica"]; 


 
//consulta estudiantes
   $cadena1="SELECT * FROM `USUARIOS` 
   Left JOIN ESTUDIANTES ON USUARIOS.Identificacion=ESTUDIANTES.Identificacion 
   Left JOIN MAILS ON USUARIOS.Identificacion=MAILS.Identificacion 
   WHERE USUARIOS.Id_perfil='4' and USUARIOS.Id_estado='$estado_estudiante'";

 if($programa<>''){ //programa
   $cadena2="AND ESTUDIANTES.Id_programa ='$programa'";
   }
   
   if($especialidad<>''){ //especialidad
   $cadena3="AND ESTUDIANTES.Id_especialidad='$especialidad'";
   }
   


  @$cadenas=$cadena1.$cadena2.$cadena3;
   $consulta_refe2=$cadenas;
   $datos_refe2=mysql_query($consulta_refe2,$conexion) or die("no se ha podido ejecutar la consulta");
   $conteo_personas=mysql_num_rows($datos_refe2);
   
    $consulta_regi=$cadenas;
    $datos_regi=mysql_query($consulta_regi,$conexion) or die("no se ha podido ejecutar la consulta");

$objSheet->getCell('A1')->setValue('N°');
$objSheet->getCell('B1')->setValue('Cedula');
$objSheet->getCell('C1')->setValue('Nombres');
$objSheet->getCell('D1')->setValue('Apellidos');
$objSheet->getCell('E1')->setValue('Email');
$objSheet->getCell('F1')->setValue('Programa');
$objSheet->getCell('G1')->setValue('Especialidad');
$objSheet->getCell('H1')->setValue('Estado practica');
$objSheet->getCell('I1')->setValue('Estado');


$i = 2;
$j=1;
while ($row= mysql_fetch_array($datos_refe2)) {

$objSheet->getCell('A'.$i)->setValue($j);

   $nom_estudiante= $row['Nombres'];
   $apell_estudiante= $row['Apellidos'];
   $cedu_estudiante=$row['Identificacion'];
   $correo =$row['Mail']; 
   $programa = $row['Id_programa'];
   $especialidad = $row['Id_especialidad'];
   $Estado = $row['Id_estado'];


    //Consulta nombre programa
   
   $consulta_nom_programa="SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$programa'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Desc_programa'];
   
   //Consulta nombre especialidad
   
   $consulta_nom_especiali="SELECT * FROM ESPECIALIDAD WHERE Id_especialidad='$especialidad'";
   $datos_nom_especiali=mysql_query($consulta_nom_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_especiali=mysql_fetch_assoc($datos_nom_especiali);
   $nom_especiali=$resul_nom_especiali['Desc_especialidad'];

     
   
    $etado_practica="En proceso";

  

   //Consulta nombre Estado
   
   $consulta_nom_estado="SELECT * FROM ESTADOS WHERE Id_estado='$Estado'";
   $datos_nom_estado=mysql_query($consulta_nom_estado,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_estado=mysql_fetch_assoc($datos_nom_estado);
   $nom_estado=$resul_nom_estado['Desc_estado'];
    

 $objSheet->getCell('B'.$i)->setValue($cedu_estudiante); 
 $objSheet->getCell('C'.$i)->setValue($nom_estudiante); 
 $objSheet->getCell('D'.$i)->setValue($apell_estudiante);
 $objSheet->getCell('E'.$i)->setValue($correo);    
 $objSheet->getCell('F'.$i)->setValue($nom_programa);  
 $objSheet->getCell('G'.$i)->setValue($nom_especiali); 
 $objSheet->getCell('H'.$i)->setValue($etado_practica); 
 $objSheet->getCell('I'.$i)->setValue($nom_estado); 
 



$j=$j+1;
$i=$i+1;
}


$content = ob_get_clean();
//$objWriter->save('pruebaexcel2.xls');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Exportar_estudiantes.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>