<?php 
/**
 * Smarty :: Archivo para actualizar smarty
 *
 * @package New_Risus_Upgrade
 * @author Miguel92 
 * @copyright NewRisus 2021
 * @version v1.4 11-03-2021
 * @link https://newrisus.com
*/

include '../header.php';

if($db['hostname'] == 'dbhost') exit('<b>Script no instalado.</b>');

$alert = 0;
# Incluimos el archivo de smarty
if($_SERVER["TU_SCRIPT"] == 'newrisus'):
	$smarty = new ReflectionClass('smarty');
	$smarty = $smarty->getConstants();
	$v = explode('-', $smarty["SMARTY_VERSION"]);
	$version_now = $v[0];
else:
	$version_now = $smarty->_version;
endif;

if($version_now < '3.1.34') {
	$sm = 'Puedes actualizar';
	$smc = 'success';
} else if($version_now > '3.1.34') {
	$sm = 'Esta actualizada';
	$smc = 'danger';
	$alert = $alert + 1;
}
unset($smarty);

# Verificando que PHP sea compatible
if (version_compare(PHP_VERSION, '7.4.0') >= 0) {
	$MPsmarty = PHP_VERSION;
	$phc = 'info';
	$pm = 'es compatible';
} else {
	$alert = $alert + 1;
	$pm = 'no es compatible, debe ser superior';
	$phc = 'danger';
	$MPsmarty = phpversion();
}

if(strpos($tsCore->settings['version'], '1.2.6') !== false && strpos($tsCore->settings['version'], '1.2.7') !== false && strpos($tsCore->settings['version'], '1.3.0') !== false) {
	$script = $tsCore->settings['version'];
	$alert = $alert + 1;
} else $script = $tsCore->settings['version'];

$act = isset($_GET['version']) ? str_replace('_', '.', $_GET['version']) : '';

?>

<div class="install text-center" style="display:none;">
 	<span class="spinner-border" style="width: 3rem; height: 3rem;" role="status" aria-hidden="true"></span>
  	<span class="d-block">Estamos actualizando el script...Espera!</span>
</div>
<noscript>
   <div class="text-center py-4">
      <div class="alert alert-danger" role="alert">
         <span>Su Javascript no est&aacute; activado, por favor, instalelo o activelo.</span>
      </div>
   </div>
</noscript>

