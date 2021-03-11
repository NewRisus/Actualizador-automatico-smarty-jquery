<?php 
/**
 * jQuert :: Archivo para actualizar jquery
 *
 * @package New_Risus_Upgrade
 * @author Miguel92 
 * @copyright NewRisus 2021
 * @version v1.4 11-03-2021
 * @link https://newrisus.com
*/

include '../header.php';
$sp = DIRECTORY_SEPARATOR;
$theme 	= TS_ROOT."{$sp}themes{$sp}{$tsCore->settings['tema']['t_path']}{$sp}js";
$folder 	= "{$theme}{$sp}*";
$folder2 = "{$theme}{$sp}";

$jseses = array_filter(glob($folder), 'is_file');

$upgrade = isset($_POST['update']) ? $_POST['update'] : false;

# NPM
$url_npm = file_get_contents("https://cdn.jsdelivr.net/npm/jquery/");
if (preg_match('|<select class="versions">(.*?)</select>|is', $url_npm, $select_option)) {
	$last_extractor = explode("\n", $select_option[1]);
	$version_extractor = explode("@", $last_extractor[1]);
	$urlnpm = strip_tags($version_extractor[2]);
}

?>
<div class="container">
	<h3 class="m-0 text-center mb-4 py-0 fs-4">Actualizador de .JS para <?php echo $tsCore->settings['titulo']; ?></h3>
</div>
<div class="row mt-4">
<?php if(!$upgrade): ?>
   <div id="upgrade" class="col-xxl-10 col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12 offset-xxl-2 offset-xl-2 offset-lg-2 offset-md-2 offset-sm-0"></div>
	<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-10 col-sm-12 col-12 offset-xxl-2 offset-xl-2 offset-lg-2 offset-md-1 offset-sm-0" id="hide">
		<div class="hidden">
			<p class="text-muted">Este actualizador de archivos .js lograr&aacute; actualizar todas las funciones obsoletas de <b>Phpost Risus 1.x</b> y <b>New Risus 1.x</b>, lograr&aacute; actualizarlas a las m&aacute;s recientes y disponibles que existan al momento para <b>jQuery <?php echo $urlnpm; ?></b>.</p>
			<p>Se actualizar&aacute;n funciones tales como:</p>
			<p>De <code>.unbind()</code> a <code>.off()</code> # De <code>.bind()</code>/<code>.live()</code> a <code>.on()</code> # De <code>.size()</code> a <code>.length</code> # De <code>.attr(</code> a <code>.prop(</code></p>
			<div class="alert alert-warning border-0 p-1 text-center"> 
				<span class="small">Los subdirectorios de la carpeta "<b><?php echo $folder; ?></b>" no se actualizar&aacute;n!</span>
			</div>
			<hr>
			<p>Se han encontrado <b><?php echo count($jseses); ?></b> (contando jQuery) archivos totales en la carpeta "<b>js</b>" para actualizar!</p>
			<div class="text-danger small text-center py-1">Recuerda hacer una copia de seguridad de la carpeta JS de tu tema</div>
			<form action="" method="post" id="upgrade_js">
				<div class="form-check my-2">
				  	<input class="form-check-input" type="checkbox" name="previo" value="true" id="echo">
				  	<label class="form-check-label" for="echo">Ya había realizado una actualización con otro upgrade</label>
				</div>
				<input name="cont" value="true" type="hidden"/>
            <input type="hidden" name="type" value="jquery">
            <input type="hidden" name="last_version" value="<?php echo $urlnpm; ?>">
				<a href="javascript:upgrade.jquery()" class="btn iniciar btn-success btn-block text-white">Iniciar actualización</a>
			</form>
		</div>
		<div class="install text-center boxinfo my-5" style="display:none;">
			<span class="spinner-border my-3" style="width: 3rem; height: 3rem;" role="status" aria-hidden="true"></span>
			<span class="d-block">Gracias por usar el actualizador, el proceso puede tardar unos segundos y/o minutos, se paciente!</span>
		</div>
	</div>
<?php endif; ?>
</div>