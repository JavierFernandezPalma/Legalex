<?php ob_start(); ?>


<?php
include("connection_db.php");
include("validacion_campos.php"); // funcion de validacion de campos
// validacion de campos

if ($_POST) {
    $campos = array('user1', 'password1');    // campos requeridos separados por coma
    if (vali_login($campos) != 0) {
        $valicampo = false;  // campos invalido
    } else {
        $valicampo = true; // campos validos
    }
}
// validacion de campos
//if((isset($_POST["user1"]) AND isset($_POST["password1"])) AND (!empty($_POST["user1"]) AND !empty($_POST["password1"])) ) {

if ($valicampo == true) {
    
    global $conexion;
    
    $user1 = mysqli_real_escape_string($conexion, filter_input(INPUT_POST, 'user1'));
    $password1 = mysqli_real_escape_string($conexion, filter_input(INPUT_POST, 'password1'));
    $contrasena_ingre = md5($password1);

    // en caso que acceda Estudiante,Docente,Administrador
    $query1 = "SELECT * FROM usuarios WHERE Id_estado='2' AND Usuario='$user1'";
    $resul1a = mysqli_query($conexion, $query1);
    $registro1 = mysqli_fetch_assoc($resul1a);
    $users_valida1 = $registro1['Identificacion'];


//		mysqli_free_result($resul1a); //Libera la memoria del resultado
//=====================================================================================================================================================

    if ($registro1['Usuario'] == $user1 and $registro1['Password'] == $password1) {  //evaluacion Usuarios estudiante,docente,adminitrador
        $clien_inter = '1';
    } else if ($registro1['Usuario'] == $user1 and $registro1['Password'] != $password1) {
        $password_bd = $registro1['Password'];
        if ($contrasena_ingre == $password_bd) {
            $clien_inter = '1';
        }
    }


//    if ($registro11['Usuario'] == $user1 and $registro11['Password'] == $password1) {  //evaluacion empresa externo
//        $clien_exter = '1';
//    } else if ($registro11['Usuario'] == $user1 and $registro11['Password'] != $password1) {
//        $password_bd = $registro11['Password'];
//        if ($contrasena_ingre == $password_bd) {
//            $clien_exter = '1';
//        }
//    }
//=======================================================================================================================




    if ($clien_inter == '1') {  // se crean variables y se determinana las politicas para el usuario interno
        $f_fin_session = $registro1['F_fin_session'];
        $fecha_ahora = date("Y-m-d");
        $users_valida = $registro1['Identificacion'];


        if ($fecha_ahora == $f_fin_session or $fecha_ahora > $f_fin_session) {
            ?>

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
                            <input name="id_nome" type="hidden" value="<?php echo $users_valida1; ?>"/>
                            <input name="id_nome2" type="hidden" value="<?php echo $users_valida; ?>"/>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Ingresar
                                </button>
                            </div>

                            <div class="text-center p-t-136">

                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
            <script src="../../login.php/main.js"></script>

            <?php
        
            
        } else {






            $link = "http://localhost/Legalex/asset/production/index.php";
            header("Location:$link");

            $nombre = $registro1['Nombres'];
            $apellido = $registro1['Apellidos'];
            $users = $registro1['Usuario'];
            $identificacion = $registro1['Identificacion'];
            $perfil = $registro1['Id_perfil'];

            // creacion de cookies
            setcookie("seguridad", 'si', time() + 43200, "/", "");
            setcookie("nombre", $nombre, time() + 43200, "/", "");
            setcookie("users", $users, time() + 43200, "/", "");
            setcookie("identificacion", $identificacion, time() + 43200, "/", "");
            setcookie("perfil", $perfil, time() + 43200, "/", "");

            //se crea sesion
            session_start();
            $_SESSION['seguridad'] = $_COOKIE['seguridad'];
            $_SESSION['nombre'] = $_COOKIE['nombre'];
            $_SESSION['users'] = $_COOKIE['users'];
            $_SESSION['identificacion'] = $_COOKIE['identificacion'];
            $_SESSION['perfil'] = $_COOKIE['perfil'];

            //Se crea el token aleatorio  con el users
            $tkn = md5(rand()) . $users;
            //$tkn= "";
            setcookie("tkn", $tkn, time() + 43200, "/", "");
            $_SESSION['tkn'] = $_COOKIE['tkn'];
            //actualizacion del token del usuario en la bd
            //mysqli_query("UPDATE users SET tkn='{$tkn}' WHERE users='{$users}'");
            //-------------inicio insert en log users
            $users = $_COOKIE['users']; // email usuario
            $nombre = $_COOKIE['nombre']; //nombre del usuario
            $tipo = $_COOKIE['tipo']; //rol del usuario
            $ip = $_SERVER['REMOTE_ADDR'];  // direccion ip del usuario
            //$insertar_log = mysqli_query("INSERT INTO Auditoria (Accion,Usuario,Id_perfil,F_accion)VALUE('Ingreso al sistema','{$users}','{$tipo}',now()')", $conexion);
            //-------------fin insert en log users
        }
    }


    // accion a ejecutar al salir de todos los if
    if ($clien_inter <> '1') {
        mysqli_close($conexion);  // cierra la conexion
        header("Location:../../../login.php?logout=true");  // envia a la pagina principal
        //echo("no existe el usuario");
    }// fin if
//------------------------------------fin en caso que acceda el cliente
} else {// fin post
    mysqli_close($conexion);  // cierra la conexion
    header("Location:../../../login.php?logout=true");  // envia a la pagina principal
}





mysqli_close($conexion);  // cierra la conexion
?>

<?php ob_flush(); ?>