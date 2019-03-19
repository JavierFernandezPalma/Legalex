<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php");

global $conexion;

$f_solicitud = date("Y-m-d");

//consulta especialidad
$consulta_especialidad = "SELECT * FROM ESPECIALIDAD ORDER BY `ESPECIALIDAD`.`Id_programa` ASC";
$datos_especialidad = mysqli_query($conexion, $consulta_especialidad) or die("no se ha podido ejecutar la consulta");

//consulta especialidad
$consulta_estado = "SELECT * FROM ESTADOS WHERE Id_estado<>'3' ";
$datos_estado = mysqli_query($conexion, $consulta_estado) or die("no se ha podido ejecutar la consulta");
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
        $("#solicitar_oferta").submit(function () {
            var f = $(this);
            var formData = new FormData(document.getElementById("solicitar_oferta"));
            formData.append("dato", "valor");
            $.ajax({
                type: "POST",
                url: "procesar/solicitud_oferta.php",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#loading_n").show();
                },
                success: function (response) {
                    $("#response_masivo").html(response);
                    $("#solicitar_oferta").hide();
                    $("#loading_n").hide();
                }
            })
            return false;
        })
    })

</script>


<script type="text/javascript">
    //<![CDATA[
    function fileValidation() {
        var fileInput = document.getElementById('archivo');
        var filePath = fileInput.value;
        var allowedExtensions = /(.xlsx)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Solo se permiten archivos Excel');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').innerHTML = '<img src="' + e.target.result + '"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
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
                                <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                                <li class="active">Crear masivo Proveedores</li>
                            </ol>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><small>Subida masiva Proveedores</small></h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" novalidate name="solicitar_oferta" id="solicitar_oferta" method="post" enctype="multipart/form-data">


                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estudiante_clave" >Subir archivo Excel<span class="required">:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" id="archivo" name="archivo" required="required" class="form-control col-md-7 col-xs-12" placeholder="Seleccione archivo" onchange="return fileValidation()">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <a href="plantillas/masivo proveedores.xlsx"><b>->Descargar plantilla para solicitudes</b></a>
                                            </div>
                                        </div>


                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-5">
                                                <input name="valor" type="hidden" value="subir_masivos"/>
                                                <input name="f_soli2" type="hidden" value="<? echo $f_solicitud; ?>"/>
                                                <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Solicitar</button>
                                                <a class="btn btn-primary" href="index.php" id = "boton_atras" style="color: #fff;">Atras</a>
                                            </div>
                                        </div>
                                        <br><br><br><br>
                                    </form>
                                    <div id="loading_n" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
                                    <div id="response_masivo"></div>
                                    <br><br><br><br><br><br><br><br><br><br><br><br> <br><br><br> <br><br><br> <br><br><br> <br><br><br> <br>
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

</body>



