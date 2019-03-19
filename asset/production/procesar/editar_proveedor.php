<?php
//select.php 
include("../seguridad/connection_db.php");
include("../seguridad/seguridad.php");

// capturamos el id del proveedor
$id_proveedor = $_POST['proveedor'];
$fila = $id_proveedor + 1;
require_once '../seguridad/PHPExcel/Classes/PHPExcel.php'; //Agregamos la librería

$ruta = "../uploads/"; //ruta carpeta

//Variable con el nombre del archivo
$archivo = $ruta . 'solicitud' . '.xlsx';
$objPHPExcel = PHPExcel_IOFactory::load($archivo);
$objPHPExcel->setActiveSheetIndex(0);
                    
$tip_documento = $objPHPExcel->getActiveSheet()->getCell('B' . $fila)->getCalculatedValue();
$documento = $objPHPExcel->getActiveSheet()->getCell('C' . $fila)->getCalculatedValue();
$nombres = $objPHPExcel->getActiveSheet()->getCell('D' . $fila)->getCalculatedValue();
$apellidos = $objPHPExcel->getActiveSheet()->getCell('E' . $fila)->getCalculatedValue();
$telefono = $objPHPExcel->getActiveSheet()->getCell('F' . $fila)->getCalculatedValue();
$celular =  $objPHPExcel->getActiveSheet()->getCell('G' . $fila)->getCalculatedValue();
$correo = $objPHPExcel->getActiveSheet()->getCell('H' . $fila)->getCalculatedValue();
$nom_empresa =  $objPHPExcel->getActiveSheet()->getCell('I' . $fila)->getCalculatedValue();
$nit_empresa = $objPHPExcel->getActiveSheet()->getCell('J' . $fila)->getCalculatedValue();
?>  

<script type="text/javascript">
    
    $(function () {
        $("#actualizar_solicitud").submit(function () {
            $.ajax({
                type: "POST",
                url: "procesar/save_edit_proveedor.php",
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
            <form id="actualizar_solicitud"  name="solicitar_oferta" novalidate method="post" class="form-horizontal form-label-left" >
                <div class="box-body">

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Tipo Documento<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tipo_documento" id="cedula" value = "<?php echo $tip_documento; ?>" required="required" autocomplete="off" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Documento<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="documento" id="cedula" value = "<?php echo $documento; ?>" required="required" autocomplete="off" maxlength="50">
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Nombres<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="proveedor_nombre" id="proveedor_nombre" value = "<?php echo $nombres; ?>" required="required" autocomplete="off" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Apellidos<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="apellidos" id="apellidos" value = "<?php echo $apellidos; ?>" required="required" autocomplete="off" maxlength="50">
                        </div>
                    </div>
                    
                    
                    <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Teléfono<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="telefono" id="correo" value = "<?php echo $telefono; ?>">
                            <div id="actualizar_solicitud_vacantes_errorloc" class="error_strings" align="left" required="required" autocomplete="off"></div>
                        </div>
                    </div>	
                    
                                        <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Celular<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="celular" id="correo" value = "<?php echo $celular; ?>">
                            <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" required="required" autocomplete="off"></div>
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
                        <label class="col-sm-3 col-form-label">Nombre Empresa<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nom_empresa" id="correo" value = "<?php echo $nom_empresa; ?>">
                            <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" required="required" autocomplete="off"></div>
                        </div>
                    </div>
                    
                                        <div class="form-group" style="margin-top:-8px;">
                        <label class="col-sm-3 col-form-label">Nit Empresa<span class="required">*:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nit" id="correo" value = "<?php echo $nit_empresa; ?>">
                            <div id='actualizar_solicitud_vacantes_errorloc' class='error_strings' align="left" required="required" autocomplete="off"></div>
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
                        <input type="hidden" name="fila" value="<?php echo $fila; ?>"/>
                        <input name="valor" type="hidden" value="actualiza_soli"/>
                        <button type="submit" class="btn btn-primary" id="subirF">Actualizar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <br><br>
                        <div id="actualizar_soli" style="display:none" align="center"></div>

                    </div>
                </div>
                <input type="hidden" name="valor" value="save_proveedor">
            </form>

            <script>
                $("#error_vac").hide();
            </script>

        </div>
    </div>
</div>
<div id="response_soli"></div>

