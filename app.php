<?php

/**
 * App :: Archivo con algunas configuraciones globales
 *
 * @package New_Risus_Upgrade
 * @author Miguel92 
 * @copyright NewRisus 2021
 * @version v1.4 11-03-2021
 * @link https://newrisus.com
*/

# Creamos una ruta "url"
$url_base = "{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["HTTP_HOST"]}" . dirname($_SERVER["PHP_SELF"]);

# Definimos la ruta de "script_upgrade"
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('SEP', DIRECTORY_SEPARATOR);

# Asignamos la ulr creada
define('TS_URL', $url_base);

$_SERVER['TU_SCRIPT'] = (isset($_GET['script']) ? htmlentities($_GET['script']) : '');

# Variable para el manejo de algunas acciones 
$pagina = isset($_GET['upgrade']) ? htmlentities($_GET['upgrade']) : 'home';

$tile1 = ($_SERVER['TU_SCRIPT'] == 'phpost') ? 'PR' : 'NR2';
$tile2 = ($_SERVER['TU_SCRIPT'] == 'phpost') ? 'PHPost Risus' : 'New Risus';

# Hacemos que el titulo sea dinamico.
$title = isset($_GET['upgrade']) ? "{$tile1}: Actualizando - " . ucfirst($_GET['upgrade']) : "{$tile2}: Upgrade";