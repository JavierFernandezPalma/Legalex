<?php 
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


//consulta ofertas activas
$consulta_ofertas="SELECT * FROM `Ofertas_empresa` WHERE `F_cierre`='00000-00-00'";
$datos_ofertas=mysql_query($consulta_ofertas,$conexion) or die("no se ha podido ejecutar la consulta");
$conteo_ofertas=mysql_num_rows($datos_ofertas);

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
        <li class="active">Ver Ofertas</li>
      </ol>
              </div>

             
            </div>
            <div class="clearfix"></div>

            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registro de ofertas</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>N̈́°</th>
                          <th>Empresa</th>
                          <th>Departamento</th>
                          <th>Ciudad</th>
                          <th>Fecha Solicitud</th>
                          <th>Cantidad Aprendices</th>
                          <th>Especialidad</th>
                          <th>Perfil Aspirante</th>
                           <th>Gestionar</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
$i=1;

while ($row= mysql_fetch_array($datos_ofertas))
    {

   $Id_oferta_empresa= $row['Id_oferta_empresa'];
   $Id_empresa= $row['Id_empresa'];
   $F_solicitud =$row['F_solicitud'];
   $Q_solicitud =$row['Q_solicitud'];
   $Cantidad_aprendices =$row['Cantidad_aprendices'];
   $Id_departamento = $row['Id_departamento'];
   $Id_ciudad = $row['Id_ciudad'];
   $Id_especialidad = $row['Id_especialidad'];
   $Perfil_aspirante = $row['Perfil_aspirante'];

?>
                        <tr>
                          <td>
                          <?php echo $i;?>    
                          </td>
                          <td><?php echo $i;?> </td>
                          <td><?php echo $Id_empresa;?> </td>
                          <td><?php echo $Id_departamento;?> </td>
                          <td><?php echo $Id_ciudad;?> </td>
                          <td><?php echo $F_solicitud;?> </td>
                          <td><?php echo $Cantidad_aprendices;?> </td>
                          <td><?php echo $Id_especialidad;?> </td>
                          <td><?php echo $Perfil_aspirante;?> </td>
  
                        </tr>
<?php
$i=$i+1;
}//fin de ofertas activas
?>                       
                      </tbody>
                    </table>
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