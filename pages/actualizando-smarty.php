<?php 
/**
 * Actualizando Smarty :: Archivo para ejecutar funciones sin recargar
 *
 * @package New_Risus_Upgrade
 * @author Miguel92 
 * @copyright NewRisus 2021
 * @version v1.5 11-03-2021
 * @link https://newrisus.com
*/

$raiz = dirname(dirname(__DIR__));
$route = dirname(__DIR__);

if($_POST["script"] == 1):
   function rmdir_recursive($dir) {
      $files = scandir($dir);
      array_shift($files);
      array_shift($files);
      foreach ($files as $file) {
         $file = $dir . '/' . $file;
         if (is_dir($file)) {
            rmdir_recursive($file);
            rmdir($file);
         } else unlink($file);
      }
      rmdir($dir);
   }
   $dir = dirname(dirname(__DIR__)) . '/inc/smarty';
   rmdir_recursive($dir);

endif;
mkdir(dirname(dirname(__DIR__)) . '/inc/smarty');
echo head('Verificacion de instalacion de Smarty');
echo '<div class="box-test">';
echo subhead('Verificacion de directorio');
if (!is_dir($smartydir)) {
   echo verificar(false, 'El directorio de /inc/smarty/ no existe');
   $oops = true;
} else echo verificar(true, 'El directorio de /inc/smarty/ existe');
echo '</div>';
#
echo '<div class="box-test">';
echo subhead('Vaciar directorio de cache');
if($oops != true) {
   $dicache = new RecursiveDirectoryIterator($cachedir, FilesystemIterator::SKIP_DOTS);
   $ricache = new RecursiveIteratorIterator($dicache, RecursiveIteratorIterator::CHILD_FIRST);
   foreach ( $ricache as $filecache ) {
      $filecache->isDir() ?  rmdir($filecache) : unlink($filecache);
   }
   if (count(glob("$cachedir*")) === 0) {
      echo verificar(true, 'El directorio est&aacute; vac&iacute;o.');
   } else{
      echo verificar(false, 'El directorio no est&aacute; vac&iacute;o.');
      $oops = true;
   }
} else echo '<div class="alert alert-danger">Este paso no se pudo completar debido a que un paso anterior no se pudo concretar...</div>';
echo '</div>';

# Descomprimimos el smarty
echo '<div class="box-test">';
echo subhead("Descomprimiendo la <b>versión {$_POST['version']}</b> dentro de la carpeta de Smarty");
$zip = new ZipArchive;
$upgrade = dirname(__DIR__) . "/update/smarty-{$_POST['version']}.zip";
if($oops != true) {
	if ($zip->open($upgrade) === TRUE) {
	   $zip->extractTo( "{$raiz}/inc/smarty" );
	   $zip->close();
	   echo verificar(true, 'Se ha completado el desempaquetado del archivo');
	} else {
	   echo verificar(false, 'No se ha podido completar el proceso de desempaquetado');
	   $oops = true;
	} 
} else echo '<div class="alert alert-danger">Este paso no se pudo completar debido a que un paso anterior no se pudo concretar...</div>';
echo '</div>';

# Descomprimimos el smarty
echo '<div class="box-test">';
echo subhead("Descomprimiendo plugins para Smarty");
$zip = new ZipArchive;
$upgrade = dirname(__DIR__) . "/update/plugins.zip";
if($oops != true) {
   if ($zip->open($upgrade) === TRUE) {
      $zip->extractTo( "{$raiz}/inc/smarty/" );
      $zip->close();
      echo verificar(true, 'Se ha completado el desempaquetado de los plugins');
   } else {
      echo verificar(false, 'No se ha podido completar el proceso de desempaquetado');
      $oops = true;
   } 
} else echo '<div class="alert alert-danger">Este paso no se pudo completar debido a que un paso anterior no se pudo concretar...</div>';
echo '</div>';

