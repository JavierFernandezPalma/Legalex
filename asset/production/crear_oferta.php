<?php 
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 


$f_solicitud=date("Y-m-d");

//consulta empresas 
$consulta_empresa="SELECT * FROM EMPRESAS left JOIN USUARIOS ON EMPRESAS.Identificacion=USUARIOS.Identificacion WHERE USUARIOS.Id_estado='2'";
$datos_empresa=mysql_query($consulta_empresa,$conexion) or die("no se ha podido ejecutar la consulta");
//departamento
$consulta_departamento="SELECT * FROM DEPARTAMENTO";
$datos_departamento=mysql_query($consulta_departamento,$conexion) or die("no se ha podido ejecutar la consulta");

//consulta programa 
$consulta_programa="SELECT * FROM PROGRAMA_ACADEMICO ORDER BY `PROGRAMA_ACADEMICO`.`Desc_programa` ASC";
$datos_programa=mysql_query($consulta_programa,$conexion) or die("no se ha podido ejecutar la consulta");


//consulta modalidad
$consulta_modalidad="SELECT * FROM MODALIDAD_ESTUDIO";
$datos_modalidad=mysql_query($consulta_modalidad,$conexion) or die("no se ha podido ejecutar la consulta");

//consulta especialidad
//$consulta_especialidad="SELECT * FROM Especialidades ORDER BY `Especialidades`.`Id_programa` ASC";
//$datos_especialidad=mysql_query($consulta_especialidad,$conexion) or die("no se ha podido ejecutar la consulta");
?>
 <!-- activa cambio de ciudad segun dpto-->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#departamento").change(function(event) {
                                var id = $("#departamento").find(':selected').val();
                                $("#ciudad").load('seguridad/generar_select.php?id=' + id);
                            });
                        });
                    </script>

 <!-- activa cambio de especialidad segun el programa-->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#programa").change(function(event) {
                                var id = $("#programa").find(':selected').val();
                                $("#especialidad").load('seguridad/generar_select_programa.php?id=' + id);
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
        <li class="active">Crear Oferta</li>
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

                    <form class="form-horizontal form-label-left" novalidate  name="solicitar_oferta" id="solicitar_oferta" method="post">

                      <p><code>Los campos con (*) son obligatorios para crear la oferta</code>
                      </p>
                         
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="f_solicitud">Fecha de Solicitud:<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="f_soli" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<? echo $f_solicitud;?>" name="f_soli"  type="text" disabled>
                        </div>
                      </div>
					  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa">Empresa<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="empresa"  id="empresa">
                            <option value="">Seleccione</option>
						<?php
						while ($objeto = mysql_fetch_array($datos_empresa)) {
						echo '<option value="' . $objeto['Id_empresa'] . '">  ' . $objeto['Nombre_empresa'] . '</option>';
						}
					   mysql_free_result($datos_empresa); //Libera la memoria del resultado 
					   ?>
					   </select>
                        </div>
                      </div>
							   
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="r_vacante">Remuneración vacante<span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="r_vacante" name="r_vacante"  class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" maxlength="8" placeholder="Ingrese Remuneración" autocomplete="off">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="can_aprendices">Cantidad Aprendices*</label><span class="required">*:</span>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="can_aprendices" name="can_aprendices" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" maxlength="2" placeholder="Ingrese Cantidad de Aprendices Requeridos" autocomplete="off" required="required">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="especialidad">Especialidad<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="especialidad"  id="especialidad" required >
                        <option value="">Seleccione</option>
                        <?php
                        if($id_programa!=""){
                        $consulta_especiali="SELECT * FROM ESPECIALIDAD WHERE Id_programa=".$id_programa;
                        $datos_especiali=mysql_query($consulta_especiali,$conexion) or die("no se ha podido ejecutar la consulta");
                        while($row =mysql_fetch_array($datos_especiali)) {
                        if($row['Id_especialidad']==$id_especialidad){echo '<option value="' . $row['Id_especialidad'] . '" selected >  ' .$row['Titulo']. ' '.$row['Nom_especialidad'].'</option>'; }else{
                        echo '<option value="' . $row['Id_especialidad'] . '" >  '.$row['Desc_especialidad'].'</option>';
                              }
                              }
                              }
                        mysql_free_result($datos_r2); //Libera la memoria del resultado
                        ?>
                         </select>
                         </div>
                         </div>

                             <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="especialidad">Modalidad<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="modalidad"  id="modalidad" >
                        <?php
                        while ($objeto = mysql_fetch_array($datos_modalidad)) {
                        echo '<option id="watch-me5" value="' . $objeto['Id_modalidad'] . '">  ' . $objeto['Desc_modalidad'] . '</option>';
                        }
                         mysql_free_result($datos_modalidad); //Libera la memoria del resultado 
                         ?>
                         </select>
                         </div>
             </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="perfil_aspirante" >Perfil Aspirante<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea type="text" id="perfil_aspirante" name="perfil_aspirante" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Descripción de Aspirante" autocomplete="off" maxlength="1000"></textarea>
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="observaciones_aspirante" >Observaciones<span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea type="text" id="observaciones_aspirante" name="observaciones_aspirante" class="form-control col-md-7 col-xs-12" autocomplete="off" maxlength="1000"></textarea>
                        </div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                           <input name="valor" type="hidden" value="oferta_interna"/>
                           <input name="f_soli2" type="hidden" value="<? echo $f_solicitud;?>"/>
                           
                          
                          <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Solicitar</button>
                          <a class="btn btn-primary" href="index.php" id = "boton_atras" style="color: #fff;">Atras</a> 
                        </div>
                      </div>
                    </form>
                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                   <div id="response_n"></div>
				   <br><br><br><br><br><br><br><br><br><br><br>
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
    
