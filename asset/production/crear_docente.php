<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php"); 
$f_solicitud=date("Y-m-d");


//consulta Estado
$consulta_estado="SELECT * FROM ESTADOS WHERE Id_estado<'4' ORDER BY `ESTADOS`.`Desc_estado` ASC";
$datos_estado=mysql_query($consulta_estado,$conexion) or die("no se ha podido ejecutar la consulta");

//consulta programa 
$consulta_programa="SELECT * FROM PROGRAMA_ACADEMICO ORDER BY `PROGRAMA_ACADEMICO`.`Id_facultad` ASC";
$datos_programa=mysql_query($consulta_programa,$conexion) or die("no se ha podido ejecutar la consulta");

//tipo de documento
$consulta_tdocumento="SELECT * FROM TIPO_DOCUMENTOS";
$datos_tdocumento=mysql_query($consulta_tdocumento,$conexion) or die("no se ha podido ejecutar la consulta");


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
        <li class="active">Crear Docente</li>
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

                      <p><code>Los campos con (*) son obligatorios para crear docente</code>
                      </p>
                         
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="f_solicitud">Fecha de Solicitud:<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="f_soli" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<? echo $f_solicitud;?>" name="f_soli"  type="text" disabled>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_docente" >Nombres<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nom_docente" name="nom_docente" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Nombres" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
                        
					 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apell_docente" >Apellidos<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="apell_docente" name="apell_docente" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Apellidos" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
					  

                           <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="especialidad">Tipo Documento<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="t_documen"  id="t_documen" >
                        <?php
                        while ($objeto = mysql_fetch_array($datos_tdocumento)) {
                        echo '<option id="watch-me5" value="' . $objeto['Id_documento'] . '">  ' . $objeto['Desc_documento'] . '</option>';
                        }
                         mysql_free_result($datos_tdocumento); //Libera la memoria del resultado 
                         ?>
                         </select>
                         </div>
                       </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula_docente" >Cedula<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cedula_docente" name="cedula_docente" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" placeholder="Ingrese N De Cedula" autocomplete="off" maxlength="15" >
                        </div>
                      </div>

<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_expe" >Fecha de expedición<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="text" class="form-control has-feedback-left" id="single_cal3" name="fecha_expe" placeholder="Ingres Fecha Expedición" aria-describedby="inputSuccess2Status3">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                               
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_naci" >Fecha Nacimientó<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="text" class="form-control has-feedback-left" id="single_cal4" name="fecha_naci" placeholder="Ingres Fecha Nacimientó" aria-describedby="inputSuccess2Status4">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                               
                        </div>
                      </div>
					  
					 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email" >Email <span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Correo" autocomplete="off" maxlength="50" >
                        </div>
                      </div>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel_docente">Telefono <span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="tel_docente" name="tel_docente" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" maxlength="13" placeholder="Ingrese Telefono Conctacto" autocomplete="off">
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="movil_docente">Movil<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="movil_docente" name="movil_docente" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" maxlength="13" placeholder="Ingrese Celular Conctacto" autocomplete="off">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="docente_clave" >Clave<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="docente_clave" name="docente_clave" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Clave" autocomplete="off" maxlength="40">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa">Estado<span class="required">*:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="estado"  id="estado">
						<?php
						while ($objeto = mysql_fetch_array($datos_estado)) {
						echo '<option value="' . $objeto['Id_estado'] . '">  ' . $objeto['Desc_estado'] . '</option>';
						}
					   mysql_free_result($datos_estado); //Libera la memoria del resultado 
					   ?>
					   </select>
                        </div>
                      </div>
					  
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                           <input name="valor" type="hidden" value="crear_docente"/>
                           <input name="f_soli2" type="hidden" value="<? echo $f_solicitud;?>"/>
                           
                          
                          <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Solicitar</button>
						   <a class="btn btn-primary" href="index" id = "boton_atras" style="color: #fff;">Atras</a> 
                        </div>
                      </div>
                    </form>
                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                   <div id="response_n"></div>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
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
