<?php 

/**
 * Index :: Aplicación para actualizar el sitio
 *
 * @package New_Risus_Upgrade
 * @author Miguel92 
 * @copyright NewRisus 2021
 * @version v1.4 11-03-2021
 * @link https://newrisus.com
*/

include __DIR__ . DIRECTORY_SEPARATOR . "app.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="shortcut icon" href="<?php echo $url_base . '/assets/images/favicon.ico'; ?>" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo $url_base . '/assets/css/bootstrap.min.css?' . time(); ?>">
<link rel="stylesheet" href="<?php echo $url_base . '/assets/css/bootstrap-icons.min.css?' . time(); ?>">
<link rel="stylesheet" href="<?php echo $url_base . '/assets/css/estilo.css?' . time(); ?>">
<script src="<?php echo $url_base . '/assets/js/jquery.min.js?' . time(); ?>"></script>
<script>
var global = {
	url: '<?php echo $url_base; ?>',
	pagina: '<?php echo $pagina; ?>',
}
</script>
<title><?php echo $title; ?></title>
</head>
<body class="bg-dark text-white">
	
		
	
		<div class="py-3 text-center logo-header">
			<img src="<?php echo $url_base . '/assets/images/logo-complete.webp'; ?>" class="img-fluid nrlogo" alt="New Risus Upgrade">
		</div>
		<div class="container">
			<?php if(!$_SERVER['TU_SCRIPT']): ?>
				<div class="d-flex justify-content-center align-items-center">
					<div class="w-50 mx-auto mt-5">
						<p>Selecciona el script que estas utilizando:</p>
						<div class="row rows-2">
							<div class="col">
								<div id="smarty" onclick="location.href=global.url + '/phpost/'" class="box rounded shadow d-flex justify-content-center align-items-center flex-column py-5">
									<i class="bi bi-hdd-rack"></i>
									<span class="text-white text-uppercase">PHPost Risus</span>
								</div>
							</div>
							<div class="col">
								<div id="jquery" onclick="location.href=global.url + '/newrisus/'" class="box rounded shadow d-flex justify-content-center align-items-center flex-column py-5">
									<i class="bi bi-hdd-rack"></i>
									<span class="text-white text-uppercase">New Risus</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<?php include ROOT . "pages/{$pagina}.php"; ?>
			<?php endif; ?>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
		<script src="<?php echo $url_base . '/assets/js/upgrade.js?' . time(); ?>"></script>
		<footer class="text-center py-4">
	      <p class="m-0 p-0 ">Copyright <?php echo date("Y"); ?> &copy; <a href="https://newrisus.com" target="_blank">New Risus</a></p> 
	      <?php if($pagina == 'smarty'): ?>
	      	<p class="m-0 p-0 small text-muted">Versi&oacute;n del mod: v1.4 - <a href="<?php echo $url_base; ?>changelog.txt" class="text-muted">Historial de cambios</a></p>
	      <?php endif; ?>
	   </footer>
</body>
</html>