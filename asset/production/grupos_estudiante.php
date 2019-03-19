
<?php 
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$f_solicitud=date("Y-m-d");
$users=$_SESSION['users'];

$cadena1="SELECT * FROM `Usuarios` Left JOIN Grupo_docente ON Usuarios.Id_usuario=Grupo_docente.Id_docente WHERE Usuarios.Id_perfil='3' and Usuarios.Id_estado='2' and Codigo_grupo<>'' AND Usuarios.Usuario = '$users'";
$datos_refe2 = mysql_query($cadena1,$conexion);

?>

<!--<script type="text/javascript">
          
           $(function() {
                            $("#consulta_docente").submit(function() {  
                                $.ajax({
                                    type: "POST",
                                    url: "procesar/consulta_filtros.php",
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
          
</script>-->



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
                          <th>N̈́°</th>
                          <th>Grupo</th>
                          <th>Total Estudiantes</th>
                          <th>Estado</th>
                           <th>Gestionar</th>
                        </tr>
                      </thead>

                      <tbody>
     <?php

$i=1;

while ($row= mysql_fetch_array($datos_refe2)) {

   $Codigo_grupo= $row['Codigo_grupo'];
   $nom_docente= $row['Nombres'];
   $F_cierre = $row['F_cierre'];
   $Id_grupo_docente = $row['Id_grupo_docente'];

      //Consulta programa Nombre
   
   $consulta_nom_programa="SELECT * FROM Programas WHERE Id_programa='$Id_programa_docen'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Nom_programa'];
   
   //Consulta nombre Estado
   
   $consulta_nom_estado="SELECT * FROM Estados WHERE Id_estado='$Id_estado'";
   $datos_nom_estado=mysql_query($consulta_nom_estado,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_estado=mysql_fetch_assoc($datos_nom_estado);
   $nom_estado=$resul_nom_estado['Nom_estado'];

if ($F_cierre=="0000-00-00"){
   
    $etado_practica="En proceso";

   }else{

    $etado_practica="Terminado";
   }

?>

<tr>
  
  <td><?php echo $i;?> </td>
   <td><?php echo $Codigo_grupo;?> </td>
   <td><?php echo "0";?> </td>
   <td><?php echo $etado_practica;?> </td>
            <td align="center">
          <script type="text/javascript">
          
           $(function() {
                            $("#edit_group<?php echo $i; ?>").submit(function() {  
                                $.ajax({
                                    type: "POST",
                                    url: "procesar/mostrar_grupos.php",
                                    dataType: "html",
                                    data: $(this).serialize(),
                                    beforeSend: function() {
                                        $("#loading_group").show();
                                    },
                                    success: function(response) {
                                        $("#response_alum").html(response);
                                        $("#loading_group").hide();
                                    }
                                })
                                return false;
                            })
                        })
          </script>

                          <form id='edit_group<?php echo $i; ?>' method="POST" name="edit_group">
                            <input type="hidden" name="codigo_grupo" value="<?php echo $Codigo_grupo; ?>">
                            <input type="hidden" name="nom_docente" value="<?php echo $nom_docente; ?>">
                            <input type="hidden" name="estado_practica" value="<?php echo $estado_practica; ?>">
                            <input type="hidden" name="programa" value="<?php echo $programa; ?>">
                            <input type="hidden" name="grupo_docente" value="<?php echo $Id_grupo_docente; ?>">
                            <input type="hidden" name="valor" value="consulta_disponibles">
                            <button type="submit" class="btn btn-primary">Editar</button>
                          </form>
                          </td>

</tr>


<?php
$i=$i+1;
} // finaliza el while

      ?>                   

                      </tbody>

</table>

                   
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