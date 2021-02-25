<?php

/**
 * App :: Archivo con algunas configuraciones globales
 *
 * @package New_Risus_Upgrade
 * @author Miguel92 
 * @copyright NewRisus 2021
 * @version v1.0 23-02-2021
 * @link https://newrisus.com
*/

# Creamos una ruta "url"
$url_base = "{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["HTTP_HOST"]}" . dirname($_SERVER["PHP_SELF"]);

# Definimos la ruta de "script_upgrade"
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('SEP', DIRECTORY_SEPARATOR);

# Asignamos la ulr creada
define('TS_URL', $url_base);

# Variable para el manejo de algunas acciones 
$pagina = isset($_GET['do']) ? htmlentities($_GET['do']) : 'home';

# Hacemos que el titulo sea dinamico.
$title = isset($_GET['do']) ? 'NR2: Actualizando - ' . ucfirst($_GET['do']) : 'New Risus: Upgrade';