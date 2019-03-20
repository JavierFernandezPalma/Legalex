<!DOCTYPE <html>
<html lang="es">
    <head>
        <title>::LEGALEX::</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="asset/production/images/unipana.jpg"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="asset/login/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="asset/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="asset/login/animate/animate.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="asset/login/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="asset/login/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="asset/login/css/util.css">
        <link rel="stylesheet" type="text/css" href="asset/login/css/main.css">
        <!--===============================================================================================-->
    </head>
    <body>

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="asset/production/images/AxedeBlancoNuevo.jpg" alt="IMG">
                    </div>
                    <form class="login100-form validate-form" name="login1"  id="login1" action="asset/production/seguridad/autenticacion.php" method="post" autocomplete="off">
                        <span class="login100-form-title">
                            <b>LEGA<font color= "#000000">LEX</font></b>
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Digite usuario" >
                            <input class="input100" type="text" name="user1" id="user1" placeholder="Usuario">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Digite Clave">
                            <input class="input100" type="password" name="password1" id="password1" placeholder="Clave">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Ingresar
                            </button>
                        </div>


                        <div class="text-center p-t-12">
<!--                            <a class="txt2" href="../../../../include/recuperar_clave.php">
                                ¿Has olvidado la contraseña?	
                            </a>-->
                            <a class="txt2" href="#">
                                ¿Has olvidado la contraseña?	
                            </a>
                            <span class="txt1">
                                <?php
                                if (filter_input(INPUT_GET, 'logout') == true) {

                                    echo "<div style='color:#FF0000;font-weight:bold'>El usuario o contraseña no son correctos, intente de nuevo.</div>";
                                }
                                ?>
                            </span>
                        </div>

                        <!--<div class="text-center p-t-12">
                                <a class="txt2" href="../../include/formu_soporte">
                                Soporte técnico	
                                </a>				
                        </div>-->


                    </form>
                    <div class=" p-t-136" align="center" style="width:100%; margin: -12% 0 0 0;">
                        <!--<a class="txt2" href="https://app.compliance.com.co/validador/#/historial" target="_blank">
                                 Ingreso a Compliance Click aqui
                        </a>--><br><br>
                        SISTEMA PARA GESTIONAR CONFIDENCILIDAD DE LOS DATOS.
                        <br><br>
                        <div>
                            <img src="asset/production/images/favicon.ico"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!--===============================================================================================-->	
        <script src="asset/login/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="asset/login/bootstrap/js/popper.js"></script>
        <script src="asset/login/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="asset/login/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="asset/login/tilt/tilt.jquery.min.js"></script>
        <script >
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script>
        <!--===============================================================================================-->
        <script src="asset/login/main.js"></script>

    </body>
</html>