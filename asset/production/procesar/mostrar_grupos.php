<?php 

   include("../seguridad/seguridad.php"); 
   include("../seguridad/connection_db.php");

if($_POST['valor'] == "consulta_disponibles") {
$codigo_grupo = $_POST['codigo_grupo'];
$programa_grupo = $_POST['programa_grupo'];

//consulta estudiantes
$consulta_estudiantes="SELECT * FROM `ESTUDIANTES` WHERE Id_programa='$programa_grupo'";
$datos_estudiantes=mysql_query($consulta_estudiantes,$conexion) or die("no se ha podido ejecutar la consulta");
?>

 <script>
function cambiaGrupo(chk) {
	
	
    var padreDIV=chk;
    while( padreDIV.nodeType==1 && padreDIV.tagName.toUpperCase()!="DIV" )
        padreDIV=padreDIV.parentNode;
    //ahora que padreDIV es el DIV, cogeremos todos sus checkboxes
    var padreDIVinputs=padreDIV.getElementsByTagName("input");
    for(var i=0; i<padreDIVinputs.length; i++) {
        if( padreDIVinputs[i].getAttribute("type")=="checkbox" )
            padreDIVinputs[i].checked = chk.checked;
    }
}
</script> 

<script type="text/javascript">
          
           $(function() {
                            $("#ingresa_estudian").submit(function() {  
                                $.ajax({
                                    type: "POST",
                                    url: "procesar/solicitud_oferta.php",
                                    dataType: "html",
                                    data: $(this).serialize(),
                                    beforeSend: function() {
                                        $("#loading_grupo").show();
                                    },
                                    success: function(response) {
                                        $("#response_grupo").html(response);
                                        $("#loading_grupo").hide();
                                    }
                                })
                                return false;
                            })
                        })
          
</script>


<form class="form-horizontal form-label-left" name="ingresa_estudian" id="ingresa_estudian" method="post">
  <div class="x_content">
<table id="datatable" class="table table-striped table-bordered">
	
<thead>
<tr>
<th>N°</th>
<th>Nombres</th>
<th>Cedula</th>
<th>Programa</th>
<th>Especialidad</th>
<th>Jornada</th>
<th>Semestre</th>
<th>Seleccionar Estudiante
<br/>
<input type="checkbox" name="todos" onchange="cambiaGrupo(this);"/>(Todos)
</th>

</tr>
</thead>

<tbody>
<?php
$i=1;

while ($row= mysql_fetch_array($datos_estudiantes))
    {
   
   $Identificacion= $row['Identificacion'];
   $Id_programa = $row['Id_programa'];
   $Id_especialidad= $row['Id_especialidad'];
   $Id_semestre = $row['Id_semestre'];
   $Id_jornada= $row['Id_jornada'];
   
   
    //Consulta estudiante en grupo
   
   $consulta_gro_estudiante="SELECT * FROM ASIGNAR_GRUPO WHERE Id_estudiante='$Identificacion'";
   $datos_gro_estudiante=mysql_query($consulta_gro_estudiante,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_gro_estudiante=mysql_fetch_assoc($datos_gro_estudiante);
   $id_estudiantes=$resul_gro_estudiante['Id_estudiante'];
   
   
   if($id_estudiantes==''){
	   
   //Consulta nombres de estudiante
   
   $consulta_nom_estudiante="SELECT Nombres,Apellidos FROM USUARIOS WHERE Identificacion='$Identificacion'";
   $datos_nom_estudiante=mysql_query($consulta_nom_estudiante,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_estudiante=mysql_fetch_assoc($datos_nom_estudiante);
   $nom_estudiantes=$resul_nom_estudiante['Nombres'];
   $apell_estudiantes=$resul_nom_estudiante['Apellidos'];
   
    //Consulta nombre programa
   
   $consulta_nom_programa="SELECT Desc_programa FROM PROGRAMA_ACADEMICO WHERE Id_programa='$Id_programa'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Desc_programa'];
   
   //Consulta nombre especialidad
   
   $consulta_nom_especiali="SELECT Desc_especialidad FROM ESPECIALIDAD WHERE Id_especialidad='$Id_especialidad'";
   $datos_nom_especiali=mysql_query($consulta_nom_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_especiali=mysql_fetch_assoc($datos_nom_especiali);
   $nom_especiali=$resul_nom_especiali['Desc_especialidad'];
   
   //Consulta jornada
   
   $consulta_jornada="SELECT Desc_jornada FROM JORNADA WHERE Id_jornada='$Id_jornada'";
   $datos_jornada=mysql_query($consulta_jornada,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_jornada=mysql_fetch_assoc($datos_jornada);
   $nom_jornada=$resul_jornada['Desc_jornada'];
   
   

   
   //Consulta Estado grupo
   
   if ($F_cierre=="0000-00-00"){
   
    $etado_practica="En proceso";

   }else{

    $etado_practica="Cerrado";
   }
?>
                        <tr>
                          <td>
                          <?php echo $i;?>    
                          </td>
                          <td><?php echo $nom_estudiantes.' '.$apell_estudiantes ;?> </td>
                          <td><?php echo $Identificacion;?> </td>
						   <td><?php echo $nom_programa;?> </td>
                          <td><?php echo $nom_especiali;?> </td>
						  <td align="center"><?php echo $nom_jornada;?> </td>
						   <td align="center"><?php echo $Id_semestre;?> </td>
                          <td align="center">
						  <input type="checkbox" name="ids[]"  value="<?php echo $Identificacion; ?>"> 
                          </td>
  
                        </tr>
<?php

 
$i=$i+1;
   }
}//fin de ofertas activas


?>                      
                      </tbody>

</table>

<div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                           <input name="valor" type="hidden" value="insertar_estudiantes"/>
                           <input name="codigo_grupo_estu" type="hidden" value="<? echo $codigo_grupo;?>"/>
                           
                          
                          <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Solicitar</button>
						   <!--<a class="btn btn-primary" href="index" id = "boton_atras" style="color: #fff;">Atras</a>-->
                        </div>
                      </div>
	
</div>
</form>
 <div id="loading_grupo" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
 <div id="response_grupo"></div>

<?php
}else if($_POST['valor'] == "consulta_gr_estudiantes") {
	
$codigo_grupo = $_POST['codigo_grupo'];

//consulta estudiantes de grupo
$cadena2="SELECT * FROM `ASIGNAR_GRUPO` WHERE Codigo_grupo='$codigo_grupo'";
$datos_refe3 = mysql_query($cadena2,$conexion);
?>
<br><br>
<form class="form-horizontal form-label-left" name="ingresa_estudian" id="ingresa_estudian" method="post">
  <div class="x_content">
<table id="datatable" class="table table-striped table-bordered">
	
<thead>
<tr>
<th>N°</th>
<th>Nombres</th>
<th>Cedula</th>
<th>Programa</th>
<th>Especialidad</th>
<th>Jornada</th>
<th>Semestre</th>
<th>Gestionar Estudiante</th>

</tr>
</thead>

<tbody>
<?php
$i=1;

while ($row= mysql_fetch_array($datos_refe3))
    {
   
   $Identificacion= $row['Id_estudiante'];
	   
   //Consulta nombres de estudiante
   
   $consulta_nom_estudiante="SELECT Nombres,Apellidos FROM USUARIOS WHERE Identificacion='$Identificacion'";
   $datos_nom_estudiante=mysql_query($consulta_nom_estudiante,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_estudiante=mysql_fetch_assoc($datos_nom_estudiante);
   $nom_estudiantes=$resul_nom_estudiante['Nombres'];
   $apell_estudiantes=$resul_nom_estudiante['Apellidos'];
   
   //consulta programa y especialidad estudiante
   $consulta_dato_practica="SELECT * FROM ESTUDIANTES WHERE Identificacion='$Identificacion'";
   $datos_dato_practica=mysql_query($consulta_dato_practica,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_dato_practica=mysql_fetch_assoc($datos_dato_practica);
   $Id_programa=$resul_dato_practica['Id_programa'];
   $Id_especialidad=$resul_dato_practica['Id_especialidad'];
   $Id_jornada=$resul_dato_practica['Id_jornada'];
   $Id_semestre=$resul_dato_practica['Id_semestre'];
   
    //Consulta nombre programa
   
   $consulta_nom_programa="SELECT Desc_programa FROM PROGRAMA_ACADEMICO WHERE Id_programa='$Id_programa'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Desc_programa'];
   
   //Consulta nombre especialidad
   
   $consulta_nom_especiali="SELECT Desc_especialidad FROM ESPECIALIDAD WHERE Id_especialidad='$Id_especialidad'";
   $datos_nom_especiali=mysql_query($consulta_nom_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_especiali=mysql_fetch_assoc($datos_nom_especiali);
   $nom_especiali=$resul_nom_especiali['Desc_especialidad'];
   
   //Consulta jornada
   
   $consulta_jornada="SELECT Desc_jornada FROM JORNADA WHERE Id_jornada='$Id_jornada'";
   $datos_jornada=mysql_query($consulta_jornada,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_jornada=mysql_fetch_assoc($datos_jornada);
   $nom_jornada=$resul_jornada['Desc_jornada'];
   
   //Consulta Estado grupo
   
   if ($F_cierre=="0000-00-00"){
   
    $etado_practica="En proceso";

   }else{

    $etado_practica="Cerrado";
   }
?>
                        <tr>
                          <td>
                          <?php echo $i;?>    
                          </td>
                          <td><?php echo $nom_estudiantes.' '.$apell_estudiantes ;?> </td>
                          <td><?php echo $Identificacion;?> </td>
						   <td><?php echo $nom_programa;?> </td>
                          <td><?php echo $nom_especiali;?> </td>
						  <td align="center"><?php echo $nom_jornada;?> </td>
						  <td align="center"><?php echo $Id_semestre;?> </td>
                          <td align="center">
						  
						  <script type="text/javascript">
          
           $(function() {
                            $("#gestionar_estudian_docen<?php echo $i; ?>").submit(function() {  
                                $.ajax({
                                    type: "POST",
                                    url: "procesar/mostrar_grupos.php",
                                    dataType: "html",
                                    data: $(this).serialize(),
                                    beforeSend: function() {
                                        $("#loading_n").show();
                                    },
                                    success: function(response) {
                                        $("#response_n").html(response);
                                        $("#loading_n").hide();
                                    }
                                })
                                return false;
                            })
                        })
          
</script>
						  
						  
                          <form name="gestionar_estudian_docen" id="gestionar_estudian_docen<?php echo $i; ?>" method="POST">
                            <input type="hidden" name="codigo_grupo" value="<?php echo $Codigo_grupo; ?>">
                            <input type="hidden" name="valor" value="consulta_gr_estudiantes">
                            <button type="submit" class="btn btn-primary">Abrir</button>
                          </form>
                          </td>
  
                        </tr>
<?php

 
$i=$i+1;
}//fin de ofertas activas


?>                      
                      </tbody>

</table>
	
</div>
</form>
 <div id="loading_grupo" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
 <div id="response_grupo"></div>

<?php
}
?>