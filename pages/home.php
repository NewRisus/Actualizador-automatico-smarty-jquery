<?php 
/**
 * Index :: Archivo principal
 *
 * @package New_Risus_Upgrade
 * @author Miguel92 
 * @copyright NewRisus 2021
 * @version v1.4 11-03-2021
 * @link https://newrisus.com
*/
?>
<div class="row mt-4">
   <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-10 col-sm-12 col-12 offset-xxl-2 offset-xl-2 offset-lg-2 offset-md-1 offset-sm-0">
		<p>Bienvenidos al centro de actualización de <b>New Risus</b>, con esta página podrás actualizar la versión de Smarty completamente fácil, solo seleccionando la versión que requieras.</p>
		<p>También podrás realizar la actualización de jQuery y actualizaciones a los archivos js.<br>En el caso que ya hayas realizado una actualización previamente, será mucho más rápido ya que solo reemplazará los archivos necesarios para el correcto funcionamiento del sitio.</p>
		<br>
		<div class="row rows-2">
			<div class="col">
				<div id="smarty" onclick="location.href=global.url + '/<?php echo $_SERVER['TU_SCRIPT']; ?>/smarty'" class="box rounded shadow d-flex justify-content-center align-items-center flex-column py-5">
					<i class="bi bi-hdd-rack"></i>
					<span class="text-white text-uppercase">Actualizar Smarty</span>
				</div>
			</div>
			<div class="col">
				<div id="jquery" onclick="location.href=global.url + '/<?php echo $_SERVER['TU_SCRIPT']; ?>/jquery'" class="box rounded shadow d-flex justify-content-center align-items-center flex-column py-5">
					<i class="bi bi-folder-symlink"></i>
					<span class="text-white text-uppercase">Actualizar jQuery</span>
				</div>
			</div>
		</div>
		<br>
		<p class="small text-muted fst-italic">Si tienes algún error puedes crear un post en <a href="https://newrisus.com/" target="_blank" class="text-primary text-decoration-none">New Risus</a> o crear un issue en github.</p>
	</div>
</div>