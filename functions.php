<?php
/** 
 * RundizStrap functions file.
 * 
 * @package rundizstrap
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


require_once 'inc/vendor/autoload.php';

$Rundizstrap = new Rundizstrap\Rundizstrap();
$Rundizstrap->init();
unset($Rundizstrap);

$Loader = new Rundizstrap\Libraries\Loader();
$Loader->autoRegisterClasses();
unset($Loader);
