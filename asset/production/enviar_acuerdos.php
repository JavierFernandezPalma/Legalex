<?php
include("seguridad/connection_db.php");
include("principal.php");
include("seguridad/seguridad.php");

global $conexion;

$f_solicitud = date("Y-m-d");

//consulta proveedores enviar acuerdo
   $query_enviar_acuerdos = "SELECT * FROM t_proveedores AS pro 
INNER JOIN t_empresas AS emp ON pro.Id_Empresa = emp.Id_empresa 
INNER JOIN t_tip_documento AS topd ON pro.Tip_Documento = topd.Id_TipDocuemnto 
INNER JOIN t_acuerdo AS acu ON pro.Respuesta_Solicitud = acu.Id_Acuerdo
WHERE Estado = 1 AND Respuesta_Solicitud IN (0,1);";
   $resultado_query_ea = mysqli_query($conexion, $query_enviar_acuerdos) or die("no se ha podido ejecutar la consulta");
   $conteo_resultado_query_ea = mysqli_num_rows($resultado_query_ea);
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
                                <li class="active">Enviar Acuerdos</li>
                            </ol>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><small>Registros para enviar acuerdos</small></h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="x_content">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Empresa</th>
                                                    <th>Tipo Documento</th>
                                                    <th>Documento</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Teléfono</th>
                                                    <th>Celular</th>
                                                    <th>Email</th>
                                                    <th>Estado Acuerdo</th>
                                                    <th>Gestionar</th>
                                                    <th>Selección</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                // $objPHPExcel->getActiveSheet()->removeRow(3); remover una fila de formulario
                                                while ($row = mysqli_fetch_array($resultado_query_ea))
                                                    {
                                                   $id_proveedor = $row['Id_Proveedor'];
                                                   $empresa = $row['Nombre_empresa'];
                                                   $tipo_documento = $row['Desc_TipDocumento'];
                                                   $documento = $row['Documento']; 
                                                   $nombres = $row['Nombres'];
                                                   $apellidos =$row['Apellidos']; 
                                                   $telefono = $row['Telefono'];
                                                   $celular = $row['Celular'];
                                                   $email = $row['Email'];                                               
                                                   $est_acuerdo =$row['Desc_Acuerdo']; 

                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $id_proveedor; ?>    
                                                        </td>
                                                        <td>
                                                            <script type="text/javascript">
                                                                function update_cedula() {
                                                                    var counter = $("#resul_nom_<?php echo $i; ?>").val();
                                                                    var cod_estu = $("#codigo_estu<?php echo $i ?>").val();
                                                                    var type_form = "update_cc_estu";
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "procesar/update_resul.php",
                                                                        dataType: "html",
                                                                        data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                                                        success: function (response) {
                                                                            $("#resul_tip_doc_<? echo $i; ?>").text(response);
                                                                        }
                                                                    })
                                                                }
                                                                setInterval(update_cedula, 5000);
                                                            </script>                             
                                                            <p id="resul_cc_<?php echo $i; ?>">   <?php echo $empresa; ?></p> </td>

                                                        <td>
                                                            <script type="text/javascript">
                                                                function update_cedula() {
                                                                    var counter = $("#resul_nom_<?php echo $i; ?>").val();
                                                                    var cod_estu = $("#codigo_estu<?php echo $i ?>").val();
                                                                    var type_form = "update_cc_estu";
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "procesar/update_resul.php",
                                                                        dataType: "html",
                                                                        data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                                                        success: function (response) {
                                                                            $("#resul_documento_<? echo $i; ?>").text(response);
                                                                        }
                                                                    })
                                                                }
                                                                setInterval(update_cedula, 5000);
                                                            </script>                             
                                                            <p id="resul_cc_<?php echo $i; ?>">   <?php echo $tipo_documento; ?></p> </td>


                                                        <td>
                                                            <script type="text/javascript">
                                                                function update_cedula() {
                                                                    var counter = $("#resul_nom_<?php echo $i; ?>").val();
                                                                    var cod_estu = $("#codigo_estu<?php echo $i ?>").val();
                                                                    var type_form = "update_cc_estu";
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "procesar/update_resul.php",
                                                                        dataType: "html",
                                                                        data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                                                        success: function (response) {
                                                                            $("#resul_nombres_<? echo $i; ?>").text(response);
                                                                        }
                                                                    })
                                                                }
                                                                setInterval(update_cedula, 5000);
                                                            </script>                             
                                                            <p id="resul_cc_<?php echo $i; ?>">   <?php echo $documento; ?></p> </td>

                                                        <td>
                                                            <input type="hidden" id ="codigo_estu<?php echo $i; ?>" value="<?php echo $documento; ?>">
                                                            <script type="text/javascript">
                                                                function update_presento() {
                                                                    var counter = $("#resul_nom_<?php echo $i; ?>").val();
                                                                    var cod_estu = $("#codigo_estu<?php echo $i ?>").val();
                                                                    var type_form = "update_nom_estu";
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "procesar/update_resul.php",
                                                                        dataType: "html",
                                                                        data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                                                        success: function (response) {
                                                                            $("#resul_apellidos_<? echo $i; ?>").text(response);
                                                                        }
                                                                    })
                                                                }

                                                                setInterval(update_presento, 5000);

                                                            </script> 
                                                            <p id="resul_nom_<?php echo $i; ?>"> <?php echo $nombres; ?> </p></td>

                                                        <td>
                                                            <input type="hidden" id ="codigo_estu<?php echo $i; ?>" value="<?php echo $id_proveedor; ?>">
                                                            <script type="text/javascript">
                                                                function update_telefono() {
                                                                    var counter = $("#resul_telefono_<?php echo $i; ?>").val();
                                                                    var cod_estu = $("#codigo_proveedor<?php echo $i ?>").val();
                                                                    var campo_form = "update_tel_proveedor";
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "procesar/update_resul.php",
                                                                        dataType: "html",
                                                                        data: {counter: counter, cod_estu: cod_estu, campo_form: campo_form},
                                                                        success: function (response) {
                                                                            $("#resul_telefono_<? echo $i; ?>").text(response);
                                                                        }
                                                                    })
                                                                }
                                                                setInterval(update_telefono, 5000);

                                                            </script> 
                                                            <p id="resul_telefono_<?php echo $i; ?>"> <?php echo $apellidos; ?> </p></td>



                                                        <td>
                                                            <script type="text/javascript">
                                                                function update_correo() {
                                                                    var counter = $("#resul_correo_<?php echo $i; ?>").val();
                                                                    var cod_estu = $("#codigo_estu<?php echo $i ?>").val();
                                                                    var type_form = "update_correo_estu";
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "procesar/update_resul.php",
                                                                        dataType: "html",
                                                                        data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                                                        success: function (response) {
                                                                            $("#resul_celular_<? echo $i; ?>").text(response);
                                                                        }
                                                                    })
                                                                }
                                                                setInterval(update_correo, 5000);
                                                            </script>
                                                            <p id="resul_correo_<?php echo $i; ?>">   <?php echo $telefono; ?> </p></td>

                                                        <td>
                                                            <script type="text/javascript">
                                                                function update_correo() {
                                                                    var counter = $("#resul_correo_<?php echo $i; ?>").val();
                                                                    var cod_estu = $("#codigo_estu<?php echo $i ?>").val();
                                                                    var type_form = "update_correo_estu";
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "procesar/update_resul.php",
                                                                        dataType: "html",
                                                                        data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                                                        success: function (response) {
                                                                            $("#resul_correo_<? echo $i; ?>").text(response);
                                                                        }
                                                                    })
                                                                }
                                                                setInterval(update_correo, 5000);
                                                            </script>
                                                            <p id="resul_correo_<?php echo $i; ?>">   <?php echo $celular; ?> </p></td>

                                                        <td>
                                                            <script type="text/javascript">
                                                                function update_correo() {
                                                                    var counter = $("#resul_correo_<?php echo $i; ?>").val();
                                                                    var cod_estu = $("#codigo_estu<?php echo $i ?>").val();
                                                                    var type_form = "update_correo_estu";
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "procesar/update_resul.php",
                                                                        dataType: "html",
                                                                        data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                                                        success: function (response) {
                                                                            $("#resul_correo_<? echo $i; ?>").text(response);
                                                                        }
                                                                    })
                                                                }
                                                                setInterval(update_correo, 5000);
                                                            </script>
                                                            <p id="resul_correo_<?php echo $i; ?>">   <?php echo $email; ?> </p></td>

                                                            <td><?php echo $est_acuerdo;?> </td>
                                                            
                                                        <td align="center">
                                                            <button type="submit" class="ver_estudian btn btn-primary" value="<? echo $id_proveedor; ?>" id="<?php echo $id_proveedor; ?>">Editar</button>
                                                        </td>
                                                        <td  align="center"><input type="checkbox" name="gender" value="male"> Seleccionar</td>
                                                    </tr>
                                                    <?php
                                                    $i = $i + 1;
                                                }//fin de ofertas activas
                                                ?>                      
                                            </tbody>
                                        </table> 

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-5">
                                                <input name="valor" type="hidden" value="subir_masivos"/>
                                                <input name="f_soli2" type="hidden" value="<? echo $f_solicitud; ?>"/>
                                                <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Enviar</button>
                                                <a class="btn btn-primary" href="masivo_proveedores.php" id = "boton_atras" style="color: #fff;">Atras</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="dataModal2" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Editar proveedor</h4>
                                                </div>
                                                <div class="modal-body" id="employee_detail2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="response_n"></div>

                                    <script>
                                        $(document).ready(function () {

                                            $(document).on('click', '.ver_estudian', function () {
                                                //$('#dataModal').modal();
                                                var proveedor = $(this).attr("id");
                                                $.ajax({
                                                    url: "procesar/editar_proveedor.php",
                                                    method: "POST",
                                                    data: {proveedor: proveedor},
                                                    success: function (data) {
                                                        $('#employee_detail2').html(data);
                                                        $('#dataModal2').modal('show');
                                                    }
                                                });
                                            });
                                        });
                                    </script>     
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



