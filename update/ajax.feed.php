<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.feed.php
 * @author  PHPost Team
*/

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.live.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/

// DEPENDE EL NIVEL
$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
if($tsLevelMsg != 1) { 
	echo '0: '.$tsLevelMsg['mensaje']; 
	die();
}
 //
$code = [
   'w' => $tsCore->settings['titulo'],
   's' => $tsCore->settings['slogan'],
   'u' => str_replace('http://', '', $tsCore->settings['url']),
   'v' => $tsCore->settings['version_code'],
   'a' => $tsUser->nick,
   'i' => $tsUser->uid,
];
$key = base64_encode(serialize($code));
	// CODIGO
	switch($action){
		case 'feed-support':
			//<--- CONSULTAR ACTUALIZACIONES OFICIALES Y VERIFICAR VERSIÓN ACTUAL DE ESTE SCRIPT
         $json = $tsCore->getUrlContent('https://newrisus.com/news/index.php?type=support&key='.$key);
         if(substr($json,0,1) == '0') eval(base64_decode(substr($json,2)));
         else echo $json;
			//--->
		break;
		case 'feed-version':
			/**
          * Versión a 20 de marzo de 2021 *
          * PHPost Risus 1.4 *
         */
         $version_now = 'Risus 1.4';
         # ACTUALIZAR VERSIÓN
         if($tsCore->settings['version'] != $version_now){
            db_exec(array(__FILE__, __LINE__), 'query', 'ALTER TABLE `w_configuracion` CHANGE `version` `version` VARCHAR(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'');
            db_exec(array(__FILE__, __LINE__), 'query', 'ALTER TABLE `w_configuracion` CHANGE `version_code` `version_code` VARCHAR(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'');
			   db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_configuracion` SET version = \''.$version_now.'\', version_code = \'risus_1_4\' WHERE tscript_id = \'1\' LIMIT 1');
            db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET stats_time_upgrade = \''.time().'\' WHERE stats_no = \'1\' LIMIT 1');
         }
			//<---
         $json = $tsCore->getUrlContent('https://newrisus.com/news/index.php?type=version&key='.$key);
         echo $json;
			//--->
		break;
      default:
         die('0: Este archivo no existe.');
      break;
	}