<?header('X-Content-Type-Options: nosniff'); 
session_unset();
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<title>Sistema para el Servicio Comunitario - CCTDS</title>

<link href="imagenes/estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
<td height="184" valign="bottom" style ="background-image:url(imagenes/top_ini.jpg); background-repeat:no-repeat;">
  </td>
  </tr>
  <tr>
    <td valign="top"></td>
  </tr>
  
  <tr>
  	<td align="center">	<h3 style="color:#06F">Bienvenido al Sistema de Pasant&iacute;as Empresariales de la USB</h3> </td>
  </tr>
  <tr>  <td align="center" class="parrafo">
<p><b>Estudiante,</b> este sistema te permite realizar la Inscripci&oacute;n, Documentaci&oacute;n, Formulaci&oacute;n y Culminaci&oacute;n de Pasant&iacute;as Empresariales.<br />

Debes mantener tu informaci&oacute;n de contacto actualizada, para que la Coordinaci&oacute;n de Cooperaci&oacute;n T&eacute;cnica y Desarrollo Social pueda comunicarse contigo.<br /><br />

<b>Profesores USB,</b> este sistema les permite realizar la Revisi&oacute;n de Planes de Trabajo, Asignaci&oacute;n de Notas y Consulta de Pasant&iacute;as Tutoreadas <br /><br />

<b>CCTDS,</b> este sistema le permite realizar Consultas Avanzadas y Reportes de utilidad para la comunidad USB entera.<br /></p>

<b> Empresa P&uacute;blica o Privada,</b> este sistema le permite solicitar pasantes, revisar el plan de trabajo y recibir anuncios de chalas y estudiantes interesados en hacer pasantías tanto largas, intermedias como cortas.<br><br>

<span class=rojo >SARTENEJAS</span>
<p style="color:#06F"><b>Si es miembro de la comunidad universitaria Sartenejas debe ingresar al sistema utilizando su USBID. 
<br/>
<a href="scriptcas-estudiante.php">Estudiante</a>
<a href="scriptcas-profesor.php">Profesor</a>
<a href="scriptcas-cctds.php">CCTDS</a>
<br>
<a href="scriptcas-departamento.php">Departamento</a>
<a href="scriptcas-coordinacion.php">Coordinacion</a>

    </b>
</p>
<span class=rojo >LITORAL</span>
<p style="color:#06F"><b>Si es miembro de la comunidad universitaria Litoral debe ingresar al sistema utilizando su USBID. 
<br/>
<a href="scriptcas-cctds-lit.php">coord-lit</a>
<br>
<a href="scriptcas-departamento-lit.php">Departamento</a>
<a href="scriptcas-coordinacion-lit.php">Coordinacion</a>
    </b>
</p>
 
    </td>
  </tr>
  <tr>
    <td valign="top"><? include_once "vBottom.php"; ?></td>
  </tr>
</table>

</body>
</html>
