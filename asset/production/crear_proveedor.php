<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php");

global $conexion;

$f_solicitud = date("Y-m-d");

//consulta empresas
$consulta_empresa = "SELECT * FROM t_empresas ORDER BY Id_empresa ASC;";
$datos_empresa = mysqli_query($conexion, $consulta_empresa ) or die("no se ha podido ejecutar la consulta");

//consulta programa 
$consulta_programa = "SELECT * FROM PROGRAMA_ACADEMICO ORDER BY `PROGRAMA_ACADEMICO`.`Id_facultad` ASC";
$datos_programa = mysqli_query($conexion, $consulta_programa) or die("no se ha podido ejecutar la consulta");

//consulta Estado
$consulta_estado = "SELECT * FROM ESTADOS WHERE Id_estado<'4' ORDER BY `ESTADOS`.`Desc_estado` ASC";
$datos_estado = mysqli_query($conexion, $consulta_estado) or die("no se ha podido ejecutar la consulta");


//consulta Jornada
$consulta_jornada = "SELECT * FROM JORNADA";
$datos_jornada = mysqli_query($conexion, $consulta_jornada) or die("no se ha podido ejecutar la consulta");

//consulta modalidad
$consulta_modalidad = "SELECT * FROM MODALIDAD_ESTUDIO";
$datos_modalidad = mysqli_query($conexion, $consulta_modalidad) or die("no se ha podido ejecutar la consulta");

//tipo de documento
$consulta_tdocumento = "SELECT * FROM TIPO_DOCUMENTOS";
$datos_tdocumento = mysqli_query($conexion, $consulta_tdocumento) or die("no se ha podido ejecutar la consulta");


//jornada
$consulta_semestre = "SELECT * FROM SEMESTRE";
$datos_semestre = mysqli_query($conexion, $consulta_semestre) or die("no se ha podido ejecutar la consulta");
?>
<!-- activa cambio de ciudad segun dpto-->
<script type="text/javascript">
    $(document).ready(function () {
        $("#departamento").change(function (event) {
            var id = $("#departamento").find(':selected').val();
            $("#ciudad").load('seguridad/generar_select.php?id=' + id);
        });
    });
</script>


<!-- activa cambio de especialidad segun el programa-->
<script type="text/javascript">
    $(document).ready(function () {
        $("#programa").change(function (event) {
            var id = $("#programa").find(':selected').val();
            $("#especialidad").load('seguridad/generar_select_programa.php?id=' + id);
        });
    });
</script>
<!-- si la modalidad es presencial-->					
<script>
    $(function () {
        $("[name=modalidad]").click(function () {

            if ($(this).val() == "6")
            {
                $("#show-me5").slideDown('slow');

            } else
            {
                $("#show-me5").slideUp('slow');
            }
        });
    });
</script> 

<!--Validar solo numeros -->
<script type="text/javascript">
// Solo permite ingresar numeros.
    function soloNumeros(e) {
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57)
    }
</script>


<script type="text/javascript">

    $(function () {
        $("#solicitar_proveedor").submit(function () {
            $.ajax({
                type: "POST",
                url: "procesar/solicitud_oferta.php",
                dataType: "html",
                data: $(this).serialize(),
                beforeSend: function () {
                    $("#loading_n").show();
                },
                success: function (response) {
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
                                <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                                <li class="active">Crear Proveedor</li>
                            </ol>
                        </div>


                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><small>Formulario De Registro</small></h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" novalidate name="solicitar_proveedor" id="solicitar_proveedor" method="post">

                                        <p><code>Los campos con (*) son obligatorios para crear un Proveedor</code>
                                        </p>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="f_solicitud">Fecha de Solicitud:<span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="f_soli" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<?php echo $f_solicitud; ?>" name="f_soli"  type="text" disabled>
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa">Empresa<span class="required">*:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="empresa"  id="empresa">
                                                    <option value="0">Seleccione una empresa</option>
                                                    <?php

                                                    while ($objeto = mysqli_fetch_array($datos_empresa)) {
                                                        
                                                        echo '<option value="' . $objeto['Id_empresa'] . '">  ' . $objeto['Nombre_empresa'] . '</option>';
                                                    }
                                                    mysqli_free_result($datos_empresa); //Libera la memoria del resultado 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo_documento">Tipo Documento<span class="required">*:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="t_documen"  id="t_documen" >
                                                    <?php
                                                    echo '<option value=0>Seleccione un tipo de documento</option>';
                                                    while ($objeto = mysqli_fetch_array($datos_tdocumento)) {
                                                        
                                                        echo '<option id="watch-me5" value="' . $objeto['Id_documento'] . '">  ' . $objeto['Desc_documento'] . '</option>';
                                                    }
                                                    mysqli_free_result($datos_tdocumento); //Libera la memoria del resultado 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="documento" >Documento<span class="required">*:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="documento" name="documento" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese documento de Proveedor" autocomplete="off" maxlength="50" >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_proveedor" >Nombres<span class="required">*:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="nom_proveedor" name="nom_proveedor" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese nombres de Proveedor" autocomplete="off" maxlength="50" >
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellidos_proveedor" >Apellidos<span class="required">*:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="apellidos_proveedor" name="apellidos_proveedor" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese apellidos de Proveedor" autocomplete="off" maxlength="50" >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_proveedor" >Telefono<span class="required">*:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                            
                                                <input type="text" id="telefono_proveedor" name="telefono_proveedor" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese teléfono de Proveedor" autocomplete="off" maxlength="50" >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="movil_proveedor">Movil<span class="required">*:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="movil_proveedor" name="movil_proveedor" required="required" class="form-control col-md-7 col-xs-12" onKeyPress="return soloNumeros(event)" maxlength="13" placeholder="Ingrese Celular Conctacto" autocomplete="off">
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado<span class="required">*:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="estado"  id="estado">
                                                    <?php
                                                    echo '<option value=0>Seleccione un estado</option>';
                                                    while ($objeto = mysqli_fetch_array($datos_estado)) {
                                                        
                                                        echo '<option value="' . $objeto['Id_estado'] . '">  ' . $objeto['Desc_estado'] . '</option>';
                                                    }
                                                    mysqli_free_result($datos_estado); //Libera la memoria del resultado 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-5">
                                                <input name="valor" type="hidden" value="crear_proveedor"/>
                                                <input name="f_soli2" type="hidden" value="<? echo $f_solicitud; ?>"/>
                                                <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Crear</button>
                                                <a class="btn btn-primary" href="index.php" id = "boton_atras" style="color: #fff;">Atras</a> 
                                            </div>
                                        </div>
                                        <br><br><br><br>
                                    </form>
                                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                                    <div id="response_n"></div>
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
