<?php
/** 
 * Bootstrap Basic FSE functions file.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


require_once 'inc/vendor/autoload.php';

$BsbFSE = new BootstrapBasicFSE\BootstrapBasicFSE();
$BsbFSE->init();
unset($BsbFSE);

$Loader = new BootstrapBasicFSE\Libraries\Loader();
$Loader->autoRegisterClasses();
unset($Loader);
