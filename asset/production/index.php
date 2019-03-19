<?php
//Conexion a la base de datos
$conexion = mysqli_connect("localhost", "root", "root");
if (!(mysqli_select_db($conexion, "sistemas_sispraemu"))) {
    printf("No se ha podido conectar con la base de datos: " . $data_base . "<br>Error N°: " . mysqli_errno($conexion) . " - " . mysqli_error($conexion));
}
?>

<?php
include("seguridad/connection_db.php");
include("principal.php");

$cedu_docente = $_SESSION['identificacion'];

//consulta estudiantes 
$consulta_estudiantes = "SELECT * FROM USUARIOS WHERE Id_estado='2' and Id_perfil='4'";
$datos_estudiantes = mysqli_query($conexion, $consulta_estudiantes) or die("no se ha podido ejecutar la consulta");
$registro_estudiantes = mysqli_num_rows($datos_estudiantes);

//consulta docentes
$consulta_docentes = "SELECT * FROM USUARIOS WHERE Id_estado='2' and Id_perfil='3'";
$datos_docentes = mysqli_query($conexion, $consulta_docentes) or die("no se ha podido ejecutar la consulta");
$registro_docentes = mysqli_num_rows($datos_docentes);

//consulta ofertas
$consulta_ofertas = "SELECT * FROM VACANTE WHERE `F_baja_vacante` IS NULL ";
$datos_ofertas = mysqli_query($conexion, $consulta_ofertas) or die("no se ha podido ejecutar la consulta");
$registro_ofertas = mysqli_num_rows($datos_ofertas);

//consulta grupos
$consulta_grupo = "SELECT * FROM GRUPO WHERE `F_cierre_grupo`='0000-00-00' ";
$datos_grupo = mysqli_query($conexion, $consulta_grupo) or die("no se ha podido ejecutar la consulta");
$registro_grupos = mysqli_num_rows($datos_grupo);

//consulta grupos por docente
$consulta_grupo_docen = "SELECT * FROM GRUPO WHERE Identificacion='$cedu_docente' ";
$datos_grupo_docen = mysqli_query($conexion, $consulta_grupo_docen) or die("no se ha podido ejecutar la consulta");
$registro_grupos_docen = mysqli_num_rows($datos_grupo_docen);
?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!--    page content -->
            <div class="right_col" role="main">
                top acuerdos confidencialidad

                <?php
                //si la session es Administrador muestra el siguiente menu
                if ($perfil == '1') {
                    ?>
                    <div class="row tile_count">
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i>Proveedores Activos</span>
                            <div class="count gree"><?php echo $registro_estudiantes; ?></div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i>Proveedores inactivos</span>
                            <div class="count gree"><?php echo $registro_docentes; ?></div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i>Proveedores con acuerdo</span>
                            <div class="count green"><?php echo $registro_ofertas; ?></div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i>Proveedores sin acuerdo</span>
                            <div class="count gree"><?php echo $registro_grupos; ?></div>
                        </div>
                    </div>
                    
                <?php } ?>

                <?php
                if ($perfil == '2') {
                    ?>
                top tiles
                    <div class="row tile_count">
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i>Grupos Activos</span>
                            <div class="count gree"><?php echo $registro_grupos_docen; ?></div>
                        </div>
                    </div>

 <?php } ?>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="dashboard_graph">

                                <img src="images/slider-3.jpg" width="90%" height="90%" style="opacity:0.4">

                            </div>
                        </div>

                    </div>
                    <br />

                    <br><br><br><br><br><br><br><br><br>
                </div>
                page content
           

        </div>

    </div>

    <?php
    include("footer.php");
    ?>
</body>

