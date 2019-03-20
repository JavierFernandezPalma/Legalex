<?php
//Conexion a la base de datos
include("connection_db.php");
global $conexion;

if (!(mysqli_select_db($conexion, "sistemas_sispraemu"))) {
    printf("No se ha podido conectar con la base de datos: " . $data_base . "<br>Error N°: " . mysqli_errno($conexion) . " - " . mysqli_error($conexion));
}
?>


<?php
//session_start();

global $conexion;

	$_SESSION['seguridad']=$_COOKIE['seguridad'];
	$_SESSION['nombre']=$_COOKIE['nombre'];
        $_SESSION['nombre']=$_COOKIE['nombre'];
	$_SESSION['users']=$_COOKIE['users'];
	@$_SESSION['identificacion']=$_COOKIE['identificacion'];
	@$_SESSION['perfil']=$_COOKIE['perfil'];
        @$_SESSION['tkn']=$_COOKIE['tkn'];

        $tkn=$_SESSION['tkn'];

	$seguridad=$_SESSION['seguridad'];  // seguridad
	$nombre=$_SESSION['nombre']; //nombre del usuario
	$users=$_SESSION['users']; //logim del usuario
	$identificacion=$_SESSION['identificacion']; //identificacion del usuario
	$perfil=$_SESSION['perfil']; //tipo de permisos del usuario

	$ip=$_SERVER['REMOTE_ADDR'];  // direccion ip del usuario
	$p_view=$_SERVER['REQUEST_URI']; // direccion pagina actual
	$agente_u=$_SERVER['HTTP_USER_AGENT'];  // informacion egente http



        //COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO y que exista el token
        $query1 = mysqli_query($conexion, "SELECT Usuario FROM USUARIOS WHERE Usuario='$users'");
        //$query2 = mysqli_query("SELECT Usuario FROM Empresas WHERE Usuario='$users'");

       if((mysqli_num_rows($query1)==1) and $_COOKIE['seguridad']=='si') {

            //  log de usuarios---------------------
            //$insertar_log = mysqli_query("INSERT INTO log_users (users,tipo,nombre,f_in,time,ip,p_view,agente_u)VALUE('{$users}','{$tipo}','{$nombre}',now(),now(),'{$ip}','{$p_view}','{$agente_u}')", $conexion);
            // fin log de usuarios---------------------

              //$tkn= md5(rand()).$users;
              //$_SESSION[tkn]=$tkn;

              //volvemos a calcular un token  y lo asigna a la variable de sesion
              // $tkn=md5(rand()).$users;
               //$_SESSION['tkn']=$tkn;

              //actualizacion del token del usuario en la bd
              //mysqli_query("UPDATE users SET tkn='{$tkn}' WHERE users='{$users}'");
              // fin
              //$tkn=$_SESSION['tkn'];
        }else{

                //Eliminacion par clave/valor
                unset($_SESSION['tkn']);
                unset($_SESSION['seguridad']);
                unset($_SESSION['nombre']);
                unset($_SESSION['users']);
                unset($_SESSION['identificacion']);
                unset($_SESSION['perfil']);

                // Borra todas las variables de sesión
                $_SESSION = array();

                // Borra la cookie que almacena la sesión
                setcookie("seguridad", '', time() - 42000, '/');
                setcookie("nombre", '', time() - 42000, '/');
                setcookie("users", '', time() - 42000, '/');
                setcookie("identificacion", '', time() - 42000, '/');
                setcookie("perfil", '', time() - 42000, '/');
                setcookie("tkn", '', time() - 42000, '/');

                // Finalmente, destruye la sesión
                session_destroy();

               mysqli_close($conexion);  // cierra la conexion
               header("Location:../../../Legalex/login.php?logout=true");  // envia a la pagina principal

               exit;
      }
  //    mysqli_close($conexion);  // cierra la conexion
?>