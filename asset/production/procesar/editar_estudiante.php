<?php
//select.php 
include("../seguridad/connection_db.php");
include("../seguridad/seguridad.php");

// capturamos el id del estudiante
$id_estudiante = $_POST['estudiante'];

$consulta_estudiante = "SELECT * FROM USUARIOS WHERE Identificacion = '$id_estudiante';";
$resul_estudiante = mysqli_query($conexion, $consulta_estudiante);

//consulta Estado
$consulta_estado = "SELECT * FROM ESTADOS WHERE Id_estado > 0 AND Id_estado < 4;";
$datos_estado = mysqli_query($conexion, $consulta_estado) or die("no se ha podido ejecutar la consulta");

//Caja compensación
$consulta_doc = "SELECT * FROM TIPO_DOCUMENTOS;";
$datos_doc = mysqli_query($conexion, $consulta_doc) or die("no se ha podido ejecutar la consulta");

while ($row = mysqli_fetch_array($resul_estudiante)) {

    $Nombres = $row['Nombres'];
    $apellidos = $row['Apellidos'];
    $Cedula = $row['Identificacion'];
    $Usuario = $row['Usuario'];
    $Id_estado = $row['Id_estado'];
    $t_documento = $row['Id_documento'];
    $fecha_expedicion = $row['F_exp_doc'];
    $fecha_nacimiento = $row['Fecha_nacimiento'];
}

$consulta_telefono = "SELECT Telefono_usuario FROM TELEFONOS WHERE Identificacion = '$Cedula' AND Id_telefono = 1;";
$datos_telefono = mysqli_query($conexion, $consulta_telefono);
$resul_tel = mysqli_fetch_assoc($datos_telefono);
$telefono = $resul_tel['Telefono_usuario'];


$consulta_movil = "SELECT Telefono_usuario FROM TELEFONOS WHERE Identificacion = '$Cedula' AND Id_telefono = 2";
$datos_movil = mysqli_query($conexion, $consulta_movil);
$resul_mov = mysqli_fetch_assoc($datos_movil);
$movil = $resul_mov['Telefono_usuario'];

$consulta_mail = "SELECT Mail FROM MAILS WHERE Identificacion = '$Cedula'";
$datos_mail = mysqli_query($conexion, $consulta_mail);
$resul_mail = mysqli_fetch_assoc($datos_mail);
$correo = $resul_mail['Mail'];
?>  

<script type="text/javascript">
    $(function () {
        $("#actualizar_solicitud").submit(function () {
            $.ajax({
                type: "POST",
                url: "procesar/save_edit.php",
                dataType: "html",
                data: $(this).serialize(),
                beforeSend: function () {
                    $("#actualizar_soli").show();
                },
                success: function (response) {
                    $("#response_soli").html(response);
                    $("#actualizar_soli").hide();
                }
            })
            return false;
        })
    })
</script>

<script type="text/javascript">
// Solo permite ingresar numeros.
    function soloNumeros(e) {
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57)
    }
</script>

<script src="../vendors/validator/validator.js"></script>		

<div class="container">
    <div class ="row">
        <div class="col-md-10">
            <form id="actualizar_solicitud" novalidate method="post" class="form-horizontal form-label-left" >
                <div class="box-body">


                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Nombres<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="estudia_nombre" id="estudia_nombre" value = "<?php echo $Nombres; ?>" required="required" autocomplete="off" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Apellidos<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="apellido" id="apellido" value = "<?php echo $apellidos; ?>" required="required" autocomplete="off" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">T. documento:</label>
                        <div class="col-sm-9">

                            <select class="form-control" name="t_documento"  id="t_documento" required>
                                <?php
                                while ($row1 = mysqli_fetch_array($datos_doc)) {
                                    if ($row1['Id_documento'] == $t_documento) {
                                        echo '<option value="' . $row1['Id_documento'] . '"  selected>  ' . $row1['Desc_documento'] . '</option>';
                                    } else {
                                        echo '<option value="' . $row1['Id_documento'] . '" >  ' . $row1['Desc_documento'] . '</option>';
                                    }
                                }
                                mysqli_free_result($datos_doc); //Libera la memoria del resultado
                                ?>
                            </select>

                            <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left"></div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Identificación<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="estudia_cedula" id="estudia_cedula" value = "<?php echo $Cedula; ?>"  required="required" autocomplete="off" maxlength="15"  onKeyPress="return soloNumeros(event)" disabled>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Fecha expedición:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="fecha_expedicion" id="fecha_expedicion" required="required"  value = "<?php echo $fecha_expedicion; ?>" autocomplete="off" maxlength="50" disabled>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Fecha nacimiento:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required="required"  value = "<?php echo $fecha_nacimiento; ?>" autocomplete="off" maxlength="50" disabled>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Teléfono<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="telefono" id="telefono" value = "<?php echo $telefono; ?>">
                            <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" required="required" autocomplete="off" maxlength="15"  onKeyPress="return soloNumeros(event)"></div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Movil<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="movil" id="movil" value = "<?php echo $movil; ?>">
                            <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" required="required" autocomplete="off" maxlength="15"  onKeyPress="return soloNumeros(event)"></div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Email<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="correo" id="correo" value = "<?php echo $correo; ?>">
                            <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" required="required" autocomplete="off"></div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Usuario:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="usuario" id="usuario" value = "<?php echo $Usuario; ?>" disabled>
                            <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left"></div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Contraseña:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="contrasena" id="contrasena" value ="" placeholder="Ingrese nueva clave si desea cambiarla">
                            <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" ></div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label" for="empresa">Estado<span class="required">*:</span>
                        </label>
                        <div  class="col-sm-9">
                            <select class="form-control" name="estado"  id="estado" value = "<?php echo $Id_estado; ?>" >
                                <?php
                                while ($objeto = mysqli_fetch_array($datos_estado)) {
                                    if ($objeto['Id_estado'] == $Id_estado) {
                                        echo '<option value="' . $objeto['Id_estado'] . '" selected >  ' . $objeto['Desc_estado'] . '</option>';
                                    } else {
                                        echo '<option value="' . $objeto['Id_estado'] . '">  ' . $objeto['Desc_estado'] . '</option>';
                                    }
                                }
                                mysqli_free_result($datos_estado); //Libera la memoria del resultado 
                                ?>
                            </select>
                        </div>
                    </div>							


                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-5">
                        </div>
                    </div>

                    <br>
                    <div class='col-md-2'>
                    </div>
                    <div class="col-md-6 col-md-offset-5">
                        <input type="hidden" name="id_estudiante" value="<?php echo $id_estudiante; ?>"/>
                        <input name="valor" type="hidden" value="actualiza_soli"/>
                        <button type="submit" class="btn btn-primary" id="subirF" >Actualizar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <br><br>
                        <div id="actualizar_soli" style="display:none" align="center"></div>

                    </div>
                </div>
                <input type="hidden" name="valor" value="save_estudiante">		
            </form>

            <script>
                $("#error_vac").hide();
            </script>

        </div>
    </div>
</div>
<div id="response_soli"></div>

