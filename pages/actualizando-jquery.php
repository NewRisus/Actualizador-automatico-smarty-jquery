<?php 
/**
 * Actualizando jQuery :: Archivo para ejecutar funciones sin recargar
 *
 * @package New_Risus_Upgrade
 * @author Miguel92 
 * @copyright NewRisus 2021
 * @version v1.0 23-02-2021
 * @link https://newrisus.com
*/

$raiz = dirname(dirname(__DIR__));
$route = dirname(__DIR__);
if(!isset($_POST['previo'])):
	echo head('Actualizaci&oacute;n Realizada');
	echo '<div class="box-test">';
	foreach ($jseses as $clave => $valor) {
		if (strpos('jquery.min.js', basename($valor)) === false) {
			$file_contents = file_get_contents($valor);
			$file_contents = str_replace(
				[".live(", ".unbind(", ".bind(", ".size()", ".attr('checked')", ".autogrow()"],
				[".on(", ".off(", ".on(", ".length", ".prop('checked')", ""],
				$file_contents
			);
			file_put_contents($valor, $file_contents);
		}
	}
	echo '</div>';
endif;
//
# Reemplazar jQuery
echo '<div class="box-test">';
echo subhead('Actualizar: jQuery.min.js');
if(!@copy("{$route}/assets/js/jquery.min.js", "{$folder2}/jquery.min.js")) {
	echo verificar(false, "No se pudo reemplazar."); 
	$oops = true;
} else echo verificar(true, "Se reemplazó correctamente.");
echo '</div>';
if(!isset($_POST['previo'])):
	# Quitamos jQuery.color
	echo '<div class="box-test">';
	echo subhead('Actualizar: jQuery.color.js');
	if(!@copy("{$route}/update/upgrade_js/jquery.color.js", "{$folder2}/jquery.color.js")) {
		echo verificar(false, "No se pudo reemplazar."); 
		$oops = true;
	} else echo verificar(true, "Se reemplazó correctamente.");
	echo '</div>';
	# Quitamos jQuery.plugins
	echo '<div class="box-test">';
	echo subhead('Actualizar: jQuery.plugins.js');
	if(!@copy("{$route}/update/upgrade_js/jquery.plugins.js", "{$folder2}/jquery.plugins.js")) {
		echo verificar(false, "No se pudo reemplazar."); 
		$oops = true;
	} else echo verificar(true, "Se reemplazó correctamente.");
	echo '</div>';
	# Quitamos jQuery.tablednd
	echo '<div class="box-test">';
	echo subhead('Actualizar: jQuery.tablednd.js');
	if(!@copy("{$route}/update/upgrade_js/jquery.tablednd.js", "{$folder2}/jquery.tablednd.js")) {
		echo verificar(false, "No se pudo reemplazar."); 
		$oops = true;
	} else echo verificar(true, "Se reemplazó correctamente.");
	echo '</div>';

	unlink("{$folder2}cuentados.js");
	unlink("{$folder2}jquery.form.js");

	$archivo_cuenta = "{$folder2}/cuenta.js";
	#
	$quitar_linea_1 = file_get_contents($archivo_cuenta);
	$quitar_linea_1 = str_replace("if (typeof $.browser.msie != 'undefined' && $.browser.version == '6.0') $('li.local-file > div.mini-modal').html('<div class=\"dialog-m\"></div><span>Esta funciÃ³n no es compatible con su navegador</span>');","", $quitar_linea_1);
	file_put_contents($archivo_cuenta, $quitar_linea_1);
	# 
	$quitar_linea_2 = file_get_contents($archivo_cuenta);
	$quitar_linea_2 = str_replace("if ($.browser.opera) document.getElementById(frameId).onload = uploadCallback;
			else {
				if (window.attachEvent) document.getElementById(frameId).attachEvent('onload', uploadCallback);
				else document.getElementById(frameId).addEventListener('load', uploadCallback, false);
			}","\n		/* Modificado el día: ".date('d.m.Y')." */\n		if (window.attachEvent) document.getElementById(frameId).attachEvent('onload', uploadCallback);
			else document.getElementById(frameId).addEventListener('load', uploadCallback, false);\n", $quitar_linea_2);
	file_put_contents($archivo_cuenta, $quitar_linea_2);
endif;
echo '</div>';
# Creamos una ruta "url"
$url_base = "{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["HTTP_HOST"]}" . dirname(dirname($_SERVER["PHP_SELF"]));
?>
<p class="text-center py-4 small fw-bold text-success">Gracias por usar el actualizador.</p>
<a href="<?php echo $tsCore->settings['url']; ?>" class="btn btn-primary">Regresar a <?php echo $tsCore->settings['titulo']; ?></a>
<a class="btn btn-danger" href="<?php echo $url_base; ?>" role="button">Volver al inicio</a>