<?php if(!defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Ajustes :: Algunos ajustes para la configuración de Smarty
 *
 * @package Smarty 3.1.x
 * @author Miguel92
 * @copyright NewRisus 2021
 * @version v1.0 24-02-2021
 * @link https://newrisus.com
 * @file ajustes.php
*/
/*
 *  Acá definimos la carpeta donde se almacenarán los archivos caché 
 * que se generan automáticamente al utilizar el sitio web
*/
define('TS_CACHE', TS_ROOT.DIRECTORY_SEPARATOR.'cache');
/*
 * Esta instrucción enviará los archivo caché a la carpeta 
 * que hemos definido antes
*/
$smarty->setCompileDir(TS_CACHE.DIRECTORY_SEPARATOR.TS_TEMA)
/*
 * Este arreglo es para habilitar el acceso a los tpl.
*/
->setTemplateDir([
	/* ↓ Templates ↓ */
	'One' => TS_ROOT.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.TS_TEMA.DIRECTORY_SEPARATOR.'templates',
	/* ↓ Login & Registro ↓ */
	'Two' => TS_ROOT . DIRECTORY_SEPARATOR . 'auth',
	/* ↓ Administración & Moderación ↓ */
	'Three' => TS_ROOT . DIRECTORY_SEPARATOR . 'dashboard',
])
/*
 * Esta instrucción evitará acceso externo sin permisos.
*/
->enableSecurity();

/* COMPRIME EL HTML PARA MÁS VELOCIDAD */
$smarty->loadFilter('output', 'trimwhitespace');

/* PARA LAS CLAVES DE RECAPTCHA */
$smarty->assign('tsPkey', $tsCore->settings['pkey']);

/**
 * -------------------------------------------------------------------
 * DAMOS LA UBICACIÓN GEOGRÁFICA 
 * Página: https://www.php.net/manual/es/timezones.php
 * -------------------------------------------------------------------
*/
date_default_timezone_set('America/Argentina/Buenos_Aires');
/**
 * -------------------------------------------------------------------
 * FORZAMOS EL IDIOMA EN ESPAÑOL 
 * Página: https://www.php.net/manual/es/function.setlocale.php
 * -------------------------------------------------------------------
*/
$lang = explode(',', $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
$locale = $lang[0];
setlocale(LC_ALL, $locale);
setlocale(LC_TIME, 'spanish');
// windows
putenv("LC_ALL={$locale}"); 
$smarty->assign('Lenguaje', $locale);