# Realizamos el proceso de compatibilidad con el smarty
echo head('Compatibilidad de los archivos');
echo '<div class="box-test">';
echo subhead('Reemplazando el archivo <b>c.smarty.php</b>');
if($oops != true) {
	$replace['file'] = 'c.smarty.php';  # re0
   $replace['from'] = "{$route}/update/{$replace['file']}"; # re1
   $replace['to'] = "{$raiz}/inc/class/{$replace['file']}"; # re2
   # Comprobando que exista el archivo c.smarty.php
   if (!file_exists($replace['to'])) {
   	echo verificar(false, "No existe en tu script ({$replace['to']})");
      $oops = true;
   } else if (!file_exists($replace['from'])) {
   	echo verificar(false, "No existe en la carpeta de actualizaci&oacute;n ({$replace['from']})");
      $oops = true;
   } else if (file_exists($replace['from'])) { //Modo Smarty
      if($_POST['mode'] == 2) $replace['from'] = "{$route}/update/bc/{$replace['file']}";
   }
   if($oops != true) {
   	# Copiamos el archivo a la ubicación predestinada
   	if(!@copy($replace['from'], $replace['to'])) {
      	echo verificar(false, "No ha sido reemplazado.");
      	$oops = true;
   	} else echo verificar(true, "Ha sido reemplazado correctamente.");
   }
} else echo '<div class="alert alert-danger">Este paso no se pudo completar debido a que un paso anterior no se pudo concretar...</div>';
echo '</div>';

echo '<div class="box-test">';
echo subhead('Reemplazar ajax_files.php');
if($oops != true) {
	$replace['file'] = 'ajax_files.php';  # re0
   $replace['from'] = "{$route}/update/{$replace['file']}"; # re1
   $replace['to'] = "{$raiz}/inc/php/{$replace['file']}"; # re2
   # Comprobamos que exista el archivo ajax_files.php
   if (!file_exists($replace['to'])) {
      echo verificar(false, "No existe en tu script ({$replace['to']})");
      $oops = true;
   } else if (!file_exists($replace['from'])) {
      echo verificar(false, "No existe en la carpeta de actualizaci&oacute;n ({$replace['to']})");
      $oops = true;
   }
   if($oops != true) {
   	# Copiamos el archivo a la ubicación predestinada
      if(!@copy($replace['from'], $replace['to'])){
     	 	echo verificar(false, "No ha sido reemplazado.");
         $oops = true;
      } else echo verificar(true, "Ha sido reemplazado correctamente.");
  }
} else echo '<div class="alert alert-danger">Este paso no se pudo completar debido a que un paso anterior no se pudo concretar...</div>';
echo '</div>';

echo '<div class="box-test">';
echo subhead('Sistema de información (New Risus en vivo)');
if($oops != true) {
	$replace['file'] = 'ajax.feed.php';  # re0
   $replace['from'] = "{$route}/update/{$replace['file']}"; # re1
   $replace['to'] = "{$raiz}/inc/php/ajax/{$replace['file']}"; # re2
   # Comprobamos que exista el archivo ajax.feed.php
   if (!file_exists($replace['to'])) {
      echo verificar(false, "No existe en tu script ({$replace['to']})");
      $oops = true;
   } else if (!file_exists($replace['from'])) {
      echo verificar(false, "No existe en la carpeta de actualizaci&oacute;n ({$replace['to']})");
      $oops = true;
   }
   if($oops != true) {
   	# Copiamos el archivo a la ubicación predestinada
      if(!@copy($replace['from'], $replace['to'])) {
     	 	echo verificar(false, "No ha sido reemplazado.");
         $oops = true;
      } else echo verificar(true, "Ha sido reemplazado correctamente.");
   }
} else echo '<div class="alert alert-danger">Este paso no se pudo completar debido a que un paso anterior no se pudo concretar...</div>';
echo '</div>';

echo '<div class="box-test">';
echo subhead('Archivo de ajustes para el sitio');
if($oops != true) {
   $type = ($_POST['script'] == 1) ? 'phpost' : 'newrisus';
   if($oops != true) {
   	# Copiamos el archivo a la ubicación predestinada
      if(!@copy("{$route}/update/ajustes-{$type}.php", "{$raiz}/ajustes.php")) {
     	 	echo verificar(false, "No ha sido reemplazado.");
         $oops = true;
      } else echo verificar(true, "Ha sido creado correctamente.");
   }
} else echo '<div class="alert alert-danger">Este paso no se pudo completar debido a que un paso anterior no se pudo concretar...</div>';
echo '</div>';

