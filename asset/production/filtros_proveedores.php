<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php");

global $conexion;

$f_solicitud = date("Y-m-d");


//consulta programa 
$consulta_programa = "SELECT * FROM PROGRAMA_ACADEMICO ORDER BY `PROGRAMA_ACADEMICO`.`Id_facultad` ASC";
$datos_programa = mysqli_query($conexion, $consulta_programa) or die("no se ha podido ejecutar la consulta");

//departamento
$consulta_departamento = "SELECT * FROM DEPARTAMENTO";
$datos_departamento = mysqli_query($conexion, $consulta_departamento) or die("no se ha podido ejecutar la consulta");

//consulta estado oferta
$consulta_estado_oferta = "SELECT * FROM ESTADOS WHERE Id_estado <'4' ORDER BY `ESTADOS`.`Desc_estado` ASC";
$datos_estado_oferta = mysqli_query($conexion, $consulta_estado_oferta) or die("no se ha podido ejecutar la consulta");

//consulta estado practica
$consulta_estado_practica = "SELECT * FROM ESTADOS WHERE Id_estado > '3' and Id_estado<'6' ";
$datos_estado_practica = mysqli_query($conexion, $consulta_estado_practica) or die("no se ha podido ejecutar la consulta");

//consulta estado practica
$consulta_acuerdo = "SELECT * FROM sistemas_sispraemu.t_acuerdo ORDER BY Desc_Acuerdo ASC;";
$datos_cuerdo = mysqli_query($conexion, $consulta_acuerdo) or die("no se ha podido ejecutar la consulta");

//consulta empresas
$consulta_empresa = "SELECT * FROM t_empresas ORDER BY Id_empresa ASC;";
$datos_empresa = mysqli_query($conexion, $consulta_empresa) or die("no se ha podido ejecutar la consulta");

//consulta estados
$consulta_estados = "SELECT * FROM sistemas_sispraemu.t_estados ORDER BY Desc_Estado ASC;";
$datos_estados = mysqli_query($conexion, $consulta_estados) or die("no se ha podido ejecutar la consulta");
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
        $("#filtro_proveedores").submit(function () {
            $.ajax({
                type: "POST",
                url: "procesar/consulta_filtros.php",
                dataType: "html",
                data: $(this).serialize(),
                beforeSend: function () {
                    $("#loading_n").show();
                },
                success: function (response) {
                    $("#response_proveedores").html(response);
                    $("#loading_n").hide();
                    $("#filtro_proveedores").hide();
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
                                <li class="active">Busqueda Proveedores</li>
                            </ol>
                        </div>


                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><small>Reporte Proveedores</small></h2>

                                    <div class="clearfix"></div>
                                </div>


                                <div class="x_content">

                                    <div class="row" id="show">

                                        <form class="form-horizontal form-label-left" novalidate  name="filtro_proveedores" id="filtro_proveedores" method="post">

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="acuerdo">Acuerdo<span class="required">*:</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control" name="acuerdo"  id="acuerdo">
                                                        <option value="0">Todos</option>
                                                        <?php
                                                        while ($objeto = mysqli_fetch_array($datos_cuerdo)) {
                                                            echo '<option value="' . $objeto['Id_Acuerdo'] . '">  ' . $objeto['Desc_Acuerdo'] . '</option>';
                                                        }
                                                        mysqli_free_result($datos_cuerdo); //Libera la memoria del resultado 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empresa">Empresa<span class="required">*:</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control" name="empresa"  id="empresa" required >
                                                        <option value="0">Todos</option>
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
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado<span class="required">*:</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control" name="estado"  id="estado">
                                                        <option value="0">Todos</option>
                                                        <?php
                                                        while ($objeto = mysqli_fetch_array($datos_estados)) {
                                                            echo '<option value="' . $objeto['Id_Estado'] . '">  ' . $objeto['Desc_Estado'] . '</option>';
                                                        }
                                                        mysqli_free_result($datos_estados); //Libera la memoria del resultado 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-5">
                                                    <input name="valor" type="hidden" value="consulta_proveedores"/>  
                                                    <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Buscar</button>
                                                    <a class="btn btn-primary" href="index.php" id = "boton_atras" style="color: #fff;">Atras</a> 
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                        </form>
                                        <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                                    </div>                  
                                    <div id="response_proveedores"></div>
                                    <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br><br><br><br><br>
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
    <!-- validator -->
 <script src="../vendors/validator/validator.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>

