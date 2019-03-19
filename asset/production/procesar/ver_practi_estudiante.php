<?php
//select.php 
include("../seguridad/connection_db.php");
include("../seguridad/seguridad.php");

global $conexion;

// capturamos el id del estudiante
$id_estudiante = $_POST['estudiante'];


$consulta_estudiante = "SELECT * FROM USUARIOS WHERE Identificacion = '$id_estudiante'";
$resul_estudiante = mysqli_query($conexion, $consulta_estudiante);
$resul_nom_usu = mysqli_fetch_assoc($resul_estudiante);
$id_usuario = $resul_nom_usu['Identificacion'];

$consulta_ofertas = "SELECT Id_oferta,
		est.Desc_estado,
        Est_identificacion,
        F_oferta,
        Desc_oferta,
        Anexo_oferta,
        Observacion_oferta,
        F_baja_oferta
	FROM sistemas_sispraemu.estados est, sistemas_sispraemu.oferta_estudiante ofer
        INNER JOIN sistemas_sispraemu.usuarios usu ON usu.Identificacion = ofer.Est_identificacion
	WHERE ofer.Id_estado = est.Id_estado
		AND Est_identificacion = '$id_estudiante';";
$resul_ofertas = mysqli_query($conexion, $consulta_ofertas);

//consulta Estado
$consulta_estado = "SELECT * FROM ESTADOS WHERE Id_estado>'0' AND Id_estado<'4'";
$datos_estado = mysqli_query($conexion, $consulta_estado) or die("no se ha podido ejecutar la consulta");
?>  
<div class="container">
    <div class="x_content">
        <div class ="row">
            <div class="col-md-10">

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Identificación</th>
                            <th>Fecha Oferta</th>
                            <th>Descripción oferta</th>
                            <th>Anexo</th>
                            <th>Estado</th>
                            <th>Observación</th>
                            <th>Fecha baja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../seguridad/connection_db.php");
                        global $conexion;
                        $i = 1;

                        while ($row = mysqli_fetch_array($resul_ofertas)) {
                            $Id_oferta = $row['Id_oferta'];
                            $Est_identificacion = $row['Est_identificacion'];
                            $F_oferta = $row['F_oferta'];
                            $Desc_oferta = $row['Desc_oferta'];
                            $Anexo_oferta = $row['Anexo_oferta'];
                            $Desc_estado = $row['Desc_estado'];
                            $Observacion_oferta = $row['Observacion_oferta'];
                            $F_baja_oferta = $row['F_baja_oferta'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo $Id_oferta; ?>    
                                </td>
                                <td><?php echo $Est_identificacion; ?> </td>
                                <td><?php echo $F_oferta; ?> </td>
                                <td><?php echo $Desc_oferta; ?> </td>
                                <td><?php echo $Anexo_oferta; ?> </td>
                                <td><?php echo $Desc_estado; ?> </td>
                                <td><?php echo $Observacion_oferta; ?> </td>
                                <td><?php echo $F_baja_oferta; ?> </td>
                            </tr>
                            <?php
                            $i = $i + 1;
                        }//fin de ofertas activas
                        ?>                      
                    </tbody>
                </table> 

                <div class="col-md-6 col-md-offset-5">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <br><br>
                    <div id="actualizar_soli" style="display:none" align="center"></div>

                </div>

                <script>
                    $("#error_vac").hide();
                </script>

            </div>
        </div>
    </div>
</div>
<div id="response_soli"></div>

