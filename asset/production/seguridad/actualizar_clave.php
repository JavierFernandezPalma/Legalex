<!--Proceso paara cambiar clave cada 6 meses-->	
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="../images/unipana.jpg"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../../login/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../../login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../../login/animate/animate.css">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="../../login/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../../login/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../../login/css/util.css">
<link rel="stylesheet" type="text/css" href="../../login/css/main.css">
<!--===============================================================================================-->

<?php
//include("connection_db.php");
//cambio de clave mensual usuarios internos
global $conexion;

if (isset($_POST['valor']) and $_POST['valor'] == '5') {

    $cambiar_contra = $_POST['cambiar_contra'];
    $verifica_contra = $_POST['verifica_contra'];
    $id_usuario = $_POST['id_nome'];

    $query3 = "SELECT Password FROM CLAVES WHERE Identificacion='$id_usuario' ORDER BY F_inicio ASC";
    $result_contrasenas = mysqli_query($conexion, $query3);
    $total_claves = mysqli_num_rows($result_contrasenas);

    $contrasena_actual = md5($cambiar_contra);

    while ($rows3 = mysqli_fetch_array($result_contrasenas)) {

        $id_claves = $rows3['Password'];

        if ($contrasena_actual == $id_claves) {

            $existe_clave = '1';
        }
    }






    if (empty($_POST['cambiar_contra']) or empty($_POST['verifica_contra'])) {  // se verifica que las variables no esten vacias
        echo '<div class="log" style="padding-left: 390px;">Algunos datos son obligatorios.</div>';
    } else if ($_POST['cambiar_contra'] != $_POST['verifica_contra']) {// verifica que las contraseñas sean iguales
        ?>

        <div class="limiter"> 
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="../images/img-03.fw.png" alt="IMG">
                    </div>

                    <form class="login100-form validate-form" name="validar_clave"  id="validar_clave" action="actualizar_clave.php" method="post">
                        <span class="login100-form-title" style="color:#FF2828">
                            Cambiar contraseña
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Digite Clave" >
                            <input class="input100" type="password" name="cambiar_contra" id="cambiar_contra" placeholder="Clave" autocomplete="off" onpaste="return false">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Confirme Clave">
                            <input class="input100" type="password" name="verifica_contra" id="verifica_contra" placeholder="Confirmar Clave" autocomplete="off" onpaste="return false">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <input name="valor" type="hidden" value="5"/>
                        <input name="id_nome" type="hidden" value="<?php echo $id_usuario; ?>"/>
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Ingresar
                            </button>
                        </div>

                        <div class="text-center p-t-12">
                            <span class="txt1">
                                <?php
                                echo "<div style='color:#FF0000;font-weight:bold'>Las contrase&ntilde;as nuevas no son iguales</div>";
                                ?>
                            </span>
                            <a class="txt2" href="#">

                            </a>
                        </div>

                        <div class="text-center p-t-136">

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    } else if ($existe_clave == 1) {
        ?>

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="../images/img-03.fw.png" alt="IMG">
                    </div>

                    <form class="login100-form validate-form" name="validar_clave"  id="validar_clave" action="actualizar_clave.php" method="post">
                        <span class="login100-form-title" style="color:#FF2828">
                            Cambiar Contraseña
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Digite Clave" >
                            <input class="input100" type="password" name="cambiar_contra" id="cambiar_contra" placeholder="Clave" autocomplete="off" onpaste="return false">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Confirme Clave">
                            <input class="input100" type="password" name="verifica_contra" id="verifica_contra" placeholder="Confirmar Clave" autocomplete="off" onpaste="return false">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <input name="valor" type="hidden" value="5"/>
                        <input name="id_nome" type="hidden" value="<?php echo $id_usuario; ?>"/>
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Ingresar
                            </button>
                        </div>

                        <div class="text-center p-t-12">
                            <span class="txt1">
                                <?php
                                echo "<div style='color:#FF0000;font-weight:bold'>La contrase&ntilde;a no puede ser igual a la actual</div>";
                                ?>
                            </span>
                            <a class="txt2" href="#">

                            </a>
                        </div>

                        <div class="text-center p-t-136">

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    } else {

        if (strlen($cambiar_contra) < 6) {
            ?>
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-pic js-tilt" data-tilt>
                            <img src="../images/img-03.fw.png" alt="IMG">
                        </div>

                        <form class="login100-form validate-form" name="validar_clave"  id="validar_clave" action="actualizar_clave.php" method="post">
                            <span class="login100-form-title" style="color:#FF2828">
                                Cambiar Contraseña
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Digite Clave" >
                                <input class="input100" type="password" name="cambiar_contra" id="cambiar_contra" placeholder="Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Confirme Clave">
                                <input class="input100" type="password" name="verifica_contra" id="verifica_contra" placeholder="Confirmar Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <input name="valor" type="hidden" value="5"/>
                            <input name="id_nome" type="hidden" value="<?php echo $id_usuario; ?>"/>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Ingresar
                                </button>
                            </div>

                            <div class="text-center p-t-12">
                                <span class="txt1">
                                    <?php
                                    echo "<div style='color:#FF0000;font-weight:bold'>La clave debe tener al menos 6 caracteres</div>";
                                    ?>
                                </span>
                                <a class="txt2" href="#">

                                </a>
                            </div>

                            <div class="text-center p-t-136">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } else if (strlen($cambiar_contra) > 16) {
            ?>
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-pic js-tilt" data-tilt>
                            <img src="../images/img-03.fw.png" alt="IMG">
                        </div>

                        <form class="login100-form validate-form" name="validar_clave"  id="validar_clave" action="actualizar_clave.php" method="post">
                            <span class="login100-form-title" style="color:#FF2828">
                                Cambiar Contraseña
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Digite Clave" >
                                <input class="input100" type="password" name="cambiar_contra" id="cambiar_contra" placeholder="Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Confirme Clave">
                                <input class="input100" type="password" name="verifica_contra" id="verifica_contra" placeholder="Confirmar Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <input name="valor" type="hidden" value="5"/>
                            <input name="id_nome" type="hidden" value="<?php echo $id_usuario; ?>"/>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Ingresar
                                </button>
                            </div>

                            <div class="text-center p-t-12">
                                <span class="txt1">
                                    <?php
                                    echo "<div style='color:#FF0000;font-weight:bold'>La clave no puede tener más de 16 caracteres</div>";
                                    ?>
                                </span>
                                <a class="txt2" href="#">

                                </a>
                            </div>

                            <div class="text-center p-t-136">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } else if (!preg_match('`[a-z]`', $cambiar_contra)) {
            ?>

            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-pic js-tilt" data-tilt>
                            <img src="../images/img-03.fw.png" alt="IMG">
                        </div>

                        <form class="login100-form validate-form" name="validar_clave"  id="validar_clave" action="actualizar_clave.php" method="post">
                            <span class="login100-form-title" style="color:#FF2828">
                                Cambiar Contraseña
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Digite Clave" >
                                <input class="input100" type="password" name="cambiar_contra" id="cambiar_contra" placeholder="Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Confirme Clave">
                                <input class="input100" type="password" name="verifica_contra" id="verifica_contra" placeholder="Confirmar Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <input name="valor" type="hidden" value="5"/>
                            <input name="id_nome" type="hidden" value="<?php echo $id_usuario; ?>"/>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Ingresar
                                </button>
                            </div>

                            <div class="text-center p-t-12">
                                <span class="txt1">
                                    <?php
                                    echo "<div style='color:#FF0000;font-weight:bold'>La clave debe tener al menos una letra minúscula</div>";
                                    ?>
                                </span>
                                <a class="txt2" href="#">

                                </a>
                            </div>

                            <div class="text-center p-t-136">

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
        } else if (!preg_match('`[A-Z]`', $cambiar_contra)) {
            ?>
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-pic js-tilt" data-tilt>
                            <img src="../images/img-03.fw.png" alt="IMG">
                        </div>

                        <form class="login100-form validate-form" name="validar_clave"  id="validar_clave" action="actualizar_clave.php" method="post">
                            <span class="login100-form-title" style="color:#FF2828">
                                Cambiar Contraseña
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Digite Clave" >
                                <input class="input100" type="password" name="cambiar_contra" id="cambiar_contra" placeholder="Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Confirme Clave">
                                <input class="input100" type="password" name="verifica_contra" id="verifica_contra" placeholder="Confirmar Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <input name="valor" type="hidden" value="5"/>
                            <input name="id_nome" type="hidden" value="<?php echo $id_usuario; ?>"/>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Ingresar
                                </button>
                            </div>

                            <div class="text-center p-t-12">
                                <span class="txt1">
                                    <?php
                                    echo "<div style='color:#FF0000;font-weight:bold'>La clave debe tener al menos una letra mayúscula</div>";
                                    ?>
                                </span>
                                <a class="txt2" href="#">

                                </a>
                            </div>

                            <div class="text-center p-t-136">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } else if (!preg_match('`[0-9]`', $cambiar_contra)) {
            ?>
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-pic js-tilt" data-tilt>
                            <img src="../images/img-03.fw.png" alt="IMG">	
                        </div>

                        <form class="login100-form validate-form" name="validar_clave"  id="validar_clave" action="actualizar_clave.php" method="post">
                            <span class="login100-form-title" style="color:#FF2828">
                                Cambiar Contraseña
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Digite Clave" >
                                <input class="input100" type="password" name="cambiar_contra" id="cambiar_contra" placeholder="Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Confirme Clave">
                                <input class="input100" type="password" name="verifica_contra" id="verifica_contra" placeholder="Confirmar Clave" autocomplete="off" onpaste="return false">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <input name="valor" type="hidden" value="5"/>
                            <input name="id_nome" type="hidden" value="<?php echo $id_usuario; ?>"/>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Ingresar
                                </button>
                            </div>

                            <div class="text-center p-t-12">
                                <span class="txt1">
                                    <?php
                                    echo "<div style='color:#FF0000;font-weight:bold'>La clave debe tener al menos un caracter numérico</div>";
                                    ?>
                                </span>
                                <a class="txt2" href="#">

                                </a>
                            </div>

                            <div class="text-center p-t-136">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } else {
            $contrasena = md5($cambiar_contra);
            $encriptar = " Password='{$contrasena}'";
            $fecha_actualizacion = date("Y-m-d");
            $fecha_auditor = date("H:i:s");
            $clave_usu = $contrasena;

            $fecha_session = strtotime('+360 day', strtotime($fecha_actualizacion));
            $fecha_session = date('Y-m-d', $fecha_session);

            //se actualiza el usuario
            $query = "UPDATE USUARIOS SET $encriptar,F_fin_session='$fecha_session' WHERE Identificacion='$id_usuario'";
            // ejecutar sentencia
            $result = mysqli_query($conexion, $query);



            if ($total_claves == 6) {


                $colusta_primera = "SELECT min( F_inicio ) as clave FROM CLAVES WHERE Identificacion = '$id_usuario'";
                $result_primera = mysqli_query($conexion, $colusta_primera);

                while ($row_primera = mysqli_fetch_array($conexion, $result_primera)) {
                    $cambia_primera = $row_primera['clave'];
                }

                $actuali_clave = "UPDATE CLAVES SET Password='$clave_usu',F_inicio='$fecha_actualizacion',Hora='$fecha_auditor' WHERE F_inicio='$cambia_primera' and Identificacion = '$id_usuario'";
                $result_actuali = mysqli_query($conexion, $actuali_clave);
            } else {

                $query2 = "INSERT INTO CLAVES (Id_clave,Identificacion,Password,F_inicio,Hora)VALUES (NULL, '$id_usuario','$clave_usu','$fecha_actualizacion', '$fecha_auditor');";
                // ejecutar sentencia
                $result2 = mysqli_query($conexion, $query2);
            }

            if ($result) {
                //echo $conexion->affected_rows." fila(s) afectada(s). Informaci&oacute;n insertada correctamente";
                ?>

                <div class="limiter">
                    <div class="container-login100">
                        <div class="wrap-login100">
                            <div class="login100-pic js-tilt" data-tilt>
                                <img src="../images/img-03.fw.png" alt="IMG">
                            </div>

                            <form class="login100-form validate-form" name="validar_clave"  id="validar_clave" action="../../../login" method="post">
                                <span class="login100-form-title" style="color:#008A45">
                                    Se ha actualizado contrase&ntilde;a.
                                </span>




                                <div class="container-login100-form-btn">
                                    <button class="login100-form-btn">
                                        Volver
                                    </button>
                                </div>

                                <div class="text-center p-t-12">
                                    <span class="txt1">

                                    </span>
                                    <a class="txt2" href="#">

                                    </a>
                                </div>

                                <div class="text-center p-t-136">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <?php
            } else {
                ?>
                <div class="limiter">
                    <div class="container-login100">
                        <div class="wrap-login100">
                            <div class="login100-pic js-tilt" data-tilt>
                                <img src="../images/img-03.fw.png" alt="IMG">	
                            </div>

                            <form class="login100-form validate-form" name="validar_clave"  id="validar_clave" action="../../../login" method="post">
                                <span class="login100-form-title" style="color:#FF0000">
                                    No se ha actualizado la contrase&ntilde;a, intente de nuevo.
                                </span>




                                <div class="container-login100-form-btn">
                                    <button class="login100-form-btn">
                                        Volver
                                    </button>
                                </div>

                                <div class="text-center p-t-12">
                                    <span class="txt1">

                                    </span>
                                    <a class="txt2" href="#">

                                    </a>
                                </div>

                                <div class="text-center p-t-136">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            // se cierra conexion
        }
    }
}
?>
<!--===============================================================================================-->	
<script src="../../login/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../../login/bootstrap/js/popper.js"></script>
<script src="../../login/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../../login/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="../../login/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="../../login/main.js"></script>