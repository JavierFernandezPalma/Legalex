
<script>
    function tiempo() {
        setTimeout(function () {
            document.getElementById('response_n').innerHTML = '';
        }, 6000);
    }
    tiempo();

</script>

<?php
include("../seguridad/seguridad.php");
include("../seguridad/connection_db.php");

if ($_POST['valor'] == "oferta_interna") {

    global $conexion;


    //variables para registrar prueba
    $empresa = $_POST['empresa'];
    $r_vacante = $_POST['r_vacante'];
    $can_aprendices = $_POST['can_aprendices'];
    $programa = $_POST['programa'];
    $especialidad = $_POST['especialidad'];
    $perfil_aspirante = $_POST['perfil_aspirante'];
    $observaciones = $_POST['observaciones_aspirante'];
    $modalidad = $_POST['modalidad'];


    $insertar_oferta = mysqli_query($conexion, "INSERT INTO VACANTE (`Id_empresa`, `Id_estado`, `Id_especialidad`, `Vacantes`, `F_publica`, `Desc_vacante`, `Remuneracion_vacante`, `Obser_vacante` , `Id_modalidad`)VALUES ('{$empresa}','6','{$especialidad}','{$can_aprendices}', now() ,'{$perfil_aspirante}','{$r_vacante}','{$observaciones}','{$modalidad}' )", $conexion);
    if (!$insertar_oferta) {
        die("Fallo la creación del registro." . mysqli_error());
    }

    //falta poner auditoria 
    ?>  
    <!--Limpiar Variables-->
    <script>
        $("#nombre").val("");
        $("#departamento").val("");
        $("#ciudad").val("");
        $("#nom_operativo").val("");
        $("#empresa").val("");
        $("#email").val("");
        $("#tel_operativo").val("");
        $("#dire_operativo").val("");
        $("#ext_operativo").val("");
        $("#can_aprendices").val("");
        $("#especialidad").val("");
        $("#perfil_aspirante").val("");
        $("#movil_operativo").val("");
        $("#programa").val("");
        $("#dir2").val("");
        $("#dir3").val("");
        $("#dir4").val("");
        $("#r_vacante").val("");
    </script>
    <div class="row" id= "response_n">
        <div class="alert alert-info alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>

            <h4><i class="icon fa fa-check"></i><b>Se creó satisfactoriamente el registro!</b></h4>
        </div>
    </div>



    <?php
} else if ($_POST['valor'] == "crear_empresa") {


//validad que los campos no esten vacios
    if ((isset($_POST['nom_empresa']) and ! empty($_POST['nom_empresa'])) AND ( isset($_POST['empresa_nit']) and ! empty($_POST['empresa_nit']))
            AND ( isset($_POST['empresa_nombre']) and ! empty($_POST['empresa_nombre'])) AND ( isset($_POST['empresa_apellido']) and ! empty($_POST['empresa_apellido'])) AND ( isset($_POST['tel_operativo']) and ! empty($_POST['tel_operativo'])) AND ( isset($_POST['movil_operativo']) and ! empty($_POST['movil_operativo']))
            AND ( isset($_POST['barrio']) and ! empty($_POST['barrio'])) AND ( isset($_POST['email']) and ! empty($_POST['email'])) AND ( isset($_POST['departamento']) and ! empty($_POST['departamento'])) AND ( isset($_POST['ciudad']) and ! empty($_POST['ciudad'])) AND ( isset($_POST['cedula_contacto']) and ! empty($_POST['cedula_contacto'])) AND ( isset($_POST['actividad_eco']) and ! empty($_POST['actividad_eco']))
            AND ( isset($_POST['caja_compe']) and ! empty($_POST['caja_compe'])) AND ( isset($_POST['empresa_usuario']) and ! empty($_POST['empresa_usuario'])) AND ( isset($_POST['empresa_clave']) and ! empty($_POST['empresa_clave'])) AND ( isset($_POST['dir2']) and ! empty($_POST['dir2'])) AND ( isset($_POST['dir3']) and ! empty($_POST['dir3'])) AND ( isset($_POST['dir4']) and ! empty($_POST['dir4']))) {

        $nombre = $_SESSION['users'];
        $f_soli2 = $_POST['f_soli2'];

        $nom_empresa = $_POST['nom_empresa'];
        $empresa_nit = $_POST['empresa_nit'];
        $empresa_nombre = $_POST['empresa_nombre'];
        $empresa_apellido = $_POST['empresa_apellido'];
        $cedula_contacto = $_POST['cedula_contacto'];
        $dire_operativo = $_POST['dire_operativo'];
        $tel_operativo = $_POST['tel_operativo'];
        $movil_operativo = $_POST['movil_operativo'];
        $email = $_POST['email'];
        $departamento = $_POST['departamento'];
        $ciudad = $_POST['ciudad'];
        $sector_eco = $_POST['sector_eco'];
        $actividad_eco = $_POST['actividad_eco'];
        $caja_compe = $_POST['caja_compe'];
        $empresa_usuario = $_POST['empresa_usuario'];
        $empresa_clave = $_POST['empresa_clave'];
        $password = md5($empresa_clave);
        $dir1 = $_POST['dir1'];
        $dir2 = $_POST['dir2'];
        $dir3 = $_POST['dir3'];
        $dir4 = $_POST['dir4'];
        $direccion = $dir2 . "#" . $dir3 . "-" . $dir4;
        $barrio = $_POST['barrio'];
        $tamano = $_POST['tamano'];
        $num_emple = $_POST['num_emple'];



//consulta Nit empresa
        $consulta_nit = "SELECT Nit FROM EMPRESAS WHERE Nit='$empresa_nit'";
        $datos_nit = mysqli_query($conexion, $consulta_nit) or die("no se ha podido ejecutar la consulta");
        $registro_nit = mysqli_fetch_assoc($datos_nit);
        $id_usu = $registro_nit['Nit'];

        if ($id_usu == '') {

            $insertar_docente = mysqli_query($conexion, "INSERT INTO USUARIOS (`Identificacion`,`Nombres`,`Apellidos`,`Id_perfil`,`Usuario`,`Password`,`Id_estado`,`F_creacion`) 
	VALUES ('{$cedula_contacto}','{$empresa_nombre}','{$empresa_apellido}','2','{$empresa_usuario}','{$password}','2','{$f_soli2}')");
            if (!$insertar_docente) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }


            $insertar_empresa = mysqli_query("INSERT INTO EMPRESAS (`Nit`, `Nombre_empresa`,`Nom_direccion`,`Direccion_empresa`,`Id_departamento`, `Id_ciudad`, `Id_sectoreconomico`, `Id_actividad_economica`, `Caja_compensacion`,`Identificacion`,`Id_tamano`,`Num_empleados`,`Barrio`) 
	  VALUES ('{$empresa_nit}','{$nom_empresa}','{$dir1}','{$direccion}','{$departamento}','{$ciudad}','{$sector_eco}','{$actividad_eco}','{$caja_compe}','{$cedula_contacto}','{$tamano}','{$num_emple}','{$barrio}')", $conexion);
            if (!$insertar_empresa) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            $insertar_tel = mysqli_query($conexion, "INSERT INTO TELEFONOS (`Identificacion`, `Telefono_usuario`,Id_telefono) 
	  VALUES ('{$cedula_contacto}','{$tel_operativo}','1')");
            if (!$insertar_tel) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            $insertar_tel2 = mysqli_query($conexion, "INSERT INTO TELEFONOS (`Identificacion`, `Telefono_usuario`,Id_telefono) 
	  VALUES ('{$cedula_contacto}','{$movil_operativo}','2')");
            if (!$insertar_tel2) {
                die("Fallo la creación del registro." . mysqli_error());
            }

            $insertar_mail = mysqli_query($conexion, "INSERT INTO MAILS (`Identificacion`, `Mail`) 
	  VALUES ('{$cedula_contacto}','{$email}')");
            if (!$insertar_mail) {
                die("Fallo la creación del registro." . mysqli_error());
            }




            //falta poner auditoria 
            ?> 
            <!--Limpiar Variables-->
            <script>
                $("#nom_empresa").val("");
                $("#empresa_nit").val("");
                $("#empresa_nombre").val("");
                $("#empresa_apellido").val("");
                $("#cedula_contacto").val("");
                $("#dire_operativo").val("");
                $("#tel_operativo").val("");
                $("#movil_operativo").val("");
                $("#email").val("");
                $("#departamento").val("");
                $("#ciudad").val("");
                $("#empresa_usuario").val("");
                $("#empresa_clave").val("");
                $("#tamano").val("");
                $("#sector_eco").val("");
                $("#actividad_eco").val("");
                $("#dir1").val("");
                $("#dir2").val("");
                $("#dir3").val("");
                $("#dir4").val("");
                $("#caja_compe").val("");
                $("#barrio").val("");
                $("#num_emple").val("");
            </script>
            <div class="row" id= "response_n">
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>Se creó satisfactoriamente el registro!</b></h4>
                </div>
            </div>
            <?php
        } else {
            ?>

            <div class="row" id= "response_n">
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>La empresa ingresada ya existe.</b></h4>
                </div>
            </div>


            <?php
        }
    }
} else if ($_POST['valor'] == "crear_proveedor") {

    if ((isset($_POST['empresa']) and ! empty($_POST['empresa'])) AND ( isset($_POST['t_documen']) and ! empty($_POST['t_documen']))
            AND ( isset($_POST['documento']) and ! empty($_POST['documento'])) AND ( isset($_POST['nom_proveedor']) and ! empty($_POST['nom_proveedor'])) AND ( isset($_POST['apellidos_proveedor']) and ! empty($_POST['apellidos_proveedor']))
            AND ( isset($_POST['telefono_proveedor']))
            AND ( isset($_POST['movil_proveedor']) and ! empty($_POST['movil_proveedor'])) AND ( isset($_POST['email']) and ! empty($_POST['email']) ) AND ( isset($_POST['estado']) and ! empty($_POST['estado']) )) {

        $nombre = $_SESSION['users'];
        $f_soli2 = $_POST['f_soli2'];

        $id_empresa = $_POST['empresa'];
        $tipo_documento = $_POST['t_documen'];
        $documento_proveedor = $_POST['documento'];
        $nom_proveedor = $_POST['nom_proveedor'];
        $apellidos_proveedor = $_POST['apellidos_proveedor'];
        $tel_proveedor= $_POST['telefono_proveedor'];
        $movil_proveedor = $_POST['movil_proveedor'];
        $email = $_POST['email'];
        $estado = $_POST['estado'];

        $trozo1 = explode("@", $email);
        $usuario = ($trozo1[0]);


//consulta documento proveedor
        $consulta_documento = "SELECT * FROM t_proveedores WHERE Documento = '$documento_proveedor'";
        $datos_documento = mysqli_query($conexion, $consulta_documento) or die("no se ha podido ejecutar la consulta");
        $registro_documento = mysqli_fetch_assoc($datos_documento);
        $id_proveedor = $registro_documento['Id_Proveedor'];
        
//$id_usu2= $registro_codigo['Id_usuario'];
//consulta tiltulos de estudiante
        
//        $consulta_titulo = "SELECT F_fin_practica FROM PRACTICAS WHERE Identificacion = '$Cedula' AND F_fin_practica = '0000-00-00'";
//        $datos_titulo = mysqli_query($conexion, $consulta_titulo) or die("no se ha podido ejecutar la consulta2" . mysqli_error());
//        $registro_titulo = mysqli_fetch_assoc($datos_titulo);
//        $conteo_titulo = mysqli_num_rows($datos_titulo);


        if ($id_proveedor == '') {
              $query = "INSERT INTO t_proveedores  (Id_Empresa, Tip_Documento, Documento, Nombres, Apellidos, Telefono, Celular, Email, Fecha_Registro, Estado ) VALUES ('{$id_empresa}', '{$tipo_documento}', '{$documento_proveedor}', '{$nom_proveedor}', '{$apellidos_proveedor}', '{$tel_proveedor}', '{$movil_proveedor}', '{$email}', now(), '{$estado}');";
              $insertar_proveedor = mysqli_query($conexion, $query);
            if (!$insertar_proveedor) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            //falta poner auditoria 
            ?> 
            <!--Limpiar Variables-->
            
            <script>
                $("#empresa").val("0");
                $("#t_documen").val("0");
                $("#documento").val("");
                $("#nom_proveedor").val("");
                $("#apellidos_proveedor").val("");
                $("#telefono_proveedor").val("");
                $("#movil_proveedor").val("");
                $("#email").val("");
                $("#estado").val("0");

            </script>
            <div class="row" id= "response_n">
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>Se creó satisfactoriamente el registro!</b></h4>
                </div>
            </div>
            <?php
        } else if ($id_proveedor == 1) {
            ?>

            <div class="row" id= "response_n">
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>El proveedor ya existe!!!</b></h4>
                </div>
            </div>


            <?php
        } else if ($conteo_titulo == 0) {

//inserta en la tabla de tiulo estudiante
            /* $insertar_especialidad = mysqli_query("INSERT INTO Titulo_estudiante (`Id_programa`,`Id_especialidad`,`Id_estudiante`,`F_creacion`,`Semestre`,`Jornada`,`Modalidad`) 
              VALUES ('{$programa}','{$especialidad}','{$id_usu2}',now(),'{$semestre}','{$jornada}','{$modalidad}')", $conexion);
              if (!$insertar_especialidad) {
              die("Fallo la creación del registro." . mysqli_error());
              }
             */
            ?>	
            <script>
                $("#nom_estudiante").val("");
                $("#cedula_estudiante").val("");
                $("#email").val("");
                $("#tel_estudiante").val("");
                $("#movil_estudiante").val("");
                $("#programa").val("");
                $("#especialidad").val("");
                $("#estudiante_clave").val("");
                $("#estado").val("");
                $("#semestre").val("");
                $("#jornada").val("");
                $("#modalidad").val("");
            </script>
            <div class="row" id= "response_n">
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>El proveedor ya existe!!!</b></h4>
                </div>
            </div>

            <?php
        }
    }else{ ?>             <div class="row" id= "response_n">
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>Hay campo vacio!!!</b></h4>
                </div>
            </div> <?php }
} else if ($_POST['valor'] == "crear_docente") {

    if ((isset($_POST['nom_docente']) and ! empty($_POST['nom_docente'])) AND ( isset($_POST['cedula_docente']) and ! empty($_POST['cedula_docente'])) AND ( isset($_POST['email']) and ! empty($_POST['email'])) AND ( isset($_POST['tel_docente']) and ! empty($_POST['tel_docente'])) AND ( isset($_POST['movil_docente']) and ! empty($_POST['movil_docente'])) AND ( isset($_POST['docente_clave']) and ! empty($_POST['docente_clave'])) AND ( isset($_POST['programa']) and ! empty($_POST['programa']))) {


        $nombre = $_SESSION['users'];
        $f_soli2 = $_POST['f_soli2'];

        $nom_docente = $_POST['nom_docente'];
        $apell_docente = $_POST['apell_docente'];
        $cedula_docente = $_POST['cedula_docente'];
        $email = $_POST['email'];
        $tel_docente = $_POST['tel_docente'];
        $movil_docente = $_POST['movil_docente'];
        $programa = $_POST['programa'];
        $docente_clave = $_POST['docente_clave'];
        $estado = $_POST['estado'];
        $tipo_documento = $_POST['t_documen'];
        $fecha_expedicion = $_POST['fecha_expe'];
        $fecha_nacimiento = $_POST['fecha_naci'];

        $trozo1 = explode("@", $email);
        $usuario = ($trozo1[0]);

//consulta cedula estudiante
        $consulta_codigo = "SELECT Identificacion FROM USUARIOS WHERE Identificacion='$cedula_docente'";
        $datos_codigo = mysqli_query($conexion, $consulta_codigo) or die("no se ha podido ejecutar la consulta");
        $registro_codigo = mysqli_fetch_assoc($datos_codigo);
        $id_usu = $registro_codigo['Identificacion'];




        if ($id_usu == '') {

            $insertar_docente = mysqli_query($conexion, "INSERT INTO USUARIOS (`Identificacion`,`Nombres`,`Apellidos`,`Id_perfil`,`Usuario`,`Password`,`Id_estado`,`F_creacion`,`Id_documento`,`F_exp_doc`,`Fecha_nacimiento`) 
VALUES ('{$cedula_docente}','{$nom_docente}','{$apell_docente}','3','{$usuario}','{$docente_clave}','{$estado}','{$f_soli2}','{$tipo_documento}','{$fecha_expedicion}','{$fecha_nacimiento}')");
            if (!$insertar_docente) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            $insertar_docente_mail = mysqli_query($conexion, "INSERT INTO MAILS (`Identificacion`,`Mail`) 
VALUES ('{$cedula_docente}','{$email}')");
            if (!$insertar_docente_mail) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            $insertar_docente_tel1 = mysqli_query($conexion, "INSERT INTO TELEFONOS (`Identificacion`,`Telefono_usuario`,Id_telefono) 
VALUES ('{$cedula_docente}','{$tel_docente}','1')");
            if (!$insertar_docente_tel1) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            $insertar_docente_tel1 = mysqli_query($conexion, "INSERT INTO TELEFONOS (`Identificacion`,`Telefono_usuario`,Id_telefono) 
VALUES ('{$cedula_docente}','{$movil_docente}','2')");
            if (!$insertar_docente_tel1) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            $insertar_docente_progra = mysqli_query($conexion, "INSERT INTO DOCENTES (`Id_docente`,`Id_programa`) 
VALUES ('{$cedula_docente}','{$programa}')");
            if (!$insertar_docente_progra) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }
            ?> 
            <!--Limpiar Variables-->
            <script>
                $("#nom_docente").val("");
                $("#apell_docente").val("");
                $("#cedula_docente").val("");
                $("#email").val("");
                $("#tel_docente").val("");
                $("#movil_docente").val("");
                $("#programa").val("");
                $("#docente_clave").val("");
            </script>

            <div class="row" id= "response_n">
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>Se creó satisfactoriamente el registro!</b></h4>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row" id= "response_n">
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>No se puede crear el docente ya exite un registro.</b></h4>
                </div>
            </div>
            <?php
        }
    }
} else if ($_POST['valor'] == "crear_grupo") {



    $nombre = $_SESSION['users'];
    $f_soli2 = $_POST['f_soli2'];
    $programa = $_POST['programa'];
    $identificacion = $_POST['id_docente'];

//Genera codigo para grupo
    $codigo1 = rand(10, 99);

    $DesdeLetra = "A";
    $HastaLetra = "Z";
    $DesdeLetra2 = "A";
    $HastaLetra2 = "Z";
    $DesdeNumero = 1;
    $HastaNumero = 10000;

    $letraAleatoria = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
    $letraAleatoria2 = chr(rand(ord($DesdeLetra2), ord($HastaLetra2)));
    $id_proveedorAleatorio = rand($DesdeNumero, $HastaNumero);

    $rando_grupo = $letraAleatoria . $letraAleatoria2 . $id_proveedorAleatorio;

    if ($programa != '' && $identificacion != '') {



//consulta cedula estudiante
        $consulta_grupos = "SELECT Identificacion FROM GRUPO WHERE Identificacion='$identificacion' and F_cierre_grupo='0000-00-00'";
        $datos_grupos = mysqli_query($conexion, $consulta_grupos) or die("no se ha podido ejecutar la consulta");
        $registro_grupos = mysqli_fetch_assoc($datos_grupos);
        $conteo_grupo = mysqli_num_rows($datos_grupos);
//$id_grupo= $registro_grupos['Codigo_grupo'];




        if ($conteo_grupo < '2') {

            $insertar_grupo = mysqli_query($conexion, "INSERT INTO GRUPO (`Identificacion`, `F_creacion_grupo`) 
VALUES ('{$identificacion}',now())");
            if (!$insertar_grupo) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }
            ?> 
            <!--Limpiar Variables-->
            <script>
                $("#programa").val("");
                $("#id_docente").val("");
            </script>

            <div class="row" id= "response_n">
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>Se creó satisfactoriamente el Grupo</b></h4>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row" id= "response_n">
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>No se puede crear mas grupos maximo 2 por semestre.</b></h4>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="row" id= "response_n">
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4><i class="icon fa fa-check"></i><b>Seleccione los campos obligatorios</b></h4>
            </div>
        </div>
        <?php
    }
} else if ($_POST['valor'] == "subir_masivo") {


    $ruta = "../uploads/"; //ruta carpeta
    $uploadfile_temporal = $_FILES['archivo']['tmp_name'];
    $uploadfile_nombre = $ruta . 'solicitud' . '.xlsx';

    if (is_uploaded_file($uploadfile_temporal)) {
        move_uploaded_file($uploadfile_temporal, $uploadfile_nombre); // se nueve el archivo

        if (file_exists("uploads/solicitud.xls")) {  //verifica si el archivo exoste
            //echo '<div style="color:#009900;font-weight:bold">El archivo se subió correctamente</div>';
        }
    } else {
        echo '<div style="color:#FF0000;font-weight:bold">Error al subir el archivo, intentelo de nuevo</div>';
    }


    require_once '../seguridad/PHPExcel/Classes/PHPExcel.php';

    $archivo = $ruta . 'solicitud' . '.xlsx';
    $inputFileType = PHPExcel_IOFactory::identify($archivo);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($archivo);
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();


    for ($i = 2; $i <= $highestRow; $i++) {

        $tipo_documento = $sheet->getCell("A" . $i)->getValue();
        $cedula = $sheet->getCell("B" . $i)->getValue();
        $nombres = $sheet->getCell("C" . $i)->getValue();
        $apellidos = $sheet->getCell("D" . $i)->getValue();
        $telefono = $sheet->getCell("E" . $i)->getValue();
        $celular = $sheet->getCell("F" . $i)->getValue();
        $email = $sheet->getCell("G" . $i)->getValue();
        $especialidad = $sheet->getCell("H" . $i)->getValue();
        $estado_m = $sheet->getCell("I" . $i)->getValue();
        $semestre = $sheet->getCell("J" . $i)->getValue();
        $jornada = $sheet->getCell("K" . $i)->getValue();
//$mod = $sheet->getCell("L".$i)->getValue();
//trae la cedula si existe
        $consulta_cedula = "SELECT Identificacion FROM USUARIOS WHERE Identificacion = '$cedula'";
        $resul_cedula = mysqli_query($conexion, $consulta_cedula);
        $num_cedula = mysqli_fetch_array($resul_cedula);

//trae codigo programa
        $consulta_idprograma = "SELECT Id_programa FROM ESPECIALIDAD WHERE Id_especialidad = '$especialidad'";
        $resul_idprograma = mysqli_query($conexion, $consulta_idprograma);
        $num_idprograma = mysqli_fetch_assoc($resul_idprograma);
        $id_programa = $num_idprograma['Id_programa'];

// si no existe se crea un nuevo usuario
        if ($num_cedula == '') {

            $trozo1 = explode("@", $email);
            $usuario = ($trozo1[0]);
            $password = md5($cedula);

//inserta los usuarios
            $insertar_usuario = mysqli_query($conexion, "INSERT INTO USUARIOS (`Identificacion`,`Id_documento`,`Id_perfil`,`Nombres`,`Apellidos`,`Usuario`,`Password`,`F_creacion`,`Id_estado`) 
  VALUES ('{$cedula}','{$tipo_documento}','4','{$nombres}','{$apellidos}','{$usuario}','{$password}',now() ,'{$estado_m}' )");

            if (!$insertar_usuario) {
                die("No se puede crear el usuario, Error: " . mysqli_error($conexion));
            }


            $insertar_programa = mysqli_query($conexion, "INSERT INTO `ESTUDIANTES` (`Id_especialidad`, `Id_programa`, `Codigo_materia`, `Id_jornada`, `Id_modalidad`, `Id_semestre`, `Identificacion`) 
VALUES ('{$especialidad}','{$id_programa}','1','{$jornada}','{$jornada}','{$semestre}','{$cedula}')");
            if (!$insertar_programa) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            $insertar_docente_mail = mysqli_query($conexion, "INSERT INTO MAILS (`Identificacion`,`Mail`) 
VALUES ('{$cedula}','{$email}')");
            if (!$insertar_docente_mail) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            $insertar_docente_tel1 = mysqli_query($conexion, "INSERT INTO TELEFONOS (`Identificacion`,`Telefono_usuario`,`Id_telefono`) 
VALUES ('{$cedula}','{$telefono}','1')");
            if (!$insertar_docente_tel1) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }

            $insertar_docente_tel1 = mysqli_query($conexion, "INSERT INTO TELEFONOS (`Identificacion`,`Telefono_usuario`,`Id_telefono`) 
VALUES ('{$cedula}','{$celular}','2')");
            if (!$insertar_docente_tel1) {
                die("Fallo la creación del registro." . mysqli_error($conexion));
            }
            ?>
            <div class="row" id= "response_n">
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>Se creó satisfactoriamente el registro para la cedula <?php echo $cedula; ?></b></h4>
                </div>
            </div>
            <?php
        } else {

//consulta codigo estudiante
            $consulta_codigo = "SELECT Identificacion FROM USUARIOS WHERE Identificacion='$cedula'";
            $datos_codigo = mysqli_query($conexion, $consulta_codigo) or die("no se ha podido ejecutar la consulta1");
            $registro_codigo = mysqli_fetch_assoc($datos_codigo);
            $id_usu = $registro_codigo['Identificacion'];


            $consulta_titulo = "SELECT F_fin_practica FROM PRACTICAS WHERE Identificacion = '$cedula' AND F_fin_practica = '0000-00-00'";
            $datos_titulo = mysqli_query($conexion, $consulta_titulo) or die("no se ha podido ejecutar la consulta2" . mysqli_error($conexion));
            $registro_titulo = mysqli_fetch_assoc($datos_titulo);
            $conteo = mysqli_num_rows($datos_titulo);

            if ($conteo != 0) {
                ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4><i class="icon fa fa-check"></i><b>No se puede crear la practica del estudiante con cedula <?php echo $cedula; ?>debido a que no se ha cerrado otro ciclo de practicas.</b></h4>
                </div>
                </br>

                <?php
//echo "No se puede crear la practica del estudiante con cedula $cedula debido a que no se ha cerrado otro ciclo de practicas</br>";
            } else {

//inserta en la tabla de tiulo estudiante
                $insertar_programa = mysqli_query($conexion, "INSERT INTO `ESTUDIANTES` (`Id_especialidad`, `Id_programa`, `Codigo_materia`, `Id_jornada`, `Id_modalidad`, `Id_semestre`, `Identificacion`) 
VALUES ('{$especialidad}','{$id_programa}','1','{$jornada}','{$jornada}','{$semestre}','{$cedula}')");
                if (!$insertar_programa) {
                    die("Fallo la creación del registro." . mysqli_error($conexion));
                } else {
                    ?> 
                    <div class="row" id= "response_n">
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4><i class="icon fa fa-check"></i><b>Se ha creado la nueva practica para la cedula <?php echo $cedula; ?></b></h4>
                        </div>
                    </div>
                    </br>
                    <?php
                }
            }
            ?>
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4><i class="icon fa fa-check"></i><b>No se puede crear el usuario con cedula <?php echo $cedula; ?> porque la cedula ya existe.</b></h4>
            </div>
            </br>
            <?php
        }
    }
    ?>
    <script>
        $("#archivo").val("");
    </script>
    <?php
} else if ($_POST['valor'] == "insertar_estudiantes") {

    $codigo_grupo = $_POST["codigo_grupo_estu"];
    $ids = $_POST["ids"];
    foreach ($ids as $key => $value) {

//consulta estudiantes seleccionados
        $consulta_estudia_sele = "SELECT * FROM `ESTUDIANTES` WHERE Identificacion='$value'";
        $datos_estudia_sele = mysqli_query($conexion, $consulta_estudia_sele) or die("no se ha podido ejecutar la consulta");
        $resul_estudi_sele = mysqli_fetch_assoc($datos_estudia_sele);
        $id_estudian = $resul_estudi_sele['Identificacion'];

//inserta los estudiantes en el grupo
        $insertar_grupo = mysqli_query($conexion, "INSERT INTO `ASIGNAR_GRUPO` (`Codigo_grupo`, `Id_estudiante`) 
VALUES ('{$codigo_grupo}','{$id_estudian}')");
        if (!$insertar_grupo) {
            die("Fallo la creación del registro." . mysqli_error($conexion));
        }
    }
    ?>
    <div class="row" id= "response_n">
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4><i class="icon fa fa-check"></i><b>Se Ingresado los estudiantes al grupo <?php echo $codigo_grupo; ?></b></h4>
        </div>
    </div>
    </br>
    <?php
} else if ($_POST['valor'] == "subir_masivos") {


    $ruta = "../uploads/"; //ruta carpeta
    $uploadfile_temporal = $_FILES['archivo']['tmp_name'];
    $uploadfile_nombre = $ruta . 'solicitud' . '.xlsx';

    if (is_uploaded_file($uploadfile_temporal)) {

        move_uploaded_file($uploadfile_temporal, $uploadfile_nombre); // se nueve el archivo

        if (file_exists("uploads/solicitud.xlsx")) {  //verifica si el archivo existe
            echo '<div style="color:#009900;font-weight:bold">El archivo se subió correctamente</div>';
        }
//    } else {
//        echo '<div style="color:#FF0000;font-weight:bold">Error al subir el archivo, intentelo de nuevo</div>';
//    }
    require_once '../seguridad/PHPExcel/Classes/PHPExcel.php';

    $archivo = $ruta . 'solicitud' . '.xlsx';
    $inputFileType = PHPExcel_IOFactory::identify($archivo);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($archivo);
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
?>
    <div class="x_content">
    <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Tipo Documento</th>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Nombre Empresa</th>
                    <th>Nit Empresa</th>
                    <th>Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php
$i=1;
                // $objPHPExcel->getActiveSheet()->removeRow(3); remover una fila de formulario
                for ($i = 2; $i <= $numRows; $i++) {

                    $id_proveedor = $sheet->getCell("A" . $i)->getValue();
                    $tip_documento = $sheet->getCell("B" . $i)->getValue();
                    $documento = $sheet->getCell("C" . $i)->getValue();
                    $nombres = $sheet->getCell("D" . $i)->getValue();
                    $apellidos = $sheet->getCell("E" . $i)->getValue();
                    $telefono = $sheet->getCell("F" . $i)->getValue();
                    $celular = $sheet->getCell("G" . $i)->getValue();
                    $email = $sheet->getCell("H" . $i)->getValue();
                    $nom_empresa = $sheet->getCell("I" . $i)->getValue();
                    $nit_empresa = $sheet->getCell("J" . $i)->getValue();
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
                            <p id="resul_cc_<?php echo $i; ?>">   <?php echo $tip_documento; ?></p> </td>

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
                            <p id="resul_cc_<?php echo $i; ?>">   <?php echo $documento; ?></p> </td>
                        
                        
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
                            <p id="resul_cc_<?php echo $i; ?>">   <?php echo $nombres; ?></p> </td>
                                                
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
                            <p id="resul_nom_<?php echo $i; ?>"> <?php echo $apellidos; ?> </p></td>

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
                            <p id="resul_telefono_<?php echo $i; ?>"> <?php echo $telefono; ?> </p></td>



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
                                        <p id="resul_correo_<?php echo $i; ?>">   <?php echo $nom_empresa; ?> </p></td>
                        
                        <td>
                                        <script type="text/javascript">
                                            function update_correo() {
                                                var counter = $("#resul_nit_<?php echo $i; ?>").val();
                                                var cod_estu = $("#codigo_proveedor<?php echo $i ?>").val();
                                                var type_form = "update_correo_estu";
                                                $.ajax({
                                                    type: "POST",
                                                    url: "procesar/update_resul.php",
                                                    dataType: "html",
                                                    data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                                    success: function (response) {
                                                        $("#resul_nit_<? echo $i; ?>").text(response);
                                                    }
                                                })
                                            }
                                            setInterval(update_correo, 5000);
                                        </script>
                                        <p id="resul_correo_<?php echo $i; ?>">   <?php echo $nit_empresa; ?> </p></td>
                        
                        <td align="center">
                            <button type="submit" class="ver_estudian btn btn-primary" value="<? echo $id_proveedor; ?>" id="<?php echo $id_proveedor; ?>">Editar</button>
                        </td>
                    </tr>
                    <?php
$i=$i+1;
                }//fin de ofertas activas
                ?>                      
            </tbody>
        </table> 
        
    <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-5">
                <input name="valor" type="hidden" value="subir_masivos"/>
                <input name="f_soli2" type="hidden" value="<? echo $f_solicitud; ?>"/>
                <button id="soli_interno" type="submit" class="btn btn-success" role="button" name="valor" align="center">Guardar</button>
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
                    <div class="modal-body" id="employee_detail2">

                    </div>
                </div>
            </div>
        </div>
    <div id="response_n"></div>
 <?php   
        } else {
        echo '<div style="color:#FF0000;font-weight:bold">Error al subir el archivo, intentelo de nuevo</div>';
    }
 ?>
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
<?php
}
?>
