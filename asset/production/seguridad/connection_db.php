<?php

//class Conectar {
//
//    public static function conexion() {
//        try {
            // se recogen en variables los datos para la conexion a la bd
            // datos conexion hostpapa
            $host = "localhost";  //local
            $user = "root";
            $password = "root";
            $data_base = "sistemas_sispraemu";

            // se establece la conexion con el servidor
            $conexion = @mysqli_connect($host, $user, $password);

            // muestra error en caso de no establecer la conexion
            if (!(mysqli_select_db($conexion, $data_base))) {
                printf("No se ha podido conectar con la base de datos: " . $data_base . "<br>Error N°: " . mysqli_errno($conexion) . " - " . mysqli_error($conexion));
            }

            //mysqli_query ("SET SESSION wait_timeout = 10;");//agregada 14 nov 2013	
            //	
            //mysqli_query ("SET NAMES 'utf8'");  // hace la conversion a utf8 para todos los caracteres
            //
                //mysqli_query ("SET time_zone = 'America/Bogota';");  // Establece zona horaria
            //mysqli_query ("SET time_zone = '-05:00';");
            //mysqli_query ("SET @@session.time_zone = '-05:00';");
            //ini_set('max_user_connections', 200);
            //ini_set('max_connections', 200);
            //mysqli_close($conexion);
//        } catch (Exception $ex) {
//            
//        }
//        
//        return $conexion;
//    }
//
//}

?>