<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 
$f_solicitud=date("Y-m-d");



//consulta programa 
$consulta_grupo="SELECT * FROM `GRUPO` WHERE F_cierre_grupo='0000-00-00'";
$datos_grupo=mysql_query($consulta_grupo,$conexion) or die("no se ha podido ejecutar la consulta");

//consulta Docentes
//$consulta_docentes="SELECT * FROM `Usuarios` WHERE Id_perfil='3' and Id_estado='3' ";
//$datos_docente=mysql_query($consulta_docentes,$conexion) or die("no se ha podido ejecutar la consulta");





?>

<!--Validar solo numeros -->
<script type="text/javascript">
// Solo permite ingresar numeros.
function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return (key >= 48 && key <= 57)
}
</script>





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
        <li class="active">Gestionar Grupo</li>
      </ol>
              </div>

             
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registrar Estudiantes</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>N°</th>
                          <th>Grupo</th>
                          <th>Docente</th>
						  <th>Programa</th>
                          <th>Total Estudiantes</th>
						  <th>Fecha Creaciòn</th>
                          <th>Agregar Estudiantes</th>
						  <th>Editar Estudiantes</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
$i=1;

while ($row= mysql_fetch_array($datos_grupo))
    {
   
   $Codigo_grupo= $row['Codigo_grupo'];
   $Identificacion= $row['Identificacion'];
   $F_creacion_grupo = $row['F_creacion_grupo'];
   
   //Consulta Nombre Docente
   
   $consulta_nom_docente="SELECT Nombres,Apellidos FROM USUARIOS WHERE Identificacion='$Identificacion'";
   $datos_nom_docente=mysql_query($consulta_nom_docente,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_docente=mysql_fetch_assoc($datos_nom_docente);
   $nom_docente=$resul_nom_docente['Nombres'];
   $apell_docente=$resul_nom_docente['Apellidos'];
   
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
  
   
   //Consulta estudiantes de grupo
   
   $consulta_gr_estudian="SELECT * FROM ASIGNAR_GRUPO WHERE Codigo_grupo='$Codigo_grupo'";
   $datos_gr_estado=mysql_query($consulta_gr_estudian,$conexion) or die("no se ha podido ejecutar la consulta");
   $registro_gr_estudian = mysql_num_rows($datos_gr_estado);

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
                          <td><?php echo $Codigo_grupo;?> </td>
                          <td><?php echo $nom_docente.' '.$apell_docente;?> </td>
						   <td><?php echo $nom_programa;?> </td>
                          <td><?php echo $registro_gr_estudian;?> </td>
						  <td><?php echo $F_creacion_grupo;?> </td>
                          <td align="center">
						  
						  <script type="text/javascript">
          
           $(function() {
                            $("#gestionar_estudian<?php echo $i; ?>").submit(function() {  
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
						  
						  
                          <form name="gestionar_estudian" id="gestionar_estudian<?php echo $i; ?>" method="POST">
                            <input type="hidden" name="codigo_grupo" value="<?php echo $Codigo_grupo; ?>">
							<input type="hidden" name="programa_grupo" value="<?php echo $nom_docente_pro; ?>">
                            <input type="hidden" name="valor" value="consulta_disponibles">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                          </form>
                          </td>
						  
						  <td align="center"><button type="button" class="gestionar_group btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="<?echo $Codigo_grupo;?>" id="<?php echo $Codigo_grupo; ?>" >Editar</button></td>
  
                        </tr>
<?php
$i=$i+1;
}//fin de ofertas activas
?>                      
                      </tbody>
                    </table> 
					
					
                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                   <div id="response_n"></div>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		
<div id="dataModal_gr" class="modal fade bd-example-modal-lg" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">GESTIONAR GRUPO</h4>
   </div>
   <div class="modal-body" id="employee_detail_gr">
    
   </div>
  </div>
 </div>
</div>


<script>  
$(document).ready(function(){

 $(document).on('click', '.gestionar_group', function(){
  //$('#dataModal').modal();
  var grup = $(this).attr("id");
  $.ajax({
   url:"procesar/gestionar_grupo.php",
   method:"POST",
   data:{grup:grup},
   success:function(data){
    $('#employee_detail_gr').html(data);
    $('#dataModal_gr').modal('show');
   }
  });
 });
});  
 </script>

        <!-- /page content -->
<?php 
    include("footer.php");
    ?>
</div>
	</div>
	</body>
	
	 <!-- validator -->
  <script src="../vendors/validator/validator.js"></script>