<div class="row mt-4">
<?php if(empty($act)): ?>
   <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-10 col-sm-12 col-12 offset-xxl-2 offset-xl-2 offset-lg-2 offset-md-1 offset-sm-0">
   	<div class="py-2">
   		<span class="small text-center text-success d-block">Esta modificaci&oacute;n fue creada para <b>Phpost Risus 1.x</b>, <b>New Risus 1.x</b>.</span>
   		<span class="text-info small d-block">Tu versión actual de Smarty es: <b><?php echo $version_now; ?></b> <i class="text-<?php echo $smc; ?>">(<?php echo $sm; ?>)</i></span>
   		<span class="text-<?php echo $phc; ?> small d-block">Tu version actual de PHP (<b><?php echo $MPsmarty; ?></b>) <?php echo $pm; ?>.</span>
   	</div>
   	<?php if($alert != '0'): ?>
   		<div class="small my-2 text-warning">Actualmente tienes <b><?php echo $alert; ?></b> advertencias del actualizador...</div>
   		<small class="d-block text-warning"></small>
   	<?php endif; ?>
               
	   <p>Selecciona que versión deseas instalar ahora:</p>
	   <div class="row rows-3">
			<div class="col">
				<div id="smarty36"<?php if('3.1.36' > $version_now): ?> onclick="location.href=global.url + '/<?php echo $_SERVER['TU_SCRIPT']; ?>/smarty/3_1_36'"<?php endif; ?> class="box rounded shadow d-flex justify-content-center align-items-center flex-column py-5">
					<i class="bi bi-cloud-upload"></i>
					<span class="text-white text-uppercase">Smarty 3.1.36</span>
				</div>
			</div>
			<div class="col">
				<div id="smarty37"<?php if('3.1.37' > $version_now): ?> onclick="location.href=global.url + '/<?php echo $_SERVER['TU_SCRIPT']; ?>/smarty/3_1_37'"<?php endif; ?> class="box rounded shadow d-flex justify-content-center align-items-center flex-column py-5">
					<i class="bi bi-cloud-upload"></i>
					<span class="text-white text-uppercase">Smarty 3.1.37</span>
				</div>
			</div>
			<div class="col">
				<div id="smarty39"<?php if('3.1.39' > $version_now): ?> onclick="location.href=global.url + '/<?php echo $_SERVER['TU_SCRIPT']; ?>/smarty/3_1_39'"<?php endif; ?> class="box rounded shadow d-flex justify-content-center align-items-center flex-column py-5">
					<i class="bi bi-cloud-upload"></i>
					<span class="text-white text-uppercase">Smarty 3.1.39</span>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
	<?php if($act == $version_now): ?>
   	<div class="col-xxl-10 col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12 offset-xxl-1 offset-xl-1 offset-lg-1 offset-md-2 offset-sm-0">
   		<div class="text-center text-danger py-5 fs-4">¿Creíste que podrías volver a instalar la actualización de: <br> <b class="text-uppercase">smarty <?php echo $act; ?></b>?</div>
   	</div>
   	<div class="my-3 text-center">
			<a class="btn btn-danger" href="<?php echo $url_base; ?>" role="button">Volver al inicio</a>
		</div>
	<?php elseif($act < $version_now): ?>
   	<div class="col-xxl-10 col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12 offset-xxl-1 offset-xl-1 offset-lg-1 offset-md-2 offset-sm-0">
   		<div class="text-center text-danger py-5 fs-4">Ya tienes una versión superior es:<br> <b class="text-uppercase">smarty <?php echo $version_now; ?></b></div>
   	</div>
   	<div class="my-3 text-center">
			<a class="btn btn-danger" href="<?php echo $url_base; ?>" role="button">Volver al inicio</a>
		</div>
	<?php else: ?>
	   <div id="upgrade" class="col-xxl-10 col-xl-10 col-lg-10 col-md-8 col-sm-12 col-12 offset-xxl-1 offset-xl-1 offset-lg-1 offset-md-2 offset-sm-0"></div>
	   <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 offset-xxl-3 offset-xl-3 offset-lg-3 offset-md-2 offset-sm-0" id="hide">
	   	<h4 class="fw-bold fs-3">Información</h4>
	   	<?php if(ALERT != 0): ?>
	   		<div class="alert alert-danger">Actualmente tienes <b><?php echo $navisos; ?></b> advertencias del actualizador...<br/>No es recomendable que instales la modificaci&oacute;n, aunque lo puedes hacer de igual manera.</div>
	   	<?php else: ?>
	   		<p>Hola <b><?php echo $tsUser->nick; ?></b>, Los creadores de esta modificaci&oacute;n no se hacen responsables en el caso de que instales mal la modificaci&oacute;n, existan fallos durante la instalaci&oacute;n y/o hayas comenzado a pesar de que el sistema te avis&oacute; de que no era compatible.</p>
	   		<p class="small text-muted m-0 p-0">Al hacer click en continuar aceptas los riesgos y asumes cualquier responsabilidad de ello.</p>
	   		<!-- <p><b class="d-block my-3 small">No olvides respaldar los archivos mencionados en el t&oacute;pic de NewRisus.</b></p> -->
	   		<div class="border-top border-light mt-4 py-2">
	            <form method="POST" id="smarty_install">
	            	<h4 class="fw-bold mt-3">Selecciona un modo de Smarty</h4>
	            	<div class="form-check form-switch">
						  	<input class="form-check-input" name="mode" type="radio" id="mode1" value="1" checked>
						  	<label class="form-check-label" for="mode1">Smarty Normal</label>
						</div>
	            	<div class="form-check form-switch">
						  	<input class="form-check-input" name="mode" type="radio" id="mode2" value="2">
						  	<label class="form-check-label" for="mode2">SmartyBC permite: <code>{php}</code> y <code>{include_php}</code></label>
						</div>
	               <input type="hidden" name="script" value="<?php echo ($_SERVER["TU_SCRIPT"] == 'phpost') ? 1 : 2; ?>">
	               <input type="hidden" name="version" value="<?php echo $act; ?>">
	               <input type="hidden" name="type" value="smarty">
	               <input type="hidden" name="cont" value="true">
	            </form><!-- :D -->
	         </div>
	         <a href="javascript:upgrade.smarty()" class="btn iniciar btn-sm shadow text-uppercase <?php echo ($alert != 0) ? 'btn-danger' : 'btn-success'; ?>">Seguir <?php echo ($alert != 0) ? 'bajo mi propio riesgo' : 'la instalación'; ?></a>
			<?php endif; ?>
	   </div>
	<?php endif; ?>
<?php endif; ?>
</div>