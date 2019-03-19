<?php
include("../seguridad/seguridad.php");
include("../seguridad/connection_db.php");

if ($_POST['valor'] == "consulta_ofertas") {


    $empresa = $_POST["empresa"];
    $programa = $_POST["programa"];
    $especialidad = $_POST["especialidad"];
    $estado_oferta = $_POST["estado_oferta"];

//consulta ofertas activas
    $cadena1 = "SELECT * FROM `VACANTE` WHERE Id_estado='$estado_oferta' ";

    if ($empresa <> '') { //empresa
        $cadena2 = "AND Id_empresa ='$empresa'";
    }

    if ($especialidad <> '') { //especialidad
        $cadena3 = "AND Id_especialidad='$especialidad'";
    }

    @$cadenas = $cadena1 . $cadena2 . $cadena3;
    $consulta_refe2 = $cadenas;
    $datos_refe2 = mysqli_query($conexion, $consulta_refe2) or die("no se ha podido ejecutar la consulta");
    $conteo_personas = mysqli_num_rows($datos_refe2);

    $consulta_regi = $cadenas;
    $datos_regi = mysqli_query($conexion, $consulta_regi) or die("no se ha podido ejecutar la consulta");
    ?>

    <style type="text/css">

        #exp_excel {
            background: none;
            border: 0;
            color: inherit;
            /* cursor: default; */
            font: inherit;
            line-height: normal;
            overflow: visible;
            padding: 0;
            -webkit-user-select: none; /* for button */
            -webkit-appearance: button; /* for input */
            -moz-user-select: none;
            -ms-user-select: none;
        }

        img {
            width: 40px;
            height: 40px;
        }

    </style>

    <div class="x_content">
        <form action="procesar/exportar_ofertas.php" target="_blank" method="POST">
            <input type="hidden" value="<?php echo $empresa; ?>" name="empresa">
            <input type="hidden" value="<?php echo $programa; ?>" name="programa">
            <input type="hidden" value="<?php echo $especialidad; ?>" name="especialidad">
            <input type="hidden" value="<?php echo $estado_oferta; ?>" name="estado_oferta">
            <button type="submit" id="exp_excel"><img src="images/excel.png"></button> 
        </form>
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N̈́°</th>
                    <th>Empresa</th>
                    <th>Cantidad Aprendices</th>
                    <th>Remuneracion vacante</th>
                    <th>Fecha Solicitud</th>
                    <th>Programa</th>
                    <th>Especialidad</th>
                    <th>Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                while ($row = mysqli_fetch_array($datos_refe2)) {

                    $Id_oferta_empresa = $row['Id_vacante'];
                    $Id_empresa = $row['Id_empresa'];
                    $F_solicitud = $row['F_publica'];
                    //$Q_solicitud =$row['Q_solicitud'];
                    $Cantidad_aprendices = $row['Vacantes'];
                    //$Id_programa = $row['Id_programa'];
                    $Id_especialidad = $row['Id_especialidad'];
                    $Remuneracion_vacante = $row['Remuneracion_vacante'];

                    //trae datos de empresa
                    //consulta empresas 
                    $consulta_nom_empresa = "SELECT * FROM EMPRESAS WHERE Id_empresa='$Id_empresa'";
                    $datos_nom_empresa = mysqli_query($conexion, $consulta_nom_empresa) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_empresa = mysqli_fetch_assoc($datos_nom_empresa);
                    $nom_empresa = $resul_nom_empresa['Nombre_empresa'];


                    //Consulta nombre especialidad

                    $consulta_nom_especiali = "SELECT * FROM ESPECIALIDAD WHERE Id_especialidad='$Id_especialidad'";
                    $datos_nom_especiali = mysqli_query($conexion, $consulta_nom_especiali) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_especiali = mysqli_fetch_assoc($datos_nom_especiali);
                    $nom_especiali = $resul_nom_especiali['Desc_especialidad'];
                    $id_pro = $resul_nom_especiali['Id_programa'];

                    //Consulta nombre programa

                    $consulta_nom_programa = "SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$id_pro'";
                    $datos_nom_programa = mysqli_query($conexion, $consulta_nom_programa) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_programa = mysqli_fetch_assoc($datos_nom_programa);
                    $nom_programa = $resul_nom_programa['Desc_programa'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>    
                        </td>
                <input type="hidden" id ="codigo_oferta<?php echo $i; ?>" value="<?php echo $Id_oferta_empresa; ?>">
                <td><?php echo $nom_empresa; ?> </td>
                <td><?php echo $Cantidad_aprendices; ?> </td>
                <td><?php echo $Remuneracion_vacante; ?> </td>
                <td><?php echo $F_solicitud; ?> </td>
                <td><?php echo $nom_programa; ?> </td>
                <td><?php echo $nom_especiali; ?> </td>
                <td align="center"><button type="button" class="gestionar_s btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="<? echo $Id_oferta_empresa; ?>" id="<?php echo $Id_oferta_empresa; ?>" >Ver</button></td>

                </tr>
                <?php
                $i = $i + 1;
            }//fin de ofertas activas
            ?>                      
            </tbody>
        </table> 

        <div class="form-group">
            <div class="col-md-6 col-md-offset-5">
                <a class="btn btn-primary" href="filtros_oferta" id = "boton_atras" style="color: #fff;">Atras</a> 
            </div>
        </div>
    </div>    
    <script>
        $("#show").hide();
    </script>


    <div id="dataModal2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">GESTIONAR SOLICITUD</h4>
                </div>
                <div class="modal-body" id="employee_detail2">

                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {

            $(document).on('click', '.gestionar_s', function () {
                //$('#dataModal').modal();
                var empresa = $(this).attr("id");
                $.ajax({
                    url: "procesar/gestionar_solicitud.php",
                    method: "POST",
                    data: {empresa: empresa},
                    success: function (data) {
                        $('#employee_detail2').html(data);
                        $('#dataModal2').modal('show');
                    }
                });
            });
        });
    </script>



    <?php
} else if ($_POST['valor'] == "consulta_ofertas_fecha") {

    $fecha_desde = $_POST['fecha_desde'];
    $fecha_hasta = $_POST['fecha_hasta'];

    $fecha1 = explode("/", $fecha_desde);
    @$f1_uno = $fecha1[2];
    @$f1_dos = $fecha1[1];
    $f1_tres = $fecha1[0];
    $f_inicio = $f1_uno . "-" . $f1_tres . "-" . $f1_dos;


    $fecha2 = explode("/", $fecha_hasta);
    @$f2_uno = $fecha2[2];
    @$f2_dos = $fecha2[1];
    $f2_tres = $fecha2[0];
    $f_fin = $f2_uno . "-" . $f2_tres . "-" . $f2_dos;

//consulta ofertas activas
    $cadena1 = "SELECT * FROM `VACANTE` WHERE F_publica BETWEEN '$f_inicio' AND '$f_fin'";
    $datos_refe2 = mysqli_query($conexion, $cadena1) or die("no se ha podido ejecutar la consulta");
    ?>

    <style type="text/css">

        #exp_excel {
            background: none;
            border: 0;
            color: inherit;
            /* cursor: default; */
            font: inherit;
            line-height: normal;
            overflow: visible;
            padding: 0;
            -webkit-user-select: none; /* for button */
            -webkit-appearance: button; /* for input */
            -moz-user-select: none;
            -ms-user-select: none;
        }

        img {
            width: 40px;
            height: 40px;
        }

    </style>

    <div class="x_content">
        <!--<form action="procesar/exportar_ofertas.php" target="_blank" method="POST">
          <input type="hidden" value="<?php echo $empresa; ?>" name="empresa">
          <input type="hidden" value="<?php echo $programa; ?>" name="programa">
          <input type="hidden" value="<?php echo $especialidad; ?>" name="especialidad">
          <input type="hidden" value="<?php echo $estado_oferta; ?>" name="estado_oferta">
         <button type="submit" id="exp_excel"><img src="images/excel.png"></button> 
        </form>-->
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N̈́°</th>
                    <th>Empresa</th>
                    <th>Cantidad Aprendices</th>
                    <th>Remuneracion vacante</th>
                    <th>Fecha Solicitud</th>
                    <th>Programa</th>
                    <th>Especialidad</th>
                    <th>Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                while ($row = mysqli_fetch_array($datos_refe2)) {

                    $Id_oferta_empresa = $row['Id_vacante'];
                    $Id_empresa = $row['Id_empresa'];
                    $F_solicitud = $row['F_publica'];
                    //$Q_solicitud =$row['Q_solicitud'];
                    $Cantidad_aprendices = $row['Vacantes'];
                    //$Id_programa = $row['Id_programa'];
                    $Id_especialidad = $row['Id_especialidad'];
                    $Remuneracion_vacante = $row['Remuneracion_vacante'];

                    //trae datos de empresa
                    //consulta empresas 
                    $consulta_nom_empresa = "SELECT * FROM EMPRESAS WHERE Id_empresa='$Id_empresa'";
                    $datos_nom_empresa = mysqli_query($conexion, $consulta_nom_empresa) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_empresa = mysqli_fetch_assoc($datos_nom_empresa);
                    $nom_empresa = $resul_nom_empresa['Nombre_empresa'];


                    //Consulta nombre especialidad

                    $consulta_nom_especiali = "SELECT * FROM ESPECIALIDAD WHERE Id_especialidad='$Id_especialidad'";
                    $datos_nom_especiali = mysqli_query($conexion, $consulta_nom_especiali) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_especiali = mysqli_fetch_assoc($datos_nom_especiali);
                    $nom_especiali = $resul_nom_especiali['Desc_especialidad'];
                    $id_pro = $resul_nom_especiali['Id_programa'];

                    //Consulta nombre programa

                    $consulta_nom_programa = "SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$id_pro'";
                    $datos_nom_programa = mysqli_query($conexion, $consulta_nom_programa) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_programa = mysqli_fetch_assoc($datos_nom_programa);
                    $nom_programa = $resul_nom_programa['Desc_programa'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>    
                        </td>
                <input type="hidden" id ="codigo_oferta<?php echo $i; ?>" value="<?php echo $Id_oferta_empresa; ?>">
                <td><?php echo $nom_empresa; ?> </td>
                <td><?php echo $Cantidad_aprendices; ?> </td>
                <td><?php echo $Remuneracion_vacante; ?> </td>
                <td><?php echo $F_solicitud; ?> </td>
                <td><?php echo $nom_programa; ?> </td>
                <td><?php echo $nom_especiali; ?> </td>
                <td align="center"><button type="button" class="gestionar_s btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="<? echo $Id_oferta_empresa; ?>" id="<?php echo $Id_oferta_empresa; ?>" >Ver</button></td>

                </tr>
                <?php
                $i = $i + 1;
            }//fin de ofertas activas
            ?>                      
            </tbody>
        </table> 

        <div class="form-group">
            <div class="col-md-6 col-md-offset-5">
                <a class="btn btn-primary" href="filtros_oferta_fecha" id = "boton_atras" style="color: #fff;">Atras</a> 
            </div>
        </div>
    </div>    
    <script>
        $("#show").hide();
    </script>

    <div id="dataModal2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">GESTIONAR SOLICITUD</h4>
                </div>
                <div class="modal-body" id="employee_detail2">

                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {

            $(document).on('click', '.gestionar_s', function () {
                //$('#dataModal').modal();
                var empresa = $(this).attr("id");
                $.ajax({
                    url: "procesar/gestionar_solicitud.php",
                    method: "POST",
                    data: {empresa: empresa},
                    success: function (data) {
                        $('#employee_detail2').html(data);
                        $('#dataModal2').modal('show');
                    }
                });
            });
        });
    </script>
    <?php
} else if ($_POST['valor'] == "consulta_empresas") {


    $empresa = $_POST["empresa"];
    $departamento = $_POST["departamento"];
    $ciudad = $_POST["ciudad"];
    $estado_empresa = $_POST["estado_empresa"];

//consulta ofertas activas
    $cadena1 = "SELECT * FROM `EMPRESAS` 
 Left JOIN USUARIOS ON EMPRESAS.Identificacion=USUARIOS.Identificacion
 WHERE USUARIOS.Id_estado='$estado_empresa' ";


    if ($empresa <> '') { //empresa
        $cadena2 = "AND EMPRESAS.Id_empresa ='$empresa'";
    }

    if ($departamento <> '') { //departamento
        $cadena3 = "AND EMPRESAS.Id_departamento='$departamento'";
    }

    if ($ciudad <> '') { //ciudad
        $cadena4 = "AND EMPRESAS.Id_ciudad='$ciudad'";
    }

    @$cadenas = $cadena1 . $cadena2 . $cadena3 . $cadena4;
    $consulta_refe2 = $cadenas;
    $datos_refe2 = mysqli_query($conexion, $consulta_refe2) or die("no se ha podido ejecutar la consulta");
    $conteo_personas = mysqli_num_rows($datos_refe2);

    $consulta_regi = $cadenas;
    $datos_regi = mysqli_query($conexion, $consulta_regi) or die("no se ha podido ejecutar la consulta");
    ?>	

    <style type="text/css">

        #exp_excel {
            background: none;
            border: 0;
            color: inherit;
            /* cursor: default; */
            font: inherit;
            line-height: normal;
            overflow: visible;
            padding: 0;
            -webkit-user-select: none; /* for button */
            -webkit-appearance: button; /* for input */
            -moz-user-select: none;
            -ms-user-select: none;
        }

        img {
            width: 40px;
            height: 40px;
        }

    </style>

    <div class="x_content">
        <form action="procesar/exportar_empresas.php" target="_blank" method="POST">
            <input type="hidden" value="<?php echo $empresa; ?>" name="empresa">
            <input type="hidden" value="<?php echo $departamento; ?>" name="departamento">
            <input type="hidden" value="<?php echo $ciudad; ?>" name="ciudad">
            <input type="hidden" value="<?php echo $estado_empresa; ?>" name="estado_empresa">
            <button type="submit" id="exp_excel"><img src="images/excel.png"></button> 
        </form>

        <!--<form  action = "ver_empresa" method="post">-->
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N̈́°</th>
                    <th>Empresa</th>
                    <th>Nit</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>Fecha creaciòn</th>
                    <th>Estado</th>
                    <th>Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                while ($row = mysqli_fetch_array($datos_refe2)) {
                    $codigo_empresa = $row['Id_empresa'];
                    $Empresa = $row['Nombre_empresa'];
                    $Nit = $row['Nit'];
                    $F_creacion = $row['F_creacion'];
                    $Id_departamento = $row['Id_departamento'];
                    $Id_ciudad = $row['Id_ciudad'];
                    $Estado = $row['Id_estado'];


                    //Consulta nombre departamento 
                    $consulta_nom_departamento = "SELECT * FROM DEPARTAMENTO WHERE Id_departamento='$Id_departamento'";
                    $datos_nom_departamento = mysqli_query($conexion, $consulta_nom_departamento) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_departamento = mysqli_fetch_assoc($datos_nom_departamento);
                    $nom_departamento = $resul_nom_departamento['Desc_departamento'];

                    //Consulta nombre ciudad

                    $consulta_nom_ciudad = "SELECT * FROM CIUDAD WHERE Id_ciudad='$Id_ciudad'";
                    $datos_nom_ciudad = mysqli_query($consulta_nom_ciudad) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_ciudad = mysqli_fetch_assoc($datos_nom_ciudad);
                    $nom_ciudad = $resul_nom_ciudad['Desc_ciudad'];

                    //Consulta nombre Estado

                    $consulta_nom_estado = "SELECT * FROM ESTADOS WHERE Id_estado='$Estado'";
                    $datos_nom_estado = mysqli_query($conexion, $consulta_nom_estado) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_estado = mysqli_fetch_assoc($datos_nom_estado);
                    $nom_estado = $resul_nom_estado['Desc_estado'];
                    ?>

                    <tr>
                        <td>
                            <?php echo $i; ?>    
                        </td>
                        <td>
                            <input type="hidden" id ="codigo_empresa<?php echo $i; ?>" value="<?php echo $codigo_empresa; ?>">
                            <script type="text/javascript">
                                function update_presento() {
                                    var counter = $("#resul_presento_<?php echo $i; ?>").val();
                                    var cod_empresa = $("#codigo_empresa<?php echo $i ?>").val();
                                    var type_form = "update_empresa";
                                    $.ajax({
                                        type: "POST",
                                        url: "procesar/update_resul.php",
                                        dataType: "html",
                                        data: {counter: counter, cod_empresa: cod_empresa, type_form: type_form},
                                        success: function (response) {
                                            $("#resul_presento_<? echo $i; ?>").text(response);
                                        }
                                    })
                                }

                                setInterval(update_presento, 5000);

                            </script> 
                            <p id="resul_presento_<?php echo $i; ?>">
                                <?php echo $Empresa; ?>
                            </p> </td>
                        <td>
                            <script type="text/javascript">
                                function update_nit() {
                                    var counter = $("#resul_nit_<?php echo $i; ?>").val();
                                    var cod_empresa = $("#codigo_empresa<?php echo $i ?>").val();
                                    var type_form = "update_nit";
                                    $.ajax({
                                        type: "POST",
                                        url: "procesar/update_resul.php",
                                        dataType: "html",
                                        data: {counter: counter, cod_empresa: cod_empresa, type_form: type_form},
                                        success: function (response) {
                                            $("#resul_nit_<? echo $i; ?>").text(response);
                                        }
                                    })
                                }

                                setInterval(update_nit, 5000);

                            </script> 
                            <p id="resul_nit_<?php echo $i; ?>">
                                <?php echo $Nit; ?>
                            </p></td>
                        <td><?php echo $nom_departamento; ?> </td>
                        <td><?php echo $nom_ciudad; ?> </td>
                        <td><?php echo $F_creacion; ?> </td>
                        <td><?php echo $nom_estado; ?> </td>
                        <td align="center">
                            <button type="submit" class="ver_prueba btn btn-primary" value="<? echo $codigo_empresa; ?>" id="<?php echo $codigo_empresa; ?>">Editar</button>
                        </td>
                    </tr>


                    <?php
                    $i = $i + 1;
                }//fin de ofertas activas
                ?>                      


            </tbody>
        </table> 


        <div class="form-group">
            <div class="col-md-6 col-md-offset-5">
                <a class="btn btn-primary" href="filtros_empresa" id = "boton_atras" style="color: #fff;">Atras</a> 
            </div>
        </div>
    </div>    


    <div id="dataModal2" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">EDITAR EMPRESA</h4>
                </div>
                <div class="modal-body" id="employee_detail2">

                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {

            $(document).on('click', '.ver_prueba', function () {
                //$('#dataModal').modal();
                var empresa = $(this).attr("id");
                $.ajax({
                    url: "procesar/editar_empresa.php",
                    method: "POST",
                    data: {empresa: empresa},
                    success: function (data) {
                        $('#employee_detail2').html(data);
                        $('#dataModal2').modal('show');
                    }
                });
            });
        });
    </script>

    <script>
        $("#show").hide();
    </script>		

    <?php
} else if ($_POST['valor'] == "consulta_proveedores") {

    $acuerdo = $_POST["acuerdo"];
    $empresa = $_POST["empresa"];
    $estado = $_POST["estado"];

    $query_proveedores = 


//consulta estudiantes
    $cadena1 = " SELECT * FROM sistemas_sispraemu.t_proveedores AS prov
                INNER JOIN t_empresas AS emp ON prov.Id_Empresa = emp.Id_empresa
                INNER JOIN t_tip_documento AS tip ON prov.Tip_Documento = tip.Id_TipDocuemnto
                INNER JOIN t_acuerdo AS acuer ON prov.Respuesta_Solicitud = acuer.Id_Acuerdo
                INNER JOIN t_estados AS estad ON prov.Estado = estad.Id_Estado";

    if ($acuerdo  <> 0) { // Acuerdo
        $cadena2 = " AND prov.Respuesta_Solicitud = '$acuerdo'";
    }else{
        $cadena2 = "";
    }

    if ($empresa <> 0) { // Empresa
        $cadena3 = " AND prov.Id_Empresa = '$empresa'";
    }else{
        $cadena3 = "";
    }


    if ($estado <> 0) { // Estado
        $cadena4 = " AND prov.Estado = '$estado'";
    }else{
        $cadena4 = "";
    }



    $query = $cadena1 . $cadena2 . $cadena3 . $cadena4;
    $datos_proveedores = mysqli_query($conexion, $query) or die("no se ha podido ejecutar la consulta");
    $conteo_proveedores = mysqli_num_rows($datos_proveedores);

    ?>	
    <style type="text/css">

        #exp_excel {
            background: none;
            border: 0;
            color: inherit;
            /* cursor: default; */
            font: inherit;
            line-height: normal;
            overflow: visible;
            padding: 0;
            -webkit-user-select: none; /* for button */
            -webkit-appearance: button; /* for input */
            -moz-user-select: none;
            -ms-user-select: none;
        }

        img {
            width: 40px;
            height: 40px;
        }

    </style>

    <div class="x_content">
        <form action="procesar/exportar_estudiantes.php" target="_blank" method="POST">
            <input type="hidden" value="<?php echo $acuerdo; ?>" name="programa">
            <input type="hidden" value="<?php echo $acuerdo; ?>" name="especialidad">
            <input type="hidden" value="<?php echo $acuerdo; ?>" name="estado_estudiante">
            <input type="hidden" value="<?php echo $acuerdo; ?>" name="estado_practica">
            <button type="submit" id="exp_excel"><img src="images/excel.png"></button> 
        </form>
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Empresa</th>
                    <th>Tipo Documento</th>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Estado Acuerdo</th>
                    <th>Estado Proveedor</th>
                    <th>Fecha Registro</th>
                    <th>Gestionar</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

             while ($row = mysqli_fetch_array($datos_proveedores)) {
                    $id_proveedor = $row['Id_Proveedor'];
                    $empresa = $row['Nombre_empresa'];
                    $tipo_documento = $row['Desc_TipDocumento'];
                    $documento = $row['Documento'];
                    $nombres = $row['Nombres'];
                    $apellidos = $row['Apellidos'];
                    $telefono = $row['Telefono'];
                    $celular = $row['Celular'];
                    $mail = $row['Email'];
                    $acuerdo_Estado = $row['Desc_Acuerdo'];
                    $fecha_registro = $row['Fecha_Registro'];
                    $estado = $row['Desc_Estado'];


//                    //Consulta nombre programa
//
//                    $consulta_nom_programa = "SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$programa'";
//                    $datos_nom_programa = mysqli_query($conexion, $consulta_nom_programa) or die("no se ha podido ejecutar la consulta");
//                    $resul_nom_programa = mysqli_fetch_assoc($datos_nom_programa);
//                    $nom_programa = $resul_nom_programa['Desc_programa'];
//
//                    //Consulta nombre especialidad
//
//                    $consulta_nom_especiali = "SELECT * FROM ESPECIALIDAD WHERE Id_especialidad='$especialidad'";
//                    $datos_nom_especiali = mysqli_query($conexion, $consulta_nom_especiali) or die("no se ha podido ejecutar la consulta");
//                    $resul_nom_especiali = mysqli_fetch_assoc($datos_nom_especiali);
//                    $nom_especiali = $resul_nom_especiali['Desc_especialidad'];
//
//                    //Consulta Estado practica
//
//                    if ($f_practica == "0000-00-00") {
//
//                        $etado_practica = "En proceso";
//                    } else {
//
//                        $etado_practica = "Terminado";
//                    }
//
//                    //Consulta nombre Estado
//
//                    $consulta_nom_estado = "SELECT * FROM ESTADOS WHERE Id_estado='$Estado'";
//                    $datos_nom_estado = mysqli_query($conexion, $consulta_nom_estado) or die("no se ha podido ejecutar la consulta");
//                    $resul_nom_estado = mysqli_fetch_assoc($datos_nom_estado);
//                    $nom_estado = $resul_nom_estado['Desc_estado'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>    
                        </td>
                        
                        <td>
                                    <script type="text/javascript">
                                        function update_empresa() {
                                            var counter = $("#resul_nom_<?php echo $i; ?>").val();
                                            var cod_estu = $("#codigo_proveed<?php echo $i ?>").val();
                                            var type_form = "update_empresa_proveed";
                                            $.ajax({
                                                type: "POST",
                                                url: "procesar/update_resul.php",
                                                dataType: "html",
                                                data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                                success: function (response) {
                                                    $("#resul_empresa_<? echo $i; ?>").text(response);
                                                }
                                            })
                                        }
                                        setInterval(update_empresa, 5000);
                                    </script>                             
                                    <p id="resul_empresa_<?php echo $i; ?>">   <?php echo $empresa; ?></p> 
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
                                            $("#resul_cc_<? echo $i; ?>").text(response);
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
                                            $("#resul_cc_<? echo $i; ?>").text(response);
                                        }
                                    })
                                }
                                setInterval(update_cedula, 5000);
                            </script>                             
                            <p id="resul_cc_<?php echo $i; ?>">   <?php echo $documento; ?></p> </td>


                        <td>
                            <input type="hidden" id ="codigo_estu<?php echo $i; ?>" value="<?php echo $id_proveedor; ?>">
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
                                            $("#resul_nom_<? echo $i; ?>").text(response);
                                        }
                                    })
                                }

                                setInterval(update_presento, 5000);

                            </script> 
                            <p id="resul_nom_<?php echo $i; ?>"> <?php echo $nombres; ?> </p></td>

                        <td>
                            <input type="hidden" id ="codigo_estu<?php echo $i; ?>" value="<?php echo $id_proveedor; ?>">
                            <script type="text/javascript">
                                function update_presento() {
                                    var counter = $("#resul_apell_<?php echo $i; ?>").val();
                                    var cod_estu = $("#codigo_estu<?php echo $i ?>").val();
                                    var type_form = "update_apell_estu";
                                    $.ajax({
                                        type: "POST",
                                        url: "procesar/update_resul.php",
                                        dataType: "html",
                                        data: {counter: counter, cod_estu: cod_estu, type_form: type_form},
                                        success: function (response) {
                                            $("#resul_apell_<? echo $i; ?>").text(response);
                                        }
                                    })
                                }

                                setInterval(update_presento, 5000);

                            </script> 
                            <p id="resul_apell_<?php echo $i; ?>"> <?php echo $apellidos; ?> </p></td>

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
                            <p id="resul_correo_<?php echo $i; ?>">   <?php echo $mail; ?> </p></td>
                        
                        <td><?php echo $acuerdo_Estado; ?> </td>
                        <td><?php echo $estado; ?> </td>
                        <td><?php echo $fecha_registro; ?> </td>
                        <td align="center">
                            <button type="submit" class="ver_practi btn btn-primary" value="<? echo $id_proveedor; ?>" id="<?php echo $id_proveedor; ?>">Ver</button>
                        </td>
                        <td align="center">
                            <button type="submit" class="ver_estudian btn btn-primary" value="<? echo $id_proveedor; ?>" id="<?php echo $id_proveedor; ?>">Editar</button>
                        </td>
                    </tr>
                    <?php
                    $i = $i + 1;
                }//fin de ofertas activas
                ?>                      
            </tbody>
        </table> 

            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                    <a class="btn btn-primary" href="filtros_estudiante" id = "boton_atras" style="color: #fff;">Atras</a> 
                </div>
            </div>
    </div>    


        <div id="dataModal2" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">EDITAR ESTUDIANTE</h4>
                    </div>
                    <div class="modal-body" id="employee_detail2">

                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function () {

                $(document).on('click', '.ver_estudian', function () {
                    //$('#dataModal').modal();
                    var estudiante = $(this).attr("id");
                    $.ajax({
                        url: "procesar/editar_estudiante.php",
                        method: "POST",
                        data: {estudiante: estudiante},
                        success: function (data) {
                            $('#employee_detail2').html(data);
                            $('#dataModal2').modal('show');
                        }
                    });
                });
            });
        </script>				

    <!--ver las practicas del estudiante-->
    <div id="dataModal3" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">OFERTAS ESTUDIANTE</h4>
                </div>
                <div class="modal-body" id="employee_detail3">

                </div>
            </div>
        </div>
    </div>					

    <script>
        $(document).ready(function () {

            $(document).on('click', '.ver_practi', function () {
                //$('#dataModal').modal();
                var estudiante = $(this).attr("id");
                $.ajax({
                    url: "procesar/ver_practi_estudiante.php",
                    method: "POST",
                    data: {estudiante: estudiante},
                    success: function (data) {
                        $('#employee_detail3').html(data);
                        $('#dataModal3').modal('show');
                    }
                });
            });
        });
    </script>			


    <script>
        $("#show").hide();
    </script>		

    <?php
} else if ($_POST['valor'] == "consulta_docentes") {

    $programa = $_POST["programa"];
    $estado_docente = $_POST["estado_docente"];

//consulta ofertas activas
    $cadena1 = "SELECT * FROM `USUARIOS` 
 Left JOIN DOCENTES ON USUARIOS.Identificacion=DOCENTES.Id_docente
 Left JOIN MAILS ON USUARIOS.Identificacion=MAILS.Identificacion
 WHERE USUARIOS.Id_perfil='3' and USUARIOS.Id_estado='$estado_docente' ";

    if ($programa <> '') { //empresa
        $cadena2 = "AND DOCENTES.Id_programa ='$programa'";
    }


    @$cadenas = $cadena1 . $cadena2;
    $consulta_refe2 = $cadenas;
    $datos_refe2 = mysqli_query($conexion, $consulta_refe2) or die("no se ha podido ejecutar la consulta1");
    $conteo_personas = mysqli_num_rows($datos_refe2);

    $consulta_regi = $cadenas;
    $datos_regi = mysqli_query($conexion, $consulta_regi) or die("no se ha podido ejecutar la consulta2");
    ?>  
    <style type="text/css">

        #exp_excel {
            background: none;
            border: 0;
            color: inherit;
            /* cursor: default; */
            font: inherit;
            line-height: normal;
            overflow: visible;
            padding: 0;
            -webkit-user-select: none; /* for button */
            -webkit-appearance: button; /* for input */
            -moz-user-select: none;
            -ms-user-select: none;
        }

        img {
            width: 40px;
            height: 40px;
        }

    </style>

    <div class="x_content">
        <form action="procesar/exportar_docentes.php" target="_blank" method="POST">
            <input type="hidden" value="<?php echo $programa; ?>" name="programa">
            <input type="hidden" value="<?php echo $estado_docente; ?>" name="estado_docente">
            <button type="submit" id="exp_excel"><img src="images/excel.png"></button> 
        </form>
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N̈́°</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cedula</th>
                    <th>Programa</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                while ($row = mysqli_fetch_array($datos_refe2)) {

                    $nom_docente = $row['Nombres'];
                    $apell_docente = $row['Apellidos'];
                    $cedu_docente = $row['Identificacion'];
                    $Id_programa_docen = $row['Id_programa'];
                    $email = $row['Mail'];
                    $Id_estado = $row['Id_estado'];
                    $codigo_docente = $row['Identificacion'];

                    //Consulta programa Nombre

                    $consulta_nom_programa = "SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$Id_programa_docen'";
                    $datos_nom_programa = mysqli_query($conexion, $consulta_nom_programa) or die("no se ha podido ejecutar la consulta3");
                    $resul_nom_programa = mysqli_fetch_assoc($datos_nom_programa);
                    $nom_programa = $resul_nom_programa['Desc_programa'];

                    //Consulta nombre Estado

                    $consulta_nom_estado = "SELECT * FROM ESTADOS WHERE Id_estado='$Id_estado'";
                    $datos_nom_estado = mysqli_query($conexion, $consulta_nom_estado) or die("no se ha podido ejecutar la consulta4");
                    $resul_nom_estado = mysqli_fetch_assoc($datos_nom_estado);
                    $nom_estado = $resul_nom_estado['Desc_estado'];
                    ?>
                    <tr>

                        <td>
                            <?php echo $i; ?>    
                        </td>
                        <td>
                            <input type="hidden" id ="codigo_docen<?php echo $i; ?>" value="<?php echo $codigo_docente; ?>">
                            <input type="hidden" id ="programa_docen<?php echo $i; ?>" value="<?php echo $Id_programa_docen; ?>">
                            <script type="text/javascript">
                                function update_nombre() {
                                    var counter = $("#resul_correo_<?php echo $i; ?>").val();
                                    var cod_docen = $("#codigo_docen<?php echo $i ?>").val();
                                    var type_form = "update_nombre_docen";
                                    $.ajax({
                                        type: "POST",
                                        url: "procesar/update_resul.php",
                                        dataType: "html",
                                        data: {counter: counter, cod_docen: cod_docen, type_form: type_form},
                                        success: function (response) {
                                            $("#resul_nombre_<? echo $i; ?>").text(response);
                                        }
                                    })
                                }
                                setInterval(update_nombre, 5000);
                            </script>
                            <p id="resul_nombre_<?php echo $i; ?>">
                                <?php echo $nom_docente; ?> </p></td>

                        <td>
                            <input type="hidden" id ="codigo_docen<?php echo $i; ?>" value="<?php echo $codigo_docente; ?>">
                            <input type="hidden" id ="programa_docen<?php echo $i; ?>" value="<?php echo $Id_programa_docen; ?>">
                            <script type="text/javascript">
                                function update_nombre() {
                                    var counter = $("#resul_correo_<?php echo $i; ?>").val();
                                    var cod_docen = $("#codigo_docen<?php echo $i ?>").val();
                                    var type_form = "update_apellido_docen";
                                    $.ajax({
                                        type: "POST",
                                        url: "procesar/update_resul.php",
                                        dataType: "html",
                                        data: {counter: counter, cod_docen: cod_docen, type_form: type_form},
                                        success: function (response) {
                                            $("#resul_apellido_<? echo $i; ?>").text(response);
                                        }
                                    })
                                }
                                setInterval(update_nombre, 5000);
                            </script>
                            <p id="resul_apellido_<?php echo $i; ?>">
                                <?php echo $apell_docente; ?> </p></td>						  

                        <td>
                            <script type="text/javascript">
                                function update_cc() {
                                    var counter = $("#resul_correo_<?php echo $i; ?>").val();
                                    var cod_docen = $("#codigo_docen<?php echo $i ?>").val();
                                    var type_form = "update_cc_docen";
                                    $.ajax({
                                        type: "POST",
                                        url: "procesar/update_resul.php",
                                        dataType: "html",
                                        data: {counter: counter, cod_docen: cod_docen, type_form: type_form},
                                        success: function (response) {
                                            $("#resul_cc_<? echo $i; ?>").text(response);
                                        }
                                    })
                                }
                                setInterval(update_cc, 5000);
                            </script>
                            <p id="resul_cc_<?php echo $i; ?>">  <?php echo $cedu_docente; ?></p> </td>

                        <td>
                            <script type="text/javascript">
                                function update_programa() {
                                    var counter = $("#resul_correo_<?php echo $i; ?>").val();
                                    var cod_docen = $("#codigo_docen<?php echo $i ?>").val();
                                    var programa_docen = $("#programa_docen<?php echo $i ?>").val();
                                    var type_form = "update_programa_docen";
                                    $.ajax({
                                        type: "POST",
                                        url: "procesar/update_resul.php",
                                        dataType: "html",
                                        data: {counter: counter, cod_docen: cod_docen, programa_docen: programa_docen, type_form: type_form},
                                        success: function (response) {
                                            $("#resul_programa_<? echo $i; ?>").text(response);
                                        }
                                    })
                                }
                                setInterval(update_programa, 5000);
                            </script>
                            <p id="resul_programa_<?php echo $i; ?>"> <?php echo $nom_programa; ?></p> </td>

                        <td><?php echo $email; ?> </td>
                        <td><?php echo $nom_estado; ?> </td>
                        <td align="center"><button type="button" class="edit_docen btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="<?php echo $codigo_docente; ?>">Editar</button></td>

                    </tr>
                    <?php
                    $i = $i + 1;
                }//fin de ofertas activas
                ?>                      
            </tbody>
        </table> 

        <div class="form-group">
            <div class="col-md-6 col-md-offset-5">
                <a class="btn btn-primary" href="filtros_docente" id = "boton_atras" style="color: #fff;">Atras</a> 
            </div>
        </div>
    </div>    

    <!--ver las practicas del estudiante-->
    <div id="dataModal3" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">EDITAR DOCENTE</h4>
                </div>
                <div class="modal-body" id="employee_detail3">

                </div>
            </div>
        </div>
    </div>          

    <script>
        $(document).ready(function () {

            $(document).on('click', '.edit_docen', function () {
                //$('#dataModal').modal();
                var estudiante = $(this).attr("id");
                $.ajax({
                    url: "procesar/editar_docente.php",
                    method: "POST",
                    data: {estudiante: estudiante},
                    success: function (data) {
                        $('#employee_detail3').html(data);
                        $('#dataModal3').modal('show');
                    }
                });
            });
        });
    </script>




    <script>
        $("#show").hide();
    </script>   

    <?php
} else if ($_POST['valor'] == "consulta_grupos") {

    $programa = $_POST["programa"];
    $id_docente = $_POST["id_docente"];
    $id_estado = $_POST["id_estado"];


    //consulta estudiantes
    $cadena1 = "SELECT * FROM `USUARIOS` Left JOIN GRUPO ON USUARIOS.Identificacion=GRUPO.Identificacion Left JOIN DOCENTES ON USUARIOS.Identificacion=DOCENTES.Id_docente WHERE  USUARIOS.Id_estado='2' and GRUPO.Codigo_grupo<>''";

    if ($programa <> '') { //programa
        $cadena2 = "AND DOCENTES.Id_programa ='$programa'";
    }

    if ($id_docente <> '') { //docente
        $cadena3 = "AND USUARIOS.Identificacion ='$id_docente'";
    }


    @$cadenas = $cadena1 . $cadena2 . $cadena3;
    $consulta_refe2 = $cadenas;
    $datos_refe2 = mysqli_query($conexion, $consulta_refe2) or die("no se ha podido ejecutar la consulta");
    $conteo_personas = mysqli_num_rows($datos_refe2);

    $consulta_regi = $cadenas;
    $datos_regi = mysqli_query($conexion, $consulta_regi) or die("no se ha podido ejecutar la consulta");
    ?>  
    <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N̈́°</th>
                    <th>Grupo</th>
                    <th>Docente</th>
                    <th>Total Estudiantes</th>
                    <th>Estado</th>
                    <th>Gestionar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                while ($row = mysqli_fetch_array($datos_refe2)) {

                    $Codigo_grupo = $row['Codigo_grupo'];
                    $nom_docente = $row['Nombres'];
                    $F_cierre = $row['F_cierre_grupo'];


                    //Consulta programa Nombre

                    $consulta_nom_programa = "SELECT * FROM PROGRAMA_ACADEMICO WHERE Id_programa='$Id_programa_docen'";
                    $datos_nom_programa = mysqli_query($conexion, $consulta_nom_programa) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_programa = mysqli_fetch_assoc($datos_nom_programa);
                    $nom_programa = $resul_nom_programa['Nom_programa'];

                    //Consulta nombre Estado

                    $consulta_nom_estado = "SELECT * FROM ESTADOS WHERE Id_estado='$Id_estado'";
                    $datos_nom_estado = mysqli_query($conexion, $consulta_nom_estado) or die("no se ha podido ejecutar la consulta");
                    $resul_nom_estado = mysqli_fetch_assoc($datos_nom_estado);
                    $nom_estado = $resul_nom_estado['Nom_estado'];

                    //Consulta estudiantes de grupo

                    $consulta_gr_estudian = "SELECT * FROM ASIGNAR_GRUPO WHERE Codigo_grupo='$Codigo_grupo'";
                    $datos_gr_estado = mysqli_query($conexion, $consulta_gr_estudian) or die("no se ha podido ejecutar la consulta");
                    $registro_gr_estudian = mysqli_num_rows($datos_gr_estado);

                    //Consulta Estado grupo

                    if ($F_cierre == "0000-00-00") {

                        $etado_practica = "En proceso";
                    } else {

                        $etado_practica = "Cerrado";
                    }
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>    
                        </td>
                        <td><?php echo $Codigo_grupo; ?> </td>
                        <td><?php echo $nom_docente; ?> </td>
                        <td><?php echo $registro_gr_estudian; ?> </td>
                        <td><?php echo $etado_practica; ?> </td>
                        <td align="center">
                            <script type="text/javascript">

                                $(function () {
                                    $("#edit_group<?php echo $i; ?>").submit(function () {
                                        $.ajax({
                                            type: "POST",
                                            url: "procesar/gestionar_grupo.php",
                                            dataType: "html",
                                            data: $(this).serialize(),
                                            beforeSend: function () {
                                                $("#loading_group").show();
                                            },
                                            success: function (response) {
                                                $("#response_alum").html(response);
                                                $("#loading_group").hide();
                                            }
                                        })
                                        return false;
                                    })
                                })
                            </script>


                            <input type="hidden" name="codigo_grupo" value="<?php echo $Codigo_grupo; ?>">
                            <input type="hidden" name="nom_docente" value="<?php echo $nom_docente; ?>">
                            <input type="hidden" name="estado_practica" value="<?php echo $estado_practica; ?>">
                            <input type="hidden" name="programa" value="<?php echo $programa; ?>">
                            <input type="hidden" name="grupo_docente" value="<?php echo $Id_grupo_docente; ?>">
                            <input type="hidden" name="valor" value="consulta_disponibles">
                        <td align="center"><button type="button" class="gestionar_group btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="<? echo $Codigo_grupo; ?>" id="<?php echo $Codigo_grupo; ?>" >Editar</button></td>


                    </tr>
                    <?php
                    $i = $i + 1;
                }//fin de ofertas activas
                ?>                      
            </tbody>
        </table> 

        <div class="form-group">
            <div class="col-md-6 col-md-offset-5">
                <a class="btn btn-primary" href="filtros_grupo" id = "boton_atras" style="color: #fff;">Atras</a> 
            </div>
        </div>                  
    </div>   
    <br>
    <br>
    <br> 
    <div id="loading_group" style="display:none;" align="center"> <img src="images/cargando.gif"/></div>
    <div id="response_alum" align="center"></div>

    <div id="dataModal_gr" class="modal fade bd-example-modal-lg" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">GESTIONAR GRUPO</h4>
                </div>
                <div class="modal-body" id="employee_detail_gr">

                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {

            $(document).on('click', '.gestionar_group', function () {
                //$('#dataModal').modal();
                var grup = $(this).attr("id");
                $.ajax({
                    url: "procesar/gestionar_grupo.php",
                    method: "POST",
                    data: {grup: grup},
                    success: function (data) {
                        $('#employee_detail_gr').html(data);
                        $('#dataModal_gr').modal('show');
                    }
                });
            });
        });
    </script> 

    <script>
        $("#show").hide();
    </script>   

    <?php
} else if ($_POST['valor'] == "consulta_estudiante") {

    echo '<table border=1><tr><td>Producto</td><td>Precio</td><td>Existencia</td></tr>';

    for ($i = 1; $i <= 5; $i++) {

        echo '<tr>';
        echo '<td>A</td>';
        echo '<td>B</td>';
        echo '<td>C</td>';
        echo '</tr>';

//		$sql = "INSERT INTO productos (nombre, precio, existencia) VALUES('$nombre','$precio','$existencia')";
//		$result = $mysqli->query($sql);
    }

    echo '<table>';
}
?>  

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script> 

