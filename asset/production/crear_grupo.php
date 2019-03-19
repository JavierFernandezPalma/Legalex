<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 
$f_solicitud=date("Y-m-d");



//consulta programa 
$consulta_programa="SELECT * FROM PROGRAMA_ACADEMICO ORDER BY `PROGRAMA_ACADEMICO`.`Id_facultad` ASC";
$datos_programa=mysql_query($consulta_programa,$conexion) or die("no se ha podido ejecutar la consulta");

//consulta Docentes
//$consulta_docentes="SELECT * FROM `Usuarios` WHERE Id_perfil='3' and Id_estado='3' ";
//$datos_docente=mysql_query($consulta_docentes,$conexion) or die("no se ha podido ejecutar la consulta");





?>
 <!-- activa cambio de ciudad segun dpto-->
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
                            $("#solicitar_oferta").submit(function() {  
                                $.ajax({
                                    type: "POST",
                                    url: "procesar/solicitud_oferta.php",
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
        <li class="active">Crear Grupo</li>
      </ol>
              </div>

             
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Formulario De Registro</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate name="solicitar_oferta" id="solicitar_oferta" method="post">

                      <p><code>Los campos con (*) son obligatorios para crear grupo</code>
                      </p>
                         
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="f_solicitud">Fecha de Creación:<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="f_soli" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<? echo $f_solicitud;?>" name="f_soli"  type="text" disabled>
                        </div>
                      </div>
                 

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="especialidad">Programa<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="programa"  id="programa" required>
                        <option value="">Seleccione</option>
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
                        <option value="">Seleccione</option>
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
					  
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                           <input name="valor" type="hidden" value="crear_grupo"/>
                           <input name="f_soli2" type="hidden" value="<? echo $f_solicitud;?>"/>
                           
                          
                          <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Solicitar</button>
						   <a class="btn btn-primary" href="index" id = "boton_atras" style="color: #fff;">Atras</a> 
                        </div>
                      </div>
                    </form>
                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                   <div id="response_n"></div>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
  <script src="../vendors/validator/validator.js"></script>
