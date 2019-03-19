
<?php 
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$f_solicitud=date("Y-m-d");

//consulta programa 
$consulta_programa="SELECT * FROM PROGRAMA_ACADEMICO ORDER BY `PROGRAMA_ACADEMICO`.`Id_facultad` ASC";
$datos_programa=mysql_query($consulta_programa,$conexion) or die("no se ha podido ejecutar la consulta");

//consulta estado grupo
$consulta_estado_grupo="SELECT * FROM ESTADOS WHERE Id_estado>'4' and Id_estado<'7' ORDER BY `ESTADOS`.`Desc_estado` DESC";
$datos_estado_grupo=mysql_query($consulta_estado_grupo,$conexion) or die("no se ha podido ejecutar la consulta");

?>
 <!-- activa cambio de docente-->
                   <script type="text/javascript">
                        $(document).ready(function() {
                            $("#programa").change(function(event) {
                                var id = $("#programa").find(':selected').val();
                                $("#id_docente").load('seguridad/generar_select_docente.php?id=' + id);
                            });
                        });
                    </script>


<!--Validar solo numeros -->
<script type="text/javascript">
// Solo permite ingresar numeros.
function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return (key >= 48 && key <= 57)
}
</script>


<script type="text/javascript">
          
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

                    <form class="form-horizontal form-label-left" novalidate  name="consulta_docente" id="consulta_docente" method="post">
                         
                     
                      
                      
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="especialidad">Programa<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="programa"  id="programa" required>
                        <option value="">Todos</option>
                        <?php
                        while ($objeto = mysql_fetch_array($datos_programa)) {
                        if ($objeto['Id_programa'] == $id_programa) {
                       echo '<option value="' . $objeto['Id_programa'] . '" selected >  ' . $objeto['Desc_programa'] . '</option>';
                        } else {
                        echo '<option value="' . $objeto['Id_programa'] . '" >  ' . $objeto['Desc_programa'] . '</option>';
                        }
                        }
                        mysql_free_result($datos_programa); //Libera la memoria del resultado
                        ?> 
                         </select>
                         </div>
                         </div>


                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_docente">Docente<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="id_docente"  id="id_docente" required >
                        <option value="">Todos</option>
                        <?php
                        if($id_programa!=""){
                        $consulta_docente="SELECT * FROM Usuarios WHERE Id_programa_docen=".$id_programa;
                        $datos_docente=mysql_query($consulta_docente,$conexion) or die("no se ha podido ejecutar la consulta");
                        while($row =mysql_fetch_array($datos_docente)) {
                        if($row['Id_usuario']==$id_docente){echo '<option value="' . $row['Id_usuario'] . '" selected >  ' .$row['Nombres'].'</option>'; }else{
                        echo '<option value="' . $row['Id_usuario'] . '" >  ' .$row['Nombres'].'</option>';
                              }
                              }
                              }
                        mysql_free_result($datos_docente); //Libera la memoria del resultado
                        ?>
                         </select>
                         </div>
                         </div>


                        
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa">Estado<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <select class="form-control" name="id_estado"  id="id_estado" required > 
                         <?php
						while ($objeto = mysql_fetch_array($datos_estado_grupo)) {
						echo '<option value="' . $objeto['Id_estado'] . '">  ' . $objeto['Desc_estado'] . '</option>';
						}
					   mysql_free_result($datos_estado_grupo); //Libera la memoria del resultado 
					   ?>
                        </select>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                           <input name="valor" type="hidden" value="consulta_grupos"/>  
                          <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Buscar</button>
                          <a class="btn btn-primary" href="index.php" id = "boton_atras" style="color: #fff;">Atras</a> 
                        </div>
                      </div>
                      <br><br><br><br>
                    </form>
                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                  </div>                  
				  <div id="response_n"></div>
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