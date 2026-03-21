<?php
/** 
 * RundizStrap functions file.
 * 
 * @package rundizstrap
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


/*
 * Require Composer's auto load.
 */
require_once 'inc/vendor/autoload.php';

$Rundizstrap = new Rundizstrap\Rundizstrap();
$Rundizstrap->init();
unset($Rundizstrap);

$RundizstrapLoader = new Rundizstrap\Libraries\Loader();
$RundizstrapLoader->autoRegisterClasses();
unset($RundizstrapLoader);
