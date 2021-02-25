<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Smarty :: Modelo para instanciar smarty
 *
 * @package Smarty 3.1.39
 * @author PHPost Team / bits4me & MrDioamDev & Miguel92
 * @copyright NewRisus 2021
 * @version v1.0 23-02-2021
 * @link https://newrisus.com
 * @file c.smarty.php
*/

require(TS_ROOT. DIRECTORY_SEPARATOR .'inc'. DIRECTORY_SEPARATOR .'smarty'. DIRECTORY_SEPARATOR .'Smarty.class.php');

class tsSmarty extends Smarty {
   var $_tpl_hooks;
   var $_tpl_hooks_no_multi = TRUE;
    
   public static function &getInstance() {
      static $instance; 
      if( is_null($instance) ) $instance = new Smarty();
      return $instance;
   }  
   #
   function tsSmarty() {
      global $tsCore;
      #
      $Root = TS_ROOT . DIRECTORY_SEPARATOR;
      # necesario para que smarty pueda imprimir la plantilla
      parent::__construct();
      # setea los directorios para smarty 
      $this->setTemplateDir($Root .'themes'. DIRECTORY_SEPARATOR . TS_TEMA . DIRECTORY_SEPARATOR . 'templates');
      $this->setCompileDir($Root . 'cache' . DIRECTORY_SEPARATOR . 'templates_c');
      $this->setCacheDir($Root . 'cache' . DIRECTORY_SEPARATOR . 'cache');
      # Config dir
      $this->setConfigDir([
         'url' => $tsCore->settings['url'],
         'title' => $tsCore->settings['titulo']
      ]);
      # define si smarty esta en modo depuracion
      $this->debugging = false;
      # define la configuracion de cache
      $this->caching = false; 
      # define tiempo de vida de cache, si esta activa 
      $this->cache_lifetime = 10; 
      # no se que es xd
      $this->_tpl_hooks = array();
   }
   # Function assign hook
   function assign_hook($hook, $include) {
      if( !isset($this->_tpl_hooks[$hook]) ) $this->_tpl_hooks[$hook] = array();
      if( $this->_tpl_hooks_no_multi && in_array($include, $this->_tpl_hooks[$hook]) ) return;
      $this->_tpl_hooks[$hook][] = $include;
   }
}