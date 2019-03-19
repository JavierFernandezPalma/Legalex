

<?php 
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$f_solicitud=date("Y-m-d");

$user = $_SESSION['users'];

$consulta_ofertas = "SELECT ESTUDIANTES.Id_especialidad FROM `USUARIOS` LEFT JOIN ESTUDIANTES ON USUARIOS.Identificacion = ESTUDIANTES.Identificacion WHERE USUARIOS.Usuario = '$user'";
$resul_oferta = mysql_query($consulta_ofertas,$conexion);
$resul_programa = mysql_fetch_array($resul_oferta);
$Id_especialidad = $resul_programa['Id_especialidad'];

$consulta_ofertas_empresa = "SELECT * FROM VACANTE WHERE Id_especialidad = '$Id_especialidad' AND F_baja_vacante IS NULL ";
$datos_refe2 = mysql_query($consulta_ofertas_empresa,$conexion); 


?>



<script type="text/javascript">
          
           $(function() {
                            $("#consulta_oferta").submit(function() {  
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
        <li class="active">Busqueda Oferta</li>
      </ol>
              </div>

             
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Reporte Ofertas</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
				  
				  
                  <div class="x_content">
				  
				  <div class="row" id="show">

                  <table id="datatable" class="table table-striped table-bordered">
            
<thead>
                     <tr>
                          <th>N̈́°</th>
                          <th>Empresa</th>
                          <th>Departamento</th>
                          <th>Ciudad</th>
                          <th>Fecha Solicitud</th>
                          <th>Programa</th>
                          <th>Especialidad</th>
                          <th>Detalle oferta</th>   
                     </tr>
                      </thead>

<tbody>

<?php 
$i = 1;

while($row = mysql_fetch_array($datos_refe2)) {

 $Id_oferta_empresa= $row['Id_vacante'];
   $Id_empresa= $row['Id_empresa'];
   $F_solicitud =$row['F_publica'];
   //$Q_solicitud =$row['Q_solicitud'];
   $Cantidad_aprendices =$row['Vacantes'];
   //$Id_departamento = $row['Id_departamento'];
   //$Id_ciudad = $row['Id_ciudad'];
   //$Id_programa = $row['Id_programa'];
   $Id_especialidad = $row['Id_especialidad'];
   $Perfil_aspirante = $row['Desc_vacante'];

 
    //consulta empresas 
   $consulta_nom_empresa="SELECT * FROM EMPRESAS WHERE Id_empresa='$Id_empresa'";
   $datos_nom_empresa=mysql_query($consulta_nom_empresa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_empresa=mysql_fetch_assoc($datos_nom_empresa);
   $nom_empresa=$resul_nom_empresa['Nombre_empresa'];
   $Id_departamento=$resul_nom_empresa['Id_departamento'];
   $Id_ciudad=$resul_nom_empresa['Id_ciudad'];
   
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
   
   
   //Consulta nombre especialidad
   
   $consulta_nom_especiali="SELECT * FROM ESPECIALIDAD WHERE Id_especialidad='$Id_especialidad'";
   $datos_nom_especiali=mysql_query($consulta_nom_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_especiali=mysql_fetch_assoc($datos_nom_especiali);
   $nom_especiali=$resul_nom_especiali['Desc_especialidad'];
   $Id_programa=$resul_nom_especiali['Id_programa'];
   
     //Consulta nombre programa
   
   $consulta_nom_programa="SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$Id_programa'";
   $datos_nom_programa=mysql_query($consulta_nom_programa,$conexion) or die("no se ha podido ejecutar la consulta");
   $resul_nom_programa=mysql_fetch_assoc($datos_nom_programa);
   $nom_programa=$resul_nom_programa['Desc_programa'];
   
   
   
  ?>   

<tr>
  
<td><?php echo $i; ?></td>
<td><?php echo $nom_empresa;?></td>
<td><?php echo $nom_departamento;?></td>
<td><?php echo $nom_ciudad;?></td>
<td><?php echo $F_solicitud;?></td>
<td><?php echo $nom_programa;?></td>
<td><?php echo $nom_especiali;?></td>
<td align="center"><button type="button" class="gestionar_s btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="<?echo $Id_oferta_empresa;?>" id="<?php echo $Id_oferta_empresa; ?>" >Ver</button></td>

</tr>


<?php
$i = $i + 1;
}

?>  




</tbody>
          </table>
               
                  </div>                  
				
                    
                     <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br><br><br><br>
				         </div>
				 
                </div>
              </div>
            </div>
          </div>
        </div>

<div id="dataModal2" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">DETALLE OFERTA</h4>
   </div>
   <div class="modal-body" id="employee_detail2">
    
   </div>
  </div>
 </div>
</div>


<script>  
$(document).ready(function(){

 $(document).on('click', '.gestionar_s', function(){
  //$('#dataModal').modal();
  var empresa = $(this).attr("id");
  $.ajax({
   url:"procesar/gestionar_solicitud.php",
   method:"POST",
   data:{empresa:empresa},
   success:function(data){
    $('#employee_detail2').html(data);
    $('#dataModal2').modal('show');
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
 <!-- <script src="../vendors/validator/validator.js"></script>-->
      <!-- Custom Theme Scripts -->
    <!--<script src="../build/js/custom.min.js"></script>-->