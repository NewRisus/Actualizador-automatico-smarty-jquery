<?php 
/**
 * Ajax :: Archivo para ejecutar funciones sin recargar
 *
 * @package New_Risus_Upgrade
 * @author Miguel92 
 * @copyright NewRisus 2021
 * @version v1.7 04-04-2021
 * @link https://newrisus.com
*/

$route = dirname(dirname(__DIR__));
if($_GET["script"] == 'phpost' && $_GET["script"] == 'newrisus') {
	include "{$route}/header.php";
} elseif($_GET["script"] == 'newrisus2') {
	include "{$route}/lib/header.php";
}

$action = htmlentities($_POST['type']);
$oops = FALSE;

function head($string) {
	return "<h3 class=\"m-0 py-2 fs-4 mt-4\">{$string}</h3>";
}
function subhead($string) {
	return "<span class=\"d-block\"><i class=\"bi bi-gear me-3\"></i> {$string}</span>";
}
function verificar($icon, $string) {
	$icono = ($icon) ? 'check-all' : 'slash-circle';
	$texto = ($icon) ? 'success' : 'danger';
	return "<p class=\"text-{$texto}\"><i class=\"bi bi-{$icono}\"></i> {$string}.</p>";
}

if(!isset($_POST['cont']) || empty($_POST['cont'])) echo "0: {$url_base}?ref=noreaden";
switch ($action) {
	case 'smarty':
		include 'actualizando-smarty.php';
	break;
	case 'jquery':
		$sp = DIRECTORY_SEPARATOR;
		$theme 	= ($_GET["script"] == 'newrisus2') ? TS_ROOT."{$sp}views{$sp}themes{$sp}{$tsCore->settings['tema']['t_path']}{$sp}js" : TS_ROOT."{$sp}themes{$sp}{$tsCore->settings['tema']['t_path']}{$sp}js";
		$folder 	= "{$theme}{$sp}*";
		$folder2 = "{$theme}{$sp}";
		$jseses = array_filter(glob($folder), 'is_file');
		include 'actualizando-jquery.php';
	break;
	
	default:
		// code...
	break;
}