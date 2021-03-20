<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Footer :: El footer permite mostrar la plantilla
 *
 * @package Smarty 3.1.39
 * @author PHPost Team & Miguel92 
 * @copyright NewRisus 2021
 * @version v1.0 23-02-2021
 * @link https://newrisus.com
*/


# Página solicitada
$smarty->assign("tsPage",$tsPage);

# Mostramos la plantilla
if($smarty->templateExists("t.{$tsPage}.tpl")) $smarty->display("t.{$tsPage}.tpl");
else die("0: Lo sentimos, se produjo un error al cargar la plantilla 't.{$tsPage}.tpl' en su theme actual. Contacte al administrador");