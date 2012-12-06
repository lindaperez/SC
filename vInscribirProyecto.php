<?php
/*
 * Solo los estudiantes pueden inscribirse en un proyecto
*/
require "cAutorizacion.php";
include_once("vHeader.php");
if  (!periodoInscripcion($conexion) AND !isExtemp($_SESSION['USBID'])){
        echo "<center><br><br>";
	echo "<span class='parrafo'>Disculpe, no se pueden realizar inscripciones en este momento. Verifique en www.cctds.dex.usb.ve</span></center>";

}else{
include "cInscribirProyecto.php";

$USBID = $_SESSION['USBID'];
$sql = "SELECT * FROM usuario u LEFT JOIN usuario_estudiante e ON (u.usbid=e.usbid_usuario) WHERE usbid='$USBID'";
$resultado = ejecutarConsulta($sql, $conexion);
while ($row = obtenerResultados($resultado))
	$ESTUDIANTE = $row;

if(empty($ESTUDIANTE['estudiante_sede'])){
?>
<script>
window.location.href='vActualizarDatosEstudiante.php?actualizar_para_inscribir=1';
</script>
<?
	exit;
}

$TITLE = 'Inscribir Proyecto - SERVICIO COMUNITARIO'; 
include_once("vHeader.php");

//-----------------SE VERIFICA QUE EL ESTUDIANTE NO ESTE INSCRITO EN ALGUN PROYECTO-----------//
if ($_SESSION[tipo]=="pregrado" and isset($_SESSION[inscrito])  and $_SESSION[inscrito]) {
	echo "<center><br><br>";
	echo "<span class='parrafo'>Usted ya está inscrito en un proyecto. Si desea cambiarse de Proyecto debe acudir a la CCTDS</span></center>";

}else{
?>

    <script language="javascript" src="cVerifInscrip.js"></script>
    <form name="datos" id="datos" action="cAgregarInscripcion.php?tok=<?=$_SESSION[csrf]?>" method="post" enctype="multipart/form-data">
    <table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="5" class="parrafo">
        <tr>
            <td colspan="4"><p align="center" class="titular_negro"><strong>PLANILLA DE INSCRIPCI&Oacute;N ESTUDIANTIL DEL PROYECTO DE SERVICIO COMUNITARIO</strong><br />
                <span class="buscador">(<span class="rojo">*</span>) campos obligatorios</span> <br />
                <span class="buscador"> </span> </p></td>
            </tr>
        <tr>
            <td width="14%">&nbsp;</td>
            <td width="13%">&nbsp;</td>
            <td width="26%" class="parrafo"><div align="right"><br />Fecha Actual:</div></td>
            <td width="47%" class="parrafo"><b><br /><? echo date('d-m-Y'); ?></b></td>
        </tr>

            <tr class="parrafo">
            <td width="14%" >
                    <strong><br />Per&iacute;odo</strong>:</td>
            <td colspan="4"><br /> <select class="parrafo" name="trimestre">
            <option value="Enero-Marzo">Enero-Marzo</option>
            <option value="Abril-Julio">Abril-Julio</option>
            <option value="Septiembre-Diciembre">Septiembre-Diciembre</option>
            </select>
            <select class="parrafo" name="anio">
            <option value="<?=date('Y')?>" selected> <?=date('Y')?> </option>
            <option value="<?=date('Y')+1?>"> <?=date('Y')+1?> </option>	
            </select>

            </td>


        </tr>
        <tr>

            <td colspan="4"><p class="parrafo"><strong> <br /><br />DATOS DEL ESTUDIANTE</strong></p></td>
            </tr>
                    <tr>
                            <td colspan="2" valign="top" class="parrafo"><div align="right">USBID:</div></td>
                            <td colspan="2" class="parrafo"><b><?php echo $_SESSION['USBID'] ?></b></td>

                            </tr>

                <tr>
                <td colspan="2" valign="top" class="parrafo"><div align="right">Nombres:</div></td>
                    <td colspan="2" class="parrafo"><b><?=$_SESSION[nombres]?></b></td>
                </tr>

                <tr>
                <td colspan="2" valign="top" class="parrafo"><div align="right">Apellidos:</div></td>
                    <td colspan="2" class="parrafo"><b><?=$_SESSION[apellidos]?></b></td>
                </tr>

                <tr>
                <td colspan="2" valign="top" class="parrafo"><div align="right">C&eacute;dula de Identidad:</div></td>
                    <td colspan="2" class="parrafo"><b><?=$_SESSION[cedula]?></b></td>
                <input type="hidden" name="ci" value="<?=$_SESSION[cedula]?>">
                </tr>

                <tr>
                <td colspan="2" valign="top" class="parrafo"><div align="right">Carrera:</div></td>
                    <td colspan="2" class="parrafo"><b><?=$_SESSION[carrera]?></b></td>
                </tr>

                <tr>
                <td colspan="2" ><div align="right"><span class="rojo">*</span>Email secundario:</div></td>
                <td colspan="2" ><input name="email_sec" type="text" class="parrafo" value="<?php echo $ESTUDIANTE['email_sec'] ?>" />
                </td>
                </tr>

                <tr>
                <td colspan="2" ><div align="right"><span class="rojo">*</span>Tel&eacute;fono de Hab.:</div></td>
                <td colspan="2" ><input name="tlf_hab" type="text" class="parrafo" value="<?php echo $ESTUDIANTE['telf_hab'] ?>" /></td>
                </tr>

                <tr>
                <td colspan="2" ><div align="right"><span class="rojo">*</span>Tel&eacute;fono Celular:</div></td>
                <td colspan="2" ><input name="tlf_cel" type="text" class="parrafo" value="<?php echo $ESTUDIANTE['telf_cel'] ?>" /></td>
                </tr>

                <tr>
                <td colspan="2" ><div align="right"><span class="rojo">*</span>Direcci&oacute;n:</div></td>
                <td colspan="2" ><textarea name="dir" cols="40" rows="6" class="parrafo" ><?php echo $ESTUDIANTE['direccion'] ?></textarea></td>
                </tr>

        </tr>

        <tr>
            <td colspan="4" class="parrafo"><strong><br /><br />DATOS DEL PROYECTO</strong>
                    <input  TYPE="hidden" VALUE="<?=$_GET["id"]?>" NAME="id_proy" />
            </td>
            </tr>
        <tr>
            <td colspan="2" class="parrafo"><div align="right">Nombre del Proyecto:</div></td>
            <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][titulo];?></td>
        </tr>
        <tr>
            <td colspan="2" class="parrafo"><div align="right">C&oacute;digo:</div></td>
            <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][codigo];?></td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="parrafo"><div align="right">Comunidad:</div></td>
            <td colspan="2" class="parrafo"> <?=$_SESSION[proyecto][nombreC];?></td>
        </tr>
        <tr>
            <td colspan="4" class="parrafo"></td>
        </tr>
        <tr>
            <td colspan="2" class="parrafo"><div align="right"><strong>Representante de la Comunindad:</strong></div></td>
            <td colspan="2" class="parrafo"><? echo $_SESSION[proyecto][nombreR]." ".$_SESSION[proyecto][apellidoR];?></td>
        </tr>

        <tr>
            <td colspan="2" class="parrafo"><div align="right">Correo Electr&oacute;nico:</div></td>
            <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][emailR];?></td>
        </tr>
        <tr>
            <td colspan="4" class="parrafo"></td>
        </tr>
        <tr>
            <td colspan="2" class="parrafo"><div align="right"><span class="rojo">*</span><strong>Tutor Acad&eacute;mico:</strong></div></td>
            <td colspan="2" class="parrafo"> <select name="tutor" onchange="cambiar()">
            <? 
            if ($_SESSION[max_tutores]>=1){
                    echo "<option value='ninguno'>Seleccione</option> ";
                    for ($i=0;$i<$_SESSION[max_tutores];$i++){
                            echo "<option value='".$_SESSION[tutores][$i]["usbid"]."'> ";
                            echo $_SESSION[tutores][$i]["nombre"]." ".$_SESSION[tutores][$i]["apellido"];
                            echo "</option>";
                    }
            }

            ?>
            </select>
            </td>
        </tr>

        <tr>
            <td colspan="2" class="parrafo"><div align="right">Dependencia:</div></td>
            <td colspan="2" class="parrafo"><input type="text" name="dependencia" value="" disabled="true"></td>
        </tr>

        <tr>
            <td colspan="2" class="parrafo"><div align="right">Correo Electr&oacute;nico:</div></td>
            <td colspan="2" class="parrafo"><input type="text" name="emailT" value="" disabled="true"></td>
        </tr>
        <tr>
            <td colspan="4" class="parrafo"></td>
        </tr>
    <tr>
            <td colspan="2" class="parrafo"><div align="right"><strong>Organizaci&oacute;n de Desarrollo Social que promueve el proyecto:</strong> <br />(en caso de que aplique)</div></td>
            <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][nombreO];?></td>
        </tr>
        <tr>
            <td colspan="2" class="parrafo"><div align="right">Correo Electr&oacute;nico:</div></td>
            <td colspan="2" class="parrafo"><?=$_SESSION[proyecto][emailO];?></td>
        </tr>

        <tr>
            <td colspan="4" class="parrafo"></td>
        </tr>
        <tr>
            <td colspan="2" class="parrafo" valign="top"><div align="right"><span class="rojo">*</span><strong>OBJETIVOS ESPEC&Iacute;FICOS:</strong></div></td>
            <td colspan="2" class="direccion" align="justify">Enumere sus objetivos espec&iacute;ficos dentro del proyecto aprobado. Describa cual es su aporte personal dentro del mencionado proyecto. Si el proyecto involucra varias comunidades, especifique en cual comunidad trabajar&aacute; Ud. </td>
        </tr>
        <tr>
            <td colspan="4" class="parrafo" align="center">
            <textarea name="objetivos" cols="60" rows="6" class="parrafo" ></textarea></td>
        </tr>
        <tr>
            <td colspan="2" class="parrafo" valign="top"><div align="right"><strong>PLAN DE ACCI&Oacute;N:</strong></div></td>
            <td colspan="2" class="direccion" align="justify">Calendario detallado (por semana) indicando la fecha estimada de inicio y de fin, as&iacute; como las semanas que efectivamente trabajar&aacute; en el proyecto y las que no.  Llene la tabla modelo, use tantas l&iacute;neas como sea necesario.</td>
        </tr>
        <br /><br />


            <tr>
            <td colspan="4" >
                    <table id="tabla_actividades" border=0 class="parrafo">
                            <tr>
                                    <TD>Actividad<br/><br/><span class='rojo'>*</span><input type='text' name='actividad0' id="actividad" maxlength="254"></TD>
                                    <TD>Cronograma <br/>(Semana o Fecha)<br/><span class='rojo'>*</span><input type='text' name='fecha0'></TD>
                                    <TD>Horas acreditables<br/><br/><span class='rojo'>*</span><input type='text' name='horas0' size="3"> </TD>
                                    <TD><a href='javascript: eliminarAct(1)'><?=mostrarImagen('rechazar');?></a></TD>
                            </tr>
                    </table>  
            </td>
        </tr>
            <tr>
            <td colspan="4" class="parrafo" align="left">
                    <input type="button" class="parrafo" value="Agregar M&aacute;s Actividades" onClick="agregarAct();">
            </td>
        </tr>
            <tr>
            <td colspan="4" class="rojo" align="center"><br /><br />La planilla impresa debe ser firmada por el tutor, sellada por el departamento al cual pertenece el tutor y entregada en SEMANA 12 en la Coordinaci&oacute;n de Cooperaci&oacute;n T&eacute;cnica y Desarrollo Social. <br></td>
        </tr>
        <tr>
            <td colspan="4" class="parrafo" align="center">
        <br />
            <a href='javascript: verificar()'><?=mostrarImagen('enviar');?></a>
            </tr>
        </table>
        </td>
    </tr>
    </table>
    </form>

        <?php }?>
    
<?php } include_once('vFooter.php'); ?>


