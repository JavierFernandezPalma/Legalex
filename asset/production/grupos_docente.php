
<?php 
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$users=$_SESSION['users'];
$cedu_docente=$_SESSION['identificacion'];

$cadena1="SELECT * FROM `GRUPO` WHERE Identificacion='$cedu_docente' and F_cierre_grupo='0000-00-00'";
$datos_refe2 = mysql_query($cadena1,$conexion);

?>

<body class="nav-md">
 <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
               <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Busqueda Grupos</li>
      </ol>
              </div>

             
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Reporte Grupos</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
				  
				  
                  <div class="x_content">
				  
				  <div class="row" id="show">

<table id="datatable" class="table table-striped table-bordered">
  
                      <thead>
                        <tr>
                          <th>N°</th>
                          <th>Grupo</th>
						  <th>Programa</th>
                          <th>Total Estudiantes</th>
						  <th>Fecha Creaciòn</th>
						  <th>Gestionar Grupo</th>
                        </tr>
                      </thead>

                      <tbody>
     <?php

$i=1;

while ($row= mysql_fetch_array($datos_refe2)) {

   $Codigo_grupo= $row['Codigo_grupo'];
   $Identificacion= $row['Identificacion'];
   $F_creacion_grupo = $row['F_creacion_grupo'];
   
   //Consulta Nombre Docente
   
   $consulta_gr_estudian="SELECT * FROM ASIGNAR_GRUPO WHERE Codigo_grupo='$Codigo_grupo'";
   $datos_gr_estudian=mysql_query($consulta_gr_estudian,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_gr_estudian=mysql_fetch_assoc($datos_gr_estudian);
   $cantidad_estudian = mysql_num_rows($datos_gr_estudian);
   $cedula_estudian=$resul_gr_estudian['Id_estudiante'];
   
    //Consulta programa Docente
   
   $consulta_pro_docente="SELECT Id_programa FROM DOCENTES WHERE Id_docente='$Identificacion'";
   $datos_pro_docente=mysql_query($consulta_pro_docente,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_pro_docente=mysql_fetch_assoc($datos_pro_docente);
   $nom_docente_pro=$resul_pro_docente['Id_programa'];
   
   //Consulta programa Nombre
   
   $consulta_nom_programa="SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$nom_docente_pro'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Desc_programa'];
   
   

?>

<tr>
  
  <td align="center"><?php echo $i;?> </td>
   <td align="center"><?php echo $Codigo_grupo;?> </td>
   <td align="center"><?php echo $nom_programa;?> </td>
   <td align="center"><?php echo $cantidad_estudian;?> </td>
   <td align="center"><?php echo $F_creacion_grupo;?> </td>
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
} // finaliza el while

      ?>                   

                      </tbody>

</table>
 <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                   <div id="response_n"></div>
                   
                  </div>                  
				 
          <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br>
				        </div>
				 
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php 
    include("footer.php");
    ?>
</div>
	</div>
	</body>
	
	 <!-- validator -->
 <!-- <script src="../vendors/validator/validator.js"></script>-->
      <!-- Custom Theme Scripts -->
    <!--<script src="../build/js/custom.min.js"></script>-->