echo '<div class="box-test">';
echo subhead('Generador de plantillas (footer.php)');
if($oops != true) {
	$replace['file'] = 'footer.php';  # re0
   $replace['from'] = "{$route}/update/{$replace['file']}"; # re1
   $replace['to'] = "{$raiz}/{$replace['file']}"; # re2
   # Comprobamos que exista el archivo footer.php
   if (!file_exists($replace['to'])) {
      echo verificar(false, "No existe en tu script ({$replace['to']})");
      $oops = true;
   } else if (!file_exists($replace['from'])) {
      echo verificar(false, "No existe en la carpeta de actualizaci&oacute;n ({$replace['to']})");
      $oops = true;
   }
   if($oops != true) {
   	# Copiamos el archivo a la ubicación predestinada
      if(!@copy($replace['from'], $replace['to'])) {
     	 	echo verificar(false, "No ha sido reemplazado.");
         $oops = true;
      } else echo verificar(true, "Ha sido reemplazado correctamente.");
   }
} else echo '<div class="alert alert-danger">Este paso no se pudo completar debido a que un paso anterior no se pudo concretar...</div>';
echo '</div>';

echo '<div class="box-test">';
echo subhead('Realizo cambios en header.php');
$ptf = "{$raiz}/header.php";
# DEFINIMOS RUTA DE SMARTY
$fc1 = file_get_contents($ptf);
$fc1 = str_replace("define('TS_EXTRA', TS_ROOT.'/inc/ext/');","define('TS_EXTRA', TS_ROOT.'/inc/ext/');\n\n    define('TS_SMARTY', TS_ROOT.'/inc/smarty/');", $fc1);
file_put_contents($ptf,$fc1);
# INSERTAMOS UN ARCHIVO DE CONFIGURACIÓN
$fc4 = file_get_contents($ptf);
$fc4 = str_replace("\$smarty->assign('tsMPs', \$tsMP->mensajes);","\$smarty->assign('tsMPs', \$tsMP->mensajes);\n\n    # NUEVO ARCHIVO DE CONFIGURACION by Miguel92\n    include TS_ROOT . '/ajustes.php';", $fc4);
file_put_contents($ptf,$fc4);
# CAMIAMOS EL ARCHIVO DE SMARTY
$fc2 = file_get_contents($ptf);
$fc2 = str_replace("TS_CLASS.'c.smarty.php'","TS_SMARTY.'SmartyBC.class.php'", $fc2);
file_put_contents($ptf,$fc2);
# CAMBIAMOS LA CLASE DE SMARTY
$fc3 = file_get_contents($ptf);
$fc3 = str_replace("new tsSmarty()","new SmartyBC()", $fc3);
file_put_contents($ptf,$fc3);
echo verificar(true, "Se ha modificado correctamente.");
echo '</div>';

# Terminando
echo head('Terminar Actualizacion');
# Creamos una ruta "url"
$url_base = "{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["HTTP_HOST"]}" . dirname(dirname($_SERVER["PHP_SELF"]));
?>
<div class="alert alert-<?php echo ($oops == true) ? 'danger' : 'success'; ?>">
	<i class="bi bi-exclamation-square-fill"></i> La modificacion  <?php echo ($oops == true) ? 'no se ha podido instalar correctamente...' : 'se ha instalado correctamente.'; ?>
</div>

<div class="alert alert-warning">
	<i class="bi bi-exclamation-square-fill"></i> No se te olvide eliminar la carpeta <code>/<?php echo basename(dirname(__DIR__)); ?>/</code>
</div>
<div class="my-3">
	<a class="btn btn-primary me-3" href="<?php echo $tsCore->settings['url']; ?>" role="button">Volver a <?php echo $tsCore->settings['titulo']; ?></a> 
	<a class="btn btn-danger" href="<?php echo $url_base; ?>" role="button">Volver al inicio</a>
</div>