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
 $estado_docente = $_POST["estado_docente"]; 


//consulta ofertas activas
 $cadena1="SELECT * FROM `USUARIOS` 
 Left JOIN DOCENTES ON USUARIOS.Identificacion=DOCENTES.Id_docente
 Left JOIN MAILS ON USUARIOS.Identificacion=MAILS.Identificacion
 WHERE USUARIOS.Id_perfil='3' and USUARIOS.Id_estado='$estado_docente'";

 if($programa<>''){ //empresa
   $cadena2="AND DOCENTES.Id_programa ='$programa'";
   }
   

  @$cadenas=$cadena1.$cadena2;
   $consulta_refe2=$cadenas;
   $datos_refe2=mysql_query($consulta_refe2,$conexion) or die("no se ha podido ejecutar la consulta");
   $conteo_personas=mysql_num_rows($datos_refe2);
   
    $consulta_regi=$cadenas;
    $datos_regi=mysql_query($consulta_regi,$conexion) or die("no se ha podido ejecutar la consulta");

$objSheet->getCell('A1')->setValue('N°');
$objSheet->getCell('B1')->setValue('Nombre');
$objSheet->getCell('C1')->setValue('Apellidos');
$objSheet->getCell('D1')->setValue('Cedula');
$objSheet->getCell('E1')->setValue('Programa');
$objSheet->getCell('F1')->setValue('Email');
$objSheet->getCell('G1')->setValue('Estado');


$i = 2;
$j=1;
while ($row= mysql_fetch_array($datos_refe2)) {

$objSheet->getCell('A'.$i)->setValue($j);

   $nom_docente= $row['Nombres'];
   $apell_docente= $row['Apellidos'];
   $cedu_docente=$row['Identificacion'];
   $Id_programa_docen =$row['Id_programa']; 
   $email = $row['Mail'];
   $Id_estado = $row['Id_estado'];
   

   //Consulta programa Nombre
   
   $consulta_nom_programa="SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$Id_programa_docen'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Desc_programa'];
   
   //Consulta nombre Estado
   
   $consulta_nom_estado="SELECT * FROM ESTADOS WHERE Id_estado='$Id_estado'";
   $datos_nom_estado=mysql_query($consulta_nom_estado,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_estado=mysql_fetch_assoc($datos_nom_estado);
   $nom_estado=$resul_nom_estado['Desc_estado'];
    

 $objSheet->getCell('B'.$i)->setValue($nom_docente);  
 $objSheet->getCell('C'.$i)->setValue($apell_docente);  
 $objSheet->getCell('D'.$i)->setValue($cedu_docente);  
 $objSheet->getCell('E'.$i)->setValue($nom_programa);  
 $objSheet->getCell('F'.$i)->setValue($email);  
 $objSheet->getCell('G'.$i)->setValue($nom_estado); 
 



$j=$j+1;
$i=$i+1;
}


$content = ob_get_clean();
//$objWriter->save('pruebaexcel2.xls');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Exportar_docentes.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>