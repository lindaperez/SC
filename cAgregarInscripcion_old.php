<?
require "cAutorizacion.php";

$modo_depuracion=false;

//se insertan los datos de la inscripcion

$sql_temp="INSERT INTO inscripcion VALUES(".
"0, ".//id
"'$_POST[trimestre]', ". //periodo
"'$_POST[anio]', ". //anio
"'$_SESSION[USBID]', ".//usbid_estudiante
"'$_POST[id_proy]', ".//id_proy
"'$_POST[objetivos]', ".//objetivos
"now(),".//fecha inscrip... actual
"'$_POST[tutor]', ".//usbid del tutor
"'',".//fecha_fin_real
"'',".//observaciones
"' ',".//aprobado
"'0',".//horas acumuladas
"''".//culminacion validada
")";

if ($modo_depuracion) echo "$sql_temp<br>";
else $resultado=ejecutarConsulta($sql_temp, $conexion);

//se modifican los datos del estudiante no provistos por el CAS
$sql_temp="UPDATE usuario_estudiante SET ".
"email_sec='$_POST[email_sec]', ".
"telf_hab='$_POST[tlf_hab]', ".
"telf_cel='$_POST[tlf_cel]', ".
"direccion='$_POST[dir]' ".
"WHERE usbid_usuario='$_SESSION[USBID]'";

if ($modo_depuracion) echo "$sql_temp<br>";
else $resultado=ejecutarConsulta($sql_temp, $conexion);

//se obtiene el último id_inscripcion insertado

$sql_temp="SELECT max(id) as id FROM inscripcion";
if ($modo_depuracion) echo "$sql_temp<br>";
else{
	$resultado=ejecutarConsulta($sql_temp, $conexion);
	$fila=obtenerResultados($resultado);
	$id_ins=$fila[id];
}

//-------------------Datos de las actividades------------------//        
    $k = 0;
            // Cuento las actividades
        foreach ($_POST as $nombre_campo => $valor) {
        if ($nombre_campo == 'actividad' . $k) {
            $numero_actividades++;
            $k++;
        }
    }
    if ($modo_depuracion)
        echo "Numero Actividades= $numero_actividades<br>";

    for ($j = 0; $j < $numero_actividades; $j++) {

        $act = "actividad" . $j;
        $cro = "fecha" . $j;
        $hor = "horas" . $j;
        
            $sql = "INSERT INTO plan_inscripcion VALUES(" .
                    "'$id_ins', " . //id
                    "'$_POST[$act]', " . //actividad
                    "'$_POST[$cro]', " . //cronograma
                    "'$_POST[$hor]' " . //horas  
                    ")";
            if ($modo_depuracion) {
                echo "$sql<br>";
            }
            $resultado = ejecutarConsulta($sql, $conexion);
    }
    $sql2="SELECT * FROM plan_inscripcion WHERE id_inscripcion=$id_ins";
    $resultado = ejecutarConsulta($sql2, $conexion);
    $numero_actividades = 0;


if ($modo_depuracion) exit();
include("cVerifInscrito.php");

cerrarConexion($conexion);

	?>
	<script language="javascript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
        <script src="scripts/jqueryui/ui/jquery-impromptu.4.0.min.js"></script>
        <link href="scripts/jqueryui/ui/impromptu.css" rel="stylesheet" type="text/css" media="screen" />
        <body>
            <script>
            $.prompt('Su inscripci&oacute;n ha sido registrada satisfactoriamente.\n<br/>Debe completar &eacute;ste Proyecto en un lapso no menor a 90 d&iacute;as.\n<br/>Recuerde que su inscripci&oacute;n se har&aacute; efectiva cuando consigne todos los recuados ante la CCTDS.', 
            { buttons: { Ok: true}, show:'slideDown' , submit: function (e,v,m,f){  if (v) window.location="vListarOpciones.php" }  })
            </script>	
        </body>
